<!DOCTYPE html>
<html lang="en">

<head>
   @include('layouts.head', ['title' => 'Register employee'])
</head>

<body>
    <div class="wrapper">
        <div class="sidebar" data-image="/assets/img/sidebar-5.jpg" data-color="blue">
            <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"

        Tip 2: you can also add an image using data-image tag
    -->
            @include('layouts.sidebar', ['selected' => 'employee'])
        </div>
        <div class="main-panel">
            <!-- Navbar -->
            @include('layouts.nav', ['title' => 'New employee'])
            <!-- End Navbar -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Add an employee</h4>
                                </div>
                                <div class="card-body">
                                    <form method="POST" action="{{ route('employee.store') }}">
                        @csrf

                        <div class="form-group row">
                            

                            <div class="col-md-6">
                                <label for="firstname" class="col-form-label text-md-right">{{ __('First name') }}</label>
                                <input id="firstname" type="text" class="form-control{{ $errors->has('firstname') ? ' is-invalid' : '' }}" name="firstname" value="{{ old('firstname') }}" required autofocus>

                                @if ($errors->has('firstname'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('firstname') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <label for="lastname" class="col-form-label text-md-right">{{ __('Last name') }}</label>
                                <input id="lastname" type="text" class="form-control{{ $errors->has('lastname') ? ' is-invalid' : '' }}" name="lastname" value="{{ old('lastname') }}" required autofocus>

                                @if ($errors->has('lastname'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('lastname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            

                            <div class="col-md-6">
                                <label for="phone" class="col-form-label text-md-right">{{ __('Phone') }}</label>
                                <input id="phone" type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone') }}" required autofocus>

                                @if ($errors->has('phone'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="col-form-label text-md-right">{{ __('Email') }}</label>
                                 <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                         <div class="form-group row">
                            

                            <div class="col-md-4">
                                <label for="DOB" class=" col-form-label text-md-right">{{ __('DOB') }}</label>
                                <input id="DOB" type="date" class="form-control{{ $errors->has('DOB') ? ' is-invalid' : '' }}" name="DOB" value="{{ old('DOB') }}" required>

                                @if ($errors->has('DOB'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('DOB') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4">
                                <label for="gender" class="col-form-label text-md-right">{{ __('Gender') }}</label>
                                <select id="gender" type="text" class="form-control{{ $errors->has('gender') ? ' is-invalid' : '' }}" name="gender" value="{{ old('gender') }}" required autofocus>
                                  
                                   <option  value="Female">Female</option>
                                   <option value="Male">Male</option>
                                   <option value="Non Binary">Non Binary</option>

                                </select>
                                @if ($errors->has('gender'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('gender') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4">
                                <label for="date_employed" class=" col-form-label text-md-right">{{ __('Date employed') }}</label>
                                <input id="date_employed" type="date" class="form-control{{ $errors->has('date_employed') ? ' is-invalid' : '' }}" name="date_employed" value="{{ old('date_employed') }}" required>

                                @if ($errors->has('date_employed'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('date_employed') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            

                            <div class="col-md-12">
                                <label for="address" class=" col-form-label text-md-right">{{ __('Home Address') }}</label>
                                <input id="address" type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" value="{{ old('address') }}" required>

                                @if ($errors->has('address'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            

                            <div class="col-md-6">
                                <label for="state" class="col-form-label text-md-right">{{ __('State') }}</label>
                                <select id="state" type="text" class="form-control{{ $errors->has('state') ? ' is-invalid' : '' }}" name="state" value="{{ old('state') }}" required autofocus>
                                    @foreach(DB::table('states')->get() as $state)
                                    <option id="{{$state->id}}" value="{{$state->name}}">{{$state->name}}</option>

                                    @endforeach
                                </select>
                                @if ($errors->has('state'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('state') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <label for="city" class="col-form-label text-md-right">{{ __('LGA') }}</label>
                                <select id="city" type="text" class="form-control{{ $errors->has('city') ? ' is-invalid' : '' }}" name="city" value="{{ old('city') }}" required autofocus>
                                    @foreach(DB::table('lgas')->where('state_id', 1)->get() as $lga)
                                        <option value="{{$lga->name}}">{{$lga->name}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('city'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                       

                        <div class="form-group text-center">
                            <div >
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register employee') }}
                                </button>
                            </div>
                        </div>
                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="footer">
                @include('layouts.footer')
            </footer>
        </div>
    </div>
    
</body>
<!--   Core JS Files   -->
@include('layouts.scripts')

</html>