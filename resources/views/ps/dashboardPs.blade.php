@extends('Layouts.Template')

@section('content')
    <div class="container-fluid" style="color:rgb(0, 64, 137)">
        <div class="container mt-4">
            <div class="row mb-4">
                <div class="col">
                    <h2 class="mb-0">Dashboard</h2>
                </div>
            </div>
            <div class="row" style="color:rgb(0, 64, 137)">
                <div class="col-lg-6 mb-4">
                    <div class="card h-200 text-dark shadow" style="background-color:#ffffff;">
                        <div class="card-body" style="color:rgb(0, 64, 137)">
                            <h5 class="card-title">Peserta Didik Rayon {{ str_replace('-', ' ', substr(Auth::user()->name, 3)) }}</h5>
                            <div class="row align-items-center mt-2">
                                <div class="col-md-1">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div class="col-md-11">
                                    <p class="card-text"> {{ $totalStudents }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="card h-200 text-dark shadow" style="background-color:#ffffff;">
                        <div class="card-body" >
                            <h5 class="card-title" style="color:rgb(0, 64, 137)">Keterlambatan {{ str_replace('-', ' ', substr(Auth::user()->name, 3)) }} Hari ini</h5>
                            <b><p>{{ now()->format('Y-m-d') }}</p></b>
                            <div class="row align-items-center mt-2">
                                <div class="col-md-1" style="color:rgb(0, 64, 137)">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div class="col-md-11">
                                    <p class="card-text" style="color:rgb(0, 64, 137)">{{ $totalLateStudents }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
@endsection