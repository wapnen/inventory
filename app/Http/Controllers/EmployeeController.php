<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\CreateEmployee;
use App\User;
use Illuminate\Validation\Rule;
use Validator;
class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //display list of employees
        $employees = User::where('role', 'Employee')->get();
        return view('employee.index', compact('employees'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('employee.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate form data
        $this->validate($request, [
            'email' => 'required|string|email|max:255|unique:users',
            'DOB' => 'required|date|before:today',
            'date_employed' => 'date',
        ]);

        //store new employee details
        $employee = new User($request->all());
        $employee->role = "Employee";
        //create a unique password for the created employee
        $password = uniqid();
        $employee->password = bcrypt($password);
        $employee->save();

        //Notify employee
        $this->notify_employee($employee, $password);
        return redirect(route('employee.index'))->with('status', 'Employee created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //show a single employee's details
        $employee = User::find($id);
        return view('employee.show', compact('employee'));
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //update employee details
        Validator::make($request->all(), [
            'email' => [
                'required',
                Rule::unique('users')->ignore($id),
            ],
            'DOB' => 'required|date|before:today',
            'date_employed' => 'date',
        ]);
        $employee = User::find($id);
        $employee->update($request->all());
        $employee->save();
        return back()->with('status', 'Changes saved');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //delete an employee
        $employee = User::find($id);
        $employee->delete();
        return redirect(route('employee.index'))->with('status', 'User deleted!');
    }

    //send email to new employee
    public function notify_employee(User $user, $password){

        Mail::to($user)->send(new CreateEmployee($user, $password));

    }
}
