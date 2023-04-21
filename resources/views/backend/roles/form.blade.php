<div class="col-md-4">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ isset($edit) ?__('Edit Role') : __('Create Role') }}</h3>
        </div>
        @php
            $route = isset($edit) ? route('roles.update',$edit->id) : route('roles.store');
        @endphp
            <!-- /.card-header -->
        <form action="{{ $route }}" method="post">@csrf
            @isset($edit)
                @method('PUT')
            @endisset
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="name">{{ __('Name') }}</label>
                            <input name="name" id="name" type="text"
                                   class="form-control" placeholder="{{ __('Enter Name') }}"
                                   value="{{ old('name',@$edit->name) }}">
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="status">{{ __('Status') }}</label>
                            <select name="status" id="status"
                                    class="form-control text-capitalize">
                                <option
                                    value="1" {{ old('status',@$edit->status) == 1 ? 'selected' : '' }}>{{ __('Active') }}</option>
                                <option
                                    value="0" {{ old('status',@$edit->status) == 0 ? 'selected' : '' }}>{{ __('Inactive') }}</option>
                            </select>
                            <span class="text-danger error">{{ $errors->first('status') }}</span>
                        </div>
                    </div>
                    <div class="col-lg-12"><h6>Permissions</h6></div>
                    <div class="col-lg-12">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="permissions[]"  value="roles.create" {{ isset($edit) && $edit->permissions && in_array('roles.create',$edit->permissions) ? 'checked' : '' }}>
                            <label class="form-check-label mr-5">Create Role</label>

                            <input class="form-check-input" type="checkbox" name="permissions[]" value="roles.edit" {{ isset($edit) && $edit->permissions && in_array('roles.edit',$edit->permissions) ? 'checked' : '' }}>
                            <label class="form-check-label mr-5">Edit Role</label>

                            <input class="form-check-input" type="checkbox" name="permissions[]" value="roles.destroy" {{ isset($edit) && $edit->permissions && in_array('roles.destroy',$edit->permissions) ? 'checked' : '' }}>
                            <label class="form-check-label">Delete Role</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="permissions[]" value="users.create" {{ isset($edit) && $edit->permissions && in_array('users.create',$edit->permissions) ? 'checked' : '' }}>
                            <label class="form-check-label mr-5">Create User</label>

                            <input class="form-check-input" type="checkbox" name="permissions[]" value="users.edit" {{ isset($edit) && $edit->permissions && in_array('users.edit',$edit->permissions) ? 'checked' : '' }}>
                            <label class="form-check-label mr-5">Edit User</label>

                            <input class="form-check-input" type="checkbox" name="permissions[]" value="users.destroy" {{ isset($edit) && $edit->permissions && in_array('users.destroy',$edit->permissions) ? 'checked' : '' }}>
                            <label class="form-check-label">Delete User</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="permissions[]" value="blogs.create" {{ isset($edit) && $edit->permissions && in_array('blogs.create',$edit->permissions) ? 'checked' : '' }}>
                            <label class="form-check-label mr-5">Create Blog</label>

                            <input class="form-check-input" type="checkbox" name="permissions[]" value="blogs.edit" {{ isset($edit) && $edit->permissions && in_array('blogs.edit',$edit->permissions) ? 'checked' : '' }}>
                            <label class="form-check-label mr-5">Edit Blog</label>

                            <input class="form-check-input" type="checkbox" name="permissions[]" value="blogs.destroy" {{ isset($edit) && $edit->permissions && in_array('blogs.destroy',$edit->permissions) ? 'checked' : '' }}>
                            <label class="form-check-label">Delete Blog</label>
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
