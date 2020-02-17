@extends('layouts.app')

@section('content')
<div class="text-center">
    <div>
        <h1 class="mt-5 mb-3 p-3"><strong>Edit employee</strong>
        </h1>
    </div>

<div>
    <form method="POST" action="/companies/{{$employee->company->id}}/employees/{{$employee->id}}">
    	@method('PATCH')
        @csrf

        <div class="form-group">
            <label for="name">First Name</label>
            <input type="text" name="first_name" class="form-control" value="{{$employee->first_name}}" required>  
        </div>
        <div class="form-group">
            <label for="name">Last Name</label>
            <input type="text" name="last_name" class="form-control" value="{{$employee->last_name}}" required>  
        </div>
        <div class="form-group">
            <label for="email">E-mail</label>
            <input type="email" name="email" class="form-control" value="{{$employee->email}}" required>
        </div>
        <div class="form-group">
            <label for="phone">Phone number</label>
            <input type="number" name="phone" class="form-control" value="{{$employee->phone}}"required>
        </div>

            <button type="submit" class="btn btn-primary" style="width:100px;">Update</button>      
    </form>

     <form method="POST" action="/companies/{{$company->id}}/employees/{{$employee->id}}">
            @method('DELETE')
            @csrf
            <button class="btn btn-danger mt-1" style="width:100px;">Delete</button>
        </form>
</div>

@endsection