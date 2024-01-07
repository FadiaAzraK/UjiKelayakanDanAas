@extends('Layouts.Template')

@section('content')
<table class="table">
    <thead>
      <tr>
        <th scope="col">No</th>
        <th scope="col">Nis</th>
        <th scope="col">Nama</th>
        <th scope="col">Rombel</th>
        <th scope="col">Rayon</th>
      </tr>
    </thead>
    <tbody>
      @php $no = 1; @endphp
      @foreach ($students as $item)
          <tr>
              <td>{{ $no++ }}</td>
              <td>{{ ucwords($item['name']) }}</td>
              <td>{{ ucwords($item['nis']) }}</td>
              <td>{{ $item['rombel']['rombel']  }}</td>
              <td>{{ $item['rayon']['rayon']  }}</td>
      @endforeach
  </tbody>
  </table>
@endsection