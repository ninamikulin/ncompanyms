@extends('layouts.app')

@section('content')
<div class="card text-center">
    <div class="card-body">
        <h5 class="card-title">{{ $company->name }}</h5>
    </div>
    <ul class="list-group list-group-flush">
    	<table class="table text-center p-3">
    		<thead>
		   	<tr>
		   		<th scope="col">Email</th> 
		   		<th scope="col">Website</th> 
			   	<th scope="col">Employees</th>
			   	<th scope="col"></th>
			</tr>
	   	</thead>
	   	<tbody>
	   		<tr>
		      	<td>{{$company->email}}</th>
			    <td><a href="{{'//' . $company->website}}">{{$company->website}}</a></td>
			    <td><a href="/companies/{{$company->id}}/employees">{{count($company->employees)}}</a></td>
			    <td><a href="{{route('companies.edit', ['company'=> $company])}}">Edit</a></td>
		    </tr>
    	</table>
 	</ul>
</div>

@endsection