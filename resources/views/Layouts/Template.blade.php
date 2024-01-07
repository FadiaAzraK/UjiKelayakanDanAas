<!DOCTYPE html>
<html lang="en">
<head>
  <title>Rekap Keterlambatan</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: rgb(0, 0, 0);">
    <div class="container px-4">
      <a class="navbar-brand" href="/">
        <span style="color:#ffffff; font-size:26px; font-weight:bold; letter-spacing: 1px;">Rekam Keterlambatan</span>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span
          class="navbar-toggler-icon"></span></button>
          <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
        <ul class="navbar-nav">
          <li class="nav-item"><a class="nav-link" href="{{route('home')}}">Dashboard</a></li>
        </ul>
        @if (Auth::check())
          @if (Auth::user()->role == "admin")
        <div class="dropdown">
          <a class="btn btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Data Master
          </a>
          <ul class="dropdown-menu">
            <li class="nav-item"><a class="nav-link" href="{{route('siswa.home')}}">Data Siswa</a></li>
            <li class="nav-item"><a class="nav-link" href="{{route('rombel.home')}}">Data Rombel</a></li>
            <li class="nav-item"><a class="nav-link" href="{{route('rayon.home')}}">Data Rayon</a></li>
            <li class="nav-item"><a class="nav-link" href="{{route('user.home')}}">Data User</a></li>
          </ul>
        </div>

        <!-- New Menu Items -->
        <ul class="navbar-nav">
          
          <li class="nav-item"><a class="nav-link" href="{{route('rekap.telat')}}">Data Keterlambatan</a></li>
        </ul>
        @else
        <ul class="navbar-nav">
          <li class="nav-item"><a class="nav-link" href="{{route('ps.siswa.home')}}">Data Siswa</a></li>
        </ul>
        <ul class="navbar-nav">
          <li class="nav-item"><a class="nav-link" href="{{route('ps.rekap.telat')}}">Data Keterlambatan</a></li>
        </ul>
        @endif
        <ul class="navbar-nav">
          <li class="nav-item"><a class="nav-link" href="{{route('logout')}}">Logout</a></li>
        </ul>
        @endif
      </div>
    </div>
  </nav>
  <div class="container mt-5">
    @yield('content')
  </div>
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous"></script>
  @stack('script')
</body>
</html>
