@extends('layouts.index')
@section('title', "Manajemen Data Stunting")

@section('content')
<main class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card mt-5 shadow-lg border-0 rounded-lg">
                <div class="card-header d-flex align-items-center">
                  <a href="{{route('admin.stunting')}}" class="me-2">
                    <i class="fa-solid fa-arrow-left fa-xl"></i>
                  </a>
                  <h3>Tambah Data Stunting</h3>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                      <form method="POST" action="{{route('admin.stunting.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                          <label for="name" class="form-label">Nama Data</label>
                          <input type="text" value="{{old('name')}}" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Masukkan nama"  >
                          <div class="invalid-feedback">
                            {{$errors->first("name")}}
                          </div>
                        </div>
                        <div class="mb-3">
                          <label for="jumlah_laki_laki" class="form-label">Jumlah Laki-Laki</label>
                          <input type="number" min="0" value="{{old('jumlah_laki_laki')}}" class="form-control @error('jumlah_laki_laki') is-invalid @enderror" name="jumlah_laki_laki" id="jumlah_laki_laki" placeholder="Masukkan nama"  >
                          <div class="invalid-feedback">
                            {{$errors->first("jumlah_laki_laki")}}
                          </div>
                        </div>
                        <div class="mb-3">
                          <label for="jumlah_prempuan" class="form-label">Jumlah Prempuan</label>
                          <input type="number" min="0" value="{{old('jumlah_prempuan')}}" class="form-control @error('jumlah_prempuan') is-invalid @enderror" name="jumlah_prempuan" id="jumlah_prempuan" placeholder="Masukkan nama"  >
                          <div class="invalid-feedback">
                            {{$errors->first("jumlah_prempuan")}}
                          </div>
                        </div>
                        <div class="mb-3">
                          <label for="long" class="form-label">Longitude</label>
                          <input type="text" min="0" value="{{old('long')}}" class="form-control @error('long') is-invalid @enderror" name="long" id="long" placeholder="Masukkan Longitude Wilayah"  >
                          <div class="invalid-feedback">
                            {{$errors->first("long")}}
                          </div>
                        </div>
                        <div class="mb-3">
                          <label for="lat" class="form-label">Latitude</label>
                          <input type="text" min="0" value="{{old('lat')}}" class="form-control @error('lat') is-invalid @enderror" name="lat" id="lat" placeholder="Masukkan Latitude Wilayah"  >
                          <div class="invalid-feedback">
                            {{$errors->first("lat")}}
                          </div>
                        </div>
                        <div class="mb-3 d-none">
                          <label for="file_geojson" class="form-label">File GeoJSON</label>
                          <input type="file" min="0" value="{{old('file_geojson')}}" class="form-control @error('file_geojson') is-invalid @enderror" name="file_geojson" id="file_geojson" placeholder="Masukkan nama"  >
                          <div class="invalid-feedback">
                            {{$errors->first("file_geojson")}}
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