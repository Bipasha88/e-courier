@extends('auth.layouts._default')
@section('title', 'SB Admin 2 - Register')

@section('content')
    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                <div class="col-lg-7">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                        </div>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form class="user" action="{{ Route('registerpost') }}" method="post">
                            @csrf
                            <div class="form-group">

                                <input type="text" class="form-control form-control-user" id="exampleFirstName"
                                           placeholder="Full Name" name="name" value="{{ old('name') }}" required autofocus>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control form-control-user" id="exampleInputEmail"
                                       placeholder="Email Address" name="email" value="{{ old('email') }}" required autofocus>
                            </div>
                            <div class="form-group">
                                    <input type="password" class="form-control form-control-user"
                                           id="exampleInputPassword" placeholder="Password"
                                           name="password" value="{{ old('password') }}" required>
                            </div>
                            <div class="form-group">

                                <input type="text" class="form-control form-control-user" id="exampleFirstName"
                                       placeholder="Address" name="address" value="{{ old('address') }}" required autofocus>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="text" class="form-control form-control-user"
                                           id="exampleInputPassword" placeholder="City"
                                           name="city" value="{{ old('city') }}" required>
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control form-control-user"
                                           id="exampleInputPassword" placeholder="Zone"
                                           name="zone" value="{{ old('zone') }}" required>
                                </div>
                            </div>
                            <div class="form-group">

                                <input type="text" class="form-control form-control-user" id="exampleFirstName"
                                       placeholder="Phone Number" name="phone" value="{{ old('phone') }}" required autofocus>
                            </div>
                            <div class="form-group">
                                <select  class="form-select form-control"
                                         aria-label="Default select example" name="role" value="{{ old('role') }}" required autofocus>
                                        <option>Merchant</option>
                                        <option>Rider</option>
                                </select>
                            </div>
                            <button type="submit"  class="btn btn-primary btn-user btn-block">
                                Register Account
                            </button>
                        </form>
                        <hr>
                        <div class="text-center">
                            <a class="small" href="{{route('login')}}">Already have an account? Login!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

