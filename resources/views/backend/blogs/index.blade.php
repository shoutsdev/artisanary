@extends('backend.layouts.master')
@section('title',__('Blog List'))
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Blogs</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
                        <li class="breadcrumb-item active">Blog List</li>
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
                <div class="col-md-12">
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
                                    <th style="width: 10px">#</th>
                                    <th>{{__('Image')}}</th>
                                    <th>{{__('Title')}}</th>
                                    <th>{{__('Status')}}</th>
                                    <th style="width: 40px">{{ __('Action')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($blogs as $key=> $blog)
                                    <tr>
                                        <td>{{ $blogs->firstItem() + $key }}</td>
                                        <td>{{ $blog->title }}</td>
                                        <td><img src="{{ asset($blog->image) }}" alt="{{ $blog->title }}"></td>
                                        <td><span @class([
                                            'badge',
                                            'badge-success' => $blog->status == 1,
                                            'badge-danger' => $blog->status == 0,
                                        ])>{{ $blog->status == 1 ? 'Active' : 'Inactive' }}</span></td>
                                        <td>
                                            <a href="{{ route('blogs.edit', $blog->id) }}" class="btn view btn-block btn-primary btn-xs">{{ __('Edit') }}</a>
                                            <form action="{{ route('blogs.destroy', $blog->id) }}" method="post">
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
                            {{ $blogs->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
