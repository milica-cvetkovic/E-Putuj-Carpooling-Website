<?php

namespace App\Controllers;

use App\Models\ModelPoruka;
use App\Models\ModelObicanKorisnikLana;

use PhpParser\Node\Stmt\Echo_;

use App\Models\ModelKorisnik;
use App\Models\ModelVanrednaPonuda;
use App\Models\ModelPonuda;
use App\Models\ModelMesto;
use App\Models\ModelSredstvo;

use  App\Controllers\GostController;


use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mailer\Transport\Smtp\EsmtpTransport;

class KorisnikController extends BaseController
{

    private function prikaz($stranica, $podaci)
    {
        $SifK = session()->get("korisnik")->SifK;
        $model = new ModelPoruka();
        $br = $model->select("count(*) as br")->where("SifKor", $SifK)->where("SmerPoruke", 2)->findAll()[0]->br;
        echo view("sabloni/headerkorisnik", ["brPoruka" => $br]);
        echo view($stranica, $podaci);
        echo view("sabloni/footer");
    }


    public function index()
    {
        

        $this->prikaz("indexkorisnik", ["kontroler"=>"KorisnikController","stranica"=>"indexkorisnik"]);
    }

    // dalje su samo fje za testiranje prikaza


    public function inboxKorisnik()
    {
        $Kime = session()->get("korisnik")->KorisnickoIme;
        $model = new ModelPoruka();
        $modelK = new ModelKorisnik();
        $modelP = new ModelPonuda();
        $modelM = new ModelMesto();

        $korisnik = $modelK->where("KorisnickoIme", $Kime)->findAll()[0];

        $poruke = $model->where("SifKor", $korisnik->SifK)->where("SmerPoruke", 2)->findAll();
        foreach ($poruke as $poruka) {
            $ponuda = $modelP->where("SifP", $poruka->SifPonuda)->findAll()[0];
            $poruka->mestoOd = $modelM->where("SifM", $ponuda->SifMesOd)->findAll()[0];
            $poruka->korisnik = $modelK->where("SifK", $poruka->SifPriv)->findAll()[0]->KorisnickoIme;
        }
        $this->prikaz("inboxKorisnik", ["poruke" => $poruke,"kontroler"=>"KorisnikController","stranica"=>"inboxKorisnik"]);
    }

    // ova stranica vrv nece da postoji, nego ce se ugraditi prikaz direktno

    public function obrisiPoruku()
    {
        $SifP = $this->request->getVar("SifP");
        $SifK = session()->get("korisnik")->SifK;

        $model = new ModelPoruka();

        $SifPor = $model->where("SifKor", $SifK)->where("SifPonuda", $SifP)->findAll()[0]->SifPor;
        $model->delete($SifPor);
        /* $db      = \Config\Database::connect();
        $builder = $db->table('rezervacija');

        $data = ["SifK"=>$SifK,"SifP"=>$SifP,"DatumRezervacije"=>];
        
        $builder->insert($data);//dodavanje rezervacije*/
        $this->inboxKorisnik();
        return;
    }

    public function inboxKorisnikPoruka()
    {
        $izbor = $this->request->getVar("poruka");
        $Kime = session()->get("korisnik")->KorisnickoIme;
        $model = new ModelPoruka();
        $modelK = new ModelKorisnik();
        $modelZ = new ModelVanrednaPonuda();
        $modelP = new ModelPonuda();
        $modelM = new ModelMesto();
        $modelS = new ModelSredstvo();

        $korisnik = $modelK->where("KorisnickoIme", $Kime)->findAll()[0];

        $poruke = $model->where("SifKor", $korisnik->SifK)->where("SmerPoruke", 2)->findAll();
        foreach ($poruke as $poruka) {
            $ponuda = $modelP->where("SifP", $poruka->SifPonuda)->findAll()[0];
            $poruka->mestoOd = $modelM->where("SifM", $ponuda->SifMesOd)->findAll()[0];
            $poruka->korisnik = $modelK->where("SifK", $poruka->SifPriv)->findAll()[0]->KorisnickoIme;
        }

        $izbor = $model->where("SifPor", $izbor)->findAll()[0];
        $odabrana = $modelP->where("SifP", $izbor->SifPonuda)->findAll()[0];
        $odabrana->RokZaOtkazivanje = $modelZ->where("SifP", $izbor->SifPonuda)->findAll()[0]->RokZaOtkazivanje;
        $odabrana->mestoOd = $modelM->where("SifM", $odabrana->SifMesOd)->findAll()[0];
        $odabrana->mestoDo = $modelM->where("SifM", $odabrana->SifMesDo)->findAll()[0];
        $odabrana->sredstvo = $modelS->where("SifSred", $odabrana->SifSred)->findAll()[0]->Naziv;
        $this->prikaz("inboxKorisnik", ["poruke" => $poruke, "odabrana" => $odabrana,"kontroler"=>"KorisnikController","stranica"=>"inboxKorisnik"]);
    }

