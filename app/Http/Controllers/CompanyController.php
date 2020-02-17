<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CompanyController extends Controller
{
    // returns view with all companies
    public function index()
    {   
        if (auth()->user()->isAdmin()) {
            $companies = Company::latest()->simplePaginate(10);
        }   
        else{
            $companies = Company::where('user_id', auth()->user()->id)->latest()->simplePaginate(10);
        }
        return view('companies.index', ['companies'=> $companies]);
    }

    // returns view with a form to create a company
    public function create()
    {
        // uses policy to authorize view
        $this->authorize('view', Company::class);
        return view('companies.create');
    }

    // persists the company to the DB
    public function store(Company $company, Request $request)
    {
        
        $this->authorize('view', $company);

        // server-side validation
        $attributes=$this->validateAttributes();

        // sets attributes
        $attributes['user_id'] = auth()->user()->id;

        // persits to DB
        $company = $company->create($attributes);

        return view("companies.show", ['company'=>$company]);
    }

    // shows one company
    public function show(Company $company)
    {
        // uses policy to authorize view
        $this->authorize('view', $company);

        // returns all the employees ordered by most recent and paginates the results 
        $employees = $company->employees()->latest()->simplePaginate(5);

        return view('companies.show', ['company'=>$company, 'employees'=> $employees]);
    }

    // returns view with a form to edit a company
    public function edit(Company $company)
    {
        // uses policy to authorize view
        $this->authorize('view', $company);

        return view('companies.edit', ['company'=>$company]);
    }

    // persists the changes to the DB
    public function update(Company $company)
    {
        // uses policy to authorize view
        $this->authorize('view', $company);

        // server-side validation
        $attributes=$this->validateAttributes();
        
        // sets attributes
        $attributes['user_id'] = auth()->user()->id;

        // persists the changes
        $company->update($attributes);

        return view('companies.show', ['company'=>$company]);
    }

    // deletes the compan from the DB
    public function destroy(Company $company)
    {   
        // uses policy to authorize view
        $this->authorize('view', $company);

        // deletes from DB
        $company->delete();
        return redirect('/companies');
    }

    // simple server-side validation
    public function validateAttributes()
    {
        return request()->validate([
            'name'=> 'required',
            'email' => 'required',
            'website' => 'required',
            ]);
    }    
}
