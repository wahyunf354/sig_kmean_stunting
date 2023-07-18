@extends('layouts.index')
@section('title', "Variabel Penilaian")

@section('content')
<main class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card mt-5 shadow-lg border-0 rounded-lg">
                <div class="card-header d-flex align-items-center">
                  <a href="{{route('admin.variable_penilaian')}}" class="me-2">
                    <i class="fa-solid fa-arrow-left fa-xl"></i>
                  </a>
                  <h3>Tambah Variabel Penilaian</h3>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                      <form method="POST" action="{{route('admin.variable_penilaian.store')}}">
                        @csrf
                        <div class="mb-3">
                          <label for="name" class="form-label">Nama Variabel</label>
                          <input type="text" value="{{old('name')}}" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Masukkan nama"  >
                          <div class="invalid-feedback">
                            {{$errors->first("name")}}
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