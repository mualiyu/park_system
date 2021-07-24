@extends('layouts.index')

@section('content')
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}

<div class="contact-page">
    <br>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9 col-lg-12 col-xl-10">
                <div class="card shadow-lg o-hidden border-0 my-5">
                    <div class="card-body">
                             <div class="text-center">
                                <h4 class="text-dark mb-4">{{ __('Reset Password') }}</h4>
                            </div>
                                @if (session('resent'))
                                     <div class="alert alert-success" role="alert">
                                         {{ __('A fresh verification link has been sent to your email address.') }}
                                     </div>
                                 @endif
                                 {{ __('Before proceeding, please check your email for a verification link.') }}
                                 {{ __('If you did not receive the email') }},
                                 <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                                     @csrf
                                     <button type="submit" class="btn btn-primary btn-block text-white btn-user">{{ __('click here to request another') }}</button>.
                                 </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
