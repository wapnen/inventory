<!DOCTYPE html>
<html lang="en">

<head>
   @include('layouts.head', ['title' => 'Customer'])
   <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</head>

<body>
    <div class="wrapper">
        <div class="sidebar" data-image="/assets/img/sidebar-5.jpg" data-color="blue">
            <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"

        Tip 2: you can also add an image using data-image tag
    -->
            @include('layouts.sidebar', ['selected' => 'customer'])
        </div>
        <div class="main-panel">
            <!-- Navbar -->
            @include('layouts.nav', ['title' => 'Customer | '. $customer->name])
            <!-- End Navbar -->
            <div class="content">
                <div class="container-fluid">
                  <div class=""></div>
                  <div class="row">
                    <div class="col-md-8">
                      <div class="card">
                        <div class="card-header">
                          <h4>Update details  </h4>
                        </div>
                        <div class="card-body">
                          <form method="POST" action="{{route('customer.update', $customer->id)}}" id="create_form">
                                          @csrf
                                          {{method_field('PATCH')}}
                                          <div class="form-group row">

                                              <div class="col-md-12">
                                                  <label for="name" class="col-form-label text-md-right">{{ __("Customer's name") }}</label>
                                                  <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $customer->name }}" required autofocus>

                                                  @if ($errors->has('name'))
                                                      <span class="invalid-feedback">
                                                          <strong>{{ $errors->first('name') }}</strong>
                                                      </span>
                                                  @endif
                                              </div>

                                              <div class="col-md-12">
                                                  <label for="email" class="col-form-label text-md-right">{{ __("Customer's email (optional)") }}</label>
                                                  <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $customer->email }}" required autofocus>

                                                  @if ($errors->has('email'))
                                                      <span class="invalid-feedback">
                                                          <strong>{{ $errors->first('email') }}</strong>
                                                      </span>
                                                  @endif
                                              </div>
                                              <div class="col-md-12">
                                                  <label for="phone" class="col-form-label text-md-right">{{ __("Customer's phone (optional)") }}</label>
                                                  <input id="phone" type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ $customer->phone }}" required autofocus>

                                                  @if ($errors->has('phone'))
                                                      <span class="invalid-feedback">
                                                          <strong>{{ $errors->first('phone') }}</strong>
                                                      </span>
                                                  @endif
                                              </div>
                                          </div>
                                          <div class="text-center">
                                             <button class="btn btn-success btn-sm btn-fill" type="submit" >Save changes</a>
                                          </div>
                                      </form>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">

                          <div class="card card-user">
                              <div class="card-image">
                                  <img src="https://ununsplash.imgix.net/photo-1431578500526-4d9613015464?fit=crop&fm=jpg&h=300&q=75&w=400" alt="...">
                              </div>
                              <div class="card-body">
                                  <div class="author">
                                      <a href="#">
                                          <img class="avatar border-gray" src="/assets/img/faces/avatar.png" alt="...">
                                          <h5 class="title">{{$customer->name}}</h5>
                                      </a>
                                      <p class="description">
                                          {{$customer->phone}}
                                      </p>
                                  </div>
                                  <p class="description text-center">
                                     <span class="badge badge-info"> Customer</span>
                                      <br> Joined on the {{date('d M, Y', strtotime($customer->created_at))}}

                                  </p>
                              </div>
                              <hr>
                              <div class="button-container mr-auto ml-auto " style="padding:3%;">
                                 <form action="{{route('customer.destroy', $customer->id)}}" method="post" id="delete-user">
                                     @csrf
                                     {{method_field('DELETE')}}

                                  <button type="submit" class="delete btn btn-fill btn-sm btn-danger">
                                      <i class="fa fa-trash"></i>  Delete customer
                                  </button>
                                  </form>
                              </div>
                          </div>
                      </div>
                  </div>
                    <div class="row">
                      <div class="col-md-12">
                         <!-- <a class="btn btn-success btn-sm btn-fill" data-toggle="modal" data-target="#create">Add customer</a> -->
                         <hr>
                      </div>
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Transactions</h4>
                                </div>
                                <div class="card-body table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <th>S\No</th>
                                            <th>Transaction ID</th>
                                            <th>Total</th>
                                            <th>Payment method</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>

                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
            <footer class="footer">
                @include('layouts.footer')
                @include('customer.edit')
            </footer>
        </div>
    </div>

</body>
<!--   Core JS Files   -->
@include('layouts.scripts')
@if(session('errors'))
<script type="text/javascript">

    $('#create').modal();
</script>
@endif
<script type="text/javascript">
    $('#edit').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var id = button.data('id') // Extract info from data-* attributes

  var name = button.data('name')
  var brand = button.data('email')
  var type = button.data('phone')
  var modal = $(this)
  modal.find(' #name').val(name)
  modal.find('#email').val(brand)
  modal.find('#phone').val(type)
  $(' #edit_form').prop('action', "/customer/"+id)

})

 //delete a customer
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
