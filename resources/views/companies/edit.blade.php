@extends('layouts.app')

@section('content')

<div class="p-3">
    <h4>Add a new company</h4>
</div>
<div class="p-3">
    <form method="POST" action="/companies/{{$company->id}}">
    	@method('PATCH')
        @csrf

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" aria-describedby="emailHelp" placeholder="Company Name" value="{{$company->name}}" required>  
        </div>
        <div class="form-group">
            <label for="email">E-mail</label>
            <input type="email" name="email" class="form-control" placeholder="Company Email" value="{{$company->email}}" required>
        </div>
        <div class="form-group">
            <label for="website">Website</label>
            <input type="text" name="website" class="form-control" placeholder="Company Website" value="{{$company->website}}"required>
        </div>
         
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    
</div>

@endsection