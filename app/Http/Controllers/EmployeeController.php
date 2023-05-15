<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Company;


class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $data['company'] = Company::get();
        return view("employee.add",$data);
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([

        'name' => 'required',
        'last_name' => 'required',
        'email' => 'required',
        'phone' => 'max:11'
        
         ]);

        $email = $request->email;
        $verified_email = Employee::where('email',$email)->count();

        if($verified_email > 0){
            return redirect()->back()->with('message','Email Already Exist');
        }else{
            $employee = new Employee;
            $employee->first_name = $request->name;
            $employee->last_name = $request->last_name;
            $employee->company_id = $request->company_id;
            $employee->email = $request->email;
            $employee->phone = $request->phone;
            $employee->save();
            
            return redirect('/employee/list')->with('message','Employee Added Succesfully');
        }
        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $data['employee'] = Employee::join('companies','companies.id','employees.company_id')
        ->select('employees.*','companies.name')->get();
        /*dd($data['employee']);*/
        return view("employee.list",$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //dd($id);
        $data['employee'] = Employee::where('id',$id)->first();
        $data['company'] = Company::get();
        return view("employee.edit",$data);

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
        //dd($request->all());
        
        $request->validate([

        'name' => 'required',
        'last_name' => 'required',
        'email' => 'required',
        'phone' => 'max:11'
        
         ]);

        $employee = Employee::find($id);
        $employee->first_name = $request->name;
        $employee->last_name = $request->last_name;
        $employee->company_id = $request->company_id;
        $employee->email = $request->email;
        $employee->phone = $request->phone;
        $employee->save();
            
        return redirect('/employee/list')->with('message','Employee Updated Succesfully');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //dd($request->all());

        $id = $request->id;
        $record = Employee::find($id);
        $record->delete();
        return response()->json(['success'=>'Record Deleted!']);
    }
}
