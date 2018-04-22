<!DOCTYPE html>
<html lang="en">

<head>
   @include('layouts.head', ['title' => 'Requests'])
   <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
   <link rel="stylesheet" href="/assets/css/easy-autocomplete.min.css">

 <!-- Additional CSS Themes file - not required-->
 <link rel="stylesheet" href="/assets/css/easy-autocomplete.themes.min.css">
</head>

<body>
    <div class="wrapper">
        <div class="sidebar" data-image="/assets/img/sidebar-5.jpg" data-color="blue">
            <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"

        Tip 2: you can also add an image using data-image tag
    -->
            @include('layouts.sidebar', ['selected' => 'request'])
        </div>
        <div class="main-panel">
            <!-- Navbar -->
            @include('layouts.nav', ['title' => 'Product\Service requests'])
            <!-- End Navbar -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        @if(count($requests ) < 1)
                        <div class="col-md-3"></div>
                        <div class="col-md-5">
                            <div class="card">
                                <div class="card-body text-center">
                                    <img class="img " src="/assets/img/warning.png" style="height: 200px; width: 200px;">
                                    <h5>No products have been requested by customers</h5>
                                    <a class="btn btn-info btn-sm " href="#" data-toggle = "modal" data-target = "#create">Record request</a>
                                </div>
                            </div>
                        </div>
                        @else

                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Requests</h4>
                                </div>
                                <div class="card-body table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <th>S\No</th>
                                            <th>Requested product</th>
                                            <th>Customer</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>
                                            @foreach($requests as $request)
                                            <tr>
                                                <td>{{$i}}</td>
                                                <td>{{$request->product}} </td>
                                                <td>{{App\Customer::find($request->customer_id)->name}}</td>
                                                <td>{{date('d M, Y'), strtotime($request->created_at)}}</td>
                                                <td>
                                                  <form method="post" action="{{route('productrequest.destroy', $request->id)}}" id="form{{$request->id}}">
                                                    @csrf
                                                    {{method_field('PATCH')}}
                                                    <button class="delete btn btn-sm btn-danger btn-fill" id="{{$request->id}}">Delete</button>
                                                  </form>
                                                </td>

                                                <?php $i++; ?>
                                              </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                </div>
                                <div class="card-footer">
                                  <a class="btn btn-info btn-sm " href="#" data-toggle = "modal" data-target = "#create">Record request</a>
                                </div>
                            </div>

                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <footer class="footer">
                @include('layouts.footer')
                @include('request.create')
            </footer>
        </div>
    </div>

</body>
<!--   Core JS Files   -->
@include('layouts.scripts')
<script type="text/javascript">
//delete a product
// confirm delete form
$('.delete').click(function(e){
   //alert($(this).attr('id'));
   e.preventDefault(e);
   var form = $(this).attr('id');

   swal({
     title: "Are you sure?",
     text: "You will not be able to undo this!",
     icon: "warning",
     buttons: true,
     dangerMode: true,
   })
   .then((willDelete) => {
     if (willDelete) {
       $("#form"+form).submit();
       // swal("Done!", {
       //   icon: "success",
       // });
     }
   });
});
</script>
</html>
