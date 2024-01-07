<?php

namespace App\Http\Controllers;

use App\Models\late;
use App\Models\rayon;
use App\Models\rombel;
use App\Models\student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rayons = rayon::all();
        $rombels = rombel::all();
        $ps = User::where('role', 'ps')->get();
        $admin = User::where('role', 'admin')->get();
        $students = student::all();

        return view('dashboard', compact('rayons', 'rombels', 'ps', 'admin', 'students'));
    }

    public function dashboardPs()
    {

        $rayon = rayon::where('user_id', Auth::user()->id)->first();

        $totalStudents = student::where('rayon_id', $rayon->id)->count();

        $today = now()->format('Y-m-d');
        $totalLateStudents = late::whereHas('student', function ($query) use ($rayon) {
            $query->where('rayon_id', $rayon->id);
        })
            ->whereDate('date_time_late', $today)
            ->count();

        return view('ps.dashboardPs', compact('totalStudents', 'totalLateStudents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
