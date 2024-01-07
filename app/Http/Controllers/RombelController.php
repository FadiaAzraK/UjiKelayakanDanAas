<?php

namespace App\Http\Controllers;

use App\Models\rombel;
use Illuminate\Http\Request;

class RombelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rombels = rombel::all();
        return view("rombel.index", compact("rombels"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('rombel.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'rombel' => 'required',
        ]); 

        rombel::create([
            'rombel' => $request->rombel, 
        ]);

        return redirect()->route('rombel.home')->with('success', 'Berhasil menambahkan data Rombel!');
    }

    /**
     * Display the specified resource.
     */
    public function show(rombel $rombel)
    {
       // 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $rombels = rombel::find($id);
        return view('rombel.edit', compact('rombels'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'rombel' => 'required',
        ]); 

        rombel::where('id', $id)->update([
            'rombel' => $request->rombel, 
        ]);

        return redirect()->back()->with('success', 'Berhasil mengubah data Rombel!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(rombel $rombel, $id)
    {
        $rombel = rombel::where('id', $id)->delete();
        return redirect()->back()->with('deleted', 'Berhasil menghapus data Rombel!');
    }
}
