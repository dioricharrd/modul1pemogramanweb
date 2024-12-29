<?php

namespace App\Http\Controllers;

use App\Models\VillaStaff;
use App\Http\Resources\VillaStaffResource;
use Illuminate\Http\Request;

class VillaStaffController extends Controller
{
    // Menampilkan daftar staf villa
    public function index()
    {
        $staffs = VillaStaff::all();
        return VillaStaffResource::collection($staffs);
    }

    // Menampilkan detail staf villa berdasarkan ID
    public function show($id)
    {
        $staff = VillaStaff::find($id);
        if ($staff) {
            return new VillaStaffResource($staff);
        } else {
            return response()->json(['message' => 'Staff not found'], 404);
        }
    }

    // Menambah staf villa baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'position' => 'required|string',
            'email' => 'required|email|unique:villa_staff,email',
            'phone' => 'required|string',
        ]);

        $staff = VillaStaff::create($request->all());
        return new VillaStaffResource($staff);
    }

    // Memperbarui staf villa
    public function update(Request $request, $id)
    {
        $staff = VillaStaff::find($id);
        if ($staff) {
            $staff->update($request->all());
            return new VillaStaffResource($staff);
        } else {
            return response()->json(['message' => 'Staff not found'], 404);
        }
    }

    // Menghapus staf villa
    public function destroy($id)
    {
        $staff = VillaStaff::find($id);
        if ($staff) {
            $staff->delete();
            return response()->json(['message' => 'Staff deleted successfully']);
        } else {
            return response()->json(['message' => 'Staff not found'], 404);
        }
    }
}
