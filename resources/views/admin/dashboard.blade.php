@extends('layouts.index')
@section('title', "Home")

@section('content')
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
    <a class="navbar-brand" href="#"></a>
    <button class="navbar-toggler d-none" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-link me-2 active" href="#">Home <span class="sr-only">(current)</span></a>
        <a class="nav-link me-2" href="#">Data Cluster</a>
        <a class="nav-link me-2" href="#">Variabel Penilaian</a>
        <a class="nav-link me-2" href="#">Manajemen Data Stunting</a>
        <a class="nav-link me-2" href="#">Penilaian K-Means</a>
        <a class="nav-link me-2" href="#">Laporan Hasil</a>
      </div>
    </div>
  </div>
</nav>
<main class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card mt-5 shadow-lg border-0 rounded-lg">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="#" class="card-link">Card link</a>
                    <a href="#" class="card-link">Another link</a>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

