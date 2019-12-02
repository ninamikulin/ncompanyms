@extends('layouts.app')

@section('content')
<div class="card text-center">
    <div class="card-body">
    	<h5 class="card-title">Companies</h5>
    </div>

@if ($companies->isNotEmpty())
@foreach($companies as $company)
	<li class="list-group-item text-center">
		<a href="{{route('companies.show',['company'=>$company->id])}}">{{ $company->name }}</a>
	</li>

@endforeach
@else
<li class="list-group-item text-center">No companies registered yet</li>
@endif

</div>
	<div class="mt-3">
		<a href="/companies/create"><button type="submit" class="btn btn-primary">Add company</button></a>
	</div>
</div>

@endsection