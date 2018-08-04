<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   

       return view('company.index');

    }

    public function action(Request $request)
    {
     if($request->ajax())
     {
      $output = '';
      $query = $request->get('query');
      if($query != '')
      {
        
       $data = Company::where('name', 'like', '%'.$query.'%')
         ->orWhere('tel', 'like', '%'.$query.'%')
         ->orWhere('address', 'like', '%'.$query.'%')
         ->orWhere('email', 'like', '%'.$query.'%')
         ->get();


   }


      else
      {
       $data = Company::where('name', '!=' ,'system')->get();
      }
      $total_row = $data->count();
      if($total_row > 0)
      {
       foreach($data as $row)
       {
        $output .= '
        <tr>
         <td>'.$row->name.'</td>
         <td>'.$row->tel.'</td>
         <td>'.$row->address.'</td>
         <td>'.$row->email.'</td>
        @can(\'isAdmin\')
        <td>
        <button class="btn btn-info" data-myname="'.$row->name.'" data-mytel="'.$row->tel.'" data-companyid="'.$row->id.'" data-myemail="'.$row->email.'"  data-myaddress="'.$row->address.'" data-toggle="modal" data-target="#edit">Edit</button>/
            <button class="btn btn-danger" data-companyid="'.$row->id.'"" data-toggle="modal" data-target="#delete">Delete</button>
        </td>
        @endcan
        </tr>';
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

        Company::create($request->all());
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
        $company = Company::findOrFail($request->company_id);
        $company->update($request->all());
       
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $company = Company::findOrFail($request->company_id);
        $company->delete();
        return back();
    }
}
