@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header">Company list</div>
    @foreach($companies as $company)
    	<li class="list-group-item">
    		<a href="{{route('companies.show',['company'=>$company->id])}}">{{ $company->name }}</a>
    	</li>
    @endforeach
    </div>
</div>

@endsection