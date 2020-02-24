@extends('layouts.app')
@section('content')
<div class="text-center">
    <div>
        <h1 class="mt-5 mb-3 p-3"><strong>Edit company</strong>
        </h1>
    </div>
<div>
    <form method="POST" action="/companies/{{$company->id}}">
    	@method('PATCH')
        @csrf

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" value="{{$company->name}}" required>  
        </div>
        <div class="form-group">
            <label for="email">E-mail</label>
            <input type="email" name="email" class="form-control" value="{{$company->email}}" required>
        </div>
        <div class="form-group">
            <label for="website">Website</label>
            <input type="text" name="website" class="form-control" value="{{$company->website}}"required>
        </div>       
        <button type="submit" class="btn btn-primary" style="width:100px;">Submit</button>  
    </form>
    <form method="POST" action="/companies/{{$company->id}}">
        @method('DELETE')
        @csrf
        <button class="btn btn-danger mt-1" style="width:100px;">Delete</button>
    </form>
</div>
@endsection