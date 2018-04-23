<!DOCTYPE html>
<html lang="en">

<head>
   @include('layouts.head', ['title' => 'Complaints'])
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
            @include('layouts.sidebar', ['selected' => 'complaint'])
        </div>
        <div class="main-panel">
            <!-- Navbar -->
            @include('layouts.nav', ['title' => 'Store complaints'])
            <!-- End Navbar -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        @if(count($complaints ) < 1)
                        <div class="col-md-3"></div>
                        <div class="col-md-5">
                            <div class="card">
                                <div class="card-body text-center">
                                    <img class="img " src="/assets/img/warning.png" style="height: 200px; width: 200px;">
                                    <h5>Good job! no customers have made any complaints</h5>
                                    <a class="btn btn-info btn-sm " href="#" data-toggle = "modal" data-target = "#create">Record complaint</a>
                                </div>
                            </div>
                        </div>
                        @else

                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Complaints</h4>
                                </div>
                                <div class="card-body table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <th>S\No</th>
                                            <th>Subject</th>
                                            <th>Customer</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>
                                            @foreach($complaints as $complaint)
                                            <tr>
                                                <td>{{$i}}</td>
                                                <td>{{$complaint->title}} </td>
                                                <td>{{App\Customer::find($complaint->customer_id)->name}}</td>
                                                <td>{{date('d M, Y'), strtotime($complaint->created_at)}}</td>
                                                <td>
                                                  @if($complaint->status == 'Unread')
                                                  <a class="btn btn-sm btn-warning"  href="/complaint/status/update/{{$complaint->id}}"> Mark as read</a>
                                                  @else
                                                  <span class="badge badge-success">Read</span>
                                                  @endif
                                                </td>
                                                <td>
                                                    <a class="btn btn-success btn-sm " href="#" data-toggle = "modal" data-target = "#show"
                                                     data-id= "{{$complaint->id}}"
                                                     data-customer = "{{App\Customer::find($complaint->customer_id)->name}}"
                                                     data-title = "{{$complaint->title}}"
                                                     data-complaint = "{{$complaint->complaint}}"
                                                    >View</a>
                                                </td>
                                                <?php $i++; ?>
                                              </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                </div>
                                <div class="card-footer">
                                  <a class="btn btn-info btn-sm " href="#" data-toggle = "modal" data-target = "#create">Record complaint</a>
                                </div>
                            </div>

                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <footer class="footer">
                @include('layouts.footer')
                @include('complaint.create')
                @include('complaint.show')
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
    $('#show').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var id = button.data('id') // Extract info from data-* attributes

  var title = button.data('title')
  var customer = button.data('customer')
  var complaint = button.data('complaint')
  var modal = $(this)
  modal.find(' #title').html(title)
  modal.find('#complaint').html(complaint)
  modal.find('#customer').html(customer)

})

</script>
</html>
