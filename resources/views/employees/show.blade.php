@extends('layouts.app')

@section('content')
<div class="card text-center">
    <div class="card-body">
        <h5 class="card-title">{{ $employee->last_name}}, {{$employee->first_name }}</h5>
    </div>
    <ul class="list-group list-group-flush">
    	<table class="table text-center p-3">
    		<thead>
		   	<tr>
		   		<th scope="col">Email</th> 
			   	<th scope="col">Phone number</th>
			   	<th scope="col"></th>
			</tr>
	   	</thead>
	   	<tbody>
	   		<tr>
		      	<td>{{$employee->email}}</th>
			    <td><a href="/companies/{{$company->id}}/employees">{{$employee->phone}}</a></td>
			    <td><a href="{{route('employees.edit', ['company'=> $company, 'employee'=> $employee])}}">Edit</a></td>
		    </tr>
    	</table>
 	</ul>
</div>

@endsection