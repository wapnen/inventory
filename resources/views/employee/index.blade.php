<!DOCTYPE html>
<html lang="en">

<head>
   @include('layouts.head', ['title' => 'Employees'])
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
            @include('layouts.nav', ['title' => 'Store Employees'])
            <!-- End Navbar -->
            <div class="content">
                <div class="container-fluid">
                    <a href="{{route('employee.create')}}" class="btn btn-info btn-fill btn-sm">Add employee</a>
                    <hr>
                    <div class="row">
                        @if(count($employees ) < 1)
                        <div class="col-md-3"></div>
                        <div class="col-md-5">
                            <div class="card">
                                <div class="card-body text-center">
                                    <img class="img " src="/assets/img/warning.png" style="height: 200px; width: 200px;">
                                    <h5>No employees found in the store!</h5>
                                    <a class="btn btn-info " href="{{route('employee.create')}}">Add employee</a>
                                </div>
                            </div>
                        </div>
                        @else
                        @foreach($employees as $employee)
                        <div class="col-md-4">
                            <div class="card card-user">
                                <div class="card-image">
                                    <img src="https://ununsplash.imgix.net/photo-1431578500526-4d9613015464?fit=crop&fm=jpg&h=300&q=75&w=400" alt="...">
                                </div>
                                <div class="card-body">
                                    <div class="author">
                                        <a href="{{route('employee.show', $employee->id)}}">
                                            <img class="avatar border-gray" src="/assets/img/faces/avatar.png" alt="...">
                                            <h5 class="title">{{$employee->firstname}} {{$employee->lastname}}</h5>
                                        </a>
                                        <p class="description">
                                            {{$employee->phone}}
                                        </p>
                                    </div>
                                    <p class="description text-center">
                                       <span class="badge badge-success"> Employee</span>
                                        <br> Joined on {{date('d M, Y', strtotime($employee->date_employed))}}

                                    </p>
                                </div>

                            </div>
                        </div>
                       @endforeach
                        @endif

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
