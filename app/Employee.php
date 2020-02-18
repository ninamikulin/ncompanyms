<?php

namespace App;

use App\Company;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
	// mass assignable attributes
	protected $guarded = [];

	// casts attribute to assigned data types
	protected $casts = [
    'created_at'  => 'datetime'];
 
    //-------------------------------------
    // RELATIONSHIPS
    //-------------------------------------

    // belongs to one company
    public function company()
    {
    	return $this->belongsTo(Company::class);
    }
}
