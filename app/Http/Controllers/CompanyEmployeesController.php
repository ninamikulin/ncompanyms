<?php

namespace App\Http\Controllers;

use App\Company;
use App\Employee;
use Illuminate\Http\Request;

class CompanyEmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Company $company)
    {
        
        return view('employees.index', ['company'=> $company]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Company $company)
    {
        return view('employees.create', ['company'=>$company]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Company $company, Employee $employee)
    {   
        $attributes= $this->validateAttributes();
        $attributes['company_id'] = $company->id;
        
        $employee->create($attributes);

        return redirect("/companies/{$company->id}/employees");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company, Employee $employee)
    {
        return view('employees.edit', ['employee'=>$employee]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Company $company, Employee $employee)
    {
        
        $employee->update($this->validateAttributes());

        return redirect("companies/{$company->id}/employees");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company, Employee $employee)
    {
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
