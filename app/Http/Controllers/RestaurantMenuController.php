<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RestaurantMenu;

class RestaurantMenuController extends Controller
{
    // Menampilkan daftar menu restoran
    public function index()
    {
        $menus = RestaurantMenu::all();
        return response()->json($menus);
    }

    // Menampilkan detail menu restoran berdasarkan ID
    public function show($id)
    {
        $menu = RestaurantMenu::find($id);
        if ($menu) {
            return response()->json($menu);
        } else {
            return response()->json(['message' => 'Menu not found'], 404);
        }
    }

    // Menambah menu restoran baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
        ]);

        $menu = RestaurantMenu::create($request->all());
        return response()->json($menu, 201);
    }

    // Memperbarui menu restoran
    public function update(Request $request, $id)
    {
        $menu = RestaurantMenu::find($id);
        if ($menu) {
            $menu->update($request->all());
            return response()->json($menu);
        } else {
            return response()->json(['message' => 'Menu not found'], 404);
        }
    }

    // Menghapus menu restoran
    public function destroy($id)
    {
        $menu = RestaurantMenu::find($id);
        if ($menu) {
            $menu->delete();
            return response()->json(['message' => 'Menu deleted successfully']);
        } else {
            return response()->json(['message' => 'Menu not found'], 404);
        }
    }
}