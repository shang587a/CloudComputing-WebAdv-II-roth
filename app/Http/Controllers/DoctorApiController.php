<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Doctor;

class DoctorApiController extends Controller
{

    //Retrieve Doctors
    public function getAllDoctor(){
         $show_doctor = DB::select("select * from doctor");  // Fetch all records from 'doctors' table
         return response()->json(
            ["List" => $show_doctor],
            200);
    }



    //Insert Doctor
    public function insertDoctor(Request $form){
        $doctor = new Doctor();

        $doctor->doctor_name = $form->doctor_name;
        $doctor->email = $form->email;
        $doctor->specialization = $form->specialization;
        $doctor->gender = $form->gender;
        $doctor->contact_number = $form->contact_number;
        $doctor->admin_id = $form->admin_id;
        $doctor->appointment_id = $form->appointment_id;
        $doctor->patient_illness_id = $form->patient_illness_id;

        $doctor->save();

        return response()->json(
            ["msg" => "Doctor record inserted successfully!"], 
            200);
      }


    // Update Doctors
    public function updateDoctor($id, Request $form) {
    $doctor = Doctor::find($id);

    if (!$doctor) {
        return response()->json(['msg' => 'Doctor not found'], 404);
    }

        $doctor->doctor_name = $form->doctor_name;
        $doctor->email = $form->email;
        $doctor->specialization = $form->specialization;
        $doctor->gender = $form->gender;
        $doctor->contact_number = $form->contact_number;
        $doctor->admin_id = $form->admin_id;
        $doctor->appointment_id = $form->appointment_id;
        $doctor->patient_illness_id = $form->patient_illness_id;

    $doctor->save();

    return response()->json(['msg' => 'Doctor updated successfully!'], 200);
}


    //Delete Doctor
    public function deleteDoctor($id) {
    $doctor = Doctor::find($id);

    if (!$doctor) {
        return response()->json(['msg' => 'Doctor not found'], 404);
    }

    $doctor->delete();

    return response()->json(['msg' => 'Doctor deleted successfully!'], 200);
}

}
