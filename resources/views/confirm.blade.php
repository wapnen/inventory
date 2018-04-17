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
                                    <h4 class="card-title">Transaction summary</h4>
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
                                            @foreach($sales as $product)
                                            <tr>
                                                <td>{{$i}}</td>
                                                <td>{{App\Product::find($product->product_id)->name}} </td>
                                                <td>N{{$product->total / $product->quantity}}</td>
                                                <td>{{$product->quantity}}</td>
                                                <td>N{{number_format($product->total)}}</td>

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
                                      <a class="btn btn-success btn-fill btn-sm" href="{{route('product.create')}}"><i class="fa fa-check"></i>Download receipt</a>
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

</html>
