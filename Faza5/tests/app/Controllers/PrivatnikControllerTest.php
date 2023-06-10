<?php

namespace App\Controllers;

use CodeIgniter\Database\Database;
use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\ControllerTestTrait;
use CodeIgniter\Test\DatabaseTestTrait;


class PrivatnikControllerTest extends CIUnitTestCase
{
    use ControllerTestTrait;
    use DatabaseTestTrait;

    protected $DBGroup = 'tests';

    protected $migrate     = false;
    //protected $migrateOnce = false;
    protected $refresh     = true;
    protected $namespace   = 'Tests\Support\Database';

    // For Seeds
    protected $seedOnce = false;
    protected $seed     = 'Tests\Support\Database\Seeds\PrivatnikSeeder';
   protected $basePath = 'Tests\Support\Database';
   
    
    protected function setUp(): void
    {
        parent::setUp();
        
        $korisnik = [
                'SifK' => 3,
                'KorisnickoIme' => 'zeljko123',
                'Lozinka' => 'zeljko123',
                'TraziBrisanje' => 0,
                'Ime' => 'Zeljko',
                'Prezime' => 'Urosevic',
                'BrTel' => 432678900,
                'Email' => 'pomocniEPUTUJ2@outlook.com',
                'PrivatnikIliKorisnik' => 'P',
                'Novac' => 400,
                'ProfilnaSlika' => '3_20230531220122_RE4wwtb.jpg'
            ];
        
        session()->set('korisnik',(object)$korisnik);
        
    }

    // protected function regressDatabase()
    // {
    //     $sql = file_get_contents(SUPPORTPATH. 'Database/' . 'testeputuj.sql');
    //     $this->db->query($sql);
    // }

    protected function tearDown(): void
    {
        parent::tearDown();

        $builder = $this->db->table("admin")->truncate();
        $builder = $this->db->table("jedobio")->truncate();
        $builder = $this->db->table("korisnik")->truncate();
        $builder = $this->db->table("kupljenakarta")->truncate();
        $builder = $this->db->table("mesto")->truncate();
        $builder = $this->db->table("obicankorisnik")->truncate();
        $builder = $this->db->table("ocena")->truncate();
        $builder = $this->db->table("poklon")->truncate();
        $builder = $this->db->table("ponuda")->truncate();
        $builder = $this->db->table("poruka")->truncate();
        $builder = $this->db->table("postavljenaponuda")->truncate();
        $builder = $this->db->table("pretplata")->truncate();
        $builder = $this->db->table("prevoznosredstvo")->truncate();
        $builder = $this->db->table("privatnik")->truncate();
        $builder = $this->db->table("report")->truncate();
        $builder = $this->db->table("rezervacija")->truncate();
        $builder = $this->db->table("uplata")->truncate();
        $builder = $this->db->table("vanrednaponuda")->truncate();
        $builder = $this->db->table("zahtevponuda")->truncate();
    }

    public function testIndexPage(){
        
        $korisnik = [
                'SifK' => 3,
                'KorisnickoIme' => 'zeljko123',
                'Lozinka' => 'zeljko123',
                'TraziBrisanje' => 0,
                'Ime' => 'Zeljko',
                'Prezime' => 'Urosevic',
                'BrTel' => 432678900,
                'Email' => 'pomocniEPUTUJ2@outlook.com',
                'PrivatnikIliKorisnik' => 'P',
                'Novac' => 400,
                'ProfilnaSlika' => '3_20230531220122_RE4wwtb.jpg'
            ];
        
        session()->set('korisnik',(object)$korisnik);
        
        $results = $this->withURI("http://localhost:8080/PrivatnikController")->controller("App\Controllers\PrivatnikController")->execute('index');
        $this->assertTrue($results->see('Dobrodošli'));
    }
    
    public function testIzborPonudeAzuriranje(){
        
        $korisnik = [
                'SifK' => 3,
                'KorisnickoIme' => 'zeljko123',
                'Lozinka' => 'zeljko123',
                'TraziBrisanje' => 0,
                'Ime' => 'Zeljko',
                'Prezime' => 'Urosevic',
                'BrTel' => 432678900,
                'Email' => 'pomocniEPUTUJ2@outlook.com',
                'PrivatnikIliKorisnik' => 'P',
                'Novac' => 400,
                'ProfilnaSlika' => '3_20230531220122_RE4wwtb.jpg'
            ];
        
        session()->set('korisnik',(object)$korisnik);
        
        $results = $this->withURI("http://localhost:8080/PrivatnikController")->controller("App\Controllers\PrivatnikController")->execute('izborPonudeAzuriranje');
        $this->assertTrue($results->see('AŽURIRANJE PONUDE'));
        
    }
    
    /**
     * @dataProvider ponudaProvider
     */
    public function testPrikazPonude($sifP){
        $results = $this->withURI("http://localhost:8080/PrivatnikController")->controller("App\Controllers\PrivatnikController")->execute('prikazPonude', $sifP);
        $this->assertTrue($results->see('Cena'));
    }
    
    public function ponudaProvider(){
        return [
            [37],
        ];
    }
    
    /**
     * @dataProvider ponudaProvider
     */
    public function testAzurirajPonudu($sifP){
        $results = $this->withURI("http://localhost:8080/PrivatnikController")->controller("App\Controllers\PrivatnikController")->execute('azurirajPonudu', $sifP);
        $this->assertTrue($results->see("Azuriraj"));
    }
    
    /**
     * @dataProvider ponudaProvider
     */
    public function testAzuriranjePonudeSubmit1($sifP){
        $_REQUEST["prevoznoSredstvo"]= 2;
        $_REQUEST["mestoPolaska"] = "Beograd";
        $_REQUEST["mestoDolaska"] = "Jagodina";
        $_REQUEST["cenaKarte"] = 900;
        $_REQUEST["brMesta"] = 10;
        $_REQUEST["datumOd"] = '2023-10-10';
        $_REQUEST["datumDo"] = '2023-10-14';
        $_REQUEST["vremeOd"] = '20:00:00';
        $_REQUEST["vremeDo"] = '19:00:00';
        $_REQUEST["rokZaOtkazivanje"] = 2;
        $_FILES['slika']['type'] =  base_url('images/1.png');
        
        $results = $this->withURI("http://localhost:8080/PrivatnikController")->controller("App\Controllers\PrivatnikController")->execute('azurirajPonudu', $sifP);
        $this->assertTrue($results->see("Azuriraj"));
   
        
        
    }
    
     /**
     * @dataProvider ponudaProvider
     */
    public function testAzuriranjePonudeSubmit2($sifP){
        $_REQUEST["prevoznoSredstvo"]= 2;
        $_REQUEST["mestoPolaska"] = "Beograd";
        $_REQUEST["mestoDolaska"] = "Jagodina";
        $_REQUEST["cenaKarte"] = 900;
        $_REQUEST["brMesta"] = -5;
        $_REQUEST["datumOd"] = '2023-06-10';
        $_REQUEST["cenaKarte"] = '2023-06-18';
        $_REQUEST["vremeOd"] = '20:00:00';
        $_REQUEST["vremeDo"] = '19:00:00';
        $_REQUEST["rokZaOtkazivanje"] = 2;
        $_FILES['slika']['type'] = base_url('images/1.png');
        
        $results = $this->withURI("http://localhost:8080/PrivatnikController")->controller("App\Controllers\PrivatnikController")->execute('azurirajPonudu', $sifP);
        $this->assertTrue($results->see("Broj slobodnih mesta mora biti nenegativan broj."));
   
    }
    
    
}