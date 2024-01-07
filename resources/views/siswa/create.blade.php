@extends('Layouts.Template')

@section('content')
<form action="{{ route('siswa.store') }}" method="POST" class="card p-5">
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
      <label for="nama" class="form-label">Nama</label>
      <input type="text" name="name" class="form-control" aria-describedby="emailHelp">
    </div>
    <div class="mb-3">
      <label for="nis" class="form-label">Nis</label>
      <input type="text" name="nis" class="form-control">
    </div>
    <div class="mb-3">
      <label for="rombel" class="form-label">Rombel</label>
      <select name="rombel_id">
          @foreach ($rombels as $item)
          <option selected disabled hidden>Pilih</option>
          <option value="{{$item->id}}"> {{$item->rombel}} </option>
          @endforeach
      </select>
    </div>
    <div class="mb-3">
      <label for="rayon" class="form-label">Rayon</label>
        <select name="rayon_id">
            @foreach ($rayons as $item)
            <option selected disabled hidden>Pilih</option>
            <option value="{{ $item->id }}"> {{$item->rayon}} </option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
@endsection