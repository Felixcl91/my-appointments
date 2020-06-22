@extends('layouts.panel')

@section('content')
<div class="card shadow">
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0">Edit Patient</h3>
            </div>
            <div class="col text-right">
              <a href="{{ url('patients') }}" class="btn btn-sm btn-default">
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

          <form action="{{ url('patients/'.$patient->id) }}" method="POST">
            @csrf
            @method('PUT')
          <div class="form-group">
            <label for="name">Name doctor</label>
            <input type="text" name="name" class="form-control" 
            value="{{ old('name', $patient->name) }}" required="">
          </div>
          <div class="form-group">
            <label for="email">E-mail</label>
            <input type="text" name="email" class="form-control" 
              value="{{ old('email', $patient->email) }}" required="">
          </div>
          <div class="form-group">
            <label for="dni">Dni</label>
            <input type="text" name="dni" class="form-control" 
              value="{{ old('dni', $patient->dni) }}" required="">
          </div>
          <div class="form-group">
            <label for="address">Direction</label>
            <input type="text" name="address" class="form-control" 
              value="{{ old('address', $patient->address) }}" required="">
          </div>
          <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" name="phone" class="form-control" 
              value="{{ old('phone', $patient->phone) }}" required="">
          </div>
           <div class="form-group">
            <label for="password">Password</label>
            <input type="text" name="password" class="form-control" 
              value="">
              <p>Ingrese un valor solo si desea modificar la contraseña</p>
          </div>
            <button type="submit" class="btn btn-primary">
              Save
            </button>
        </form>
        </div>
</div>
@endsection