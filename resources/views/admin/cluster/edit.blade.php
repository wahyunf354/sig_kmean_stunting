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
                  <h3>Edit Data Cluster</h3>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                      <form method="POST" action="{{route('admin.data_cluster.store')}}">
                        @method('put')
                        @csrf
                        <input type="hidden" name="id" value="{{$cluster->id}}">
                        <div class="mb-3">
                          <label for="title" class="form-label">Nama Cluster</label>
                          <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title" placeholder="Masukkan nama" value="{{$cluster->title}}" >
                          <div class="invalid-feedback">
                            {{$errors->first("title")}}
                          </div>
                        </div>
                        <div class="mb-3">
                          <label for="order" class="form-label">Order</label>
                          <input type="number" class="form-control @error('order') is-invalid @enderror" name="order" id="order" placeholder="Masukkan nama" value="{{$cluster->order}}" >
                          <div class="invalid-feedback">
                            {{$errors->first("order")}}
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