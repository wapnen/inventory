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
                            <div class="card-header"><h4>Checkout | Select customer</h4>
                              <hr>
                            </div>
                            <div class="card-body">
                              <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                  <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Returning customer</a>
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">New customer</a>
                                </li>
                              </ul>
                              <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                  <form class="form-inline" method="post" action = "{{url('/transaction/customer')}}" >
                                    @csrf
                                    <div class="row">

                                          <div class="col-md-9">

                                            <select class="form-control" name="customer" id="customer" required>
                                              <option>--Select customer--</option>
                                              @foreach(App\Customer::all() as $customer)
                                                <option value="{{$customer->id}}">{{$customer->name}} <span>(Tel- {{$customer->phone}} )</span></option>
                                              @endforeach
                                            </select>
                                          </div>
                                          <div class="col-md-3 form-group">
                                            <button class="btn btn-success btn-sm btn-fill">Confirm sale</button>
                                          </div>

                                    </div>


                                    </form>
                                </div>
                                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">...</div>

                              </div>


                            </div>
                          </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Summary</h4>
                                </div>
                                <div class="card-body table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <th>S\No</th>
                                            <th>Product name</th>
                                            <th>Unit price</th>
                                            <th>Quantity</th>
                                            <th>Total</th>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>
                                            @foreach(Cart::content() as $product)
                                            <tr>
                                                <td>{{$i}}</td>
                                                <td>{{$product->name}} </td>
                                                <td>N{{number_format($product->price, 2)}}</td>
                                                <td>{{$product->qty}}</td>
                                                <td>N{{number_format($product->qty * $product->price, 2)}}</td>

                                              </tr>
                                                <?php $i++; ?>
                                            @endforeach
                                            <tr>

                                              <td></td>
                                              <td></td>
                                              <td></td>
                                              <th>Total</th>
                                              <td>N{{Cart::total()}}</td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </div>
                                <div class="card-footer">
                                  <hr>
                                    <a class="btn btn-warning btn-fill btn-sm" href="{{route('cart.index')}}"><i class="fa fa-refresh"></i>Refresh cart</a>
                                    <a class="btn btn-success btn-fill btn-sm" href="{{route('product.create')}}"><i class="fa fa-check"></i>Checkout</a>
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
<script type="text/javascript">


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


});
</script>
</html>
