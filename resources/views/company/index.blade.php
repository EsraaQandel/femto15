@extends('layouts.master')

@section('content')

<h3>All Companies</h3>

	<!-- Button trigger modal -->
	@can('isAdmin')
<button type="button" style="margin-bottom: 20px" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
 	Add New
</button>
	@endcan

	  <div class="form-group">
      <input type="text" name="search" id="search-company" class="form-control" placeholder="Search Companies Data" />
     </div>
     <div class="table-responsive">
      <h3 align="center">Total Data : <span id="company_total_records"></span></h3>

			<div class="box-body">
				<table class="table table-responsive">
					<thead>
						<tr>
							<th>Name</th>
							<th>Tel</th>
							<th>address</th>
							<th>email</th>
							@can('isAdmin')
							<th>Modify</th>
							@endcan
						</tr>
						
					</thead>

					<tbody id="company-tbody">
					</tbody>


				</table>				
			</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">New Company</h4>
      </div>
      <form action="{{route('company.store')}}" method="post">
      		{{csrf_field()}}
	      <div class="modal-body">
               @include('company.form')
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
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit Company</h4>
      </div>
      <form action="{{route('company.update','test')}}" method="post">
      		{{method_field('patch')}}
      		{{csrf_field()}}
	      <div class="modal-body">
	      		<input type="hidden" name="company_id" id="company_id" value="">
				@include('company.form')
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
<div class="modal modal-danger fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title text-center" id="myModalLabel">Delete Confirmation</h4>
      </div>
      <form action="{{route('company.destroy','test')}}" method="post">
      		{{method_field('delete')}}
      		{{csrf_field()}}
	      <div class="modal-body">
				<p class="text-center">
					Are you sure you want to delete this?
				</p>
	      		<input type="hidden" name="company_id" id="company_id" value="">

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
