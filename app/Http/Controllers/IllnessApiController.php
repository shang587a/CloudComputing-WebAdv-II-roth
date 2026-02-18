<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Illness;

class IllnessApiController extends Controller
{
     // Get all illnesses
    public function getAllIllnesses()
    {
        $illnesses = Illness::all();
        return response()->json(["List"=> $illnesses], 200);
    }

    // Insert a new illness
    public function insertIllness(Request $request)
    {
        $illness = new Illness();

        $illness->name_of_illness = $request->name_of_illness;
        $illness->descripton = $request->descripton;
        $illness->patient_illness_id = $request->patient_illness_id;

        $illness->save();

        return response()->json(['msg' => 'Illness inserted successfully'], 200);
    }

    // Update illness by id
    public function updateIllness(Request $request, $id)
    {
        $illness = Illness::where('illness_id', $id)->first();

        if (!$illness) {
            return response()->json(['msg' => 'Illness not found'], 404);
        }

        $illness->name_of_illness = $request->name_of_illness;
        $illness->descripton = $request->descripton;
        $illness->patient_illness_id = $request->patient_illness_id;

        $illness->save();

        return response()->json(['msg' => 'Illness updated successfully'], 200);
    }

    // Delete illness by id
    public function deleteIllness($id)
    {
        $illness = Illness::where('illness_id', $id)->first();

        if (!$illness) {
            return response()->json(['msg' => 'Illness not found'], 404);
        }

        $illness->delete();

        return response()->json(['msg' => 'Illness deleted successfully'], 200);
    }
}
