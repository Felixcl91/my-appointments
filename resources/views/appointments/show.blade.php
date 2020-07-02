@extends('layouts.panel')

@section('content')
<div class="card shadow">
    <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0">Appointment #{{ $appointment->id }}</h3>
            </div>
          </div>
    </div>
    <div class="card-body">
       <ul>
         <li>
           <strong>Date:</strong> {{ $appointment->scheduled_date }}
         </li>
         <li>
           <strong>Hour:</strong> {{ $appointment->scheduled_time }}
         </li>

         @if ($role == 'patient' || $role == 'admin')
           <li>
             <strong>Doctor:</strong> {{ $appointment->doctor->name }}
           </li>
          @endif

         @if ($role == 'doctor' || $role == 'admin')
           <li>
             <strong>Patient:</strong> {{ $appointment->patient->name }}
           </li>
          @endif

         <li>
           <strong>Specialty:</strong> {{ $appointment->specialty->name }}
         </li>
         <li>
           <strong>Type:</strong> {{ $appointment->type }}
         </li>
         <li>
           <strong>Status:</strong> {{ $appointment->status }}
         </li>
       </ul>

      @if ($appointment->status == 'Cancelada')
       <div class="alert alert-warning">
         <p>Acerca de la cancelación</p>
         <ul>
           @if ($appointment->cancellation)
             
             <li>
               <strong>Date of cancellation: </strong>
               {{ $appointment->cancellation->created_at }}
             </li>
             <li>
              <strong>Who cancellation the appointment?: </strong>
              @if (aut()->id() == $appointment->cancellation->cancelled_by_id)
                Tú
              @else
               {{ $appointment->cancellation->cancelled_by->name }}
              @endif
             </li>
             <li>
               <strong>Justification: </strong>
               {{ $appointment->cancellation->justification }}
             </li>
            @else
              <li>This appointment went cancelled before your confirmation</li>
            @endif
         </ul>
       </div>
      @endif

       <a href="{{ url('/appointments') }}" class="btn btn-primary">Volver</a>
          
    </div>
        
</div>
@endsection