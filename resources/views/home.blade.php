<!DOCTYPE html>
<html lang="en">

<head>
   @include('layouts.head', ['title' => 'Dashboard'])
</head>

<body>
    <div class="wrapper">
        <div class="sidebar" data-image="/assets/img/sidebar-5.jpg" data-color="blue">
            <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"

        Tip 2: you can also add an image using data-image tag
    -->
            @include('layouts.sidebar', ['selected' => 'dashboard'])
        </div>
        <div class="main-panel">
            <!-- Navbar -->
            @include('layouts.nav', ['title' => 'Dashboard'])
            <!-- End Navbar -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                      <div class="col-md-12">
                          <div class="card ">
                              <div class="card-header ">
                                  <h4 class="card-title">Sales report</h4>
                                  <p class="card-category">Generate sales report</p>
                              </div>
                              <div class="card-body ">
                                <form class="" method="post" action ="/sales/report">
                                  @csrf
                                  <div class="row">
                                    <div class="col-md-5 form-group">
                                        <label for="from">From (date)</label>
                                        <input type="date" name="from" class="form-control {{ $errors->has('from') ? ' is-invalid' : '' }}" value="{{ old('from') }}" required/>
                                        @if ($errors->has('from'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('from') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-md-5 form-group">
                                        <label for="from">To (date)</label>
                                        <input type="date" name="to" class="form-control {{ $errors->has('to') ? ' is-invalid' : '' }}" value="{{ old('to') }}" required/>
                                        @if ($errors->has('to'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('to') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-md-2 form-group">
                                      <label>Get report</label>
                                      <button class="btn btn-warning form-control" type="submit">Download</button>
                                    </div>
                                  </div>
                                </form>
                              </div>
                          </div>
                      </div>
                        <div class="col-md-12">
                            <div class="card ">
                                <div class="card-header ">
                                    <h4 class="card-title">Weekly sales</h4>
                                    <p class="card-category">Amount of sales this week</p>
                                </div>
                                <div class="card-body ">
                                    <div  class="">{!! $chart->container() !!}</div>
                                </div>
                                <div class="card-footer ">

                                    <hr>
                                    <div class="stats">
                                        <i class="fa fa-history"></i> Updated just now
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                      <div class="col-md-6">
                          <div class="card  card-tasks">
                              <div class="card-header ">
                                  <h4 class="card-title">Grossing products </h4>
                                  <p class="card-category">Most purchased items</p>
                              </div>
                              <div class="card-body ">
                                  <div class="table-full-width">
                                      <table class="table">
                                          <thead>
                                            <tr>
                                              <th>Rank</th>
                                              <th>Product</th>
                                              <th>Quantity sold</th>
                                              <th>Action</th>
                                            </tr>
                                          </thead>
                                          <tbody>
                                            <?php $i = 1; ?>
                                            @foreach($top_products as $product)
                                              <tr>
                                                  <td>
                                                      {{$i}}
                                                  </td>
                                                  <td>{{$product->name}}</td>
                                                  <td><span class="badge badge-warning">{{$product->quantity_sold}} </span> sale(s) </td>
                                                  <td class="td-actions text-right">
                                                      <a href="{{route('product.show', $product->id)}}"   class="btn btn-primary btn-sm">View product
                                                      </a>

                                                  </td>
                                              </tr>
                                              <?php $i++; ?>
                                              @endforeach

                                          </tbody>
                                      </table>
                                  </div>
                              </div>
                              <div class="card-footer ">
                                  <hr>
                                  <div class="stats">
                                      <i class="now-ui-icons loader_refresh spin"></i> Updated just now
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="col-md-6">
                          <div class="card  card-tasks">
                              <div class="card-header ">
                                  <h4 class="card-title">Poor performing products </h4>
                                  <p class="card-category">Least purchased items</p>
                              </div>
                              <div class="card-body ">
                                  <div class="table-full-width">
                                      <table class="table">
                                          <thead>
                                            <tr>
                                              <th>Rank</th>
                                              <th>Product</th>
                                              <th>Quantity sold</th>
                                              <th>Action</th>
                                            </tr>
                                          </thead>
                                          <tbody>
                                            <?php $i = 1; ?>
                                            @foreach($least_products as $product)
                                              <tr>
                                                  <td>
                                                      {{$i}}
                                                  </td>
                                                  <td>{{$product->name}}</td>
                                                  <td><span class="badge badge-warning">{{$product->quantity_sold}} </span> sale(s) </td>
                                                  <td class="td-actions text-right">
                                                      <a href="{{route('product.show', $product->id)}}"   class="btn btn-primary btn-sm">View product
                                                      </a>

                                                  </td>
                                              </tr>
                                              <?php $i++; ?>
                                              @endforeach

                                          </tbody>
                                      </table>
                                  </div>
                              </div>
                              <div class="card-footer ">
                                  <hr>
                                  <div class="stats">
                                      <i class="now-ui-icons loader_refresh spin"></i> Updated just now
                                  </div>
                              </div>
                          </div>
                      </div>
                        <div class="col-md-12">
                            <div class="card  card-tasks">
                                <div class="card-header ">
                                    <h4 class="card-title">Top customers </h4>
                                    <p class="card-category">Most frequent customers in the store</p>
                                </div>
                                <div class="card-body ">
                                    <div class="table-full-width">
                                        <table class="table">
                                          <thead>
                                            <tr>
                                              <th>Rank</th>
                                              <th>Customer</th>
                                              <th>No of transactions</th>
                                              <th>Started shopping</th>
                                              <th>Action</th>
                                            </tr>
                                          </thead>
                                            <tbody>
                                              <?php $i = 1; ?>
                                              @foreach($frequent_customers as $customer)
                                                <tr>
                                                    <td>
                                                        {{$i}}
                                                    </td>
                                                    <td>{{$customer->name}}</td>
                                                    <td><span class="badge badge-danger">{{$customer->no_of_transactions}} </span> transaction(s) </td>
                                                    <td>{{date('d M, Y', strtotime($customer->created_at))}}</td>
                                                    <td class="td-actions text-right">
                                                        <a href="{{route('customer.show', $customer->id)}}"   class="btn btn-success btn-sm">View customer
                                                        </a>

                                                    </td>
                                                </tr>
                                                <?php $i++; ?>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="card-footer ">
                                    <hr>
                                    <div class="stats">
                                        <i class="now-ui-icons loader_refresh spin"></i> Updated just now
                                    </div>
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

<script src=//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js charset=utf-8></script>
{!! $chart->script() !!}

</html>