    public function izmenaProfila()
    {
        $data = [];
        $db = db_connect();
        $model = new ModelObicanKorisnikLana($db);
        // $SifK =  session()->get("korisnik")->SifK;
        $SifK = "2";
        if ($this->request->getMethod() == 'post') {
            if ($_POST) {
                $data['poruka'] = "post";
                $ime = $_POST['ime'];
                $prezime = $_POST['prezime'];
                $lozinka = $_POST['lozinka'];
                $email = $_POST['email'];
                // $prfilna = $_POST[''] IZMJENA PROFILNE
                $profilna = null;

                $model->izmenaProfila($ime, $prezime, $lozinka, $email, $profilna, $SifK);
            }

            

            $data["kontroler"]="KorisnikController";
            $data["stranica"]="izmenaProfila";
        }
        $this->prikaz("izmenaProfila",$data);
    }

    public function ocenjivanje()
    {
        $data = [];
        $db = db_connect();
        $model = new ModelObicanKorisnikLana($db);
        if ($this->request->getMethod() == 'post') {
            if ($_POST) {
                $Imeprivatnika = $_POST['Imeprivatnika'];
                $ocena = $_POST['ocena'];
                $komentar = $_POST['komentar'];
                // $SifK =  session()->get("korisnik")->SifK;
                $SifK = "2";
                $ocena = $model->ocenjivanje($Imeprivatnika, $komentar, $ocena, $SifK);
                if ($ocena == null) {
                    $data['poruka'] = "Privatnik ne postoji!";
                } else {
                    $db->table('ocena')->insert($ocena);
                }
            }
        }
        
        $data["kontroler"]="KorisnikController";
        $data["stranica"]="ocenjivanje";
        $this->prikaz("ocenjivanje",$data);
    }

    public function pregledPonuda()
    {
        $this->prikaz("pregledPonuda", ["kontroler"=>"KorisnikController","stranica"=>"PregledPonuda"]);
    }

    // vrv ce moci da se ujedini sa prikazom ponude posto se samo dugmici razlikuju
    public function prikazPonudeInbox()
    {
        $SifP = $this->request->getVar("SifP");
        $model = new ModelPonuda();
        $modelK = new ModelKorisnik();
        $ponuda = $model->where("SifP", $SifP)->findAll()[0];
        $ponuda->Korisnik = $modelK->where("SifK", $ponuda->SifK)->findAll()[0]->KorisnickoIme;
        $this->prikaz("prikazPonudeInbox", ["ponuda" => $ponuda,"kontroler"=>"KorisnikController","stranica"=>"prikazPonudeInbox"]);
    }

    public function prikazPonude($sifP, $tip = "nista")
    {

        $SifK = session()->get("korisnik")->SifK;  // dohvati 
        

        $db      = \Config\Database::connect();

        $model = new ModelObicanKorisnikLana($db);
        $builder = $db->table("ponuda");
        $ponuda = ($builder->where("SifP", $sifP)->get()->getResult())[0];
        $res = $db->table('jedobio')->select("SifPokl")->where('Sifk',$SifK)->get()->getResult();
        
        $new_res =[];
        foreach($res as $r){
           array_push ($new_res,$r->SifPokl);

        }
        // print_r($new_res);
        $res_1 = array_unique($new_res);
        $res=[];
        foreach($res_1 as $r){
            array_push($res, $db->table('poklon')->where("SifPokl",$r)->get()->getResult()[0]);
        }
        
        $data=[];
        
        $data['mojenagrade']= $res;
        
        if ($this->request->getMethod() == 'post') {
            if ($_POST) {
                
                $BrMesta = $this->request->getVar("BrMesta");
                if (!empty($BrMesta)) {
                    $SifPokl="";
                
                    if(isset($_POST['grupa'])){
                    $SifPokl = $_POST['grupa'];}
                    // echo $SifPokl;
               
                    if ($tip == "kupi") {
                        // echo "kupovina";
                        $model->kupovina_karata($sifP, $SifK, $BrMesta,$SifPokl);
                    }
                    if ($tip == "rezervisi") {
                        // echo "rezervacija";
                        $model->rezervacija_karata($sifP, $SifK, $BrMesta);
                    }
                }
            }
        }
        $data['ponuda'] = ($builder->where("SifP", $sifP)->get()->getResult())[0];

       
        $data["kontroler"]="KorisninikController";
        $data["stranica"]="prikazPonude";
        
        $this->prikaz("prikazPonude", $data);
    }

