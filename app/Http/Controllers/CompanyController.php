<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;


class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        
        return view("company.add");
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
        'email' => 'required',
        'image' => 'dimensions:max_width=100,max_height=100'

         ]);

        $email = $request->email;
        $verified_email = Company::where('email',$email)->count();

        if($verified_email > 0){
            return redirect()->back()->with('message','Email Already Exist');
        }else{
            $company = new Company;
            $company->name = $request->name;
            $company->email = $request->email;
            $company->website = $request->website;

        if($request->file('image')){
        
            $file = $request->file('image');
            $imageName = time(). "_".$file->GetClientOriginalName();
            $filename = '/assets/logos/'.$imageName;
            $file->move(public_path('/assets/logos/'), $filename);
            $company->logo = $filename;
            
        }

        $company->save();
        return redirect('/comapnies/list')->with('message','Company Added Succesfully');
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
        $data['company'] = Company::get();
        return view("company.list",$data);
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
        $data['company'] = Company::where('id',$id)->first();
        return view("company.edit",$data);

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
        $company = Company::find($id);
        $request->validate([

        'name' => 'required',
        'email' => 'required',
        'image' => 'dimensions:max_width=100,max_height=100'

         ]);

            $company = Company::find($id);
            $company->name = $request->name;
            $company->email = $request->email;
            $company->website = $request->website;

        if($request->file('image')){
        
            $file = $request->file('image');
            $imageName = time(). "_".$file->GetClientOriginalName();
            $filename = '/assets/logos/'.$imageName;
            $file->move(public_path('/assets/logos/'), $filename);
            $company->logo = $filename;
            
        }

        $company->update();
        return redirect('/comapnies/list')->with('message','Company updated Succesfully');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        $record = Company::find($id);
        $record->delete();
        return response()->json(['success'=>'Record Deleted!']);
    }
}
