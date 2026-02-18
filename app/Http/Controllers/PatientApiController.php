<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Patient;

class PatientApiController extends Controller
{
     //  Get all patients
    public function getAllPatients()
    {
        $patients = Patient::all();
        return response()->json(["List" => $patients], 200);
    }

    //  Insert a new patient
    public function insertPatient(Request $request)
    {
        $patient = new Patient();

        $patient->patient_name = $request->patient_name;
        $patient->patient_date_of_birth = $request->patient_date_of_birth;
        $patient->gender = $request->gender;
        $patient->address = $request->address;
        $patient->contact_number = $request->contact_number;
        $patient->email = $request->email;
        $patient->appointment_id = $request->appointment_id;
        $patient->patient_illness_id = $request->patient_illness_id;

        $patient->save();

        return response()->json(['msg' => 'Patient inserted successfully'], 200);
    }

    //  Update patient
    public function updatePatient(Request $request, $id)
    {
        $patient = Patient::where('patient_id', $id)->first();

        if (!$patient) {
            return response()->json(['msg' => 'Patient not found'], 404);
        }

        $patient->patient_name = $request->patient_name;
        $patient->patient_date_of_birth = $request->patient_date_of_birth;
        $patient->gender = $request->gender;
        $patient->address = $request->address;
        $patient->contact_number = $request->contact_number;
        $patient->email = $request->email;
        $patient->appointment_id = $request->appointment_id;
        $patient->patient_illness_id = $request->patient_illness_id;

        $patient->save();

        return response()->json(['msg' => 'Patient updated successfully'], 200);
    }

    //  Delete patient
    public function deletePatient($id)
    {
        $patient = Patient::where('patient_id', $id)->first();

        if (!$patient) {
            return response()->json(['msg' => 'Patient not found'], 404);
        }

        $patient->delete();

        return response()->json(['msg' => 'Patient deleted successfully'], 200);
    }
}
