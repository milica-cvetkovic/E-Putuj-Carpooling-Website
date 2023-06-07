<?php

/**
 * Anja Curic 2020/0513
 */

namespace App\Controllers;

use App\Models\ModelMesto;
use App\Models\ModelKorisnik;
use App\Models\ModelObicanKorisnik;
use App\Models\ModelPrivatnik;
use App\Models\ModelReport;

use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mailer\Transport\Smtp\EsmtpTransport;



class AdminController extends BaseController {
     
    private function prikaz($stranica, $podaci){
        $model=new ModelKorisnik();
        $modelO=new ModelObicanKorisnik();
        $modelP=new ModelPrivatnik();
        $modelR=new ModelReport();
        $brojac=0;
        $ids=$model->select("SifK")->findAll();
        foreach($ids as $id){ 
            if(empty($modelO->where("SifK",$id->SifK)->findAll()) && empty($modelP->where("SifK",$id->SifK)->findAll()))$brojac++;
        }
        $brojac1=0;
        $nadji=$model->where("TraziBrisanje","1")->findAll();
        if(!empty($nadji))$brojac1+=$model->select("count(*) as br")->where("TraziBrisanje","1")->findAll()[0]->br;
        $nadji=$modelR->findAll();
        if(!empty($nadji))$brojac1+=$modelR->select("count(*) as br")->findAll()[0]->br;


       echo view("sabloni/headeradmin",["broj"=>$podaci["broj"],"nalog"=>$brojac,"brisanje"=>$brojac1]);
       echo view($stranica, $podaci);
    }
    /**
     * @author  Anja Curic 2020/0513
     * 
     * Prikazivanje glavne starnice admin
     * 
     * 
     * 
     */
    public function index() {
        $model=new ModelKorisnik();
        $modelO=new ModelObicanKorisnik();
        $modelP=new ModelPrivatnik();

        $nalozi=[];
        $br=0;

        $n=$model->findAll();

        foreach($n as $nalog){ 
            if(empty($modelO->where("SifK",$nalog->SifK)->findAll()) && empty($modelP->where("SifK",$nalog->SifK)->findAll())){ 
                $nalozi[$br++]=$nalog;
            }
        }

        $this->prikaz("indexadmin", ["broj"=>"1","nalozi"=>$nalozi]);
    }

    // dalje su samo testiranja prikaza, vrv ce se neke stranice spojiti jedna sa drugom
    // ali dok se ne krene implementacija jos ne moze
   
    public function detaljiPrivatnikaPosleReporta(){

        $izbor1=$this->request->getVar("izbor1");
        $izbor2=$this->request->getVar("izbor2");
        $SifRep=$this->request->getVar("r");

        $model=new ModelKorisnik();
        $modelR=new ModelReport();

        $nalozi=$model->where("TraziBrisanje","1")->findAll();

        $reportovi=$modelR->findAll();

        foreach($reportovi as $r){
            $r->KorisnickoIme=$model->where("SifK",$r->SifPrijavljen)->findAll()[0]->KorisnickoIme;
        }

        $odabran1=$model->where("SifK",$izbor1)->findAll()[0];
        $odabran2=$model->where("SifK",$izbor2)->findAll()[0];

        $razlog=$modelR->where("SifRep",$SifRep)->findAll()[0]->Razlog;

        $odabran1->SifRep=$SifRep;

        $this->prikaz("detaljiPrivatnikaPosleReporta", ["razlog"=>$razlog,"broj"=>"2","nalozi"=>$nalozi,"reportovi"=>$reportovi,"odabran1"=>$odabran1,"odabran2"=>$odabran2]);
    }
     /**
     * @author  Anja Curic 2020/0513
     * Dodavanje mesta
     * 
     * 
     * 
     * 
     */

    public function dodajMesto(){
        $this->prikaz("dodajMesto", ["broj"=>"3"]);
    }
    public function dodavanjeMesta(){
        $model=new ModelMesto();
        $naziv=$this->request->getVar("mesto");
        if(!empty($naziv)){ 
            $mesta=$model->where("Naziv",$naziv)->findAll();
            if(!empty($mesta)){ 
                $this->prikaz("dodajMesto", ["poruka_neuspeh"=>"Mesto već postoji!","broj"=>"3"]);
            }
            else{ 
                $id=$model->select("SifM")->orderBy("SifM","desc")->findAll();
                if(!empty($id)){ 
                    $id=$id[0]->SifM;
                    $model->insert([ "SifM"=>$id+1,"Naziv"=>$naziv]);
                    
                }
                else{ 
                    $model->insert([ "SifM"=>0,"Naziv"=>$naziv]);
                }
                
                $this->prikaz("dodajMesto", ["poruka"=>"Uspešno dodato mesto!","broj"=>"3"]);
            }
        }
        else $this->prikaz("dodajMesto", ["poruka_neuspeh"=>"Niste uneli naziv mesta!","broj"=>"3"]);
    }
     /**
     * @author  Anja Curic 2020/0513
     * 
     * 
     * Brisanje naloga korisnika
     * 
     * 
     */

