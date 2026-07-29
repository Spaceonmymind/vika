<?php

namespace Modules\AppointmentToDoctorWidget\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Context;
use Illuminate\Support\Facades\Log;
use Modules\AppointmentToDoctorWidget\Services\AppointmentToDoctorService;
use Modules\AppointmentToDoctorWidget\Swagger\Docs\Attributes\BookSlot;
use Modules\AppointmentToDoctorWidget\Swagger\Docs\Attributes\CancelBooking;
use Modules\AppointmentToDoctorWidget\Swagger\Docs\Attributes\FindPeopleByMax;
use Modules\AppointmentToDoctorWidget\Swagger\Docs\Attributes\GetBooksByPatientId;
use Modules\AppointmentToDoctorWidget\Swagger\Docs\Attributes\GetDataForCancelBooking;
use Modules\AppointmentToDoctorWidget\Swagger\Docs\Attributes\GetDoctorFreeSlots;
use Modules\AppointmentToDoctorWidget\Swagger\Docs\Attributes\GetDoctorSpecialities;
use Modules\AppointmentToDoctorWidget\Swagger\Docs\Attributes\GetDoctorsWithFreeSlots;
use Modules\AppointmentToDoctorWidget\Swagger\Docs\Attributes\GetMedOrganisationsForPatient;
use Modules\AppointmentToDoctorWidget\Swagger\Docs\Attributes\GetTmkConsultations;
use Modules\AppointmentToDoctorWidget\Swagger\Docs\Attributes\IsUserSavedContact;
use Modules\AppointmentToDoctorWidget\Swagger\Docs\Attributes\SaveMaxContact;
use OpenApi\Attributes as OA;

#[OA\Tag(name: 'AppointmentToDoctorWidget', description: 'Виджет записи на приём к врачу')]
class AppointmentToDoctorController extends Controller
{
    private AppointmentToDoctorService $appointmentToDoctorService;

    /**
     * @param AppointmentToDoctorService $appointmentToDoctorService
     */
    public function __construct(AppointmentToDoctorService $appointmentToDoctorService)
    {
        Context::add('module', 'AppointmentToDoctorWidget');
        $this->appointmentToDoctorService = $appointmentToDoctorService;
    }

    #[FindPeopleByMax]
    public function findPeopleByMax(Request $request)
    {
        $validated = $request->validate([
            'web_app_data' => 'required|array',
            'web_app_data.auth_date' => 'sometimes|integer|nullable',
            'web_app_data.ip' => 'sometimes|string|nullable',

            'web_app_data.chat' => 'sometimes|array',
            'web_app_data.chat.id' => 'sometimes|integer|nullable',
            'web_app_data.chat.type' => 'sometimes|string|nullable',

            'web_app_data.query_id' => 'sometimes|string',

            'web_app_data.user' => 'required|array',
            'web_app_data.user.id' => 'required|integer|nullable',
            'web_app_data.user.first_name' => 'required|string',
            'web_app_data.user.last_name' => 'sometimes|string|nullable',
            'web_app_data.user.language_code' => 'sometimes|string',
            'web_app_data.user.username' => 'sometimes|string|nullable',
            'web_app_data.user.photo_url' => 'sometimes|string|nullable',
        ]);
        return $this->appointmentToDoctorService->findPeopleByMax($validated['web_app_data']['user']['id']);
    }

    #[GetMedOrganisationsForPatient]
    public function getMedOrganisationsForPatient(Request $request)
    {
        $validated = $request->validate([
            'patient_id' => 'required|string',
        ]);
        return $this->appointmentToDoctorService->getMedOrganisationsForPatient($validated['patient_id']);
    }

    #[GetDoctorSpecialities]
    public function getDoctorSpecialities(Request $request)
    {
        $validated = $request->validate([
            'med_organisation_guid' => 'required|string',
            'patient_id' => 'required|string',
        ]);
        return $this->appointmentToDoctorService->getDoctorSpecialities($validated['med_organisation_guid'], $validated['patient_id']);
    }

    #[GetDoctorsWithFreeSlots]
    public function getDoctorsWithFreeSlots(Request $request)
    {
        $validated = $request->validate([
            'med_organisation_guid' => 'required|string',
            'post_id' => 'required|string',
        ]);
        return $this->appointmentToDoctorService->getDoctorsWithFreeSlots($validated['med_organisation_guid'], $validated['post_id']);
    }

