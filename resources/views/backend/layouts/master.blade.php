@extends('backend.layouts.base')
@section('base.content')
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{ asset('assets/backend/img/AdminLTELogo.png') }}" alt="AdminLTELogo" height="60" width="60">
        </div>
        @include('backend.layouts.header')
        @include('backend.layouts.sidebar')
        <div class="content-wrapper">
            @yield('content')
        </div>
        @include('backend.layouts.footer')
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
@endsection
