<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
use App\Customer;
use Cart;
use Auth;
use App\Sale;
use PDF;
use App\Product;

class TransactionController extends Controller
{
    //
    //store transaction details for customer
    public function checkout_customer(Request $request){

      $transaction = new Transaction();
      $transaction->user_id = Auth::user()->id;
      $transaction->customer_id = $request->customer_id;
      $total = floatval(Cart::subtotal(null,null,''));

      $transaction->total = $total;
      $transaction->save();

      $sale = $this->store_sale($transaction);

      $update_customer = $this->update_customer_stats($transaction->customer_id, $transaction->total);


      Cart::destroy();

      return redirect(url('/transaction/confirm', $transaction->id))->with('status', 'Successful');
    }



    //record the details of the sale
    public function store_sale(Transaction $transaction){
      foreach(Cart::content() as $cartitem){
        $sale = new Sale();
        $sale->transaction_id = $transaction->id;
        $sale->product_id = $cartitem->id;
        $sale->quantity = $cartitem->qty;
        $total = $cartitem->price * $cartitem->qty;
        $sale->total = $total;
        $sale->save();

        $update_product =  $this->update_product_qty($cartitem->id, $cartitem->qty);


      }
    }

    //confirm a transaction
    public function confirm_sale($transaction){

      $transaction = Transaction::find($transaction);
      $sales = Sale::where('transaction_id', $transaction->id)->get();
      return view('confirm', compact('transaction', 'sales'));

    }

    //print receipt
    public function invoice($id){
      $transaction = Transaction::find($id);
      $sales = Sale::where('transaction_id', $transaction->id)->get();

      $pdf = PDF::loadView('invoice', ['transaction' => $transaction, 'sales' => $sales]);
      return $pdf->download('invoice.pdf');
    }

    //update the quantity of items bought
    public function update_product_qty($product, $quantity_sold){
      $product = Product::find($product);
      $qty = $product->quantity;
      $qty_sold = $product->quantity_sold;
      $product->quantity = $qty - $quantity_sold;
      $product->quantity_sold = $qty_sold + $quantity_sold;
      $product->save();
    }

    //update the total amount of items bought by the customer
    public function update_customer_stats($customer, $total){
      //update amount of transactions for customer_id
      $customer = Customer::find($customer);
      $no_of_transactions = $customer->no_of_transactions;
      $transaction_total = $customer->total_transactions;
      $customer->no_of_transactions = $no_of_transactions +1;
      $customer->total_transactions = $transaction_total + $total;
      $customer->save();
    }

    //generate sales report
    public function generate_report(Request $request){
      $sales = Sale::whereBetween('created_at', [$request->from, $request->to])->get();
      $sum_sales = Sale::whereBetween('created_at', [$request->from, $request->to])->sum('total');
      $pdf =   PDF::loadView('report', [ 'sales' => $sales, 'from' => $request->from, 'to' => $request->to, 'total' => $sum_sales]);
      return $pdf->download('report.pdf');
    }

}
