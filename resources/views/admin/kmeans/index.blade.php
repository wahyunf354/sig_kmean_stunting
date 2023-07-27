@extends('layouts.index')
@section('title', "Manajemen Data Stunting")

@section('content')
<main class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card mt-5 shadow-lg border-0 rounded-lg">
                <div class="card-header">
                  <h2>Manajemen Data Stunting</h2>
                  @if(session('success')):
                  <div class="alert alert-success" role="alert">
                    {{session('success')}}
                  </div>
                  @endif
                  @if(session('warning')):
                  <div class="alert alert-warning" role="alert">
                    {{session('warning')}}
                  </div>
                  @endif
                </div>
                <div class="card-body">
                  {{-- <h3>{{$row->title}}</h3> --}}
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Jumlah Laki-Laki</th>
                        <th scope="col">Jumlah Prempuan</th>
                        <th scope="col">Cluster</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($stunting as $key => $row)
                      <tr>
                        <td scope="col">{{$key+1}}</td>
                        <td scope="col">{{ $row['name'] }}</td>
                        <td scope="col">{{ $row['jumlah_laki_laki'] }}</td>
                        <td scope="col">{{ $row['jumlah_prempuan'] }}</td>
                        <td scope="col">{{ $row['label'] }}</td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>

                </div>
            </div>
        </div>
    </div>
</main>
@endsection