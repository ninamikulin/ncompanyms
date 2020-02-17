<?php

namespace App;

use App\Employee;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    // mass assignable attributes
    protected $guarded=[];

    // casts attribute to assigned data types
    protected $casts=[
    	'created_at'=>'datetime'];

    //-------------------------------------
    // RELATIONSHIPS
    //-------------------------------------

    // has many employees
    public function employees()
    {
    	return $this->hasMany(Employee::class);
    }

    // belongs to one user
    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
