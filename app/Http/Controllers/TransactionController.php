<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
use App\Customer;
use Cart;
use Auth;
use App\Sale;

class TransactionController extends Controller
{
    //

    public function checkout_customer(Request $request){
      //dd($request->all());
      $transaction = new Transaction();
      $transaction->user_id = Auth::user()->id;
      $transaction->customer_id = $request->customer;
      $total = floatval(Cart::total(null,null,''));
      $transaction->total = $total;
      $transaction->save();

      $sale = $this->store_sale($transaction);
      return redirect(url('/transaction/confirm', $transaction->id))->with('Status', 'Successful');
    }

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

    public function confirm_sale($transaction){

      $transaction = Transaction::find($transaction);
      $sales = Sale::where('transaction_id', $transaction->id)->get();
      return view('confirm', compact('transaction', 'sales'));

    }
}
