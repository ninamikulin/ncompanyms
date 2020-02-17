<?php

namespace App\Http\Controllers;


use App\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CompanyController extends Controller
{

    public function index()
    {   
        if (auth()->user()->isAdmin()) {
            $companies = Company::simplePaginate(10);
        }   
        else{
            $companies = Company::where('user_id', auth()->user()->id)->simplePaginate(10);
        }


        return view('companies.index', ['companies'=> $companies]);
    }


    public function create()
    {
        $this->authorize('view', Company::class);
        return view('companies.create');
    }


    public function store(Company $company,Request $request)
    {
        $attributes=$this->validateAttributes();

        $attributes['user_id'] = auth()->user()->id;

        $company = $company->create($attributes);

        return view("companies.show", ['company'=>$company]);
    }


    public function show(Company $company)
    {

        $this->authorize('view', $company);

        return view('companies.show', ['company'=>$company]);
    }


    public function edit(Company $company)
    {
        $this->authorize('view', $company);
        return view('companies.edit', ['company'=>$company]);
    }


    public function update(Company $company)
    {
        $attributes=$this->validateAttributes();
        $attributes['user_id'] = auth()->user()->id;

        $company->update($attributes);
        return view('companies.show', ['company'=>$company]);
    }


    public function destroy(Company $company)
    {   

        $company->delete();
        return redirect('/companies');
    }


    public function validateAttributes()
    {
        return request()->validate([
            'name'=> 'required',
            'email' => 'required',
            'website' => 'required',
            ]);
    }    
}
