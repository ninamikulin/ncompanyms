<?php

namespace App\Http\Controllers;

use App\Company;
use App\Employee;
use Illuminate\Http\Request;

class CompanyEmployeesController extends Controller
{

    // returns view with a form to create new employee
    public function create(Company $company)
    {
        // uses policy to authorize view
        $this->authorize('view', $company);

        return view('employees.create', ['company'=>$company]);
    }

    // persists the employee to the DB
    public function store(Company $company, Employee $employee)
    {   
        // uses policy to authorize view
        $this->authorize('view', $company);

        // server-side validation
        $attributes= $this->validateAttributes();

        // sets attributes
        $attributes['company_id'] = $company->id;
        
        // persits to DB
        $employee = $employee->create($attributes);

        return redirect("/companies/{$company->id}");
    }


    public function edit(Company $company, Employee $employee)
    {
        // uses policy to authorize view
        $this->authorize('view', $employee);

        return view('employees.edit', ['company'=>$company,'employee'=>$employee]);
    }

    
    public function update(Company $company, Employee $employee)
    {
        // uses policy to authorize view
        $this->authorize('view', $employee);

        // server-side validation
        $attributes= $this->validateAttributes();

        // sets attributes
        $attributes['company_id'] = $company->id;

        // persits the changes to DB
        $employee->update($attributes);

        return redirect("companies/{$company->id}");
    }


    // deletes the employee from the DB
    public function destroy(Company $company, Employee $employee)
    {   
        // uses policy to authorize view
        $this->authorize('view', $employee);

        // deletes the record
        $employee->delete();
        return redirect ("companies/{$company->id}");
    }

    // server-side validation
    public function validateAttributes()
    {
        return request()->validate([
            'first_name'=> 'required',
            'last_name' => 'required',
            'email' => 'required',
            'phone' => 'required']);
    }  
}
