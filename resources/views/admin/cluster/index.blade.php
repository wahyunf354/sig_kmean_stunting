@extends('layouts.index')
@section('title', "Data Cluster")

@section('content')
<main class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card mt-5 shadow-lg border-0 rounded-lg">
                <div class="card-header">
                  <h2>Data Cluster</h2>
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
                  <a href="{{route('admin.data_cluster.create')}}" class="btn btn-outline-primary btn-sm">Tambah Data</a>
                </div>
                <div class="card-body">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($clusters as $key => $row)
                      <tr>
                        <th scope="row">{{$key+1}}</th>
                        <td>{{$row->title}}</td>
                        <td>
                          <form method="POST" action="{{route('admin.data_cluster.destroy', $row->id)}}" >
                            @method('delete')
                            @csrf
                            <a href="{{route('admin.data_cluster.edit', $row->id)}}" class="btn btn-outline-primary btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                            <button type="submit" class="btn btn-sm btn-outline-danger">
                              <i class="fa-solid fa-trash"></i>
                            </button>
                          </form>
                        </td>
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