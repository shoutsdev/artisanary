@extends('backend.layouts.master')
@section('title', isset($edit) ?__('Edit Blog') : __('Create Blog'))
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Blog</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">{{ isset($edit) ?__('Edit Blog') : __('Create Blog') }}</li>
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
                            <h3 class="card-title">{{ isset($edit) ?__('Edit Blog') : __('Create Blog') }}</h3>
                        </div>
                        @php
                            $route = isset($edit) ? route('blogs.update',$edit->id) : route('blogs.store');
                        @endphp
                        <!-- /.card-header -->
                        <form action="{{ $route }}" method="post" enctype="multipart/form-data">@csrf
                            @isset($edit)
                                @method('PUT')
                            @endisset
                            <input type="hidden" name="user_id" value="{{ isset($edit) ? $edit->user_id : auth()->id() }}">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="title">{{ __('Title') }}</label>
                                            <input name="title" id="title" type="text"
                                                   class="form-control" placeholder="{{ __('Enter Title') }}" value="{{ old('title',@$edit->title) }}">
                                            <span class="text-danger">{{ $errors->first('title') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="image">{{ __('Image') }}</label>
                                            <input name="image" id="image" type="file"
                                                   class="form-control">
                                            <span class="text-danger">{{ $errors->first('image') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="status">{{ __('Status') }}</label>
                                            <select name="status" id="status"
                                                    class="form-control text-capitalize">
                                                <option value="1" {{ old('status',@$edit->status) == 1 ? 'selected' : '' }}>{{ __('Active') }}</option>
                                                <option value="0" {{ old('status',@$edit->status) == 0 ? 'selected' : '' }}>{{ __('Inactive') }}</option>
                                            </select>
                                            <span class="text-danger error">{{ $errors->first('status') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="summernote">{{ __('Description') }}</label>
                                            <textarea id="summernote" name="description" class="summernote">{{ old('description',@$edit->description) }}</textarea>
                                            <span class="text-danger error">{{ $errors->first('description') }}</span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="card-footer text-right">
                                <button type="submit" class="btn btn-primary">{{ __('Save')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('js')
    <script>
        $('#summernote').summernote({
            placeholder: 'Enter Description',
            tabsize: 2,
            height: 250
        });
    </script>
@endpush
