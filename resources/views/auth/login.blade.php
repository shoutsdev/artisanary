@extends('backend.layouts.base')
@section('title', __('Login'))
@section('base.content')
    <div class="login-box">
        <div class="login-logo">
            <a href="../../index2.html"><b>Admin</b>LTE</a>
        </div>

        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Sign in to start your session</p>
                <form action="{{ route('login') }}" method="post">@csrf
                    <div class="input-group">
                        <input type="email" name="email" class="form-control" placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                    <div class="input-group mt-3">
                        <input type="password" name="password" class="form-control" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <span class="text-danger">{{ $errors->first('password') }}</span>
                    <div class="row mt-3">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                    </div>
                </form>
                <div class="social-auth-links text-center mb-3" id="firebaseui-auth-container">

                </div>
                <p class="mb-0">
                    <a href="{{ route('register') }}" class="text-center">Register a new membership</a>
                </p>
            </div>

        </div>
    </div>
@endsection
@push('css')
    <link type="text/css" rel="stylesheet" href="https://www.gstatic.com/firebasejs/ui/6.0.1/firebase-ui-auth.css" />
@endpush
@push('js')
    <script src="https://www.gstatic.com/firebasejs/8.10.1/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.10.1/firebase-auth.js"></script>
    <script src="https://www.gstatic.com/firebasejs/ui/6.0.1/firebase-ui-auth.js"></script>
    <script>
        const firebaseConfig = {
            apiKey: "AIzaSyBITQn4jU802VIvoaTTFHsv6bm9HKp86b8",
            authDomain: "artisanary-4a9d3.firebaseapp.com",
            projectId: "artisanary-4a9d3",
            storageBucket: "artisanary-4a9d3.appspot.com",
            messagingSenderId: "154070063718",
            appId: "1:154070063718:web:af0b346ba2c8c5f0e22ba7",
            measurementId: "G-2NK43TXPYY"
        };

        // Initialize Firebase
        firebase.initializeApp(firebaseConfig);

        var ui = new firebaseui.auth.AuthUI(firebase.auth());
        var uiConfig = {
            callbacks: {
                signInSuccessWithAuthResult: function (authResult, redirectUrl) {
                    let response = authResult.additionalUserInfo.profile;

                        var data = {
                                uid: authResult.user.uid,
                            name: response.name,
                            email: response.email,
                            picture: response.picture,
                            phone: authResult.user.phoneNumber,
                            _token: '{{ csrf_token() }}',
                        };

                    $.ajax({
                        url: "{{ route('social.login') }}",
                        type: 'POST',
                        data: data,
                        success: function (response) {
                            if (response.success) {
                                window.location.href = response.route;
                            } else {
                                alert(response.error);
                            }
                        },
                        error: function (error) {
                            alert('Something Went Wrong');
                            window.location.reload();
                        }
                    });
                    return true;
                }
            },
            signInFlow: 'popup',
            signInSuccessUrl: '#',
            signInOptions: [
                {
                    provider: firebase.auth.GoogleAuthProvider.PROVIDER_ID,
                    scopes: [
                        'https://www.googleapis.com/auth/contacts.readonly',
                        'https://www.googleapis.com/auth/user.birthday.read',
                        'https://www.googleapis.com/auth/user.gender.read',
                        'https://www.googleapis.com/auth/user.phonenumbers.read'
                    ],
                }
            ]
        };
        ui.start('#firebaseui-auth-container', uiConfig);
    </script>
@endpush
