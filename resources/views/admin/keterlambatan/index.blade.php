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
          <a class="nav-link active" aria-current="page" href="#">Keseluruhan Data</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('rekap.home')}}">Rekapitulasi Data</a>
        </li> 
      </ul>

      <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Nama</th>
            <th scope="col">Tanggal</th>
            <th scope="col">Informasi</th>
            {{-- <th scope="col">Bukti</th> --}}
            <th scope="col" class="text-center">Aksi</th>
          </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach ($lates as $late)
            <tr>
                <td>{{($lates->currentpage()-1) * $lates->perpage() + $loop->index + 1 }}</td>
                <td>{{$late['student']['name']}}</td>
                <td>{{$late['date_time_late']}}</td>
                <td>{{$late['information']}}</td>
                <td class="d-flex justify-content-center">
                    <a href="{{ route('rekap.edit', $late['id']) }}" class="btn btn-primary me-3">Edit</a>
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal-{{ $late['id']}}">Hapus</button>
                </td>
            </tr>  
            <div class="modal fade" id="confirmDeleteModal-{{ $late['id']}}" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="confirmDeleteModalLabel">Konfirmasi hapus</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Yakin ingin menghapus data ini?
                            <br>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <form action="{{ route('rekap.delete', $late['id']) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
          </tr>
        </tbody>
      </table>
      <div class="d-flex justify-content-end">
        @if ($lates->count())
            {{ $lates->links() }}
        @endif
    </div>

@endsection