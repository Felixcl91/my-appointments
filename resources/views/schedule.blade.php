@extends('layouts.panel')

@section('content')
<form action="{{ url('/schedule') }}" method="POST">
  @csrf
  <div class="card shadow">
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0">Manage schedule</h3>
            </div>
            <div class="col text-right">
              <button type="submit" class="btn btn-sm btn-primary">
              Save
            </button>
            </div>
          </div>
        </div>
        <div class="card-body">
          @if (session('notification'))
          <div class="alert alert-success" role="alert">
            {{ session('notification') }}
          </div>
          @endif
        </div>
        
        <div class="table-responsive">
          <!-- Projects table -->
          <table class="table align-items-center table-dark">
            <thead class="thead-dark">
              <tr>
                <th scope="col">Day</th>
                <th scope="col">Active</th>
                <th scope="col">Morning turn</th>
                <th scope="col">Afternoon turn</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($days as $key => $day)
              <tr>
                <th>{{ $day }}</th>
                <td>
                  <label class="custom-toggle">
                    <input type="checkbox" name="active[]" value="{{ $key }}">
                    <span class="custom-toggle-slider rounded-circle"></span>
                  </label>
                </td>
                <td>
                  <div class="row">
                    <div class="col">
                      <select class="form-control" name="morning_start[]">
                        @for ($i=5; $i<=11; $i++)
                        <option value="{{ $i }}:00">{{ $i }}:00 am</option>
                        <option value="{{ $i }}:30">{{ $i }}:30 am</option>
                        @endfor
                      </select>
                    </div>
                    <div class="col">
                      <select class="form-control" name="morning_end[]">
                      @for ($i=5; $i<=11; $i++)
                        <option value="{{ $i }}:00">{{ $i }}:00 am</option>
                        <option value="{{ $i }}:30">{{ $i }}:30 am</option>
                        @endfor
                      </select>
                    </div>   
                  </div>
                </td>
                <td>
                  <div class="row">
                    <div class="col">
                      <select class="form-control" name="afternoon_start[]">
                        @for ($i=1; $i<=11; $i++)
                        <option value="{{ $i+12 }}:00">{{ $i }}:00 pm</option>
                        <option value="{{ $i+12 }}:30">{{ $i }}:30 pm</option>
                        @endfor
                      </select>
                    </div>
                    <div class="col">
                      <select class="form-control" name="afternoon_end[]">
                      @for ($i=1; $i<=11; $i++)
                        <option value="{{ $i+12 }}:00">{{ $i }}:00 pm</option>
                        <option value="{{ $i+12 }}:30">{{ $i }}:30 pm</option>
                        @endfor
                      </select>
                    </div>
                  </div>
                </td>

              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
</div>
</form>
@endsection