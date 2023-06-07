<?php

namespace App\Controllers;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\ControllerTestTrait;
use CodeIgniter\Test\DatabaseTestTrait;

class TextPrivatnikController extends CIUnitTestCase
{
    use ControllerTestTrait;
    use DatabaseTestTrait;
    
    protected $migrate     = false;
    //protected $migrateOnce = false;
    protected $refresh     = true;
    //protected $namespace   = 'Tests\Support\Database';

    // For Seeds
    //protected $seedOnce = false;
    protected $seed     = 'Tests\Support\Database\Seeds\PrivatnikSeeder';
   protected $basePath = 'Tests\Support\Database';
    
    protected function setUp(): void
    {
        parent::setUp();

    }

    protected function tearDown(): void
    {
        parent::tearDown();

    }
    
    public function testIndexPage(){
        $results = $this->controller('App\Controllers\PrivatnikController')->execute('index');
        $this->assertTrue($results->see('Dobrodošli'));
    }
    
}