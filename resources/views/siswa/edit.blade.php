@extends('Layouts.Template')

@section('content')
<form action="{{ route('siswa.update', $students['id']) }}" method="POST" class="card p-5">
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
      <label for="nama" class="form-label">Nama</label>
      <input type="text" name="name" class="form-control" aria-describedby="emailHelp" value="{{ $students['name'] }}">
    </div>
    <div class="mb-3">
      <label for="nis" class="form-label">Nis</label>
      <input type="text" name="nis" class="form-control" value="{{ $students['nis']}}">
    </div>
    <div class="mb-3">
      <label for="rombel" class="form-label">Rombel</label>
      <select name="rombel_id">
          @foreach ($rombels as $rombel)
              <option value="{{ $rombel->id }}"> {{ $rombel->rombel }} </option>
          @endforeach
      </select>
  </div>
  
  <div class="mb-3">
      <label for="rayon" class="form-label">Rayon</label>
      <select name="rayon_id">
          @foreach ($rayons as $rayon)
              <option value="{{ $rayon->id }}"> {{ $rayon->rayon }} </option>
          @endforeach
      </select>
  </div>
  
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
@endsection