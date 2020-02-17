<?php

namespace App\Policies;

use App\Company;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CompanyPolicy
{
    use HandlesAuthorization;

    // if the user_id of the company to be viewed === auth user id return true
    public function view(User $user, Company $company)
    {
        return $company->user_id === $user->id;
    } 
}
