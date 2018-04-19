<!DOCTYPE html>
<html lang="en">

<head>
   @include('layouts.head', ['title' => 'Customers'])
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
            @include('layouts.nav', ['title' => 'Our customers'])
            <!-- End Navbar -->
            <div class="content">
                <div class="container-fluid">

                    <div class="row">
                      <div class="col-md-12">
                         <a class="btn btn-success btn-sm btn-fill" data-toggle="modal" data-target="#create">Add customer</a>
                         <hr>
                      </div>
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Customers</h4>
                                </div>
                                <div class="card-body table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <th>S\No</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Action</th>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>
                                            @foreach($customers as $customer)
                                              <tr>
                                                <td>{{$i}}</td>
                                                <td> <a href="{{route('customer.show', $customer->id)}}"> {{$customer->name}} </a> </td>
                                                <td>{{$customer->email}}</td>
                                                <td>{{$customer->phone}}</td>

                                                <td>
                                                    <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                                      <div class="btn-group" role="group">
                                                        <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                          Options
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                          <a class="dropdown-item"  href="{{route('customer.show', $customer->id)}}"    >View customer</a>

                                                          <form id="form{{$customer->id}}" action="{{route('customer.destroy', $customer->id)}}" method="post">
                                                            @csrf
                                                            {{method_field('delete')}}
                                                            <button class="dropdown-item delete" id="{{$customer->id}}" >Delete customer</button>
                                                          </form>

                                                        </div>
                                                      </div>
                                                    </div>
                                                </td>
                                              </tr>
                                                <?php $i++; ?>
                                            @endforeach
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
                @include('customer.create')
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
  modal.find('#email').val(email)
  modal.find('#phone').val(phone)
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
