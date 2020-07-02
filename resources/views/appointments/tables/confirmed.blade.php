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
                <th scope="col">Status</th>
                <th scope="col">Options</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($confirmedAppointments as $appointment)
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
                  {{ $appointment->status }}
                </td>
                <td>
                  @if ($role == 'admin')
                    <a class="btn btn-sm btn-primary" title="Ver cita" 
                    href="{{ url('/appointments/'.$appointment->id) }}">See
                    </a>
                  @endif
                  <a class="btn btn-sm btn-danger" title="Cancelar cita" 
                  href="{{ url('/appointments/'.$appointment->id.'/cancel') }}">Cancel
                  </a>

                </td>
              </tr>
              @endforeach
            </tbody>
      </table>
</div>

<div class="card-body">
      {{ $confirmedAppointments->links() }}
</div>