<?php

namespace Modules\AppointmentToDoctorWidget\Services;

use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Modules\AppointmentToDoctorWidget\Models\AppointmentToDoctorMaxContact;
use Modules\AppointmentToDoctorWidget\Services\External\BookService;
use Modules\AppointmentToDoctorWidget\Services\External\FerService;
use Modules\AppointmentToDoctorWidget\Services\External\RrpService;

class AppointmentToDoctorService
{
    private FerService $fer;
    private RrpService $rrp;
    private BookService $bookService;

    /**
     * @param FerService $fer
     * @param RrpService $rrp
     * @param BookService $bookService
     */
    public function __construct(FerService $fer, RrpService $rrp, BookService $bookService)
    {
        $this->fer = $fer;
        $this->rrp = $rrp;
        $this->bookService = $bookService;
    }

    /**
     * Поиск информации о пользователе по его номеру телефона, сохранённому из Max
     * @param string $maxUserId
     * @return array
     */
    public function findPeopleByMax(string $maxUserId)
    {
        $maxContact = AppointmentToDoctorMaxContact::query()->where('user_id', $maxUserId)->first();

        if (!isset($maxContact)) {
            return [
                'success' => false,
                'error' => 'Контакт не найден, пожалуйста, сохраните контакт',
            ];
        }

        $phone = Str::substr($maxContact->phone, 1);

        $patients = $this->rrp->findPatient($phone);

        if ($patients === null) {
            return [
                'success' => false,
                'error' => 'Сервис временно недоступен, попробуйте позже',
            ];
        }

        if (empty($patients)) {
            return [
                'success' => false,
                'error' => 'Пациенты, с указанным в вашем профиле MAX номером телефона, не найдены, обратитесь в регистратуру вашей мед. организации для внесения номера телефона',
            ];
        }

        return [
            'success' => true,
            'patients' => $patients,
        ];
    }

    /**
     * Получение списка мед. организаций, в которых пациент может записаться на приём
     * @param string $patientId
     * @return array
     */
    public function getMedOrganisationsForPatient(string $patientId)
    {
        $medOrganisations = $this->fer->getMedOrganisationsForPatient($patientId);
        if (!isset($medOrganisations)) {
            return [
                'success' => false,
                'error' => 'Сервис временно недоступен, попробуйте позже',
            ];
        }

        return [
            'success' => true,
            'med_organisations' => $medOrganisations,
        ];
    }

    /**
     * Получение списка специальностей врачей, к которым пациент может записаться на приём
     * @param string $medOrganisationGuid
     * @param string $patientId
     * @return array
     */
    public function getDoctorSpecialities(string $medOrganisationGuid, string $patientId)
    {
        $doctorSpecialities = $this->fer->getDoctorSpecialitiesWithSlotsForPatient($medOrganisationGuid, $patientId);
        if (!isset($doctorSpecialities)) {
            return [
                'success' => false,
                'error' => 'Сервис временно недоступен, попробуйте позже',
            ];
        }

        return [
            'success' => true,
            'doctor_specialities' => $doctorSpecialities,
        ];

    }

    /**
     * Получение списка врачей с доступными слотами для записи на приём
     * @param string $medOrganisationGuid
     * @param string $postId
     * @return array
     */
    public function getDoctorsWithFreeSlots(string $medOrganisationGuid, string $postId)
    {
        $doctorsFreeSlots = $this->fer->getDoctorsFreeSlots($medOrganisationGuid, $postId);
        if (!isset($doctorsFreeSlots)) {
            return [
                'success' => false,
                'error' => 'Сервис временно недоступен, попробуйте позже',
            ];
        }

        $doctors = [];

        foreach ($doctorsFreeSlots as $doctorFreeSlot) {

            if (!isset($doctors[$doctorFreeSlot['resource_id']])) {
                $doctors[$doctorFreeSlot['resource_id']] = [
                    'id' => $doctorFreeSlot['resource_id'],
                    'last_name' => $doctorFreeSlot['resource_lastname'],
                    'first_name' => $doctorFreeSlot['resource_firstname'],
                    'middle_name' => $doctorFreeSlot['resource_middlename'],
                    'free_slots_count' => 0,
                ];
            }

            $doctors[$doctorFreeSlot['resource_id']]['free_slots_count']++;
        }

        return [
            'success' => true,
            'doctors' => array_values($doctors),
        ];
    }

    /**
     * Получение списка свободных слотов для записи на приём к конкретному врачу
     * @param string $medOrganisationGuid
     * @param string $postId
     * @param string $doctorId
     * @return array
     */
    public function getDoctorFreeSlots(string $medOrganisationGuid, string $postId, string $doctorId)
    {
        $doctorsFreeSlots = $this->fer->getDoctorsFreeSlots($medOrganisationGuid, $postId);
        if (!isset($doctorsFreeSlots)) {
            return [
                'success' => false,
                'error' => 'Сервис временно недоступен, попробуйте позже',
            ];
        }

        return [
            'success' => true,
            'free_slots' => collect($doctorsFreeSlots)
                ->where('resource_id', $doctorId)
                ->sortBy('visit_time')
                ->map(function ($item) {
                    $visitTime = Carbon::parse($item['visit_time']);
                    return [
                        'id' => $item['id'],
                        'date' => $visitTime->format('d.m.Y'),
                        'time' => $visitTime->format('H:i'),
                        'duration' => $item['duration'],
                    ];
                })
                ->groupBy('date')
                ->map(function ($item, $key) {
                    return [
                        'date' => $key,
                        'slots' => $item,
                    ];
                })
                ->values()
                ->all(),
        ];
    }

