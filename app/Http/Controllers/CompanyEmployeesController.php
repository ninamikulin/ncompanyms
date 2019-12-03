<?php

namespace App\Http\Controllers;

use App\Company;
use App\Employee;
use Illuminate\Http\Request;

class CompanyEmployeesController extends Controller
{
    

    public function index(Company $company)
    {
        $this->authorize('view', $company);
        $employees = Employee::where('company_id', $company->id)->paginate(10);

        return view('employees.index', ['company'=> $company, 'employees'=> $employees]);
    }


    public function create(Company $company)
    {
        $this->authorize('view', $company);

        return view('employees.create', ['company'=>$company]);
    }

   
    public function store(Company $company, Employee $employee)
    {   
        $this->authorize('view', $company);

        $attributes= $this->validateAttributes();
        $attributes['company_id'] = $company->id;
        
        $employee = $employee->create($attributes);

        return redirect("/companies/{$company->id}/employees/{$employee->id}");
    }

    
    public function show(Company $company, Employee $employee)
    {
        $this->authorize('view', $company);

        return view('employees.show', ['company'=> $company, 'employee'=>$employee]);
    }

    
    public function edit(Company $company, Employee $employee)
    {
        $this->authorize('view', $employee);

        return view('employees.edit', ['employee'=>$employee]);
    }

    
    public function update(Company $company, Employee $employee)
    {
        
        $attributes= $this->validateAttributes();
        $attributes['company_id'] = $company->id;

        $employee->update($attributes);

        return redirect("companies/{$company->id}/employees/{$employee->id}");
    }


    
    public function destroy(Company $company, Employee $employee)
    {   
        $this->authorize('view', $employee);

        $employee->delete();
        return redirect ("companies/{$company->id}/employees");
    }

    
    public function validateAttributes()
    {
        return request()->validate([
            'first_name'=> 'required',
            'last_name' => 'required',
            'email' => 'required',
            'phone' => 'required']);
    }  
}
