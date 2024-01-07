@extends('Layouts.Template')

@section('content')
<a class="btn btn-primary" href="{{ route('rombel.create') }}">Tambah</a>
<table class="table">
    <thead>
      <tr>
        <th scope="col">No</th>
        <th scope="col">Rombel</th>
        <th scope="col">Aksi</th>
      </tr>
    </thead>
    <tbody class="table-group-divider">
          @php $no = 1; @endphp
          @foreach ($rombels as $item)
              <tr>
                  <td>{{ $no++ }}</td>
                  <td>{{ ucwords($item['rombel']) }}</td>
                  <td class="d-flex justify-content-center">
                      <a href="{{ route('rombel.edit', $item['id']) }}" class="btn btn-primary me-3">Edit</a>
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
                              <form action="{{ route('rombel.delete', $item['id']) }}" method="POST">
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