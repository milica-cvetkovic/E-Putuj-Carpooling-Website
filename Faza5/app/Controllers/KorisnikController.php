<?php

namespace App\Controllers;

use App\Models\ModelPoruka;
use App\Models\ModelObicanKorisnikLana;
class KorisnikController extends BaseController {

    private function prikaz($stranica, $podaci){
        $SifK=session()->get("korisnik")->SifK;
        $model=new ModelPoruka();
        $br=$model->select("count(*) as br")->where("SifKor",$SifK)->where("SmerPoruke",2)->findAll()[0]->br;
        echo view("sabloni/headerkorisnik",["brPoruka"=>$br]);
        echo view($stranica, $podaci);
        echo view("sabloni/footer");
    }

    public function index() {
        $this->prikaz("indexkorisnik", []);
    }

    // dalje su samo fje za testiranje prikaza
    
/**
 * Anja Curic 2020/0513
 */
    public function inboxKorisnik(){
        $this->prikaz("inboxPrivatnik", []);
    }

    // ova stranica vrv nece da postoji, nego ce se ugraditi prikaz direktno
    public function inboxKorisnikPoruka(){
        $this->prikaz("inboxKorisnikPoruka", []);
    }

    public function izmenaProfila(){
        $data = [];
        $db= db_connect();
        $model = new ModelObicanKorisnikLana($db);
        // $SifK =  session()->get("korisnik")->SifK;
        $SifK = "2";
        if($this->request->getMethod()=='post'){ 
            if($_POST){
                $data['poruka']= "post";
                $ime = $_POST['ime'];
                $prezime=$_POST['prezime'];
                $lozinka=$_POST['lozinka'];
                $email = $_POST['email'];
                // $prfilna = $_POST[''] IZMJENA PROFILNE
                $profilna =null;
                
                $model->izmenaProfila($ime,$prezime,$lozinka,$email,$profilna,$SifK);

            }
        }
        $this->prikaz("izmenaProfila", $data);
    }

    public function ocenjivanje(){
        $data = [];
        $db= db_connect();
        $model = new ModelObicanKorisnikLana($db);
        if($this->request->getMethod()=='post'){ 
            if($_POST){
                $Imeprivatnika = $_POST['Imeprivatnika'];
                $ocena = $_POST['ocena'];
                $komentar = $_POST['komentar'];
                // $SifK =  session()->get("korisnik")->SifK;
                $SifK = "2";
                $ocena = $model->ocenjivanje($Imeprivatnika,$komentar,$ocena,$SifK);
                if($ocena==null){
                    $data['poruka']="Privatnik ne postoji!";
                }else{
                $db->table('ocena')->insert($ocena);}
            }
        }
        $this->prikaz("ocenjivanje", $data);
        
       
        
        
    }

    public function pregledPonuda(){
        $this->prikaz("pregledPonuda", []);
    }

    // vrv ce moci da se ujedini sa prikazom ponude posto se samo dugmici razlikuju
    public function prikazPonudeInbox(){
        $this->prikaz("prikazPonudeInbox", []);
    }

    public function prikazPonude($sifP){
        $db      = \Config\Database::connect();
        $builder = $db->table("ponuda");
        $ponuda = ($builder->where("SifP", $sifP)->get()->getResult())[0];

        $this->prikaz("prikazPonude", ["ponuda" => $ponuda]);
    }

    public function report(){
        $db= db_connect();
        $model = new ModelObicanKorisnikLana($db);
        $data =[];
        if($this->request->getMethod()=='post'){
           
            
            if($_POST){
                $SifK = $_POST['SifK'];
                $komentar = $_POST['komentar'];
                
                // $SifPrijavitelja =  session()->get("korisnik")->SifK;
                $SifPrijavitelja = "2";
                $prijava =  $model->report($SifK,$komentar,$SifPrijavitelja);
                if($prijava==null){
                    $data['poruka']="Privatnik ne postoji!";

                }else{
                    $db->table('report')->insert($prijava);

                }

            }}
       $this->prikaz("report",$data);

    }

    public function rezervacije(){
        $db= db_connect();
        $model = new ModelObicanKorisnikLana($db);
        $data =[];
        // $SifK = session()->get("korisnik")->SifK;  // dohvati 
        $SifK = "2";
        $data["mojeRezervacije"] =  $model->mojeRezervacije($SifK);
        $this->prikaz("rezervacije", $data);
    }

    public function trazenjeVoznje(){
        
        $db = db_connect();
        $data=[];
        $model = new ModelObicanKorisnikLana($db);
        $data['poruka']="";
        $data['mesta'] = $model->svaMesta();
        $data['sredstva']= $model->svaSredstva();

        // $SifK = session()->get("korisnik")->SifK;  // dohvati 
        $SifK = "2";
        if($this->request->getMethod()=='post'){
           
            
            if($_POST){
                if( $_POST['CenaOd']>$_POST['CenaDo'] || 
                    $_POST['BrojPutnika']<0 || 
                    $_POST['DatumDo']<$_POST['DatumOd'] ){
                    // $_POST['VremeDo']<$_POST['VremeOd'] nez 
                   
                    $data['poruka']="Greska pri unosu podataka";

                }else{
                    echo $_POST['prevoz'];
                    echo $_POST['CenaOd'];
                    echo $_POST['DatumDo'];
                    echo $_POST['VremeDo'];
                    $ponuda=[
                        'Sred'=>$_POST['prevoz'], 
                        'SifMesDo'=>$_POST['MesDo'],
                        'SifMesOd'=>$_POST['MesOd'],
                        'CenaOd'=>$_POST['CenaOd'],
                        'CenaDo'=>$_POST['CenaDo'],
                        'BrMesta'=>$_POST['BrojPutnika'],
                        'DatumDo'=>$_POST['DatumDo'],
                        'DatumOd'=>$_POST['DatumOd'],
                        'VremeDo'=>$_POST['VremeDo'],
                        'VremeOd'=>$_POST['VremeOd'],
                        'SifK'=>$SifK
                        
                    ];
                    
                    print_r($ponuda);
                    
                    $model = new ModelObicanKorisnikLana($db);
                    $model->posaljiVandrednuVoznju($ponuda);
                }
                
            }

        }
        
        
        $this->prikaz("trazenjeVoznje", $data);
    }
}
