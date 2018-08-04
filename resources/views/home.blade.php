@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                  @can('isAdmin')
                  Admin
                  @endcan
                  @can('isEmployee')
                  Employee
                  @endcan
                </div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    You are logged in as @can('isAdmin')admin!
                    @endcan
                    @can('isEmployee')
                    employee!
                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
