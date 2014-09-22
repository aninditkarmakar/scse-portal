<div class="contain-to-grid sticky">
  <nav class="top-bar" data-topbar data-options="sticky_on: large">
   <ul class="title-area">
    <li class="name site-title">
      <h1><a href="{{ route('home') }}">SCSE PORTAL</a>
      </li>
      <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
    </ul>

    <section class="top-bar-section">
      <ul class="right">
        @if(!Auth::check())
          <li class=""><a href="{{ route('login.index') }}">LOGIN</a></li>
        @else 
          <?php $dashboard_url = route('dashboard'); ?>
          <li class="{{ Request::url() === $dashboard_url?('active'):('') }}">{{ link_to_route('dashboard', 'Dashboard') }}</li>
          <li class=""><a href="{{ route('logout') }}">LOGOUT</a></li>
          
        @endif
      </ul>
      <ul class="left">
        @if(Auth::check()) 
          <?php $create_student_url = route('student.create'); ?>
          <?php $create_faculty_url = route('faculty.create'); ?>
          
          <li class="{{ Request::url() === $create_student_url?('active'):('') }}">{{ link_to_route('student.create', 'Add Student') }}</li>
          <li class="{{ Request::url() === $create_faculty_url?('active'):('') }}">{{ link_to_route('faculty.create', 'Add Faculty') }}
        @endif
      </ul>
    </section>
  </nav>
</div>