@extends('layout.auth')

@section('content')
    <div class="container">

        <div class="row justify-content-center">

            <div class="col-xl-6 col-lg-8 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                                    </div>
                                    <form class="user" method="post" action="{{ route('auth.register.post') }}">
                                        @csrf
                                        <div class="form-group row">
                                            <div class="col-sm mb-3 mb-sm-0">
                                                <input type="text" class="form-control form-control-user"
                                                       id="exampleFirstName" name="nama_staff"
                                                       placeholder="Name" value="{{ old('nama_staff') }}">
                                                @error('nama_staff')
                                                <small class="ml-2 text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user"
                                                   id="exampleInputEmail" name="email_staff"
                                                   placeholder="Email Address" value="{{ old('email_staff') }}">
                                            @error('email_staff')
                                            <small class="ml-2 text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <input type="password" class="form-control form-control-user"
                                                       id="exampleInputPassword" name="password" placeholder="Password">
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="password" class="form-control form-control-user"
                                                       id="exampleRepeatPassword" name="confirm_password"
                                                       placeholder="Confirm Password">
                                            </div>
                                            @error('password')
                                            <small class="ml-3 mt-2 text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Register Account
                                        </button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="forgot-password.html">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="{{ route('auth.login') }}">Already have an account?
                                            Login!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
