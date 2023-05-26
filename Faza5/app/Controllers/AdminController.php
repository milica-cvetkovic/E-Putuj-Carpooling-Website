<?php

/**
 * Anja Curic 2020/0513
 */

namespace App\Controllers;

use App\Models\ModelMesto;
use App\Models\ModelKorisnik;
use App\Models\ModelObicanKorisnik;
use App\Models\ModelPrivatnik;

class AdminController extends BaseController {

    private function prikaz($stranica, $podaci){
        $model=new ModelKorisnik();
        $modelO=new ModelObicanKorisnik();
        $modelP=new ModelPrivatnik();
        $brojac=0;
        $ids=$model->select("SifK")->findAll();
        foreach($ids as $id){ 
            if(empty($modelO->where("SifK",$id->SifK)->findAll()) && empty($modelP->where("SifK",$id->SifK)->findAll()))$brojac++;
        }
        $brojac1=0;
        $nadji=$model->where("TraziBrisanje","1")->findAll();
        if(!empty($nadji))$brojac1=(int)$model->select("count(*) as br")->where("TraziBrisanje","1")->findAll()[0]->br;
       echo view("sabloni/headeradmin",["broj"=>$podaci["broj"],"nalog"=>$brojac,"brisanje"=>$brojac1]);
        echo view($stranica, $podaci);
    }

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
        $this->prikaz("detaljiPrivatnikaPosleReporta", ["broj"=>"2"]);
    }

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

    public function potvrdiBrisanje(){
        $this->prikaz("potvrdiBrisanje", ["broj"=>"2"]);
    }

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
    public function potvrdiKreiranje(){ 
        $model=new ModelKorisnik();
        $id=$this->request->getVar("izbor");
        $nalog=$model->where("SifK",$id)->findAll()[0];
        if($nalog->PrivatnikIliKoirsnik=="K"){ 
            $modelO=new ModelObicanKorisnik();
            $modelO->insert(["SifK"=>$id]);
        }
        else{ 
            $modelO=new ModelPrivatnik();
            $modelO->insert(["SifK"=>$id,"SifPret"=>"1"]);
        }
        redirect($this->index());
    }

    //ako se pritisne dugme odbijanja potvrde
    public function potvrdiOdbijanje(){ 

    }

    public function reportDetalji(){
        $this->prikaz("reportDetalji", ["broj"=>"2"]);
    }

    public function ukloniNalog(){
        $this->prikaz("ukloniNalog", ["broj"=>"2"]);
    }
}
