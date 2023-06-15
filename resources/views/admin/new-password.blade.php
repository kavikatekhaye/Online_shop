@extends('admin.layouts.master')
@section('content')

<div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
        @include('admin.message')

        <div class="card-header text-center">
            <a href="#" class="h3">Change Password</a>
        </div>


        <div class="card-body">
            <p class="login-box-msg">If you want change this password then enter your new password!!</p>



            {{-- @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif --}}
            <form action="{{route('admin.new-password', $user['id'])}}" method="POST">
                @csrf

                <div class="input-group mb-3">
                    <input type="password" placeholder="Password" name="password" class="form-control @error('password') is-invalid @enderror">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    @error('password')
                    <p class="invalid-feedback">{{$message}}</p>
                @enderror
                </div>


                <div class="input-group mb-3">
                    <input type="password" placeholder=" Confirm Password" name="confirm_password" class="form-control @error('confirm_password') is-invalid @enderror">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    @error('confirm_password')
                    <p class="invalid-feedback">{{$message}}</p>
                @enderror
                </div>
                <div class="row">

                    <!-- /.col -->
                    <div class="col-6">
                        <button type="submit" class="btn btn-primary btn-block">Change Password</button>
                    </div>



                    <a href="{{route('admin.dashboard')}}" class="btn btn-primary btn-shadow "><i class="fa fa-arrow-left"
                        aria-hidden="true"></i> back</a>
                    <!-- /.col -->
                </div>


            </form>
            <p class="mb-1 mt-3">
                {{-- <a href="forgot-password.html">I forgot my password</a> --}}
            </p>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>

@endsection
