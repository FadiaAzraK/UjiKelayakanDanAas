@extends('Layouts.Template')

@section('content')
<form action="{{ route('rombel.store') }}" method="POST" class="card p-5">
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
      <label for="rombel" class="form-label">Rombel</label>
      <input type="text" name="rombel" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
@endsection