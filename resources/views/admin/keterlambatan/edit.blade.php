@extends('Layouts.Template')

@section('content')
<form action="{{route('rekap.update', $late['id'])}}" method="POST" class="card p-5" enctype="multipart/form-data">
  @csrf
  @method('PATCH')
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
    <label for="student" class="form-label">Siswa</label>
    <select name="student_id">
        @foreach ($students as $student)
            <option value="{{ $student->id }}" {{ $student->id == $student->student_id ? 'selected' : '' }}>
                {{ $student->name }}
            </option>
        @endforeach
    </select>
</div>

    <div class="mb-3">
      <label for="tgl" class="form-label">Tanggal</label>
      <input type="datetime-local" name="date_time_late" class="form-control" value="{{$late['date_time_late']}}">
    </div>
    <div class="mb-3">
      <label for="info" class="form-label">Keterangan Keterlambatan</label>
      <input type="textarea" name="information" class="form-control" value="{{$late['information']}}">
    </div>
    <div class="mb-3">
      <label for="bukti" class="form-label">Bukti</label>
      <input type="file" name="bukti" class="form-control">
      @if ($late['bukti'])
        <img src="{{ asset('img/' . $late['bukti']) }}" alt="Bukti" style="width: 60%">
      @endif
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
@endsection