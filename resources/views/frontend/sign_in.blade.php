@extends('layouts.master_frontend')
@section('content')
<div>
    <!-- ============================ Who We Are Start ================================== -->
    <section class="section-shadow">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                </div>
                <div class="col-md-7">
                    <div class="contact-form contact-box text-left">
                        <div class="modal-header">
                            <h5 class="modal-title">
                                Log In
                            </h5>
                        </div>
                        <div class="modal-body icon-form">
                            <div class="login-form">
                                {{ Form::open(array('url'=>route('do-sign-in'),'id'=>"signin-form", 'class'=>"")) }}
                                <div class="form-group">
                                    <label>
                                        Email ID
                                    </label>
                                    <div class="input-with-icon">
                                        <input name="email" class="form-control" placeholder="Email ID" type="email" required>
                                            <i class="ti-email">
                                            </i>
                                        </input>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>
                                        Password
                                    </label>
                                    <div class="input-with-icon">
                                        <input name="password" class="form-control" placeholder="*******" type="password" required>
                                            <i class="ti-unlock">
                                            </i>
                                        </input>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-md full-width pop-login" type="submit">
                                        Login
                                    </button>
                                </div>
                                {{ Form::close() }}
                            </div>
                            <div class="text-center">
                                <p class="mt-3">
                                    No Account?
                                    <a class="link" href="{{route('sign-up')}}">
                                        Create One
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="clearfix">
    </div>
    <!-- ============================ Who We Are End ================================== -->
</div>
@endsection
