<!DOCTYPE html>
<html lang="en">

<head>
   @include('layouts.head', ['title' => 'Products'])
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
            @include('layouts.sidebar', ['selected' => 'product'])
        </div>
        <div class="main-panel">
            <!-- Navbar -->
            @include('layouts.nav', ['title' => 'Store products'])
            <!-- End Navbar -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        @if(count($products ) < 1)
                        <div class="col-md-3"></div>
                        <div class="col-md-5">
                            <div class="card">
                                <div class="card-body text-center">
                                    <img class="img " src="/assets/img/warning.png" style="height: 200px; width: 200px;">
                                    <h5>No products found in the store!</h5>
                                    <a class="btn btn-info " href="{{route('product.create')}}">Add product</a>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="col-md-12">
                          <div class="card">
                            <div class="card-body">
                                <form method="" action="" class="inline-form">
                              <div class="row">

                                    <div class="col-md-10">
                                      <input id = "search" type="text" name="search" class="form-control" placeholder="Search for product" /required>
                                    </div>
                                    <div class="col-md-2 text-center">

                                      <a href="" id="view-product" class="btn btn-warning btn-fill">View</a>
                                    </div>
                              </div>

                            </form>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Products</h4>
                                </div>
                                <div class="card-body table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <th>S\No</th>
                                            <th>Product name</th>
                                            <th>Category</th>
                                            <th>Unit price</th>
                                            <th>Quantity remaining</th>
                                            <th>Action</th>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>
                                            @foreach($products as $product)
                                            <tr>
                                                <td>{{$i}}</td>
                                                <td>{{$product->name}} </td>
                                                <td>{{$product->type}}</td>
                                                <td>{{number_format($product->price, 2)}}</td>
                                                <td>{{$product->quantity}}</td>
                                                <td>
                                                    <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                                      <div class="btn-group" role="group">
                                                        <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                          Options
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                          <a class="dropdown-item"  href="#" data-toggle="modal" data-target="#edit"
                                                          data-id="{{$product->id}}"
                                                          data-name="{{$product->name}}"
                                                          data-brand="{{$product->brand}}"
                                                          data-type="{{$product->type}}"
                                                          data-description="{{$product->description}}"
                                                          data-size="{{$product->size}}"
                                                          data-quantity="{{$product->quantity}}"
                                                          data-price="{{$product->price}}"
                                                          >Edit product</a>

                                                          <form id="form{{$product->id}}" action="{{route('product.destroy', $product->id)}}" method="post">
                                                            @csrf
                                                            {{method_field('delete')}}
                                                            <button class="dropdown-item delete" id="{{$product->id}}" >Delete product</button>
                                                          </form>

                                                        </div>
                                                      </div>
                                                    </div>
                                                </td>
                                                <?php $i++; ?>
                                              </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                </div>
                                <div class="card-footer">
                                    <a class="btn btn-success btn-fill" href="{{route('product.create')}}">Add product</a>
                                </div>
                            </div>

                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <footer class="footer">
                @include('layouts.footer')
                @include('product.edit')
            </footer>
        </div>
    </div>

</body>
<!--   Core JS Files   -->
@include('layouts.scripts')
<script src="/assets/js/autocomplete/jquery.easy-autocomplete.min.js"></script>
@if(session('errors'))
<script type="text/javascript">

    $('#edit').modal();
</script>
@endif
<script type="text/javascript">
    $('#edit').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var id = button.data('id') // Extract info from data-* attributes

  var name = button.data('name')
  var brand = button.data('brand')
  var type = button.data('type')
  var description = button.data('description')
  var size = button.data('size')
  var quantity = button.data('quantity')
  var price = button.data('price')
  var modal = $(this)
  modal.find(' #name').val(name)
  modal.find('#brand').val(brand)
  modal.find('#type').val(type)
  modal.find('#description').val(description)
  modal.find('#size').val(size)
  modal.find('#quantity').val(quantity)
  modal.find('#price').val(price)
  $(' #edit_form').prop('action', "/product/"+id)

})

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


//search for a product
var options = {

  url: function(phrase) {
    return "/api/product/search";
  },

  getValue: function(element) {
    return element.name;
  },

  ajaxSettings: {
    dataType: "json",
    method: "POST",
    data: {
      dataType: "json"
    }
  },

  preparePostData: function(data) {
    data.phrase = $("#search").val();
    return data;
  },
  list: {
    onClickEvent: function(){

      $('#view-product').prop('disabled', false);
      var value = $("#search").getSelectedItemData().id;
			$("#view-product").attr('href', '/product/'+value);
    },
    onChooseEvent: function(){

      $('#view-product').prop('disabled', false);
      var value = $("#search").getSelectedItemData().id;
			$("#view-product").attr('href', '/product/'+value);
    }
  }

};

$("#search").easyAutocomplete(options);
</script>
</html>
