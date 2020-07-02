 <div class="table-responsive">
          <!-- Projects table -->
      <table class="table align-items-center table-flush">
            <thead class="thead-light">
              <tr>
                <th scope="col">Description</th>
                <th scope="col">Specialty</th>
                @if ($role == 'patient')
                  <th scope="col">Doctor</th>
                @elseif ($role == 'doctor')
                  <th scope="col">Patient</th>
                @endif
                <th scope="col">Date</th>
                <th scope="col">Hour</th>
                <th scope="col">Type</th>
                <th scope="col">Options</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($pendingAppointments as $appointment)
              <tr>
                <th scope="row">
                  {{ $appointment->description }}
                </th>
                <td>
                  {{ $appointment->specialty->name }}
                </td>
                @if ($role == 'patient')
                  <td>
                    {{ $appointment->doctor->name }}
                  </td>
                @elseif ($role == 'doctor')
                  <td>
                      {{ $appointment->patient->name }}
                  </td>
                @endif
                <td>
                  {{ $appointment->scheduled_date }}
                </td>
                <td>
                  {{ $appointment->scheduled_time_12 }}
                </td>
                <td>
                  {{ $appointment->type }}
                </td>
                <td>
                  @if ($role == 'admin')
                    <a class="btn btn-sm btn-primary" title="Ver cita" 
                    href="{{ url('/appointments/'.$appointment->id) }}">See
                    </a>
                  @endif
                  @if ($role == 'doctor' || $role == 'admin')
                    <form action="{{ url('/appointments/'.$appointment->id. '/confirm') }}" method="POST" class="d-inline-block">
                      @csrf
                      
                      <button class="btn btn-sm btn-success" type="submit" title="Confirmar cita">Confirm</button>
                    </form>
                    <a href="{{ url('/appointments/'.$appointment->id. '/cancel') }}" 
                      class="btn btn-sm btn-danger">Cancel</a>
                    
                  @else {{-- patient --}}
                      <form action="{{ url('/appointments/'.$appointment->id. '/cancel') }}" method="POST" class="  d-inline-block">
                        @csrf
                      
                        <button class="btn btn-sm btn-danger" type="submit" title="Cancelar cita">Cancel</button>
                      </form>
                  @endif
                  
                </td>
              </tr>
              @endforeach
            </tbody>
      </table>
</div>

<div class="card-body">
    {{ $pendingAppointments->links() }}
</div>