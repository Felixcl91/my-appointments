<div class="table-responsive">
          <!-- Projects table -->
      <table class="table align-items-center table-flush">
            <thead class="thead-light">
              <tr>
                <th scope="col">Specialty</th>
                <th scope="col">Date</th>
                <th scope="col">Hour</th>
                <th scope="col">Status</th>
                <th scope="col">Options</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($oldAppointments as $appointment)
              <tr>
                <td>
                  {{ $appointment->specialty->name }}
                </td>
                <td>
                  {{ $appointment->scheduled_date }}
                </td>
                <td>
                  {{ $appointment->scheduled_time_12 }}
                </td>
                <td>
                  {{ $appointment->status }}
                </td>
                <td>
                  <a href="{{ url('/appointments/'.$appointment->id) }}" class="btn btn-primary">Ver</a>
                </td>
              </tr>
              @endforeach
            </tbody>
      </table>
</div>

<div class="card-body">
    {{ $oldAppointments->links() }}
</div>