    public function report()
    {
        $db = db_connect();
        $model = new ModelObicanKorisnikLana($db);
        $data = ["kontroler"=>"KorisnikController"];
        if ($this->request->getMethod() == 'post') {


            if ($_POST) {
                $SifK = $_POST['SifK'];
                $komentar = $_POST['komentar'];

                // $SifPrijavitelja =  session()->get("korisnik")->SifK;
                $SifPrijavitelja = "2";
                $prijava =  $model->report($SifK, $komentar, $SifPrijavitelja);
                if ($prijava == null) {
                    $data['poruka'] = "Privatnik ne postoji!";
                } else {
                    $db->table('report')->insert($prijava);
                }
            }
        }
        
        $data["kontroler"]="KorisnikController";
        $data["stranica"]="report";

        $this->prikaz("report", $data);
    }

    public function rezervacije()
    {

        $db = db_connect();
        $SifK = session()->get("korisnik")->SifK;  // dohvati 
        $model = new ModelObicanKorisnikLana($db);
        $res = $db->table('jedobio')->select("SifPokl")->where('Sifk',$SifK)->get()->getResult();
        
        $new_res =[];
        foreach($res as $r){
           array_push ($new_res,$r->SifPokl);

        }
        // print_r($new_res);
        $res_1 = array_unique($new_res);
        $res=[];
        foreach($res_1 as $r){
            array_push($res, $db->table('poklon')->where("SifPokl",$r)->get()->getResult()[0]);
        }
        
        
        $data['mojenagrade']= $res;
        

        $data["mojeRezervacije"] =  $model->mojeRezervacije($SifK);

        
        $data["kontroler"]="KorisnikController";
        $data["stranica"]="rezervacije";

        // print_r($data["mojeRezervacije"]);
        $this->prikaz("rezervacije", $data);
    }

    public function kupi_kartu()
    {
        $db = db_connect();
        $model = new ModelObicanKorisnikLana($db);
        $data['poruka'] = "";




        $SifK = session()->get("korisnik")->SifK;  // dohvati 
        $res = $db->table('jedobio')->select("SifPokl")->where('Sifk',$SifK)->get()->getResult();
        
        $new_res =[];
        foreach($res as $r){
           array_push ($new_res,$r->SifPokl);

        }
        // print_r($new_res);
        $res_1 = array_unique($new_res);
        $res=[];
        foreach($res_1 as $r){
            array_push($res, $db->table('poklon')->where("SifPokl",$r)->get()->getResult()[0]);
        }
        
        
        $data['mojenagrade']= $res;

        if ($this->request->getMethod() == 'post') {


            if ($_POST) {
                $SifR = $_POST['SifR'];
                $BrMesta = $_POST['BrMesta'];
                $SifPokl="";
                
                if(isset($_POST['grupa'])){
                $SifPokl = $_POST['grupa'];}
                // echo $SifPokl;
                // echo $BrMesta;
                $uspijeh = $model->kupi_kartu($SifR, $SifK, $BrMesta,$SifPokl);
                // da dodam neka obavjestenja
                if (!$uspijeh) {
                    //alert
                } else {
                    //nesto alert
                }
            }
        }
        $data["mojeRezervacije"] =  $model->mojeRezervacije($SifK);

        
        $data["kontroler"]="KorisnikController";
        $data["stranica"]="rezervacije";

        $this->prikaz("rezervacije", $data);
    }

