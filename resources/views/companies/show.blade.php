@extends('layouts.app')

@section('content')
<div class="card text-center">
    <div class="card-body">
        <h5 class="card-title">{{ $company->name }}</h5>
    </div>
    <ul class="list-group list-group-flush">
        <li class="list-group-item">{{$company->email}}</li>
    </ul>
    <div class="card-body">
        <a href="{{'//' . $company->website}}" class="btn btn-primary">Go to the website</a>
    </div>
   	
</div>
<table class="table text-center p-3 w-25">

	   <th>
	   		<button class="btn btn-link"><a href="{{route('companies.edit', ['company'=> $company])}}">Edit</a></button>
		</th> 
		<th>
		<form method="POST" action="/companies/{{$company->id}}">
	    	@method('DELETE')
	        @csrf
	        	<button class="btn btn-link">Delete</a>
	    	</form>
	    	
	    </th>
</table>

@endsection