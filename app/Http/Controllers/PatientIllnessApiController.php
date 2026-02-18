<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\PatientIllness;

class PatientIllnessApiController extends Controller
{
     // Get all patient illness records
    public function getAllPatientIllnesses()
    {
        $records = PatientIllness::all();
        return response()->json(['patient_illnesses' => $records], 200);
    }

    // Insert a new patient illness record
    public function insertPatientIllness(Request $request)
    {
        $record = new PatientIllness();

        $record->patient_id = $request->patient_id;
        $record->illness_id = $request->illness_id;
        $record->doctor_id = $request->doctor_id;

        $record->save();

        return response()->json(['msg' => 'Patient illness record inserted successfully'], 200);
    }

    // Update an existing patient illness record
    public function updatePatientIllness(Request $request, $id)
    {
        $record = PatientIllness::where('patient_illness_id', $id)->first();

        if (!$record) {
            return response()->json(['msg' => 'Patient illness record not found'], 404);
        }

        $record->patient_id = $request->patient_id;
        $record->illness_id = $request->illness_id;
        $record->doctor_id = $request->doctor_id;

        $record->save();

        return response()->json(['msg' => 'Patient illness record updated successfully'], 200);
    }

    // Delete a patient illness record
    public function deletePatientIllness($id)
    {
        $record = PatientIllness::where('patient_illness_id', $id)->first();

        if (!$record) {
            return response()->json(['msg' => 'Patient illness record not found'], 404);
        }

        $record->delete();

        return response()->json(['msg' => 'Patient illness record deleted successfully'], 200);
    }
}
