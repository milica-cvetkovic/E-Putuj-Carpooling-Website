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
    public function testAzuriranjePonudeSubmitUspesno($sifP){
        
        $this->markTestSkipped('Nemoguce doci do kraja');
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
        $_FILES["slika"]["size"] = 5000;
        $_FILES['slika']['name'] = '1.png';
        $_FILES['slika']['tmp_name'] = '11.png';
        
        $results = $this->withURI("http://localhost:8080/PrivatnikController")->controller("App\Controllers\PrivatnikController")->execute('azuriranjePonudeSubmit', $sifP);
        $this->assertTrue($results->see("Uspesno azurirana ponuda!"));
   
    }
    
     /**
     * @dataProvider ponudaProvider
     */
    public function testAzuriranjePonudeSubmitNeuspesnoBrojMesta($sifP){
        $_REQUEST["prevoznoSredstvo"]= 2;
        $_REQUEST["mestoPolaska"] = "Beograd";
        $_REQUEST["mestoDolaska"] = "Jagodina";
        $_REQUEST["cenaKarte"] = 900;
        $_REQUEST["brMesta"] = -5;
        $_REQUEST["datumOd"] = '2023-10-10';
        $_REQUEST["datumDo"] = '2023-10-14';
        $_REQUEST["vremeOd"] = '20:00:00';
        $_REQUEST["vremeDo"] = '19:00:00';
        $_REQUEST["rokZaOtkazivanje"] = 2;
        $_FILES['slika']['type'] = base_url('images/1.png');
        $_FILES["slika"]["size"] = 5000;
        $_FILES['slika']['name'] = '1.png';
        $_FILES['slika']['tmp_name'] = '11.png';
        
        $results = $this->withURI("http://localhost:8080/PrivatnikController")->controller("App\Controllers\PrivatnikController")->execute('azuriranjePonudeSubmit', $sifP);
        $this->assertTrue($results->see("Broj slobodnih mesta mora biti nenegativan broj."));
   
    }
    
    /**
     * @dataProvider ponudaProvider
     */
    public function testAzuriranjePonudeSubmitNeuspesnoCena($sifP){
        $_REQUEST["prevoznoSredstvo"]= 2;
        $_REQUEST["mestoPolaska"] = "Beograd";
        $_REQUEST["mestoDolaska"] = "Jagodina";
        $_REQUEST["cenaKarte"] = -10;
        $_REQUEST["brMesta"] = 10;
        $_REQUEST["datumOd"] = '2023-10-10';
        $_REQUEST["datumDo"] = '2023-10-14';
        $_REQUEST["vremeOd"] = '20:00:00';
        $_REQUEST["vremeDo"] = '19:00:00';
        $_REQUEST["rokZaOtkazivanje"] = 2;
        $_FILES['slika']['type'] = base_url('images/1.png');
        $_FILES["slika"]["size"] = 5000;
        $_FILES['slika']['name'] = '1.png';
        $_FILES['slika']['tmp_name'] = '11.png';
        
        $results = $this->withURI("http://localhost:8080/PrivatnikController")->controller("App\Controllers\PrivatnikController")->execute('azuriranjePonudeSubmit', $sifP);
        $this->assertTrue($results->see("Cena mora da bude pozitivan broj."));
   
    }
    
     /**
     * @dataProvider ponudaProvider
     */
    public function testAzuriranjePonudeSubmitNeuspesnoDatumIVremeRanije($sifP){
        
        $_REQUEST["prevoznoSredstvo"]= 2;
        $_REQUEST["mestoPolaska"] = "Beograd";
        $_REQUEST["mestoDolaska"] = "Jagodina";
        $_REQUEST["cenaKarte"] = 900;
        $_REQUEST["brMesta"] = 10;
        $_REQUEST["datumOd"] = '2023-05-09';
        $_REQUEST["datumDo"] = '2023-05-26';
        $_REQUEST["vremeOd"] = '20:00:00';
        $_REQUEST["vremeDo"] = '19:00:00';
        $_REQUEST["rokZaOtkazivanje"] = 2;
        $_FILES['slika']['type'] =  base_url('images/1.png');
        $_FILES["slika"]["size"] = 5000;
        $_FILES['slika']['name'] = '1.png';
        $_FILES['slika']['tmp_name'] = '11.png';
        
        $results = $this->withURI("http://localhost:8080/PrivatnikController")->controller("App\Controllers\PrivatnikController")->execute('azuriranjePonudeSubmit', $sifP);
        $this->assertTrue($results->see("Uneti datum i vreme moraju biti kasnije od trenutnog datuma i vremena."));
    }
    
    /**
     * @dataProvider ponudaProvider
     */
    public function testAzuriranjePonudeSubmitDatumiNeispravni($sifP){
        $_REQUEST["prevoznoSredstvo"]= 2;
        $_REQUEST["mestoPolaska"] = "Beograd";
        $_REQUEST["mestoDolaska"] = "Jagodina";
        $_REQUEST["cenaKarte"] = 900;
        $_REQUEST["brMesta"] = 10;
        $_REQUEST["datumOd"] = '2023-06-25';
        $_REQUEST["datumDo"] = '2023-06-14';
        $_REQUEST["vremeOd"] = '20:00:00';
        $_REQUEST["vremeDo"] = '19:00:00';
        $_REQUEST["rokZaOtkazivanje"] = 2;
        $_FILES['slika']['type'] =  base_url('images/1.png');
        $_FILES["slika"]["size"] = 5000;
        $_FILES['slika']['name'] = '1.png';
        $_FILES['slika']['tmp_name'] = '11.png';
        
        $results = $this->withURI("http://localhost:8080/PrivatnikController")->controller("App\Controllers\PrivatnikController")->execute('azuriranjePonudeSubmit', $sifP);
        $this->assertTrue($results->see("Datum dolaska mora biti kasnije od datuma polaska."));
   
    }
    
    /**
     * @dataProvider ponudaProvider
     */
    public function testAzuriranjePonudeSubmitVreme($sifP){
        
        $_REQUEST["prevoznoSredstvo"]= 2;
        $_REQUEST["mestoPolaska"] = "Beograd";
        $_REQUEST["mestoDolaska"] = "Jagodina";
        $_REQUEST["cenaKarte"] = 900;
        $_REQUEST["brMesta"] = 10;
        $_REQUEST["datumOd"] = '2023-06-14';
        $_REQUEST["datumDo"] = '2023-06-14';
        $_REQUEST["vremeOd"] = '20:00:00';
        $_REQUEST["vremeDo"] = '13:00:00';
        $_REQUEST["rokZaOtkazivanje"] = 2;
        $_FILES['slika']['type'] =  base_url('images/1.png');
        $_FILES["slika"]["size"] = 5000;
        $_FILES['slika']['name'] = '1.png';
        $_FILES['slika']['tmp_name'] = '11.png';
        
        $results = $this->withURI("http://localhost:8080/PrivatnikController")->controller("App\Controllers\PrivatnikController")->execute('azuriranjePonudeSubmit', $sifP);
        $this->assertTrue($results->see("Vreme dolaska mora biti kasnije od vremena polaska."));
   
    }
    
    /**
     * @dataProvider ponudaProvider
     */
    public function testAzuriranjePonudeSubmitMesto($sifP){
        
        $_REQUEST["prevoznoSredstvo"]= 2;
        $_REQUEST["mestoPolaska"] = "Beograd";
        $_REQUEST["mestoDolaska"] = "Beograd";
        $_REQUEST["cenaKarte"] = 900;
        $_REQUEST["brMesta"] = 10;
        $_REQUEST["datumOd"] = '2023-10-10';
        $_REQUEST["datumDo"] = '2023-10-14';
        $_REQUEST["vremeOd"] = '20:00:00';
        $_REQUEST["vremeDo"] = '19:00:00';
        $_REQUEST["rokZaOtkazivanje"] = 2;
        $_FILES['slika']['type'] = base_url('images/1.png');
        $_FILES["slika"]["size"] = 5000;
        $_FILES['slika']['name'] = '1.png';
        $_FILES['slika']['tmp_name'] = '11.png';
        
        $results = $this->withURI("http://localhost:8080/PrivatnikController")->controller("App\Controllers\PrivatnikController")->execute('azuriranjePonudeSubmit', $sifP);
        $this->assertTrue($results->see("Mesto polaska i dolaska moraju biti različiti."));
   
    }
    
    
    /**
     * @dataProvider ponudaProvider
     */
    public function testAzuriranjePonudeSubmitNeuspesnoRokOTkazivanja($sifP){
        
        $_REQUEST["prevoznoSredstvo"]= 2;
        $_REQUEST["mestoPolaska"] = "Beograd";
        $_REQUEST["mestoDolaska"] = "Jagodina";
        $_REQUEST["cenaKarte"] = 900;
        $_REQUEST["brMesta"] = 10;
        $_REQUEST["datumOd"] = '2023-10-10';
        $_REQUEST["datumDo"] = '2023-10-14';
        $_REQUEST["vremeOd"] = '20:00:00';
        $_REQUEST["vremeDo"] = '19:00:00';
        $_REQUEST["rokZaOtkazivanje"] = 15;
        $_FILES['slika']['type'] = base_url('images/1.png');
        $_FILES["slika"]["size"] = 5000;
        $_FILES['slika']['name'] = '1.png';
        $_FILES['slika']['tmp_name'] = '11.png';
        
        $results = $this->withURI("http://localhost:8080/PrivatnikController")->controller("App\Controllers\PrivatnikController")->execute('azuriranjePonudeSubmit', $sifP);
        $this->assertTrue($results->see("Rok za otkazivanje rezervacije mora da bude pozitivan broj i ne veći od trenutnog roka."));
   
    }
    
    /**
     * @dataProvider ponudaProvider
     */
    public function testAzuriranjePonudeSubmitNeuspesnoNijeSlika($sifP){
        
        $_REQUEST["prevoznoSredstvo"]= 2;
        $_REQUEST["mestoPolaska"] = "Beograd";
        $_REQUEST["mestoDolaska"] = "Jagodina";
        $_REQUEST["cenaKarte"] = 900;
        $_REQUEST["brMesta"] = 10;
        $_REQUEST["datumOd"] = '2023-10-10';
        $_REQUEST["datumDo"] = '2023-10-14';
        $_REQUEST["vremeOd"] = '20:00:00';
        $_REQUEST["vremeDo"] = '19:00:00';
        $_REQUEST["rokZaOtkazivanje"] = 15;
        $_FILES['slika']['type'] = 123;
        $_FILES["slika"]["size"] = 5000;
        $_FILES['slika']['name'] = '1.png';
        $_FILES['slika']['tmp_name'] = '11.png';
        
        $results = $this->withURI("http://localhost:8080/PrivatnikController")->controller("App\Controllers\PrivatnikController")->execute('azuriranjePonudeSubmit', $sifP);
        $this->assertTrue($results->see("Ubacen fajl nije slika"));
   
    }
    
    /**
     * @dataProvider ponudaProvider
     */
    public function testAzuriranjePonudeSubmitNeuspesnoPrevelikaSlika($sifP){
        
        $_REQUEST["prevoznoSredstvo"]= 2;
        $_REQUEST["mestoPolaska"] = "Beograd";
        $_REQUEST["mestoDolaska"] = "Jagodina";
        $_REQUEST["cenaKarte"] = 900;
        $_REQUEST["brMesta"] = 10;
        $_REQUEST["datumOd"] = '2023-10-10';
        $_REQUEST["datumDo"] = '2023-10-14';
        $_REQUEST["vremeOd"] = '20:00:00';
        $_REQUEST["vremeDo"] = '19:00:00';
        $_REQUEST["rokZaOtkazivanje"] = 15;
        $_FILES['slika']['type'] = base_url('images/1.png');
        $_FILES["slika"]["size"] = 10000200;
        $_FILES['slika']['name'] = '1.png';
        $_FILES['slika']['tmp_name'] = '11.png';
        
        $results = $this->withURI("http://localhost:8080/PrivatnikController")->controller("App\Controllers\PrivatnikController")->execute('azuriranjePonudeSubmit', $sifP);
        $this->assertTrue($results->see("Maksimalna dozvoljena veličina fajla je 1000000 bajtova."));
   
    }
    
    // uradi neuspelo ubacivanje slike i ostatal azuriranje ponude submit
    
    public function testNapraviPonudu(){
        $_REQUEST["SifK"] = 3;
        $results = $this->withURI("http://localhost:8080/PrivatnikController")->controller("App\Controllers\PrivatnikController")->execute('napraviPonudu');
        $this->assertTrue($results->see("KREIRANJE PONUDE"));
    }
    
    public function testNapraviPonuduSubmitNeuspesnoCena(){
        
        $_REQUEST["prevoznoSredstvo"]= 1;
        $_REQUEST["mestoPolaska"] = "Beograd";
        $_REQUEST["mestoDolaska"] = "Jagodina";
        $_REQUEST["cenaKarte"] = -10;
        $_REQUEST["brMesta"] = 12;
        $_REQUEST["datumOd"] = '2023-10-10';
        $_REQUEST["datumDo"] = '2023-10-14';
        $_REQUEST["vremeOd"] = '20:00:00';
        $_REQUEST["vremeDo"] = '19:00:00';
        $_REQUEST["rokZaOtkazivanje"] = 14;
        $_REQUEST["SifK"] = 3;
        
        $results = $this->withURI("http://localhost:8080/PrivatnikController")->controller("App\Controllers\PrivatnikController")->execute('napraviPonuduSubmit');
        $this->assertTrue($results->see("Cena mora da bude pozitivan broj."));
    }
    
    public function testNapraviPonuduSubmitNeuspesnoDatumIVremeKasnije(){
        
        $_REQUEST["prevoznoSredstvo"]= 1;
        $_REQUEST["mestoPolaska"] = "Beograd";
        $_REQUEST["mestoDolaska"] = "Jagodina";
        $_REQUEST["cenaKarte"] = 47;
        $_REQUEST["brMesta"] = 12;
        $_REQUEST["datumOd"] = '2023-04-10';
        $_REQUEST["datumDo"] = '2023-04-14';
        $_REQUEST["vremeOd"] = '20:00:00';
        $_REQUEST["vremeDo"] = '19:00:00';
        $_REQUEST["rokZaOtkazivanje"] = 14;
        $_REQUEST["SifK"] = 3;
        
        $results = $this->withURI("http://localhost:8080/PrivatnikController")->controller("App\Controllers\PrivatnikController")->execute('napraviPonuduSubmit');
        $this->assertTrue($results->see("Uneti datum i vreme moraju biti kasnije od trenutnog datuma i vremena."));
    }
    
    public function testNapraviPonuduSubmitNeuspesnoDatumKasnije(){
        
        $_REQUEST["prevoznoSredstvo"]= 1;
        $_REQUEST["mestoPolaska"] = "Beograd";
        $_REQUEST["mestoDolaska"] = "Jagodina";
        $_REQUEST["cenaKarte"] = 47;
        $_REQUEST["brMesta"] = 12;
        $_REQUEST["datumOd"] = '2023-10-14';
        $_REQUEST["datumDo"] = '2023-10-10';
        $_REQUEST["vremeOd"] = '20:00:00';
        $_REQUEST["vremeDo"] = '19:00:00';
        $_REQUEST["rokZaOtkazivanje"] = 14;
        $_REQUEST["SifK"] = 3;
        
        $results = $this->withURI("http://localhost:8080/PrivatnikController")->controller("App\Controllers\PrivatnikController")->execute('napraviPonuduSubmit');
        $this->assertTrue($results->see("Datum dolaska mora biti kasnije od datuma polaska."));
    }
    
    public function testNapraviPonuduSubmitNeuspesnoVreme(){
        
        $_REQUEST["prevoznoSredstvo"]= 1;
        $_REQUEST["mestoPolaska"] = "Beograd";
        $_REQUEST["mestoDolaska"] = "Jagodina";
        $_REQUEST["cenaKarte"] = 47;
        $_REQUEST["brMesta"] = 12;
        $_REQUEST["datumOd"] = '2023-10-10';
        $_REQUEST["datumDo"] = '2023-10-10';
        $_REQUEST["vremeOd"] = '20:00:00';
        $_REQUEST["vremeDo"] = '19:00:00';
        $_REQUEST["rokZaOtkazivanje"] = 14;
        $_REQUEST["SifK"] = 3;
        
        $results = $this->withURI("http://localhost:8080/PrivatnikController")->controller("App\Controllers\PrivatnikController")->execute('napraviPonuduSubmit');
        $this->assertTrue($results->see("Vreme dolaska mora biti kasnije od vremena polaska."));
    }
    
    public function testNapraviPonuduSubmitNeuspesnoMesto(){
        
        $_REQUEST["prevoznoSredstvo"]= 1;
        $_REQUEST["mestoPolaska"] = "Beograd";
        $_REQUEST["mestoDolaska"] = "Beograd";
        $_REQUEST["cenaKarte"] = 47;
        $_REQUEST["brMesta"] = 12;
        $_REQUEST["datumOd"] = '2023-10-10';
        $_REQUEST["datumDo"] = '2023-10-14';
        $_REQUEST["vremeOd"] = '20:00:00';
        $_REQUEST["vremeDo"] = '19:00:00';
        $_REQUEST["rokZaOtkazivanje"] = 14;
        $_REQUEST["SifK"] = 3;
        
        $results = $this->withURI("http://localhost:8080/PrivatnikController")->controller("App\Controllers\PrivatnikController")->execute('napraviPonuduSubmit');
        $this->assertTrue($results->see("Mesto polaska i dolaska moraju biti različiti."));
    }
    
     public function testNapraviPonuduSubmitNeuspesnoRokZaOtkazivanje(){
        
        $_REQUEST["prevoznoSredstvo"]= 1;
        $_REQUEST["mestoPolaska"] = "Beograd";
        $_REQUEST["mestoDolaska"] = "Jagodina";
        $_REQUEST["cenaKarte"] = 47;
        $_REQUEST["brMesta"] = 12;
        $_REQUEST["datumOd"] = '2023-10-10';
        $_REQUEST["datumDo"] = '2023-10-14';
        $_REQUEST["vremeOd"] = '20:00:00';
        $_REQUEST["vremeDo"] = '19:00:00';
        $_REQUEST["rokZaOtkazivanje"] = -10;
        $_REQUEST["SifK"] = 3;
        
        $results = $this->withURI("http://localhost:8080/PrivatnikController")->controller("App\Controllers\PrivatnikController")->execute('napraviPonuduSubmit');
        $this->assertTrue($results->see("Rok za otkazivanje rezervacije mora da bude pozitivan broj i da se uklapa u period do realizacije ponude."));
    }
    
     public function testNapraviPonuduSubmitNeuspesnoBrMesta(){
        
        $_REQUEST["prevoznoSredstvo"]= 1;
        $_REQUEST["mestoPolaska"] = "Beograd";
        $_REQUEST["mestoDolaska"] = "Jagodina";
        $_REQUEST["cenaKarte"] = 47;
        $_REQUEST["brMesta"] = -10;
        $_REQUEST["datumOd"] = '2023-10-10';
        $_REQUEST["datumDo"] = '2023-10-14';
        $_REQUEST["vremeOd"] = '20:00:00';
        $_REQUEST["vremeDo"] = '19:00:00';
        $_REQUEST["rokZaOtkazivanje"] = 14;
        $_REQUEST["SifK"] = 3;
        
        $results = $this->withURI("http://localhost:8080/PrivatnikController")->controller("App\Controllers\PrivatnikController")->execute('napraviPonuduSubmit');
        $this->assertTrue($results->see("Broj slobodnih mesta mora da bude pozitivan broj."));
    }
    
    // dovrsi napraviPonuduSUbmit
    
    public function testOtkaziPonudu(){
        
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
        
        $results = $this->withURI("http://localhost:8080/PrivatnikController")->controller("App\Controllers\PrivatnikController")->execute('otkaziPonudu');
        $this->assertTrue($results->see('OTKAZIVANJE PONUDE'));
        
    }
    
    /**
     * @dataProvider ponudaProvider
     */
    public function testOtkaziPonuduSubmit($sifP){
        
        $results = $this->withURI("http://localhost:8080/PrivatnikController")->controller("App\Controllers\PrivatnikController")->execute('otkaziPonuduSubmit', $sifP);
        $this->assertTrue($results->see("Ponuda je otkazana!"));
        
    }
    
    public function testPromenaPretplate(){
        $results = $this->withURI("http://localhost:8080/PrivatnikController")->controller("App\Controllers\PrivatnikController")->execute('promenaPretplate');
        $this->assertTrue($results->see('PROMENA PRETPLATE'));
    }
    
    public function testPromenaPretplateSubmitUspesnoPremium(){
        
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
        
        $_REQUEST["dugme"] = "Premium";
        
        $results = $this->withURI("http://localhost:8080/PrivatnikController")->controller("App\Controllers\PrivatnikController")->execute('promenaPretplateSubmit');
        $this->assertTrue($results->see('Uspesno ažuriranje'));
        
    }
    
     public function testPromenaPretplateSubmitNeuspesnoPremium(){
        
        $korisnik = [
                'SifK' => 4,
                'KorisnickoIme' => 'milica.c',
                'Lozinka' => 'Milica123#',
                'TraziBrisanje' => 0,
                'Ime' => 'Milica',
                'Prezime' => 'Cvetkovic',
                'BrTel' => 1234,
                'Email' => 'pomocniEPUTUJ2@outlook.com',
                'PrivatnikIliKorisnik' => 'P',
                'Novac' => 300,
                'ProfilnaSlika' => '3_20230531220122_RE4wwtb.jpg'
            ];
        
        session()->set('korisnik',(object)$korisnik);
        
        $_REQUEST["dugme"] = "Premium";
        
        $results = $this->withURI("http://localhost:8080/PrivatnikController")->controller("App\Controllers\PrivatnikController")->execute('promenaPretplateSubmit');
        $this->assertTrue($results->see('Vec imate premium pretplatu.'));
        
    }
    
     public function testPromenaPretplateSubmitUspesnoStandard(){
        
        $korisnik = [
                'SifK' => 4,
                'KorisnickoIme' => 'milica.c',
                'Lozinka' => 'Milica123#',
                'TraziBrisanje' => 0,
                'Ime' => 'Milica',
                'Prezime' => 'Cvetkovic',
                'BrTel' => 1234,
                'Email' => 'pomocniEPUTUJ2@outlook.com',
                'PrivatnikIliKorisnik' => 'P',
                'Novac' => 300,
                'ProfilnaSlika' => '3_20230531220122_RE4wwtb.jpg'
            ];
        
        session()->set('korisnik',(object)$korisnik);
        
        $_REQUEST["dugme"] = "Standard";
        
        $results = $this->withURI("http://localhost:8080/PrivatnikController")->controller("App\Controllers\PrivatnikController")->execute('promenaPretplateSubmit');
        $this->assertTrue($results->see('Uspesno ažuriranje'));
        
    }
    
    public function testPromenaPretplateSubmitNeuspesnoStandard(){
        
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
        
        $_REQUEST["dugme"] = "Standard";
        
        $results = $this->withURI("http://localhost:8080/PrivatnikController")->controller("App\Controllers\PrivatnikController")->execute('promenaPretplateSubmit');
        $this->assertTrue($results->see('Vec imate standard pretplatu.'));
        
    }
    
    
}