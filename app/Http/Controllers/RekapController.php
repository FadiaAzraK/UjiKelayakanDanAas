<?php

namespace App\Http\Controllers;

use App\Models\late;
use Illuminate\Http\Request;
use Excel;
use PDF;
use App\Exports\LatesExport;
use App\Models\rayon;
use App\Models\student;
use Illuminate\Support\Facades\Auth;

class RekapController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $late = late::all();
        $students = student::withCount('late')->get()->filter(function ($student) {
            return $student->late_count > 0;
        });

    return view('admin.keterlambatan.rekap', compact('late', 'students'));
    }

    public function indexPs()
    {
        $rayon = Rayon::where('user_id', Auth::user()->id)->first();
        
        $lates = Late::with('student')
            ->whereHas('student', function ($query) use ($rayon) {
                $query->where('rayon_id', $rayon->id);
            })
            ->get()
            ->unique('student_id')
            ->values(); 
        // dd($lates);
        return view('ps.late.rekap', compact('lates'));
    }
  

    public function telatPs() 
    {
        $rayon = rayon::where('user_id', Auth::user()->id)->first();
    
        $lates = late::whereHas('student', function ($query) use ($rayon) {
                $query->where('rayon_id', $rayon->id);
            })
            ->get();
            
        return view('ps.late.index', compact('lates'));
    }


    public function telat() {
        $lates = Late::with('student')->simplePaginate(5);
        return view("admin.keterlambatan.index", compact('lates'));
    }

    
    public function export()
    {
        return Excel::download(new LatesExport, 'lates.xlsx');
    }

    public function review($id)
    {
        $student = student::find($id)->first();
        $pdf = PDF::loadView('admin.keterlambatan.download-pdf', compact('student'));

        return $pdf->stream('keterlambatan_' . $student->id . '.pdf');
    }

    public function downloadPDF($id){
        $late = late::all();
        $student = student::findOrfail($id)->withCount('late')->first();
        // dd($student);
        $pdf = PDF::loadView('admin.keterlambatan.download-pdf', compact('late', 'student'));
        return $pdf->download('keterlambatan_' . $student->id . '.pdf');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $students = student::all();
        return view('admin.keterlambatan.create', compact('students'));
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

        return redirect()->route('rekap.telat')->with('success', 'Berhasil menambahkan data keterlambatan!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $student = student::where('id', $id)->first();
        $lates = late::whereHas('student', function ($query) use ($id) {
            $query->where('id', $id);
        })->get();

        if ($student && $lates) {
            return view('admin.keterlambatan.detail', compact('student', 'lates'));
        } else {
            return redirect()->route('rekap.home')->with('error', 'Data tidak ditemukan.');
        }
    }
    public function showPs($id)
    {
        $student = student::where('id', $id)->first();
        $lates = late::whereHas('student', function ($query) use ($id) {
            $query->where('id', $id);
        })->get();

        if ($student && $lates) {
            return view('ps.late.detail', compact('student', 'lates'));
        } else {
            return redirect()->route('ps.rekap.home')->with('error', 'Data tidak ditemukan.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $late = late::find($id);
        $students = student::all();

        return view("admin.keterlambatan.edit", compact('late', 'students'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
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
        return redirect()->route('rekap.telat')->with('success', 'Berhasil mengubah data keterlambatan!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        late::where('id', $id)->delete();
        return redirect()->back()->with('deleted', 'Berhasil menghapus data!');
    }

    public function downloadPDFPs($id)
{
    $student = late::find($id);
    $pdf = PDF::loadView('ps.late.download-pdf', compact('student'));
    return $pdf->download('keterlambatan_' . $student->id . '.pdf');
}

public function reviewPs($id)
{
    $late = late::find($id);
    if (!$late) {
        return abort(404, 'Late record not found.');
    }

    $student = $late->student;

    if (!$student) {
        return abort(404, 'Student not found.');
    }

    $pdf = PDF::loadView('ps.late.download-pdf', compact('late', 'student'));

    return $pdf->stream('keterlambatan_' . $student->id . '.pdf');
}


}