    /**
     * Сохранение контакта пользователя из Max
     * @param $webAppData
     * @param $phone
     * @return array
     */
    public function saveMaxContact($webAppData, $phone)
    {
        $phone = $this->validatePhone($phone);
        if (
            AppointmentToDoctorMaxContact::query()
                ->where('user_id', $webAppData['user']['id'])
                ->exists()
        ) {
            return [
                'success' => false,
                'error' => 'Контакт уже сохранён',
            ];
        }
        AppointmentToDoctorMaxContact::query()->create([
            'user_id' => $webAppData['user']['id'],
            'last_name' => $webAppData['user']['last_name'] ?? null,
            'first_name' => $webAppData['user']['first_name'] ?? null,
            'phone' => $phone,
        ]);

        return ['success' => true];
    }

    private function validatePhone($phone)
    {
        $phone = Str::replaceMatches('/\D/', '', $phone);
        if (Str::startsWith($phone, '8')) {
            $phone = Str::replaceFirst('8', '7', $phone);
        }
        if (strlen($phone) === 10) {
            $phone = '7' . $phone;
        }
        return $phone;
    }

    /**
     * Проверка, сохранён ли контакт пользователя из Max
     * @param array $webAppData
     * @return array
     */
    public function isUserSavedContact(array $webAppData)
    {
        return [
            'has_contact' => AppointmentToDoctorMaxContact::query()
                ->where('user_id', $webAppData['user']['id'])
                ->exists(),
        ];
    }

    /**
     * Запись пациента на приём к врачу
     * @param string $patientId
     * @param string $slotId
     * @param string $departOid
     * @param string $moOid
     * @return array
     */
    public function bookSlot(string $patientId, string $slotId, string $departOid, string $moOid)
    {
        $bookingResult = $this->bookService->bookSlot($patientId, $slotId, $departOid, $moOid);
        if (!isset($bookingResult)) {
            return [
                'success' => false,
                'error' => 'Сервис временно недоступен, попробуйте позже',
            ];
        }

        if ($bookingResult['type'] == 'BookResponseError') {

            $errorMessage = match( $bookingResult['status']['statusCode']){
                //Коды ошибок взяты из регламента
                11=>'Выбранное время занято, попробуйте выбрать другое время',
                12=>'У вас есть запись к другому специалисту на то же время, попробуйте выбрать другое время',
                13=>'У вас уже есть активная запись на приём к специалисту данной специальности',
                14=>'Вы не можете записаться к этому специалисту, так как он ведет прием для другой возрастной категории пациентов',
                15=>'Данная запись была аннулирована. Пожалуйста, выберите другое время',
                default=>'Не удалось записаться на приём, попробуйте выбрать другое время, либо попробуйте позже',
            };

            return [
                'success' => false,
                'error' => $errorMessage,
            ];
        }
        return [
            'success' => true,
            'book_ext_id' => $bookingResult['book_ext_id'],
        ];
    }

    public function cancelBooking(string $slotId, string $patientId, string $departOid, string $moOid, string $bookExtId)
    {
        $cancelResult = $this->bookService->cancelBooking($slotId, $patientId, $departOid, $moOid, $bookExtId);
        if (!isset($cancelResult) || $cancelResult['type'] == 'BookResponseError') {
            return [
                'success' => false,
                'error' => 'Сервис временно недоступен, пожалуйста, попробуйте позже',
            ];
        }
        return [
            'success' => true,

        ];
    }

    /**
     * Получить список броней слотов по ID пациента
     * @param string $patientId
     * @return array
     */
    public function getBooksByPatientId(string $patientId): array
    {
        $books = $this->fer->getBooksByPatientId($patientId);
        if ($books === null) {
            return [
                'success' => false,
                'error' => 'Сервис временно недоступен, вы сможете отменить запись через портал пациента',
            ];
        }
        return [
            'success' => true,
            'booking_list' => $books,
        ];
    }

    /**
     * Получить данные для отмены записи
     * @param string $slotId
     * @param string $resourceId
     * @param string $patientId
     * @return array
     */
    public function getDataForCancelBooking(string $slotId, string $resourceId, string $patientId)
    {
        $data = $this->fer->getDataForCancelBooking($slotId, $resourceId, $patientId);
        if ($data === null) {
            return [
                'success' => false,
                'error' => 'Сервис временно недоступен, вы сможете отменить запись через портал пациента',
            ];
        }
        return [
            'success' => true,
            'slot' => $data,
        ];
    }
}
