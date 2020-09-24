@extends('layouts.app')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-xl-10 col-lg-9 col-md-8 ml-auto p-4">
            {{-- header --}}
            <div class="row">
                <div class="col-12 text-center">
                    <h1 class="text-center lead display-4">
                        Create User
                    </h1>
                </div>
            </div>
            {{-- end header --}}

            {{-- create user--}}
            <div class="row mt-5">
                <div class="col-12 col-md-6 mx-auto">
                    {{-- form --}}
                    <form action="{{ route('users.store')}}" method="post">
                        @csrf

                        {{-- name --}}
                        @include('units.partials.form-group',[
                        'title' => "Name",
                        'name' => 'name',
                        'type' => 'text',
                        'classes' => ['form-control', 'form-control-sm']
                        ])

                        {{-- email --}}
                        @include('units.partials.form-group',[
                        'title' => "Email",
                        'name' => 'email',
                        'type' => 'email',
                        'classes' => ['form-control', 'form-control-sm']
                        ])

                        {{-- control code --}}
                        <div class="form-group">
                            <label for="role_show">Role</label>
                            <select id="role_show" name="role_show" class="form-control" disabled>
                                <option value="2">normal user</option>
                            </select>
                            <input type="hidden" name="role_id" id="role_id" value="2">
                        </div>

                        {{-- password --}}
                        @include('units.partials.form-group',[
                        'title' => "Password",
                        'name' => 'password',
                        'type' => 'password',
                        'classes' => ['form-control', 'form-control-sm']
                        ])

                        {{-- confirm password --}}
                        @include('units.partials.form-group',[
                        'title' => "Confirm Password",
                        'name' => 'password_confirmation',
                        'type' => 'password',
                        'classes' => ['form-control', 'form-control-sm']
                        ])


                        <button class="btn btn-md btn-primary my-2">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-plus-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                              <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                              <path fill-rule="evenodd" d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                          </svg>
                        Add User</button>

                    </form>
                    {{-- end form --}}
                </div>

            </div>
            {{-- end create user --}}
        </div>
    </div>
</div>
@endsection
