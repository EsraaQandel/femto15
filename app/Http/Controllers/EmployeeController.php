<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Company;
use Gate;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $employees = User::where('user_type','employee')->get();
        $companies = Company::where('name', '!=' ,'system')->get();
        return view('employee.index',compact('employees','companies'));
    }

 function action(Request $request)
    {
     if($request->ajax())
     {
      $output = '';
      $query = $request->get('query');
      if($query != '')
      {
       $data = User::where('phone', 'like', '%'.$query.'%')
         ->orWhere('email', 'like', '%'.$query.'%')
         ->orWhere('name', 'like', '%'.$query.'%')
         ->get();
         
      }
      else
      {
       $data = User::where('user_type','employee')->get();
      }
      $total_row = $data->count();
      if($total_row > 0)
      {
       foreach($data as $row)
       { 

        if(Gate::allows('isAdmin')){
        $output .= '
        <tr>
         <td>'.$row->name.'</td>
         <td>'.$row->phone.'</td>
         <td>'.$row->email.'</td>
         <td>'.$row->companies->name.'</td>
         <td>
           <button class="btn btn-info" data-myname="'.$row->name.'" data-myphone="'.$row->phone.'" data-employeeid="'.$row->id.'" data-myemail="'.$row->email.'"  data-companyid="'.$row->company_id.'" data-toggle="modal" data-target="#edit-employee">Edit</button>
                                    /
            <button class="btn btn-danger" data-employeeid="'.$row->id.'" data-toggle="modal" data-target="#delete-employee">Delete</button>
                                </td>
        
        </tr>
        ';
       }else{
        $output .= '
        <tr>
         <td>'.$row->name.'</td>
         <td>'.$row->phone.'</td>
         <td>'.$row->email.'</td>
         <td>'.$row->companies->name.'</td>
        ';
       }
      }
    }
      else
      {
       $output = '
       <tr>
        <td align="center" colspan="5">No Data Found</td>
       </tr>
       ';
      }
      $data = array(
       'table_data'  => $output,
       'total_data'  => $total_row
      );

      echo json_encode($data);
     }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {  
        User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'phone' => $request['phone'],
            'password' => bcrypt($request['password']),
            'company_id' => $request['company_id'],
           'remember_token' => str_random(10),
        ]);
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $employee = User::findOrFail($request->employee_id);
        $employee->update([           
            'name' => $request['name'],
            'email' => $request['email'],
            'phone' => $request['phone'],
            'company_id' => $request['company_id'],
       ]);
        return back();
       
       // dd($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $employee = User::findOrFail($request->employee_id);
        $employee->delete();
        return back();
    }
}
