@extends('backend.layouts.master')
@section('title',__('Role'))
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Role</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
                        <li class="breadcrumb-item active">Role</li>
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
                            <h3 class="card-title">{{__('Blogs')}}</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <table class="table table-sm">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{__('Title')}}</th>
                                    <th>{{__('Status')}}</th>
                                    <th>{{ __('Action')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($roles as $key=> $role)
                                    <tr>
                                        <td>{{ $roles->firstItem() + $key }}</td>
                                        <td>{{ $role->name }}</td>
                                        <td><span @class([
                                            'badge',
                                            'badge-success' => $role->status == 1,
                                            'badge-danger' => $role->status == 0,
                                        ])>{{ $role->status == 1 ? 'Active' : 'Inactive' }}</span></td>
                                        <td>
                                            <a href="{{ route('roles.edit', $role->id) }}" class="btn view btn-block btn-primary btn-xs">{{ __('Edit') }}</a>
                                            <form action="{{ route('roles.destroy', $role->id) }}" method="post">
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
                            {{ $roles->links() }}
                        </div>
                    </div>
                </div>
                @include('backend.roles.form')
            </div>
        </div>
    </section>
@endsection
