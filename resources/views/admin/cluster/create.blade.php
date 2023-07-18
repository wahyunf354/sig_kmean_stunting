@extends('layouts.index')
@section('title', "Data Cluster")

@section('content')
<main class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card mt-5 shadow-lg border-0 rounded-lg">
                <div class="card-header d-flex align-items-center">
                  <a href="{{route('admin.data_cluster')}}" class="me-2">
                    <i class="fa-solid fa-arrow-left fa-xl"></i>
                  </a>
                  <h3>Tambah Data Cluster</h3>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                      <form method="POST" action="{{route('admin.data_cluster.store')}}">
                        @csrf
                        <div class="mb-3">
                          <label for="title" class="form-label">Nama Cluster</label>
                          <input type="text" value="{{old('title')}}" class="form-control @error('title') is-invalid @enderror" name="title" id="title" placeholder="Masukkan nama"  >
                          <div class="invalid-feedback">
                            {{$errors->first("title")}}
                          </div>
                        </div>
                        <button class="btn btn-sm btn-outline-primary" type="submit">Submit</button>
                      </form>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection