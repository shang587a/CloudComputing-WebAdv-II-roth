<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminApiController;
use App\Http\Controllers\AppointmentApiController;
use App\Http\Controllers\DoctorApiController;
use App\Http\Controllers\IllnessApiController;
use App\Http\Controllers\PatientApiController;
use App\Http\Controllers\PatientIllnessApiController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DoctorAuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'registerPatient']); // Public
Route::get('/testAPI', fn() => response()->json(["msg" => "API connection is working"], 200));

Route::middleware('auth:sanctum')->group(function () {

    // DEPEND ON LOG IN

    // DOCTOR
    Route::get('/showDoctor', [DoctorApiController::class,'getAllDoctor']);
    Route::post('/insertdoctor', [DoctorApiController::class,'insertDoctor']);
    Route::put('/updatedoctor/{id}', [DoctorApiController::class, 'updateDoctor']);
    Route::delete('/deletedoctors/{id}', [DoctorApiController::class, 'deleteDoctor']);

    // APPOINTMENTS
    Route::get('/showAppointment', [AppointmentApiController::class, 'getAllAppointments']);
    Route::post('/insertappointment', [AppointmentApiController::class, 'insertAppointment']);
    Route::put('/updateappointment/{id}', [AppointmentApiController::class, 'updateAppointment']);
    Route::delete('/deleteappointment/{id}', [AppointmentApiController::class, 'deleteAppointment']);

    // PATIENT
    Route::get('/showPatient', [PatientApiController::class, 'getAllPatients']);
    Route::post('/insertpatient', [PatientApiController::class, 'insertPatient']);
    Route::put('/updatepatient/{id}', [PatientApiController::class, 'updatePatient']);
    Route::delete('/deletepatient/{id}', [PatientApiController::class, 'deletePatient']);

    // ILLNESS
    Route::get('/showIllnesses', [IllnessApiController::class, 'getAllIllnesses']);
    Route::post('/insertillnesses', [IllnessApiController::class, 'insertIllness']);
    Route::put('/updateillnesses/{id}', [IllnessApiController::class, 'updateIllness']);
    Route::delete('/deleteillnesses/{id}', [IllnessApiController::class, 'deleteIllness']);

    // PATIENT ILLNESS
    Route::get('/showPatientIllness', [PatientIllnessApiController::class, 'getAllPatientIllnesses']);
    Route::post('/insertpatientillness', [PatientIllnessApiController::class, 'insertPatientIllness']);
    Route::put('/updatepatientillness/{id}', [PatientIllnessApiController::class, 'updatePatientIllness']);
    Route::delete('/deletepatientillness/{id}', [PatientIllnessApiController::class, 'deletePatientIllness']);

    // ADMIN
    Route::get('/showAdmin', [AdminApiController::class, 'getAllAdmins']);
    Route::post('/innsertadmin', [AdminApiController::class, 'insertAdmin']);
    Route::put('/updateadmin/{id}', [AdminApiController::class, 'updateAdmin']);
    Route::delete('/deleteadmin/{id}', [AdminApiController::class, 'deleteAdmin']);

    // Create doctor only by admin
    Route::post('/create-doctor', [AuthController::class, 'createDoctor']);

    // Logout
    Route::post('/logout', [AuthController::class, 'logout']);
});