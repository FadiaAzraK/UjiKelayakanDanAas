@extends('Layouts.Template')

@section('content')
    <div>
        <a class="btn btn-info" href="{{route('ps.rekap.export-excel')}}">Export Data Keterlambatan</a>
    </div>
    <br>
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link" href="{{route('ps.rekap.telat')}}">Keseluruhan Data</a>
        </li> 
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Rekapitulasi Data</a>
        </li>
      </ul>

      <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Nis</th>
            <th scope="col">Nama</th>
            <th scope="col">Jumlah Keterlambatan</th>
            <th scope="col">Bukti</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach ($lates as $late)
            <tr>
                <td>{{$no++}}</td>
                <td>{{$late->student->nis}}</td>
                <td>{{$late->student->name}}</td>
                <td>{{$late->student->late->count()}}</td>
                <td><a href="{{ route('ps.rekap.show', $late->id) }}" style="text-decoration: none; color: rgb(0, 145, 255);">Lihat</a></td>
                @if ($late->student->late->count() >= 3) 
                  <td><a href="{{route('ps.rekap.print', $late->id)}}" class="btn btn-primary">Cetak Surat Pernyataan</a></td>
                @endif
          @endforeach
          </tr>
        </tbody>
      </table>
@endsection