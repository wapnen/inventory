<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use Illuminate\Validation\Rule;
use Validator;
use App\Transaction;
class CustomerController extends Controller
{
    /**
     * Display a listing of the customers.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $customers = Customer::all();
        return view('customer.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created customer in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate the request
        $this->validate($request, [
            'name' => 'required',
            'email' => 'nullable|unique:customers',
            'phone' => 'unique:customers'
        ]);

        //store the customer
        $customer = new Customer($request->all());
        $customer->save();
        return back()->with('status', 'Customer added successfully');
    }

    /**
     * Display the customer's details
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $customer =  Customer::find($id);
        $transactions = Transaction::where('customer_id', $customer->id)->get();
        return view('customer.show', compact('customer', 'transactions'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the customer's details in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        Validator::make($request->all(), [
            'email' => [
                'required',
                Rule::unique('customers')->ignore($id),
            ],

        ]);

        $customer = Customer::find($id);
        $customer->update($request->all());
        return back()->with('status', 'Changes saved!');
    }

    /**
     * Remove the customer from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $customer = Customer::find($id);
        $customer->delete();
        return back()->with('status', 'Customer removed');
    }

    //search for a customer
    public function search(Request $request){
      $customers = Customer::where('name', 'LIKE', '%'.$request->phrase.'%')->orWhere('phone', 'LIKE', '%'.$request->phrase.'%')->get();

      return json_encode($customers);
    }
}
