@extends('Layouts.Template')

@section('content')

<form action="{{ route('rayon.edit', $rayons['id']) }}" method="POST" class="card p-5">
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
      <label for="rombel" class="form-label">Rayon</label>
      <input type="text" name="rayon" class="form-control" value="{{ $rayons['rayon'] }}">
    </div>
    <div class="mb-3">
      <label for="user" class="form-label">PS</label>
        <select name="user_id">
            @foreach ($user as $item)
            @if ($item['role'] == 'ps' )
            <option value="{{ $item->id }}">{{$item->name}} </option>
            @endif
            @endforeach
        </select>
      
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
@endsection