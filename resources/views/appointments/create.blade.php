@extends('layouts.panel')

@section('content')
<div class="card shadow">
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0">Register new appointments</h3>
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

          <form action="{{ url('appointments') }}" method="POST">
          @csrf
          <div class="form-group"> 
            <label for="description">Description</label>
            <input type="text" name="description" value="{{ old('description') }}" id="description" class="form-control"
              placeholder="Describe brevement la consulta" required>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="specialty">Specialty</label>
            <select name="specialty_id" id="specialty" class="form-control" required>
              <option>Seleccionar especialidad</option>
              @foreach ($specialties as $specialty)
                <option value="{{ $specialty->id }}" @if(old('specialty_id') == 
                $specialty->id) selected @endif>{{ $specialty->name }}</option>
              @endforeach
            </select>
            </div>
            <div class="form-group col-md-6">
              <label for="doctor">Doctor</label>
            <select name="doctor_id" id="doctor" class="form-control">
              @foreach ($doctors as $doctor)
                <option value="{{ $doctor->id }}" @if(old('doctor_id') == 
                $doctor->id) selected @endif>{{ $doctor->name }}</option>
              @endforeach
            </select>
            </div>
          </div> 
        
          <div class="form-group">
            <label for="email">Date</label>
            <div class="input-group input-group-alternative">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
              </div>
                <input class="form-control datepicker" placeholder="Select date" 
                id="date" name="scheduled_date" type="text" 
                value="{{ old('scheduled_date', date('Y-m-d')) }}" 
                data-date-format="yyyy-mm-dd" 
                data-date-start-date="{{ date('Y-m-d') }}" 
                data-date-end-date="+30d">
            </div>
          </div>
          <div class="form-group">
            <label for="address">Atention hour</label>
            <div id="hours">
              @if ($intervals)
                @foreach($intervals['morning'] as $key => $interval)
                  <div class="custom-control custom-radio mb-3">
                    <input name="scheduled_time" value="{{ $interval['start'] }}" class="custom-control-input" type="radio" id="intervalMorning {{ $key }}" required>
                    <label class="custom-control-label" for="intervalMorning {{ $key }}">
                      {{ $interval['start'] }} - {{ $interval['end'] }}
                    </label>
                  </div>
                @endforeach
                @foreach($intervals['afternoon'] as $key => $interval)
                  <div class="custom-control custom-radio mb-3">
                    <input name="scheduled_time" value="{{ $interval['start'] }}" class="custom-control-input" type="radio" id="intervalAfternoon {{ $key }}" required>
                    <label class="custom-control-label" for="intervalAfternoon {{ $key }}">
                      {{ $interval['start'] }} - {{ $interval['end'] }}
                    </label>
                  </div>
                @endforeach
              @else
                <div class="alert alert-info" role="alert">
                  Selleciona un medico y fecha para ver sus horas disponibles.
                </div>
              @endif
            </div>
          </div>
          <div class="form-group">
            <label for="type">Type of query</label>
            <div class="custom-control custom-radio mb-3">
              <input name="type" class="custom-control-input" type="radio" id="type1" 
              @if(old('type', 'Query') == 'Query') checked @endif value="Query">
              <label class="custom-control-label" for="type1">Query</label>
            </div>
          </div>
          <div class="form-group">
            <div class="custom-control custom-radio mb-3">
              <input name="type" class="custom-control-input"  type="radio" id="type2" 
              @if(old('type') == 'Exam') checked @endif value="Exam">
              <label class="custom-control-label" for="type2">Exam</label>
            </div>
          </div>
          <div class="form-group">
            <div class="custom-control custom-radio mb-3">
              <input name="type" class="custom-control-input"  type="radio" id="type3" 
              @if(old('type') == 'Operation') checked @endif value="Operation">
              <label class="custom-control-label" for="type3">Operation</label>
            </div>
          </div>

           <div class="form-group">
            <label for="password">Password</label>
            <input type="text" name="password" class="form-control" 
              value="{{ str_random(6) }}" >
          </div>
            <button type="submit" class="btn btn-primary">
              Save
            </button>
        </form>
        </div>
</div>
@endsection

@section('scripts')
  <script src="{{ asset('/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
  <script src="{{ asset('/js/appointments/create.js') }}"></script>
@endsection