@extends('backend.layouts.master')
@section('title',__('User'))
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">User</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
                        <li class="breadcrumb-item active">User</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    @include('layouts.alert')
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{__('User')}}</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <table class="table table-sm">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{__('Name')}}</th>
                                    <th>{{__('Email')}}</th>
                                    <th>{{__('Role')}}</th>
                                    <th>{{ __('Action')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($users as $key=> $user)
                                    <tr>
                                        <td>{{ $users->firstItem() + $key }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->role->name }}</td>
                                        <td>
                                            <a href="{{ route('users.edit', $user->id) }}" class="btn view btn-block btn-primary btn-xs">{{ __('Edit') }}</a>
                                            <form action="{{ route('users.destroy', $user->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-block btn-danger btn-xs">
                                                    {{__('Delete')}}
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="text-center">
                                            {{ __('No Data Found') }}
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
                @include('backend.users.form')
            </div>
        </div>
    </section>
@endsection
