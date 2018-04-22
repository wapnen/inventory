<!DOCTYPE html>
<html lang="en">

<head>
   @include('layouts.head', ['title' => $product->name])
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
            @include('layouts.nav', ['title' => $product->name])
            <!-- End Navbar -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="row">
                          <div class="col-md-4">
                            <div class="card">
                              <div class="card-header">
                                <h4 class="card-title">Quantity in stock</h4>

                              </div>
                              <div class="card-body">
                                <hr>
                                  <h2 class="">{{$product->quantity}}</h2>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="card">
                              <div class="card-header">
                                <h4 class="card-title">Quantity sold</h4>

                              </div>
                              <div class="card-body">
                                <hr>
                                  <h2 class="">{{$product->quantity_sold}}</h2>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="card">
                              <div class="card-header">
                                <h4 class="card-title">Revenue</h4>

                              </div>
                              <div class="card-body">
                                <hr>
                                  <h2 class="">N{{number_format(App\Sale::where('product_id', $product->id)->sum('total'))}}</h2>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                        <div class="col-md-12 ">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Update product details</h4>
                                </div>
                                <div class="card-body table-responsive">
                                  <table class="table table-striped">
                                    <thead>
                                      <tr>
                                        <th class="service">PRODUCT</th>
                                        <th>QUANTITY SOLD</th>
                                        <th>UNIT PRICE</th>
                                        <th>TOTAL</th>
                                        <th>CUSTOMER</th>
                                        <th>DATE</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      @foreach(App\Sale::where('product_id', $product->id)->get() as $sale)
                                              <tr>
                                                <td class="service">{{App\Product::find($sale->product_id)->name}}</td>
                                                <td>{{$sale->quantity}}</td>
                                                <?php $price = $sale->total / $sale->quantity ?>
                                                <td>{{$price}}</td>
                                                <td>{{$sale->total}}</td>
                                                <?php $transaction = App\Transaction::find($sale->transaction_id); ?>
                                                <td><a href="{{route('customer.show', $transaction->customer_id)}}">{{App\Customer::find( $transaction->customer_id)->name}}</a> </td>
                                                <td>{{date('F d, Y', strtotime($sale->created_at))}}</td>
                                              </tr>
                                            @endforeach


                                      <tr>
                                        <td colspan="5" class="grand total">GRAND TOTAL</td>
                                        <td class="grand total">N{{number_format(App\Sale::where('product_id', $product->id)->sum('total'), 2)}}</td>
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
            </footer>
        </div>
    </div>

</body>
<!--   Core JS Files   -->
@include('layouts.scripts')

</html>
