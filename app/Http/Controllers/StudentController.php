<?php

namespace App\Http\Controllers;

use App\Models\late;
use App\Models\rayon;
use App\Models\rombel;
use App\Models\student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = student::with('rayon', 'rombel')->get();
        // dd($students);
        // $students = student::with('rombel')->get();
        // $students = student::all();
        // $rombels = rombel::all();
        // $rayons = rayon::all();

        return view("siswa.index", compact("students"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $rombels = rombel::all();
        $rayons = rayon::all();
        return view('siswa.create', compact("rombels", "rayons"));
    } 

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'nis' => 'required|numeric',
            'rombel_id' => 'required',
            'rayon_id' => 'required',
        ]); 

        student::create([
            'name' => $request->name, 
            'nis' => $request->nis, 
            'rombel_id' => $request->rombel_id, 
            'rayon_id' => $request->rayon_id, 
        ]);

        return redirect()->back()->with('success', 'Berhasil menambahkan data Siswa!');

    }
    public function dataSiswa() 
    {
        $rayon = Rayon::where('user_id', Auth::user()->id)->first();
    
        // Pastikan rayon ditemukan sebelum melanjutkan
        if (!$rayon) {
            return abort(404, 'Rayon not found for the current user.');
        }
    
        // Menggunakan metode with untuk memuat relasi rayon
        $students = Student::with('rayon')
            ->where('rayon_id', $rayon->id) // Menggunakan where untuk filter berdasarkan rayon_id
            ->get();
        
        return view('ps.siswa.index', compact('rayon', 'students'));
    }
    

    /**
     * Display the specified resource.
     */
    public function show(student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(student $student, $id)
    {
        $students = student::find($id);
        $rombels = rombel::all();
        $rayons = rayon::all();
        return view('siswa.edit', compact('students', 'rayons', 'rombels'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, student $student, $id)
    {
        $request->validate([
            'name' => 'required',
            'nis' => 'required|numeric',
            'rombel_id' => 'required',
            'rayon_id' => 'required',
        ]); 

        Student::where('id', $id)->update([
            'name' => $request->name, 
            'nis' => $request->nis, 
            'rombel_id' => $request->rombel_id, 
            'rayon_id' => $request->rayon_id, 
        ]);

        return redirect()->back()->with('success', 'Berhasil mengubah data Siswa!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(student $student, $id)
    {
        $student = student::where('id', $id)->delete();
        return redirect()->back()->with('deleted', 'Berhasil menghapus data Siswa!');

    }
}
