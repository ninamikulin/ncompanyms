@extends('layouts.app')

@section('content')

<div class="text-center">
    <div>
        <h1 class="mt-5 mb-3 p-3"><strong>Add employee</strong>
        </h1>
    </div>
<div>
    <form method="POST" action="/companies/{{$company->id}}/employees">
        @csrf
        <div class="form-group">
            <label for="first_name">First Name</label>
            <input type="text" name="first_name" class="form-control" aria-describedby="emailHelp" placeholder="First Name" value="{{old('name')}}" required>  
        </div>
        <div class="form-group">
            <label for="last_name">Last Name</label>
            <input type="text" name="last_name" class="form-control" aria-describedby="emailHelp" placeholder="Last Name" value="{{old('name')}}" required>  
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" placeholder="Email" value="{{old('email')}}" required>
        </div>
        <div class="form-group">
            <label for="phone">Phone number</label>
            <input type="number" name="phone" class="form-control" placeholder="Phone Number" value="{{old('phone')}}"required>
        </div>
         
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>

@endsection