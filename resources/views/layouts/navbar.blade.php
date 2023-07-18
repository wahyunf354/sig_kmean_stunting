<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="#">Aplikasi K-Means Stunting</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    @if(!Request::is('/')) 
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">Home</a>
        <a class="nav-link" href="{{ route('admin.data_cluster') }}">Data Cluster</a>
        <a class="nav-link" href="#">Variabel Penilaian</a>
        <a class="nav-link" href="#">Manajemen Data Stunting</a>
        <a class="nav-link" href="#">Penilaian K-Means</a>
        <a class="nav-link" href="#">Laporan Hasil</a>
      </div>
    </div>
    @endif
  </div>
</nav>