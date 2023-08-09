@extends('layouts.index')
@section('title', "Home")

@section('content')
<style>
    #map { height: 70vh; }
</style>
<main class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card mt-5 shadow-lg border-0 rounded-lg">
                <div class="card-body">
                    @include('components.map')
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

