<div class="col-md-4">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ isset($edit) ?__('Edit User') : __('Create User') }}</h3>
        </div>
        @php
            $route = isset($edit) ? route('users.update',$edit->id) : route('users.store');
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
                            <label for="email">{{ __('Email') }}</label>
                            <input name="email" id="email" type="email"
                                   class="form-control" placeholder="{{ __('Enter Email') }}"
                                   value="{{ old('email',@$edit->email) }}">
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="password">{{ __('Password') }}</label>
                            <input name="password" id="password" type="password"
                                   class="form-control" placeholder="{{ __('Enter Password') }}">
                            <span class="text-danger">{{ $errors->first('password') }}</span>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="password_confirmation">{{ __('Confirm Password') }}</label>
                            <input name="password_confirmation" id="password_confirmation" type="password"
                                   class="form-control" placeholder="{{ __('Re-Enter Password') }}">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="role_id">{{ __('Role') }}</label>
                            <select name="role_id" id="role_id" class="form-control text-capitalize">
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}" {{ old('role_id',@$edit->role_id) == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger error">{{ $errors->first('role_id') }}</span>
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
