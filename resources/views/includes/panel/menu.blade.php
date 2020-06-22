<!-- Navigation -->  
<h6 class="navbar-heading text-muted">
  @if(auth()->user()->role == 'admin')
    Gestionar datos
  @else
    Menú
  @endif
</h6>
  <ul class="navbar-nav">
    @if (auth()->user()->role == 'admin')
          <li class="nav-item">
            <a class="nav-link" href="/home">
              <i class="ni ni-tv-2 text-primary"></i> Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/specialties">
              <i class="ni ni-planet text-blue"></i> Specialties
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/doctors">
              <i class="ni ni-single-02 text-orange"></i> Doctors
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/patients">
              <i class="ni ni-satisfied text-info"></i> Patients
            </a>
          </li>
    @elseif (auth()->user()->role == 'doctor')
          <li class="nav-item">
            <a class="nav-link" href="/schedule">
              <i class="ni ni-planet text-blue"></i> Manage schedule
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/doctors">
              <i class="ni ni-time-alarm text-primary"></i> My appointments
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/patients">
              <i class="ni ni-satisfied text-info"></i> My patients
            </a>
          </li>
    @else {{--patient--}}
          <li class="nav-item">
            <a class="nav-link" href="/patients">
              <i class="ni ni-send tex-danger"></i> Book appointment
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/patients">
              <i class="ni ni-satisfied text-info"></i> My appointments
            </a>
          </li>
    @endif
          <li class="nav-item">
            <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('formLogout').submit();">
              <i class="ni ni-key-25 "></i> Logout
            </a>
            <form action="{{ route('logout') }}" method="POST" style="display: none;" id="formLogout">
              @csrf
            </form>
          </li>
          
  </ul>

<!-- Divider -->
  @if (auth()->user()->role == 'admin')
        <hr class="my-3">
        <!-- Heading -->
        <h6 class="navbar-heading text-muted">Reportes</h6>
        <!-- Navigation -->
        <ul class="navbar-nav mb-md-3">
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="ni ni-palette text-red"></i> Frecuencia de citas
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="ni ni-spaceship"></i> Médicos más activos
            </a>
          </li>
  @endif
        </ul>