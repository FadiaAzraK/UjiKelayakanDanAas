@extends('Layouts.Template')

@section('content')
    @if(Session::get('success'))
    <div class="alert alert-success">{{ Session::get('success') }}</div>
    @endif
    @if(Session::get('deleted'))
    <div class="alert alert-warning">{{ Session::get('deleted') }}</div>
    @endif

<a class="btn btn-primary" href="{{ route('siswa.create') }}">Tambah</a>
<table class="table">
    <thead>
      <tr>
        <th scope="col">No</th>
        <th scope="col">Nis</th>
        <th scope="col">Nama</th>
        <th scope="col">Rombel</th>
        <th scope="col">Rayon</th>
        <th scope="col">Aksi</th>
      </tr>
    </thead>
    <tbody>
      @php $no = 1; @endphp
      @foreach ($students as $item)
          <tr>
              <td>{{ $no++ }}</td>
              <td>{{ ucwords($item['name']) }}</td>
              <td>{{ ucwords($item['nis']) }}</td>
              <td>{{ isset($item['rombel']) ? $item['rombel']['rombel'] : ' ' }}</td>
              <td>{{ isset($item['rayon']) ? $item['rayon']['rayon'] : ' ' }}</td>
              <td class="d-flex justify-content-center">
                  <a href="{{ route('siswa.edit', $item['id']) }}" class="btn btn-primary me-3">Edit</a>
                  <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal-{{ $item['id']}}">Hapus</button>
              </td>
          </tr>  
          <div class="modal fade" id="confirmDeleteModal-{{ $item['id']}}" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
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
                          <form action="{{ route('siswa.delete', $item['id']) }}" method="POST">
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="btn btn-danger">Hapus</button>
                          </form>
                      </div>
                  </div>
              </div>
          </div>
      @endforeach
  </tbody>
  </table>
@endsection