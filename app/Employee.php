<?php

namespace App;

use App\Company;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
	protected $guarded = [];

	protected $casts = [
    'created_at'  => 'date:d-m-Y'];

    public function company()
    {
    	return $this->belongsTo(Company::class);
    }
}
