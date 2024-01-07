@extends('layouts.template')

@section('content')
    <div class="container-fluid">
        <div class="container mt-4">
            <div class="row mb-4">
                <div class="col">
                    <h2 class="mb-0">Dashboard</h2>
                    <p class="text-muted">Home/dashboard</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 mb-4">
                    <div class="card h-200 text-dark shadow" style="">
                        <div class="card-body">
                            <h5 class="card-title">Peserta Didik</h5>
                            <div class="row align-items-center mt-2">
                                <div class="col-md-2">
                                    {{-- <i class="fas fa-user"><a href="https://icons8.com/icon/98957/user"></a></i> --}}
                                </div>
                                <div class="col-md-10">
                                    <b class="card-text">{{ count($students) }}</b>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 mb-4">
                    <div class="card h-200 text-dark shadow" style="">
                        <div class="card-body">
                            <h5 class="card-title">Administrator</h5>
                            <div class="row align-items-center mt-2">
                                <div class="col-md-2">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div class="col-md-10">
                                    <b class="card-text">{{count($admin)}}</b>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 mb-4">
                    <div class="card h-200 text-dark shadow" style="">
                        <div class="card-body">
                            <h5 class="card-title">Pembimbing Siswa</h5>
                            <div class="row align-items-center mt-2">
                                <div class="col-md-2">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div class="col-md-10">
                                    <b class="card-text">{{count($ps)}}</b>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 mb-4">
                    <div class="card h-200 text-dark shadow" style="">
                        <div class="card-body">
                            <h5 class="card-title">Rombel</h5>
                            <div class="row align-items-center mt-2">
                                <div class="col-md-2">
                                    <i class="fa-solid fa-book"></i>
                                </div>
                                <div class="col-md-10">
                                    <b class="card-text">{{ count($rombels) }}</b>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="card h-200 text-dark shadow" style="">
                        <div class="card-body">
                            <h5 class="card-title">Rayon</h5>
                            <div class="row align-items-center mt-2">
                                <div class="col-md-2">
                                    <i class="fa-solid fa-book"></i>
                                </div>
                                <div class="col-md-10">
                                    <b class="card-text">{{count($rayons)}}</b>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection