@extends('layouts.app')

@section('content')

<div class="p-3">
    <h4>Update employee information</h4>
</div>
<div class="p-3">

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
         
        <button type="submit" class="btn btn-primary">Update</button> 
    </form>
    <form method="POST" action="/companies/{{$employee->company->id}}/employees/{{$employee->id}}"> @csrf @method('DELETE')<button type="submit" class="btn btn-primary mt-3">Delete</button></form>

</div>

@endsection