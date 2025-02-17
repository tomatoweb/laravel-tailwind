<?php

namespace Tests\Feature;

use App\Models\Department;
use App\Models\Employee;
use Illuminate\Foundation\Testing\Concerns\MakesHttpRequests;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


/**
 * Use sqlite memory database, configure it in .env.testing
 * Browse this memory database with the cli command 'sqlite3'
 */


class ExampleTest extends TestCase
{

    use MakesHttpRequests;

    use RefreshDatabase;
      
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/employees');

        $response->assertStatus(200);
        
        $response->assertSee('Employees');
    }
    
    public function test_homepage_contains_non_empty_table(): void
    {
        Department::create([
            'name' => 'compta',
            'description' => 'la comptabilité',
            'slug' =>   'compta'
        ]);

         $employee = Employee::create([
            'name' => 'John Doe',
            'description' => 'Stagiaire',
            'slug' => 'john-doe',
            'department_id' => 1
        ]); 

        $response = $this->get('/employees');
        $response->assertStatus(200);
        $response->assertDontSee('no employees');
        // the view contents some text
        $response->assertSee('John Doe'); 
        // datas contents some object
        $response->assertViewHas('employees', function ($collection) use ($employee) {
            return $collection->contains($employee);
        });

    }
}