    public function trazenjeVoznje()
    {

        $db = db_connect();
        $model = new ModelObicanKorisnikLana($db);
        $data['poruka'] = "";
        $data['mesta'] = $model->svaMesta();
        $data['sredstva'] = $model->svaSredstva();

        $SifK = session()->get("korisnik")->SifK;  // dohvati 

        if ($this->request->getMethod() == 'post') {


            if ($_POST) {
                if (
                   
                    $_POST['BrojPutnika'] < 0 ||
                    $_POST['DatumOd']." ".$_POST['VremeOd'] <= date("Y-m-d H:i:s")||
                    $_POST['DatumDo']." ".$_POST['VremeDo'] <= date("Y-m-d H:i:s")||
                    $_POST['CenaDo']<$_POST['CenaOd'] 


                    
                ) {
                   
                   

                    $data['poruka'] = "Greska pri unosu podataka";
                } else {
                    
                    $ponuda = [
                        'Sred' => $_POST['prevoz'],
                        'SifMesDo' => $_POST['MesDo'],
                        'SifMesOd' => $_POST['MesOd'],
                        'CenaOd' => $_POST['CenaOd'],
                        'CenaDo' => $_POST['CenaDo'],
                        'BrMesta' => $_POST['BrojPutnika'],
                        'DatumDo' => $_POST['DatumDo'],
                        'DatumOd' => $_POST['DatumOd'],
                        'VremeDo' => $_POST['VremeDo'],
                        'VremeOd' => $_POST['VremeOd'],
                        'SifK' => $SifK

                    ];

                    // print_r($ponuda);

                    $model = new ModelObicanKorisnikLana($db);
                    $model->posaljiVandrednuVoznju($ponuda);
                }
            }
        }

        
        $data["kontroler"]="KorisnikController";
        $data["stranica"]="trazenjeVoznje";

        $this->prikaz("trazenjeVoznje", $data);
    }
    public function tocakSrece()
    {
        // echo "lana";
        // $SifK = session()->get("korisnik")->SifK;  // dohvati 
        $SifK = "2";
        $db = db_connect();
        

        $model = new ModelObicanKorisnikLana($db);
        $data['poruka'] = "";

        if ($this->request->getMethod() == 'post') {

            if ($_POST) {

                $poklon = $_POST['poklon'];
                $model->azuriraj_poklone_i_tokene($poklon, $SifK);
                $data['tokena'] = $db->table('obicankorisnik')->where('SifK=', $SifK)->get()->getResult()[0]->token; // iz baze za korisnika
            }
        }
        $data['tokena'] = $db->table('obicankorisnik')->where('SifK=', $SifK)->get()->getResult()[0]->token; // iz baze za korisnika

        
        $data["kontroler"]="KorisnikController";
        $data["stranica"]="tocakSrece";


        echo view('tocakSrece', $data);
    }
    public function komentar(){ 
        $transport=new EsmtpTransport("smtp-mail.outlook.com",587);
        $transport->setUsername("pomocniEPUTUJ1@outlook.com");
        $transport->setPassword("RADIMAIL123");
        $mailer=new Mailer($transport);
        $email = (new Email())->from("pomocniEPUTUJ1@outlook.com")->to('sideeyetim@outlook.com')
        ->subject('Novi komentar')->text('Ime:'.$this->request->getVar('ime').'
Komentar:'.$this->request->getVar('komentar').'
                ');

        
        $mailer->send($email);

        $stranica=$this->request->getVar("stranica");
        
        
        if($stranica=="trazenjeVoznje")$this->trazenjeVoznje();
        else if($stranica=="rezervacije")$this->rezervacije();
        else if($stranica=="report")$this->report();
        else if($stranica="inboxKorisnik")$this->inboxKorisnik();
        else if($stranica=="indexkorisnik")$this->index();
        else if($stranica=="izmenaProfila")$this->izmenaProfila();
        else if($stranica=="prikazPonude")$this->pregledPonuda();
        else if($stranica=="prikazPonudeInbox")$this->inboxKorisnik();
        else if($stranica=="ocenjivanje")$this->ocenjivanje();
        else if($stranica=="pregledPonuda")$this->pregledPonuda();
    }
}
