<?php

use Illuminate\Support\Facades\Route;
use Modules\AppointmentToDoctorWidget\Http\Controllers\AppointmentToDoctorController;
use Modules\AppointmentToDoctorWidget\Http\Middleware\CheckMaxDataValid;

Route::prefix('widget/appointment_to_doctor')->middleware([CheckMaxDataValid::class])->group(function () {
    Route::post('is_user_saved_contact', [AppointmentToDoctorController::class, 'isUserSavedContact']);
    Route::post('save_max_contact', [AppointmentToDoctorController::class, 'saveMaxContact']);
    Route::post('find_people_by_max', [AppointmentToDoctorController::class, 'findPeopleByMax']);
    Route::post('get_med_organisations', [AppointmentToDoctorController::class, 'getMedOrganisationsForPatient']);
    Route::post('get_doctor_specialities', [AppointmentToDoctorController::class, 'getDoctorSpecialities']);
    Route::post('get_doctors_with_free_slots', [AppointmentToDoctorController::class, 'getDoctorsWithFreeSlots']);
    Route::post('get_doctor_free_slots', [AppointmentToDoctorController::class, 'getDoctorFreeSlots']);
    Route::post('book', [AppointmentToDoctorController::class, 'bookSlot']);
    Route::post('cancel_booking', [AppointmentToDoctorController::class, 'cancelBooking']);

    Route::post('get_tmk_consultations', [AppointmentToDoctorController::class, 'getTmkConsultations']);

    Route::post('get_booking_list', [AppointmentToDoctorController::class, 'getBooksByPatientId']);
    Route::post('get_data_for_cancel_booking', [AppointmentToDoctorController::class, 'getDataForCancelBooking']);
});