    #[GetDoctorFreeSlots]
    public function getDoctorFreeSlots(Request $request)
    {
        $validated = $request->validate([
            'med_organisation_guid' => 'required|string',
            'post_id' => 'required|string',
            'doctor_id' => 'required|string',
        ]);
        return $this->appointmentToDoctorService->getDoctorFreeSlots(
            $validated['med_organisation_guid'],
            $validated['post_id'],
            $validated['doctor_id'],
        );
    }

    #[IsUserSavedContact]
    public function isUserSavedContact(Request $request)
    {
        $validated = $request->validate([
            'web_app_data' => 'required|array',
            'web_app_data.auth_date' => 'sometimes|integer',
            'web_app_data.ip' => 'sometimes|string|nullable',

            'web_app_data.chat' => 'sometimes|array',
            'web_app_data.chat.id' => 'sometimes|integer',
            'web_app_data.chat.type' => 'sometimes|string',

            'web_app_data.query_id' => 'sometimes|string',

            'web_app_data.user' => 'required|array',
            'web_app_data.user.id' => 'required|integer',
            'web_app_data.user.first_name' => 'required|string',
            'web_app_data.user.last_name' => 'sometimes|string|nullable',
            'web_app_data.user.language_code' => 'sometimes|string',
            'web_app_data.user.username' => 'sometimes|string|nullable',
            'web_app_data.user.photo_url' => 'sometimes|string|nullable',

        ]);

        return $this->appointmentToDoctorService->isUserSavedContact($validated['web_app_data']);
    }

    #[SaveMaxContact]
    public function saveMaxContact(Request $request)
    {
        $validated = $request->validate([
            'web_app_data' => 'required|array',
            'web_app_data.auth_date' => 'sometimes|integer',
            'web_app_data.ip' => 'sometimes|string|nullable',

            'web_app_data.chat' => 'sometimes|array',
            'web_app_data.chat.id' => 'sometimes|integer',
            'web_app_data.chat.type' => 'sometimes|string',

            'web_app_data.query_id' => 'sometimes|string',

            'web_app_data.user' => 'required|array',
            'web_app_data.user.id' => 'required|integer',
            'web_app_data.user.first_name' => 'required|string',
            'web_app_data.user.last_name' => 'sometimes|string|nullable',
            'web_app_data.user.language_code' => 'sometimes|string',
            'web_app_data.user.username' => 'sometimes|string|nullable',
            'web_app_data.user.photo_url' => 'sometimes|string|nullable',

            'phone' => 'required|string|min:10',
        ]);
        return $this->appointmentToDoctorService->saveMaxContact($validated['web_app_data'], $validated['phone']);
    }

    #[BookSlot]
    public function bookSlot(Request $request)
    {
        $validated = $request->validate([
            'patient_id' => 'required|string',
            'depart_oid' => 'required|string',
            'mo_oid' => 'required|string',
            'slot_id' => 'required|string',
        ]);
        return $this->appointmentToDoctorService->bookSlot($validated['patient_id'], $validated['slot_id'], $validated['depart_oid'], $validated['mo_oid']);
    }

    #[CancelBooking]
    public function cancelBooking(Request $request)
    {
        $validated = $request->validate([
            'slot_id' => 'required|string',
            'depart_oid' => 'required|string',
            'mo_oid' => 'required|string',
            'book_ext_id' => 'required|string',
            'patient_id' => 'required|string',
        ]);

        return $this->appointmentToDoctorService->cancelBooking(
            $validated['slot_id'],
            $validated['patient_id'],
            $validated['depart_oid'],
            $validated['mo_oid'],
            $validated['book_ext_id'],
        );
    }

    #[GetBooksByPatientId]
    public function getBooksByPatientId(Request $request)
    {
        $validated = $request->validate([
            'patient_id' => 'required|string',
        ]);

        return $this->appointmentToDoctorService->getBooksByPatientId($validated['patient_id']);
    }

    #[GetDataForCancelBooking]
    public function getDataForCancelBooking(Request $request)
    {
        $validated = $request->validate([
            'slot_id' => 'required|string',
            'resource_id' => 'required|string',
            'patient_id' => 'required|string',
        ]);

        return $this->appointmentToDoctorService->getDataForCancelBooking(
            $validated['slot_id'],
            $validated['resource_id'],
            $validated['patient_id'],
        );
    }

    #[GetTmkConsultations]
    public function getTmkConsultations(Request $request)
    {
        $validated = $request->validate([
            'patient_id' => 'required|string',
        ]);
        usleep(rand(1_000_000, 10_000_000));
        return [
            'success' => false,
            'consultations' => [],
            'error' => 'У вас нет активной возможности записи на телемедицинскую консультацию, запишитесь к необходимому специалисту и после приема вам назначат ТМК при необходимости',
        ];
    }
}
