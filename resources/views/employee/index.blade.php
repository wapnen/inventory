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
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Employees</h4>
                                </div>
                                <div class="card-body table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <th>S\No</th>
                                            <th>Employee name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Date employed</th>
                                            <th>Action</th>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>
                                            @foreach($employees as $employee)
                                                <td>{{$i}}</td>
                                                <td>{{$employee->firstname}} {{$employee->lastname}} </td>
                                                <td>{{$employee->email}}</td>
                                                <td>{{$employee->phone}}</td>
                                                <td>{{date('d M, Y', strtotime($employee->date_employed))}}</td>
                                                <td><a href="{{route('employee.show', $employee->id)}}" class="btn btn-primary btn-fill btn-sm btn-round"><i class="fa fa-list"></i></a></td>
                                                <?php $i++; ?>
                                            @endforeach
                                        </tbody>
                                    </table>
                        
                                </div>
                                <div class="card-footer">
                                    <a class="btn btn-info " href="{{route('employee.create')}}">Add employee</a>
                                </div>
                            </div>
                        </div>
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