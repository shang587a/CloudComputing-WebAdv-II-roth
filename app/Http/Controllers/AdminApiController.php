<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\Doctor;

class AdminApiController extends Controller
{
     // Get all admins
    public function getAllAdmins()
    {
        $admins = Admin::all();
        return response()->json(['admins' => $admins], 200);
    }

    // Insert new admin
    public function insertAdmin(Request $request)
    {
        $admin = new Admin();

        $admin->name = $request->name;
        $admin->email = $request->email;
        // Hash the password before saving
        $admin->password = bcrypt($request->password);
        $admin->doctor_id = $request->doctor_id;

        $admin->save();

        return response()->json(['msg' => 'Admin inserted successfully'], 200);
    }

    // Update admin
    public function updateAdmin(Request $request, $id)
    {
        $admin = Admin::find($id);

        if (!$admin) {
            return response()->json(['msg' => 'Admin not found'], 404);
        }

        $admin->name = $request->name;
        $admin->email = $request->email;
        if ($request->password) {
            $admin->password = bcrypt($request->password);
        }
        $admin->doctor_id = $request->doctor_id;

        $admin->save();

        return response()->json(['msg' => 'Admin updated successfully'], 200);
    }

    // Delete admin
    public function deleteAdmin($id)
    {
        $admin = Admin::find($id);

        if (!$admin) {
            return response()->json(['msg' => 'Admin not found'], 404);
        }

        $admin->delete();

        return response()->json(['msg' => 'Admin deleted successfully'], 200);
    }

    

     // Admin login (Sanctum token)
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $admin = Admin::where('email', $request->email)->first();

        if (!$admin || !Hash::check($request->password, $admin->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $token = $admin->createToken('api-token')->plainTextToken;

        return response()->json(['admin' => $admin, 'token' => $token]);
    }

    // Admin creates doctor account
    public function createDoctor(Request $request)
    {
        $request->validate([
            'doctor_name' => 'required|string',
            'email' => 'required|email|unique:doctor,email',
            'password' => 'required|string|min:6',
            'gender' => 'required|string|in:M,F,O',
            'contact_number' => 'required|string|max:100',
            // 'specialized_id' => 'required|integer',
            // 'admin_id' => 'required|integer', // Must link to an admin
        ]);

        $doctor = Doctor::create([
            'doctor_name' => $request->doctor_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'gender' => $request->gender,
            'contact_number' => $request->contact_number,
            // 'specialized_id' => $request->specialized_id,
            // 'admin_id' => $request->admin_id,
        ]);

        return response()->json([
        'msg' => 'Doctor account created successfully',
        ], 201);
    }
}