    public function potvrdiBrisanje(){
        $izbor=$this->request->getVar("izbor");
        $model=new ModelKorisnik();
        $modelR=new ModelReport();

        $nalozi=$model->where("TraziBrisanje","1")->findAll();

        $reportovi=$modelR->findAll();

        foreach($reportovi as $r){
            $r->KorisnickoIme=$model->where("SifK",$r->SifPrijavljen)->findAll()[0]->KorisnickoIme;
        }

        $odabran=$model->where("SifK",$izbor)->findAll()[0];

        $this->prikaz("potvrdiBrisanje", ["broj"=>"2","nalozi"=>$nalozi,"reportovi"=>$reportovi,"odabran"=>$odabran]);
    }
     /**
     * @author  Anja Curic 2020/0513
     * 
     * Potvrda naloga
     * 
     * 
     * 
     */
    public function potvrdiNalog(){
        $izbor=$this->request->getVar("izbor");
        $model=new ModelKorisnik();
        $modelO=new ModelObicanKorisnik();
        $modelP=new ModelPrivatnik();

        $nalozi=[];
        $br=0;

        $n=$model->findAll();

        foreach($n as $nalog){ 
            if(empty($modelO->where("SifK",$nalog->SifK)->findAll()) && empty($modelP->where("SifK",$nalog->SifK)->findAll())){ 
                $nalozi[$br++]=$nalog;
            }
        }

        $odabran=$model->where("SifK",$izbor)->findAll()[0];

        $this->prikaz("potvrdiNalog", ["broj"=>"1","nalozi"=>$nalozi,"odabran"=>$odabran]);
    }

    //ako se pritisne dugme potvrde naloga
     /**
     * @author  Anja Curic 2020/0513
     * 
     * Potvrda kreiranja naloga
     * 
     * 
     * 
     */
    public function potvrdiKreiranje(){ 
        $model=new ModelKorisnik();
        $id=(int)$this->request->getVar("izbor");
        $nalog=$model->where("SifK",$id)->findAll()[0];
        if($nalog->PrivatnikIliKorisnik=="K"){ 
            $db=\Config\Database::connect();
            $builder=$db->table("obicankorisnik");
            

            $data=["SifK"=>$id];
            $builder->insert($data);
        }
        else{ 
            $modelO=new ModelPrivatnik();
            $modelO->save(["SifK"=>$id,"SifPret"=>"1"]);
        }
        redirect($this->index());
    }

    //ako se pritisne dugme odbijanja potvrde
    
    public function potvrdiOdbijanje(){ 
        $model=new ModelKorisnik();
        $id=(int)$this->request->getVar("izbor");
        $model->delete($id);
        redirect($this->index());
    }

    public function reportDetalji(){
        $izbor1=$this->request->getVar("izbor1");
        $izbor2=$this->request->getVar("izbor2");
        $SifRep=$this->request->getVar("r");
        $model=new ModelKorisnik();
        $modelR=new ModelReport();

        $nalozi=$model->where("TraziBrisanje","1")->findAll();

        $reportovi=$modelR->findAll();

        foreach($reportovi as $r){
            $r->KorisnickoIme=$model->where("SifK",$r->SifPrijavljen)->findAll()[0]->KorisnickoIme;
        }

        $odabran1=$model->where("SifK",$izbor1)->findAll()[0];
        $odabran2=$model->where("SifK",$izbor2)->findAll()[0];

        $razlog=$modelR->where("SifRep",$SifRep)->findAll()[0]->Razlog;

        $odabran1->SifRep=$SifRep;

        $this->prikaz("reportDetalji", ["razlog"=>$razlog ,"broj"=>"2","nalozi"=>$nalozi,"reportovi"=>$reportovi,"odabran1"=>$odabran1,"odabran2"=>$odabran2]);
    }
 /**
     * @author  Anja Curic 2020/0513
     * 
     * Uklanjanje naloga korisnika
     * 
     * 
     * 
     */
    public function ukloniNalog(){
        $model=new ModelKorisnik();
        $modelR=new ModelReport();

        $nalozi=$model->where("TraziBrisanje","1")->findAll();
        
        $reportovi=$modelR->findAll();

        foreach($reportovi as $r){
            $r->KorisnickoIme=$model->where("SifK",$r->SifPrijavljen)->findAll()[0]->KorisnickoIme;
        }


        $this->prikaz("ukloniNalog", ["broj"=>"2","nalozi"=>$nalozi,"reportovi"=>$reportovi]);
    }
     /**
     * @author  Anja Curic 2020/0513
     * Brisanje naloga korsnika
     * 
     * 
     * 
     */

