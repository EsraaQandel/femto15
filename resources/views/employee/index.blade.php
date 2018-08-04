@extends('layouts.master')

@section('content')

<h3>All Employees</h3>

	<!-- Button trigger modal -->
	 @can('isAdmin')
<button type="button" class="btn btn-primary" style="margin-bottom: 20px" data-toggle="modal" data-target="#myModal">
 	Add New
</button>
@endcan
    <div class="form-group">
      <input type="text" name="search" id="search-employee" class="form-control" placeholder="Search Employees Data" />
     </div>
     <div class="table-responsive">
      <h3 align="center">Total Data : <span id="employee_total_records"></span></h3>

			<div class="box-body">
				<table class="table table-responsive">
					<thead>
						<tr>
							<th>Name</th>
							<th>Phone</th>
              <th>Email</th>
              <th>Company</th>
							 @can('isAdmin')
							<th>Modify</th>
							@endcan
						</tr>
						
					</thead>

					<tbody id="employee-tbody">

					</tbody>


				</table>				
			</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">New Employee</h4>
      </div>
      <form action="{{route('employee.store')}}" method="post">
      		{{csrf_field()}}
	      <div class="modal-body">
	      	<input type="hidden" name="employee_id" id="employee_id" value="">
               @include('employee.form')
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        <button type="submit" class="btn btn-primary">Save</button>
	      </div>
      </form>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="edit-employee" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit Employee</h4>
      </div>
      <form action="{{route('employee.update','test')}}" method="post">
      		{{method_field('patch')}}
      		{{csrf_field()}}
	      <div class="modal-body">
	      		<input type="hidden" name="employee_id" id="employee_id" value="">
				                        <div class="overflow form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="overflow form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="overflow form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label for="phone" class="col-md-4 control-label">Phone</label>

                            <div class="col-md-6">
                                <input id="phone" type="phone" class="form-control" name="phone" value="{{ old('phone') }}" required>

                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
        
                        <div class="overflow form-group">
                          <label for="company_id" class="col-md-4 control-label">Change Company:</label>
                          <div class="col-md-6">
                              <select class="form-control col-md-6" id="my_company_id" name="company_id">
                              @foreach($companies as $company)
                                <option  id="{{$company->id}}"  value="{{$company->id}}">{{$company->name}}</option>
                              @endforeach
                              </select>
                            </div>
                        </div>



	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        <button type="submit" class="btn btn-primary">Save Changes</button>
	      </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal modal-danger fade" id="delete-employee" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title text-center" id="myModalLabel">Delete Confirmation</h4>
      </div>
      <form action="{{route('employee.destroy','test')}}" method="post">
      		{{method_field('delete')}}
      		{{csrf_field()}}
	      <div class="modal-body">
				<p class="text-center">
					Are you sure you want to delete this?
				</p>
	      		<input type="hidden" name="employee_id" id="employee_id" value="">

	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-success" data-dismiss="modal">No, Cancel</button>
	        <button type="submit" class="btn btn-warning">Yes, Delete</button>
	      </div>
      </form>
    </div>
  </div>
</div>
@endsection
