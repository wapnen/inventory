<!DOCTYPE html>
<html lang="en">

<head>
   @include('layouts.head', ['title' => 'Sell product'])
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
            @include('layouts.sidebar', ['selected' => 'cart'])
        </div>
        <div class="main-panel">
            <!-- Navbar -->
            @include('layouts.nav', ['title' => 'Checkout'])
            <!-- End Navbar -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">

                        <div class="col-md-12">
                          <div class="card">
                            <div class="card-body">
                                <form method="post" action="{{route('cart.store')}}" class="inline-form">
                                  @csrf
                              <div class="row">
                                    <div class="col-md-9">
                                      <input id = "search" type="text" name="search"  class=" form-control" placeholder="Search for product" /required>
                                      <input type="hidden" name="product_id" id="product_id" />
                                    </div>
                                    <div class="col-md-1">
                                      <input type="number" name="quantity" value="1" class="form-control" /required>
                                    </div>
                                    <div class="col-md-2 text-center">
                                      <button type = "submit" class="btn btn-info btn-fill " id="add-to-cart" disabled>Add to cart</button>

                                    </div>
                              </div>

                            </form>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Cart | N{{Cart::subtotal()}}</h4>
                                </div>
                                <div class="card-body table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <th>S\No</th>
                                            <th>Product name</th>
                                            <th>Unit price</th>
                                            <th>Quantity</th>
                                            <th>Total</th>
                                            <th>Action</th>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>
                                            @foreach(Cart::content() as $product)
                                            <tr>
                                                <td>{{$i}}</td>
                                                <td>{{$product->name}} </td>
                                                <td>N{{number_format($product->price, 2)}}</td>
                                                <td><input type="number" name="quantity" value="{{$product->qty}}" id = "{{$product->rowId}}" class="quantity form-control" /required></td>
                                                <td>N{{number_format($product->qty * $product->price, 2)}}</td>
                                                <td>
                                                  <form id="form{{$product->rowId}}" action="{{route('cart.destroy', $product->rowId)}}" method="post">
                                                    @csrf
                                                    {{method_field('delete')}}
                                                    <button class="btn btn-danger btn-sm btn-fill delete" id="{{$product->rowId}}" ><i class="fa fa-remove"></i></button>
                                                  </form>
                                                </td>
                                              </tr>
                                                <?php $i++; ?>
                                            @endforeach
                                            <tr>
                                              <td></td>
                                              <td></td>
                                              <td></td>
                                              <td></td>
                                              <th>Total</th>
                                              <td>N{{Cart::subtotal()}}</td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </div>
                                <div class="card-footer">
                                  <hr>
                                  @if(count(Cart::content()) > 0)
                                    <a class="btn btn-warning btn-fill btn-sm" href="{{route('cart.index')}}"><i class="fa fa-refresh"></i>Refresh cart</a>
                                    <a class="btn btn-success btn-fill btn-sm" href="/checkout"><i class="fa fa-check"></i>Checkout</a>
                                  @endif
                                </div>
                            </div>

                        </div>

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
  template: {
		type: "description",
		fields: {
			description: "price"
		}
	},
  list: {
    onClickEvent: function(){

      $('#add-to-cart').prop('disabled', false);
      var value = $("#search").getSelectedItemData().id;
			$("#product_id").val(value).trigger("change");
    },
    onChooseEvent: function(){

      $('#add-to-cart').prop('disabled', false);
      var value = $("#search").getSelectedItemData().id;
			$("#product_id").val(value).trigger("change");
    }
  }

};

$("#search").easyAutocomplete(options);


$('#search').keyup(function(){
    $('#add-to-cart').prop('disabled', true);
});


//change quantity of item in Cart
$('.quantity').change(function(){
    var qty = $(this).val();
    var id = $(this).attr('id');

    $.ajax({
      url : "/cart/update/"+id+"/"+qty,
      type : "get",
      success : function(data){
        $.notify({
            icon: "nc-icon nc-app",
            message: "Product quantity updated, refresh cart to view changes"

        }, {
            type: type['green'],
            timer: 8000,
            placement: {
                from: 'top',
                align: 'right'
            }
        });
      }
    });
});
</script>
</html>