    public function Obrisi(){ 
        $model=new ModelKorisnik();
        
        if(!empty($this->request->getVar("izbor")))$id=(int)$this->request->getVar("izbor");
        else $id=(int)$this->request->getVar("izbor1");
        $val=$model->where("SifK",$id)->findAll()[0];

        $db=\Config\Database::connect();
        $builder=$db->table("korisnik");
        $builder->where("SifK", $id)->delete();

        $transport=new EsmtpTransport("smtp-mail.outlook.com",587);
        $transport->setUsername("sideeyetim@outlook.com");
        $transport->setPassword("RADIMAIL123");
        $mailer=new Mailer($transport);
       if(empty($this->request->getVar("r"))) {
        $email = (new Email())->from("sideeyetim@outlook.com")->to($val->Email)
        ->subject('Obaveštenje o gašenju naloga '.$val->KorisnickoIme.' na sajtu ePutuj')->text('
Poštovani/a, 
    Odlukom administratora,a po Vašem zahtevu,Vaš nalog je uklonjen . Za više informacija obratite na se putem mejla ili na broj telefona.   
S poštovanjem,
Tim Side-Eye.
                ');
       }
       else{ 
        $email = (new Email())->from("sideeyetim@outlook.com")->to($val->Email)
        ->subject('Obaveštenje o gašenju naloga '.$val->KorisnickoIme.' na sajtu ePutuj')->text('
Poštovani/a, 
    Odlukom administratora,radi određenog broja report-ova,Vaš nalog je uklonjen . Za više informacija obratite nam se putem mejla ili na broj telefona.   
S poštovanjem,
Tim Side-Eye.
                ');
       }
        
        $mailer->send($email);
        redirect($this->ukloniNalog());
    }
     /**
     * @author  Anja Curic 2020/0513
     * 
     * 
     * Odbijanje naloga korsinika
     * 
     * 
     */
    public function Odbij(){ 
        $model=new ModelKorisnik();
        $id=(int)$this->request->getVar("izbor");
        $val=$model->where("SifK",$id)->findAll()[0];
        $model->update($id,["KorisnickoIme"=>$val->KorisnickoIme,"Lozinka"=>$val->Lozinka,"BrTel"=>$val->BrTel,"Ime"=>$val->Ime,"Prezime"=>$val->Prezime,"Email"=>$val->Email,"PrivatnikIliKorisnik"=>$val->PrivatnikIliKorisnik,"TraziBrisanje"=>"0"]);

        $transport=new EsmtpTransport("smtp-mail.outlook.com",587);
        $transport->setUsername("sideeyetim@outlook.com");
        $transport->setPassword("RADIMAIL123");
        $mailer=new Mailer($transport);
        $email = (new Email())->from("sideeyetim@outlook.com")->to($val->Email)
        ->subject('Obaveštenje o odbijanju gašenja naloga '.$val->KorisnickoIme.' na sajtu ePutuj')->text('
Poštovani/a, 
    Odlukom administratora,Vaš nalog neće biti uklonjen . Za više informacija obratite nam se putem mejla ili na broj telefona.   
S poštovanjem,
Tim Side-Eye.
                ');

        
        $mailer->send($email);
        redirect($this->ukloniNalog());
    }
 /**
     * @author  Anja Curic 2020/0513
     * 
     * Posalji Email potvrde korisniku
     * 
     * 
     * 
     */
    public function posaljiEmail(){

        $SifRep=$this->request->getVar("r");
        $model=new ModelKorisnik();
        $modelR=new ModelReport();

        $izbor1=$this->request->getVar("izbor1");
        $izbor2=$this->request->getVar("izbor2");


        $odabran1=$model->where("SifK",$izbor1)->findAll()[0];
        $odabran2=$model->where("SifK",$izbor2)->findAll()[0];

        $transport=new EsmtpTransport("smtp-mail.outlook.com",587);
        $transport->setUsername("sideeyetim@outlook.com");
        $transport->setPassword("RADIMAIL123");
        $mailer=new Mailer($transport);
        $email = (new Email())->from("sideeyetim@outlook.com")->to($odabran1->Email)
        ->subject('Upozorenje o gašenju naloga '.$odabran1->KorisnickoIme.' na sajtu ePutuj')->text('
Poštovani/a, 
    Radi određenog broja report-ova na Vašem nalogu,obaveštavamo Vas o mogućem gašenju istog . Poslednji primljeni report:
    
    Od naloga: '.$odabran2->KorisnickoIme.'
    Razlog report-a:'.$modelR->where("SifRep",$SifRep)->findAll()[0]->Razlog.'.
    
S poštovanjem,
Tim Side-Eye.
                ');

        
        $mailer->send($email);

        $modelR->delete($SifRep);
        
  
        $this->ukloniNalog();


    }
    
    /**
     * @author  Anja Curic 2020/0513
     * 
     * Logout za admina
     * 
     * @return void
     */

    public function logout()
    {
        session()->remove("korisnik");
        $gostController = new GostController();
        $gostController->index();
    }
}

