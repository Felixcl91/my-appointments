@extends('layouts.panel')

@section('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
@endsection

@section('content')
<div class="card shadow">
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0">Edit Doctor</h3>
            </div>
            <div class="col text-right">
              <a href="{{ url('doctors') }}" class="btn btn-sm btn-default">
              Cancel and return
            </a>
            </div>
          </div>
        </div>
        <div class="card-body">

          @if ($errors->any())
            <ul>
              <div class="alert alert-danger" role="alert">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
              </div>
            </ul>
          @endif

          <form action="{{ url('doctors/'.$doctor->id) }}" method="POST">
            @csrf
            @method('PUT')
          <div class="form-group">
            <label for="name">Name doctor</label>
            <input type="text" name="name" class="form-control" 
            value="{{ old('name', $doctor->name) }}" required="">
          </div>
          <div class="form-group">
            <label for="email">E-mail</label>
            <input type="text" name="email" class="form-control" 
              value="{{ old('email', $doctor->email) }}" >
          </div>
          <div class="form-group">
            <label for="dni">Dni</label>
            <input type="text" name="dni" class="form-control" 
              value="{{ old('dni', $doctor->dni) }}" >
          </div>
          <div class="form-group">
            <label for="address">Direction</label>
            <input type="text" name="address" class="form-control" 
              value="{{ old('address', $doctor->address) }}">
          </div>
          <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" name="phone" class="form-control" 
              value="{{ old('phone', $doctor->phone) }}" >
          </div>
          <div class="form-group">
            <label for="password">Password </label>
            <input type="text" name="password" class="form-control">
            <em>Ingrese un valor nuevo si desea cambiar la contraseña</em>
          </div>
          <div class="form-group">
            <label for="specialties">Specialties</label>
            <select name="specialties[]" id="specialties" class="form-control selectpicker" data-style="btn-secundary" multiple>
              @foreach ($specialties as $specialty)
                <option value="{{ $specialty->id }}">{{ $specialty->name }}</option>
              @endforeach
            </select>
          </div>
            <button type="submit" class="btn btn-primary">
              Save
            </button>
        </form>
        </div>
</div>
@endsection

@section('scripts')
<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
<script type="">
  $(document).ready(() => {
    $('#specialties').selectpicker('val', @json($specialty_ids));
  });
</script>
@endsection