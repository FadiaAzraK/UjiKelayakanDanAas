@extends('Layouts.Template')

@section('content')
    <div>
        <a class="btn btn-info" href="{{route('ps.rekap.export-excel')}}">Export Data Keterlambatan</a>
    </div>
    <br>
    <ul class="nav nav-tabs">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Keseluruhan Data</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('ps.rekap.home')}}">Rekapitulasi Data</a>
        </li> 
      </ul>

      <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Nama</th>
            <th scope="col">Tanggal</th>
            <th scope="col">Informasi</th>
          </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach ($lates as $late)
            <tr>
                <td>{{$no++ }}</td>
                <td>{{$late['student']['name']}}</td>
                <td>{{$late['date_time_late']}}</td>
                <td>{{$late['information']}}</td>
        @endforeach
          </tr>
        </tbody>
      </table>

@endsection