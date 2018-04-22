<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Product;
use App\Sale;
use App\Charts\WeeklySales;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

      //get days for the current week
       $monday = date( 'Y-m-d ', strtotime( 'monday this week' ) );
       $tuesday = date( 'Y-m-d ', strtotime( 'tuesday this week' ) );
       $wednesday = date( 'Y-m-d ', strtotime( 'wednesday this week' ) );
       $thursday = date( 'Y-m-d ', strtotime( 'thursday this week' ) );
       $friday = date( 'Y-m-d ', strtotime( 'friday this week' ) );
       $saturday = date( 'Y-m-d ', strtotime( 'saturday this week' ) );
       $sunday = date( 'Y-m-d ', strtotime( 'sunday this week' ) );

       $date_array = [$monday, $tuesday, $wednesday, $thursday, $friday, $saturday, $sunday];
       //get the number of sales for each day of the current week
       $request_count = [];
       foreach ($date_array as  $value) {
           $request_count[] = count(Sale::whereDate('created_at',  $value)->get());
       }

       //render the results in a line chart
       $chart = new WeeklySales();
       $chart->dataset('Weekly sales', 'line', $request_count)->options(['backgroundColor' => '#22A7F0' ]);

       //get top 20 customers
        $no_of_customer = count(Customer::all());
        $customer_percent = (20 / 100) * $no_of_customer;


        $frequent_customers = Customer::orderBy('no_of_transactions', 'DESC')->limit(ceil($customer_percent))->get();
        $top_products = Product::orderBy('quantity_sold', 'DESC')->limit(5)->get();
        $least_products = Product::orderBy('quantity_sold', 'ASC')->limit(5)->get();
        return view('home', compact('frequent_customers', 'top_products', 'least_products', 'chart'));
    }
}
