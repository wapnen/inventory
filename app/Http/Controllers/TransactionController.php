<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
use App\Customer;
use Cart;
use Auth;
use App\Sale;
use PDF;
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
}
