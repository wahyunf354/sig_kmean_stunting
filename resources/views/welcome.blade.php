@extends('layouts.index')
@section('title', "Home")

@section('content')
<main class="container">
    <div class="row">
        <div class="col-md-8">
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
        <div class="col-md-4">
            <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header"><h4 class="text-center font-weight-light">Login</h4></div>
                <div class="card-body">
                    <form action="{{route('signin')}}" method="POST">
                        @csrf
                        <div class="form-floating mb-3">
                            <input class="form-control" name="email" id="inputEmail" type="email" placeholder="name@example.com" />
                            <label for="inputEmail">Email address</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input class="form-control" name="password" id="inputPassword" type="password" placeholder="Password" />
                            <label for="inputPassword">Password</label>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                            <a class="small d-none" href="password.html">Forgot Password?</a>
                            <button class="btn btn-primary" type="submit">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

