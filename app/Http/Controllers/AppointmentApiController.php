<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Appointment;

class AppointmentApiController extends Controller
{
    // Get all appointments
    public function getAllAppointments()
    {
        $appointments = Appointment::all();
        return response()->json(["List" => $appointments], 200);
    }

    // Insert new appointment
    public function insertAppointment(Request $request)
    {
        $appointment = new Appointment();

        $appointment->patient_name = $request->patient_name;
        $appointment->appointment_date = $request->appointment_date;
        $appointment->appointment_time = $request->appointment_time;
        $appointment->doctor_name = $request->doctor_name;
        $appointment->reason = $request->reason;
        $appointment->status = $request->status;
        $appointment->doctor_id = $request->doctor_id;
        $appointment->patient_id = $request->patient_id;

        $appointment->save();

        return response()->json(["msg" => "Appointment record inserted successfully!"], 200);
    }

    // Update appointment by ID
    public function updateAppointment($id, Request $request)
    {
        $appointment = Appointment::find($id);
        if (!$appointment) {
            return response()->json(["msg" => "Appointment not found"], 404);
        }

        $appointment->patient_name = $request->patient_name;
        $appointment->appointment_date = $request->appointment_date;
        $appointment->appointment_time = $request->appointment_time;
        $appointment->doctor_name = $request->doctor_name;
        $appointment->reason = $request->reason;
        $appointment->status = $request->status;
        $appointment->doctor_id = $request->doctor_id;
        $appointment->patient_id = $request->patient_id;

        $appointment->save();

        return response()->json(["msg" => "Appointment updated successfully!"], 200);
    }

    // Delete appointment by ID
    public function deleteAppointment($id)
    {
        $appointment = Appointment::find($id);
        if (!$appointment) {
            return response()->json(["msg" => "Appointment not found"], 404);
        }

        $appointment->delete();

        return response()->json(["msg" => "Appointment deleted successfully!"], 200);
    }
}
