@extends('layouts.app')

@section('content')
<form action="/companies/{{$company->id}}", method="GET">
    <input  class="form-control" style="width:200px;" name="search" value="{{isset($_GET['search']) ? $_GET['search'] : 'Search'}}">
</form>
<div class="text-center">
    <div>
    	<h1 class="mt-5 mb-3 p-3"><strong>{{$company->name}}</strong>
    	</h1>
    	<p class="p-1">Company added: {{$company->created_at->format('d-m-Y')}}</br>
    	Company Email: {{$company->email}}</p>    	
    	<div class="mb-3 mt-1">
    		<a href="{{route('companies.edit', ['company'=> $company])}}"><button type="link" class="btn btn-primary mb-3">Edit company information </button></a>
    	</div>
    </div>
        
    <ul class="list-group list-group-flush">
    	<table class="table text-center p-3">
    	<thead>
		   	<tr>
		   		<th scope="col">First Name</th>
		   		<th scope="col">Last Name</th> 
		   		<th scope="col">Email</th> 
			   	<th scope="col">Phone</th>
			   	<th scope="col">Employed since</th>
			   	<th scope="col"></th>
			</tr>
	   	</thead>
	   	@if(isset($employees))
	   	@foreach($employees as $employee)
	   	<tbody>
	   		<tr>
	   			<td>{{$employee->first_name}}</th>
		      	<td>{{$employee->last_name}}</th>
		      	<td>{{$employee->email}}</th>
				<td>{{$employee->phone}}</th>
				<td>{{$employee->created_at->format('d-m-Y')}}</th>
			    <td><a href="{{route('employees.edit', ['company'=> $company, 'employee' => $employee])}}">Edit</a></td>
		    </tr>
		</tbody>
		@endforeach
		@endif
    	</table>
    	<a href="/companies/{{$company->id}}/employees/create"><button type="link" class="btn btn-primary">Add Employee</button></a>
 	</ul>
</div>
@endsection