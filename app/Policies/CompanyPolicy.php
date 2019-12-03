<?php

namespace App\Policies;

use App\Company;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CompanyPolicy
{
    use HandlesAuthorization;

    
    public function view(User $user, Company $company)
    {
        return $company->user_id === $user->id;
    }

   
}
