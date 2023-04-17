@extends('layouts.Backend.admin.admin')

@section('content')
    <section id="body-content" class="">
        <div class="container-fluid px-lg-5 px-md-4 pb-5 pt-lg-3">
            <div class="row pt-4">
                <div class="col-12">
                    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='white'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                        <ol class="breadcrumb mb-2">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Cart</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row pb-4">
                <div class="col-sm-6 text-white my-auto">

                    <h3 class="mb-0">All Users</h3>
                </div>
            </div>

            <div class="bg-white rounded page-height mt-3 shadow">
                <div class="p-lg-4 p-3">
                    <div class="pt-2 pb-4">
                        <h5>Create new User</h5>
                    </div>
                    <form action="" method="post" name="create_user" id="createUser">
                        <div class="justify-content-center">
                        <div class="color-records pb-3">
                            <div class="row">
                                <div class="col-lg-12 col-xl-12">
                                    <div class="row gx-2">
                                        <div class="col-lg-3">
                                            <label for="name" class="pb-2">First Name <span class="text-danger">*</span></label>
                                            <input type="text" id="name" class="form-control" name="name" placeholder="First Name" value="{{old('name')}}">
                                        </div>
                                        <div class="col-lg-3">
                                            <label for="last_name" class="pb-2">Last Name <span class="text-danger">*</span></label>
                                            <input type="text" id="last_name" class="form-control" name="last_name" placeholder="Last Name" value="{{old('last_name')}}">
                                        </div>
                                        <div class="col-lg-3">
                                            <label for="email" class="pb-2">Email <span class="text-danger">*</span></label>
                                            <input type="text" id="email" class="form-control" name="email" placeholder="Email" value="{{old('email')}}">
                                        </div>
                                        <div class="col-lg-3">
                                            <label for="password" class="pb-2">Password <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="password" name="password" placeholder="Password" value="{{old('password')}}">
                                        </div>
                                    </div>
                                    <div class="row gx-2 mt-3">
                                        <div class="col-lg-3 my-auto">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="1" id="send_email">
                                                <label class="form-check-label" for="send_email">
                                                    Send the new user an email about their account.
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <label for="role" class="pb-2">Roles <span class="text-danger">*</span></label>
                                            <select name="role" id="role" class="form-select" >
                                                <option value="">Select Roles</option>
                                                @foreach($allRoles->toArray() as $role)
                                                    <option value="{{$role->name}}">{{ucfirst($role->name)}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-lg-2 text-center mt-4">
                                            <label></label>
                                            <button name="create_user" type="submit" class="btn btn-primary">Create User</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
                <div class="p-lg-4 p-3">
                    <div class="table-responsive mt-2">
                        <table class="table table-striped">
                            <thead class="text-white bg-secondary">
                            <tr>
                                <th>#</th>
                                <th>User Name</th>
                                <th>User Email</th>
                                <th>User Role</th>
                                <th>Registered Date</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $index => $user)
                                   <tr>
                                       <td>{{$index+1}}</td>
                                       <td>{{$user->name}}</td>
                                       <td>{{$user->email}}</td>
                                       <td>
                                            @if(!empty($user->roles->toArray()))
                                                @foreach($user->roles as $role)
                                                    <span class="me-2">{{$role->name}}</span>
                                               @endforeach
                                           @else
                                            Not Found!
                                           @endif
                                       </td>
                                       <td>{{$user->created_at}}</td>
                                   </tr>
                                @endforeach
                            </tbody>

                        </table>
                        <div class="justify-content-center">
                            {{$users->links()}}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

@endsection
