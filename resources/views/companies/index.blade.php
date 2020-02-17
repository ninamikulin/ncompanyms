@extends('layouts.app')

@section('content')
<div class="text-center">
    <div>
    	<h1 class="mt-5 mb-3 p-3"><strong>Registered Companies</strong>
    	</h1>
    	<div class="mb-4 p-2 text-center">
	<a href="/companies/create"><button type="submit" class="btn btn-primary">Add company</button></a>
</div>
    </div>

@if (!empty($companies))


	<table class="table text-center p-5 ">
		<thead>
		   	<tr class="p-4">
		   		<th scope="col"><h4>Company</h4></th>
		   		<th scope="col"><h4>Website</h4></th> 
			   	<th scope="col"><h4>Employees</h4></th>
			   	<th scope="col"></th>
			</tr>
   		</thead>
   		@foreach($companies as $company)
	   	<tbody>

	   		<tr>
	   			<td><strong>{{$company->name}}</strong></th>
			    <td><a href="{{'//' . $company->website}}">{{$company->website}}</a></td>
			    <td><a href="/companies/{{$company->id}}/employees">{{count($company->employees)}}</a></td>
			    <td><a href="{{route('companies.show', ['company'=> $company])}}"><button type="link" class="btn btn-primary">More</button></a></td>
		    </tr>
		  </tbody>
		  @endforeach
	</table>



@else
<li class="list-group-item text-center">No companies registered yet</li>
@endif
</div>



@endsection