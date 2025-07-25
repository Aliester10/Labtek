@extends('layouts.customer.master2')

@section('content')

<?php 
use App\Models\TParameter;
$parameter = TParameter::first();
?>

    <!----------------------- Main Container -------------------------->
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <!----------------------- Register Container -------------------------->
        <div class="row border rounded-5 p-3 bg-white shadow box-area">
            <!--------------------------- Left Box ----------------------------->
            <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box" style="background: #416bbf;">
                <div class="inner-box rounded-4 p-4" style="background: #ffffff;">
                    <div class="featured-image mb-3 d-flex justify-content-center">
                        <a href="{{ route('home') }}">
                        <img src="{{ asset($parameter->logo1) }}" class="img-fluid" style="width: 250px;">
                    </a>
                    </div>
                    <p class="text-dark fs-2 text-center">{{ __('messages.join_us') }}</p>
                    <p class="text-dark text-wrap text-center">{{ __('messages.be_part_of_platform') }}</p>
                </div>
            </div>

            <!----------------------------- Right Box ---------------------------->
            <div class="col-md-6 right-box">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="row align-items-center">
                        <div class="header-text mb-4">
                            <h2>{{ __('messages.create_account') }}</h2>
                            <p>{{ __('messages.start_your_experience') }}</p>
                        </div>

                        <!-- Name Input -->
                        <div class="input-group mb-3">
                            <input id="name" type="text" class="form-control form-control-lg bg-light @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="{{ __('messages.full_name') }}">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Email Input -->
                        <div class="input-group mb-3">
                            <input id="email" type="email" class="form-control form-control-lg bg-light @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="{{ __('messages.email_address') }}">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Password Input -->
                        <div class="input-group mb-3">
                            <input id="password" type="password" class="form-control form-control-lg bg-light @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="{{ __('messages.password') }}">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Confirm Password Input -->
                        <div class="input-group mb-3">
                            <input id="password-confirm" type="password" class="form-control form-control-lg bg-light" name="password_confirmation" required autocomplete="new-password" placeholder="{{ __('messages.confirm_password') }}">
                        </div>

                        <!-- Register Button -->
                        <div class="input-group mb-3">
                            <button type="submit" class="btn btn-lg text-white w-100 fs-6" style="background: #416bbf;">{{ __('messages.register') }}</button>
                        </div>

                        <!-- Sign In with Google Button -->
                        <div class="input-group mb-3">
                            <a href="{{ route('socialite.redirect', 'google') }}" class="btn btn-lg btn-light w-100 fs-6">
                                <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABwAAAAcCAMAAABF0y+mAAAAzFBMVEVHcEz////////+/v77+/vx8fL9/f309fX+/v739/f////09PXOz8/5+vr8/P3////////29vf///////84qlf8wAdGiPX8/PzsUUTqQjQsqFLrSj3S3/w6g/TqPCs0gPQgpUf85+bv9P+63sL62Nb+8ef4ycbw+PJkunkeePP81HXwgGv0jhzc5/3o9efX7N5Fr19Uj/WQy562zPr2trL94KDzoJrzoJv80Gjyl5H94qgyh9v7xzihsSp+wYV1sE5ZtXBmmvUynoWKrvzKDGT6AAAAE3RSTlMAW+TTeBLcHLMt1WsKzfUznkBIxSDAuAAAAUZJREFUKJFtktligkAMRUFZxKVuDMOAggpu1apVu+/t//9TkxBU1PsySQ4hlyGadpTd0fWOrV2R3eqyWhe80j1RpYCc7pmcI2tyaZimQw6bOTMplU9hpKIofJSUmgwtTCYq9EFhqKIJ5lbGdGIRAGhUQLNX6wRLOA2Y8vdpuvfVOJtaOjhdhL56yYrjU8cGFsRSLc4/x+DPfxBiSZN6LMlXUYXzVghBT8/7pPkdxFX28yzEO8HYI8U9dlQudMZx3AeInWWe+SrExxrhCLTre3E+M3P7FXznLn887z53a2PwGbjBLLvUP2jcYUC/FYdOA9d1g22SbN1fbizT9bUxXA+QguB4G2GlfbIFqw1i0GCzKmzDDQ1LZgPQLKHk5rAJpmSj0ykH0jxArW4V79yqF1bMkEckjYvFrTWIy0btApFsx7m68Ff1D4OdMHbngtKsAAAAAElFTkSuQmCC" style="width:20px" class="me-2">
                                <small>{{ __('messages.register_with_google') }}</small>
                            </a>
                        </div>

                        <!-- Login Link -->
                        <div class="input-group">
                            <small>{{ __('messages.already_have_account') }} <a href="{{ route('login') }}">{{ __('messages.login') }}</a></small>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap');
        body {
            font-family: 'Poppins', sans-serif;
            background: #ececec;
        }
        /* Register container */
        .box-area {
            width: 930px;
        }
        /* Right box */
        .right-box {
            padding: 40px 30px 40px 40px;
        }
        /* Custom Placeholder */
        ::placeholder {
            font-size: 16px;
        }
        .rounded-4 {
            border-radius: 20px;
        }
        .rounded-5 {
            border-radius: 30px;
        }
        /* For small screens */
        @media only screen and (max-width: 768px) {
            .box-area {
                margin: 0 10px;
            }
            .left-box {
                height: 100px;
                overflow: hidden;
            }
            .right-box {
                padding: 20px;
            }
        }

        @media only screen and (max-width: 768px) {
    .left-box {
        height: auto;
        justify-content: center;
        align-items: center;
        padding: 20px;
    }

    .inner-box {
        width: auto;
        padding: 20px;
        text-align: center;
    }

    /* Hide the text elements */
    .left-box .inner-box p {
        display: none;
    }

    /* Adjust the logo size */
    .left-box .featured-image img {
        width: 150px;
    }
}

    </style>
@endsection
