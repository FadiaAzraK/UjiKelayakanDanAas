@extends('Layouts.Template')

@section('content')
    <div class="container mt-4">
        <div class="container-fluid">
            <div class="row">
                <h2 class="mb-4" style="color:rgb(0, 64, 137)">Detail Data Keterlambatan</h2>
                <p>{{ $student->name }} | {{ $student->nis }} | {{ $student->rombel->rombel }} |
                    {{ $student->rayon->rayon }}</p>
                @php
                    $no = 1;
                @endphp
                <div class="container">
                    <div class="row">
                        @if ($lates && $lates->count() > 0)
                            @foreach ($lates as $keterlambatan)
                                <div class="col-md-4">
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <h4 style="color:rgb(0, 64, 137)">Keterlambatan ke - {{ $no++ }}</h4>
                                            <div class="container">
                                                <p class="card-text ">
                                                    {{ $keterlambatan->date_time_late }}</p>
                                                <p class="card-text text-primary fw-bold">{{ $keterlambatan->information }}</p>
                                            </div>
                                            <p class="card-text text-center mt-2">
                                                <img src="{{ asset('img/' . $keterlambatan['bukti']) }}" alt="" style="width: 60%">
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p>Tidak ada data keterlambatan untuk siswa ini.</p>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection