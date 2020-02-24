# CompanyCMS

1. [About](#about)   
2. [Basic Laravel Auth](#basic-laravel-auth)   
3. [CRUD for Companies](#crud-for-companies)  
    i. [CREATE company](#create-company)  
    ii. [READ company](#read-company)  
    iii. [UPDATE company](#update-company)  
    iv. [DELETE company](#delete-company) 
4. [CRUD for Employees](#crud-for-employees)  
    i. [CREATE employee](#create-employee)   
    ii. [UPDATE employee](#update-employee)  
    iii. [DELETE employee](#delete-employee) 
5. [Eloquent relationships](#eloquent-relationships)
6. [Policy](#policy)
7. [DB seeding](#db-seeding)   
    i. [Factories](#factories)  
    ii. [Seeders](#seeders)    
8. [Search functionality](#search-functionality)

   

## About 

CompanyCMS is a simple CRUD website made with Laravel 6 that allows users to create an account add companies and manage company employees.

   * Basic Laravel login is used for creating accounts and authenticating users.  
   * Users can view, create, edit and delete their companies and employees. The admin of the website can view, edit and delete all companies and employees.  
   * Laravel's auth middleware is used for checking if the user is authenticated. 
   * A policy is used to verify is a user has permissions to access company and employee information. 
   * Database is seeded with records using factories and seeders.
   * A simple search for companies and employees has been implemented.  

## Basic Laravel Auth

Create basic Laravel auth: 
- `composer require laravel/ui --dev`
- `npm install && npm run dev`
- `php artisan ui vue --auth` - installs a layout view, registration and login views, routes for all authentication end-points and a HomeController.

## CRUD for Companies

### Create company

To create a new company 2 `CompanyController` methods are used:

- `create` -> returns view with form to create new company    

<details> 
<summary> store -> persists the new company in the DB  </summary> 

- validates the request attributes       
- persists the new company to the DB      

```php
// /app/Http/Controllers/CompanyController.php

// persists the company to the DB
public function store(Company $company, Request $request)
{
  // server-side validation
  $attributes = $this->validateAttributes();

  // sets attributes
  $attributes['user_id'] = auth()->user()->id;

  // persits to DB
  $company = $company->create($attributes);

  return view("companies.show", ['company' => $company]);
}
```
</details>


### Read company

<details>
<summary>View all companies </summary>

- checks if user is admin -> returns all companies ordered by latest added and paginates the results  
- if user is not admin -> returns all companies belonging to a specific user ordered by latest added and paginates the results  
- checks if a search has been performed and returns the paginated results of the search   
```php
// /app/Http/Controllers/CompanyController.php

// returns view with all companies
public function index()
{   
  // if user is admin returns all companies
  if (auth()->user()->isAdmin()) {

    $companies = Company::latest();             
  }
  // else returns the companies that belong to the user   
  else {

    $companies = Company::where('user_id', auth()->id())->latest();  
  }

  //checks if search was performed, returns companies that match
  if (isset($_GET['search'])) {

    $companies->whereRaw("UPPER(name) LIKE '%" . strtoupper($_GET['search']) . "%'");          
  }

  //orders by most recent and paginates the results
  $companies = $companies->paginate(10);
  
  return view('companies.index', ['companies' => $companies]);
}
```
</details>
<details>
<summary>Show one company  </summary>

- shows details of one company with the associated employees    
- checks if a search was performed and returns the results    
- if no search was performed returns all the employees  

```php
// /app/Http/Controllers/CompanyController.php

// shows one company
public function show(Company $company)
{
  // uses policy to authorize view
  $this->authorize('view', $company);

  //checks if search was performed, returns employees that match
  if (isset($_GET['search'])) {

    $employees = $company->employees()
        ->whereRaw("UPPER(first_name) LIKE '%" . $_GET['search'] . "%'"); 

  } else {
    // returns all the employees ordered by most recent and paginates the results 
      $employees = $company->employees()->latest();
  }

  return view('companies.show', ['company' => $company, 'employees' => $employees->paginate(10)]);
}
```
</details>
<details>
<summary>Display pagination in view </summary>

```html
@if (!empty($companies->links()))
<div class="mt-3">
  <div>{{ $companies->links() }}</div>
<div>
@endif
```

</details>

### Update company

To update an existing company 2 `CompanyController` methods are used:

- `edit` -> returns view with form to edit an existing company  

<details> 
<summary> update -> persists the changes to the company</summary> 

- validates the request attributes  
- persists the new company in the DB    

```php
// /app/Http/Controllers/CompanyController.php

// persists the changes to the DB
  public function update(Company $company)
{
  // server-side validation
  $attributes = $this->validateAttributes();
  
  // sets attributes
  $attributes['user_id'] = auth()->user()->id;

  // persists the changes
  $company->update($attributes);

  return view('companies.show', ['company' => $company]);
}
```

</details>

### Delete company

<details> 
<summary> destroy -> deletes the record from the DB</summary>

```php
// /app/Http/Controllers/CompanyController.php

// deletes the company from the DB
public function destroy(Company $company)
{   
  // uses policy to authorize view
  $this->authorize('view', $company);

  // deletes from DB
  $company->delete();

  return redirect('/companies');
}
```

</details>

## CRUD for Employees

### Create employee

To create a new employee 2 `CompanyEmployeesController` methods are used:

- `create` -> returns view with form to create new employee (passing the `$company` argument to the view)  

<details> 
<summary> store -> persists the new employee in the DB  </summary>

- validates the request attributes    
- persists the new employee to the DB    

```php
// /app/Http/Controllers/CompanyEmployeeController.php

// persists the employee to the DB
public function store(Company $company, Employee $employee)
{   
  // server-side validation
  $attributes = $this->validateAttributes();

  // sets attributes
  $attributes['company_id'] = $company->id;

  // persits to DB
  $employee = $employee->create($attributes);

  return redirect("/companies/{$company->id}");
}
```

</details>

### Update employee

To update an existing employee 2 `CompanyEmployeesController` methods are used:

- `edit` -> returns view with form to edit an existing employee  

<details> 
<summary> update -> persists the changes to the employee </summary> 

- validates the request attributes      
- persists the new company in the DB      

```php
// /app/Http/Controllers/CompanyEmployeeController.php

public function update(Company $company, Employee $employee)
{
  // server-side validation
  $attributes= $this->validateAttributes();

  // sets attributes
  $attributes['company_id'] = $company->id;

  // persits the changes to DB
  $employee->update($attributes);

  return redirect("companies/{$company->id}");
}
```

</details>

### Delete employee

<details> 
<summary> destroy-> deletes the record from the DB</summary>

```php
// /app/Http/Controllers/CompanyController.php

// deletes the employee from the DB
public function destroy(Company $company, Employee $employee)
{   
  // uses policy to authorize view
  $this->authorize('view', $company);

  // deletes the record
  $employee->delete();

  return redirect ("companies/{$company->id}");
}
```
</details>

## Eloquent relationships

<details><summary>User</summary>

- hasMany Companies    

```php
// has many companies
public function companies()
{
  return $this->hasMany(Company::class);
}
```

- check if admin      

```php
// checks if admin - user with id==1 is admin 
public function isAdmin()
{
  if ($this->id == 1)
  {
    return true;
  }
}
``` 
</details>
<details><summary>Company</summary>

- belongsTo one User    

```php
// belongs to one user
public function user()
{
  return $this->belongsTo(User::class);
}
```
- hasMany Employees     
```php
// has many employees
public function employees()
{
  return $this->hasMany(Employee::class);
}
```
- casting attribute to datetime      
```php
// casts attribute to assigned data types
protected $casts=[
  'created_at' => 'datetime'
];
```

</details>
<details><summary>Employee</summary>

- belongsTo one company      

```php
// belongs to one company
public function company()
{
  return $this->belongsTo(Company::class);
}
```
</details>


## Policy

<details><summary>Company policy -> only auth users and admin can edit and delete a company  </summary>

```php
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
```
</details>

## DB Seeding

The database was seeded using factories and a DB seeder with the `php artisan db:seed` command.


### Factories

<details><summary>User factory </summary>

```php
// /database/factories/UserFactory.php

// defining the 
$factory->define(User::class, function (Faker $faker) {
  return [
    'name' => $faker->name,
    'email' => $faker->unique()->safeEmail,
    'email_verified_at' => now(),
    'password' => $faker->password, // password
    'remember_token' => Str::random(10),
  ];
});

```
</details>
<details><summary>Company factory </summary>
    
- when a Company is created, a new User is created

```php
// /database/factories/CompanyFactory.php  
$factory->define(Company::class, function (Faker $faker) {
  return [
    'name' => $faker->company,
    'email' => $faker->email,
    'website' => $faker->domainName,
    'user_id' => factory(User::class),
  ];
});


```
</details>
<details><summary>Employee factory </summary>

```php
// /database/factories/EmployeeFactory.php

$factory->define(Employee::class, function (Faker $faker) {
  return [
    'first_name' => $faker->firstName,
    'last_name' => $faker->lastName,
    'email' => $faker->email,
    'phone' => $faker->e164PhoneNumber,
  ];
});
```
</details>

### Seeders

<details><summary>CompaniesTableSeeder </summary>

- `php artisan make:seeder CompaniesTableSeeder` 
- create 5 new Company instances, for each company create 20 employees 

```php
// /database/seeds/CompaniesTableSeeder.php

use App\Company;
use App\Employee;
use Illuminate\Database\Seeder;

class CompaniesTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {   
    // create 5 new Company instances, for each company create 20 employees
    factory(App\Company::class, 5)->create()->each(function ($company) {
    $company->employees()->saveMany(factory(App\Employee::class, 20)->make());
    });
  }
}
```
</details>
<details><summary>DatabaseSeeder </summary>

- the run method is called when `php artisan db:seed` command is used 
- all the seeders in the run method are called 

```php
// /database/seeds/DatabaseSeeder.php

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run()
  {   
    // calls the seeder
    $this->call(CompaniesTableSeeder::class);
  }
}
```
</details>


## Search functionality  

<details><summary>Controller method  </summary>

- check if search was performed  
- queries the DB for all the employees whose last names contain specified characters    

```php
// /app/Http/Controllers/CompanyController.php

//checks if search was performed, returns matching employees
if (isset($_GET['search'])) {

  $employees = $company->employees()
  ->whereRaw("UPPER(last_name) LIKE '%" . $_GET['search'] . "%'");
```
</details>

<details><summary>Form - view</summary>

```html
<!-- /resources/views/companies/show.blade.php -->

<form action="/companies/{{ $company->id }}", method="GET">
    <input  class="form-control" style="width:200px;" name="search" value="{{ isset($_GET['search']) ? $_GET['search'] : 'Search' }}">
</form>
```
</details>
