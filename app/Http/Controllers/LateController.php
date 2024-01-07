<?php

namespace App\Http\Controllers;

use App\Exports\LatesExport;
use Illuminate\Support\Facades\DB;
use App\Models\late;
use App\Models\student;
use Illuminate\Http\Request;
use Excel;

class LateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lates = late::with('student')->get();
        // dd($lates);
        return view("keterlambatan.index", compact('lates'));
    }

    public function tela() {
        $lates = late::with('student')->select('student_id', DB::raw('count(*) as total'))->groupBy('student_id')->get();
        return view("keterlambatan.rekap", compact('lates'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $students = student::all();
        return view('keterlambatan.create', compact('students'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required',
            'date_time_late' => 'required',
            'information' => 'required',
            'bukti' => 'mimes:jpg,jpeg,png,gif|max:1024'

        ]); 

        if ($request->hasFile('bukti')) {
            $bukti_file = $request->file('bukti');
            $bukti_nama = $bukti_file->hashName();
            $bukti_file->move(public_path('img'), $bukti_nama);

            $data_lates['bukti'] = $bukti_nama;
        }

        late::create([
            'student_id' => $request->student_id,
            'date_time_late' => $request->date_time_late,
            'information' => $request->information,
            'bukti' => $bukti_nama
        ]);


        return redirect()->route('late.home')->with('success', 'Berhasil menambahkan data keterlambatan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(late $late)
    {
        $late = late::findOrFail();
        return view('keterlambatan.detail', compact('late'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(late $late, $id)
    {
        $late = late::find($id);
        $students = student::all();

        return view("keterlambatan.edit", compact('late', 'students'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, late $late, $id)
    {
        $request->validate([
            'student_id' => 'required',
            'date_time_late' => 'required',
            'information' => 'required',
            'bukti' => 'mimes:jpg,jpeg,png,gif|max:1024'

        ]); 

        $dataToUpdate = [
            'student_id' => $request->student_id,
            'date_time_late' => $request->date_time_late,
            'information' => $request->information,
        ];

        if ($request->hasFile('bukti')) {
            $bukti_file = $request->file('bukti');
            $bukti_nama = $bukti_file->hashName();
            $bukti_file->move(public_path('img'), $bukti_nama);

            $dataToUpdate['bukti'] = $bukti_nama;
        }

        late::where('id', $id)->update($dataToUpdate);

        return redirect()->route('late.home')->with('success', 'Berhasil mengubah data keterlambatan!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(late $late, $id)
    {
        late::where('id', $id)->delete();
        return redirect()->back()->with('deleted', 'Berhasil menghapus data!');
    }

    public function exportExcel(){
        $file_name = 'data_keterlambatan'.'.xlsx';
        return Excel::download(new LatesExport, $file_name);
    }
}
