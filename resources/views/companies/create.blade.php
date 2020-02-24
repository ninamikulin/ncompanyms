@extends('layouts.app')
@section('content')
<div class="text-center">
    <div>
        <h1 class="mt-5 mb-3 p-3"><strong>Add company</strong>
        </h1>
    </div>
<div>
    <form method="POST" action="/companies">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" aria-describedby="emailHelp" placeholder="Company Name" value="{{old('name')}}" required>  
        </div>
        <div class="form-group">
            <label for="email">E-mail</label>
            <input type="email" name="email" class="form-control" placeholder="Company Email" value="{{old('email')}}" required>
        </div>
        <div class="form-group">
            <label for="website">Website</label>
            <input type="text" name="website" class="form-control" placeholder="Company Website" value="{{old('website')}}" required>
        </div>        
        <button type="submit" class="btn btn-primary mt-3">Create</button>
    </form>
</div>
@endsection