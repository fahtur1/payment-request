@extends('layout.auth')

@section('content')
    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-8 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome To <br> Al - Khair Indonesia!</h1>
                                    </div>
                                    @if(session('status'))
                                        <div class="alert alert-{{ session('class') }} alert-dismissible fade show"
                                             role="alert">
                                            {{ session('status') }}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endif
                                    <form class="user" method="post" action="{{ route('auth.login.post') }}">
                                        @csrf
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" name="email_staff"
                                                   id="exampleInputEmail" aria-describedby="emailHelp"
                                                   placeholder="Enter Email Address...">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                   name="password" id="exampleInputPassword" placeholder="Password">
                                        </div>
                                        <button class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>
                                    </form>
                                    {{--                                    <hr>--}}
                                    {{--                                    <div class="text-center">--}}
                                    {{--                                        <a class="small" href="forgot-password.html">Forgot Password?</a>--}}
                                    {{--                                    </div>--}}
                                    {{--                                    <div class="text-center">--}}
                                    {{--                                        <a class="small" href="{{ route('auth.register') }}">Create an Account!</a>--}}
                                    {{--                                    </div>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
