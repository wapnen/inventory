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
                          <div class="card-header">
                            <h4 class="card-title">Select customer</h4>
                          </div>
                          <div class="card-body">
                              <form method="post" action="/transaction/customer" class="inline-form">
                                @csrf
                            <div class="row">
                                  <div class="col-md-10">
                                    <input id = "search" type="text" name="search"  class=" form-control" placeholder="Search for customer" /required>
                                    <input type="hidden" name="customer_id" id="customer_id" />
                                  </div>

                                  <div class="col-md-2 text-center">
                                    <button type = "submit" class="btn btn-info btn-fill " id="confirm-sale" disabled>Confirm sale</button>

                                  </div>
                            </div>

                          </form>
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
                                              <td>N{{Cart::subtotal()}}</td>
                                            </tr>
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
    return "/api/customer/search";
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
			description: "phone"
		}
	},
  list: {
    onClickEvent: function(){

      $('#confirm-sale').prop('disabled', false);
      var value = $("#search").getSelectedItemData().id;
			$("#customer_id").val(value).trigger("change");
    },
    onChooseEvent: function(){

      $('#confirm-sale').prop('disabled', false);
      var value = $("#search").getSelectedItemData().id;
			$("#customer_id").val(value).trigger("change");
    }
  }

};

$("#search").easyAutocomplete(options);


$('#search').keyup(function(){
    $('#confirm-sale').prop('disabled', true);
});


</script>
</html>
