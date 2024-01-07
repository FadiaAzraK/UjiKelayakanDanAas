<?php

namespace App\Http\Controllers;

use App\Models\rayon;
use App\Models\User;
use Illuminate\Http\Request;

class RayonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $rayons = rayon::with('user')->get();
        $rayons = rayon::with('user')->get();

        return view("rayon.index", compact('rayons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        return view('rayon.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'rayon' => 'required',
            'user_id' => 'required',
        ]); 

        rayon::create([
            'rayon' => $request->rayon, 
            'user_id' => $request->user_id,
        ]);

        return redirect()->back()->with('success', 'Berhasil menambahkan data Rayon!');
    }

    /**
     * Display the specified resource.
     */
    public function show(rayon $rayon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(rayon $rayon, $id)
    {
        $rayons = rayon::find($id);
        $user = User::all();
        return view('rayon.edit', compact('rayons', 'user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, rayon $rayon, $id)
    {
        $request->validate([
            'rayon' => 'required',
            'user_id' => 'required',
        ]); 

        rayon::where('id', $id)->update([
            'rayon' => $request->rayon, 
            'user_id' => $request->user_id,
        ]);

        return redirect()->back()->with('success', 'Berhasil mengubah data Rayon!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(rayon $rayon, $id)
    {
        rayon::where('id', $id)->delete();
        return redirect()->back()->with('deleted', 'Berhasil menghapus data!');
    }
}
