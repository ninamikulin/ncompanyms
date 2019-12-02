@extends('layouts.app')

@section('content')

<div class="p-3">
    <h4>{{$company->name}} - Add a new employee</h4>
</div>
<div class="p-3">
    <form method="POST" action="/companies/{{$company->id}}/employees">
        @csrf
        <div class="form-group">
            <label for="first_name">First Name</label>
            <input type="text" name="first_name" class="form-control" aria-describedby="emailHelp" placeholder="Company Name" value="{{old('name')}}" required>  
        </div>
        <div class="form-group">
            <label for="last_name">Last Name</label>
            <input type="text" name="last_name" class="form-control" aria-describedby="emailHelp" placeholder="Company Name" value="{{old('name')}}" required>  
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" placeholder="Company Email" value="{{old('email')}}" required>
        </div>
        <div class="form-group">
            <label for="phone">Phone number</label>
            <input type="number" name="phone" class="form-control" placeholder="Company Phone Number" value="{{old('phone')}}"required>
        </div>
         
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>

@endsection