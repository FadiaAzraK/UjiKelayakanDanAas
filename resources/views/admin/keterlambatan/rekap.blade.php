@extends('Layouts.Template')

@section('content')

    @if(Session::get('success'))
        <div class="alert alert-success"> {{ Session::get('success') }} </div>
    @endif

    @if(Session::get('deleted'))
        <div class="alert alert-warning"> {{ Session::get('deleted') }} </div>
    @endif
    <div>
        <a class="btn btn-primary" href="{{route('rekap.create')}}">Tambah</a>
        <a class="btn btn-info" href="{{route('rekap.export-excel')}}">Export Data Keterlambatan</a>
    </div>
    <br>
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link" href="{{route('rekap.telat')}}">Keseluruhan Data</a>
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
            @foreach ($students as $late)
            <tr>
                <td>{{$no++}}</td>
                <td>{{$late->nis}}</td>
                <td>{{$late->name}}</td>
                <td>{{$late->late_count }}</td>
                <td><a href="{{ route('rekap.show', $late->id) }}" style="text-decoration: none; color: rgb(0, 145, 255);">Lihat</a></td>
                @if ($late->late_count >= 3) 
                  <td><a href="{{route('rekap.print', $late->id)}}" class="btn btn-primary">Cetak Surat Pernyataan</a></td>
                @endif
          @endforeach
          </tr>
        </tbody>
      </table>
@endsection