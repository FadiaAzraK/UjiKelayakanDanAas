@extends('Layouts.Template')

@section('content')
<form action="{{ route('rekap.store') }}" method="POST" class="card p-5" enctype="multipart/form-data">
  @csrf

  @if(Session::get('success'))
      <div class="alert alert-success">{{ Session::get('success') }}</div>
  @endif
  @if ($errors->any())
  <ul class="alert alert-danger">
      @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
      @endforeach
  </ul>
  @endif
    <div class="mb-3">
        <label for="rombel" class="form-label">Siswa</label>
        <select name="student_id">
            @foreach ($students as $item)
            <option selected disabled hidden>Pilih</option>
            <option value="{{$item->id}}"> {{$item->nis}}-{{$item->name}} </option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
      <label for="nis" class="form-label">Tanggal</label>
      <input type="datetime-local" name="date_time_late" class="form-control">
    </div>
    <div class="mb-3">
      <label for="nis" class="form-label">Keterangan Keterlambatan</label>
      <input type="textarea" name="information" class="form-control">
    </div>
    <div class="mb-3">
      <label for="nis" class="form-label">Bukti</label>
      <input type="file" name="bukti" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
@endsection