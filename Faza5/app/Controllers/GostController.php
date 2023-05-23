<?php

/**
 * Milica Cvetkovic 2020/0003 
 */

namespace App\Controllers;

class GostController extends BaseController {

    private function prikaz($stranica, $podaci){
        echo view("sabloni/headergost");
        echo view($stranica, $podaci);
        echo view("sabloni/footer");
    }

    public function index() {
        $this->prikaz("index", []);
    }
    
    public function login(){
        $this->prikaz("login.php", []);
    }
    
    public function loginSubmit(){
        
        if(!$this->validate(['korime' => 'required', 'lozinka' => 'required'])){
            // error handling
        }
        
        $korisnickoime = $this->request->getVar("username-input");
        $lozinka = $this->request->getVar("password-input");
        
        $korisnik = $this->dohvatiKorisnika($korisnickoime);
        
        if($korisnik == null){
            // greska
        }
        if($korisnik->Lozinka != $lozinka){
            // greska
        }
        
        $this->session->set("korisnik", $korisnik);
        return redirect()->to(site_url("KorisnikController"));
        
    }

    public function registracija(){
        $this->prikaz("registracija.php", []);
    }
    
    public function registracijaSubmit(){
        
        $ime = $this->request->getVar("firstname");
        $prezime = $this->request->getVar("lastname");
        $brtel = $this->request->getVar("phonenumber");
        $email = $this->request->getVar("email");
        $tip = $this->request->getVar("choice");
        
        $korisnickoime = $this->request->getVar("username");
        $lozinka = $this->request->getVar("password");
        $ponovnalozinka = $this->request->getVar("checkpassword");
        
        // greska ako je nesto prazno
        // greska u formatu
        
        if($lozinka != $ponovnalozinka){
            // greska
        }
        
        // forma ne radi
        //var_dump($GLOBALS);
        
        switch($tip){
            case "Korisnik":
                $this->sacuvajObicnogKorisnika($ime, $prezime, $brtel, $email, $korisnickoime, $lozinka);
                break;
            case "Privatnik":
                
                break;
        }
        return redirect()->to(site_url("GostController/index"));
    }
    
    public function zaboravljenalozinka(){
        $this->prikaz("zaboravljenalozinka", []);
    }

    public function pregledPonuda(){
        $prevoznoSredstvo = null;
        $mestoOd = null;
        $mestoDo = null;
        $minimalnaCena = null;
        $maksimalnaCena = null;
        $brojPutnika = null;
        $datumOd = null;
        $datumDo = null;
        $vremeOd = null;
        $vremeDo = null;
        $ponude = $this->pretraga($prevoznoSredstvo, $mestoOd, $mestoDo, $minimalnaCena, $maksimalnaCena, $brojPutnika, $datumOd, $datumDo, $vremeOd, $vremeDo);
        $this->prikaz("pregledPonuda", ["ponude" => $ponude]);
    }

    public function prikazPonude(){
        $this->prikaz("prikazPonude", []);
    }
    
    public function dohvatiKorisnika($korisnickoime){
        
        $db      = \Config\Database::connect();
        $builder = $db->table('korisnik');
        
        $builder->where("KorisnickoIme", $korisnickoime);
        
        return $builder->get()->getResult();
        
    }
    
    public function sacuvajObicnogKorisnika($ime, $prezime, $brtel, $email, $korisnickoime, $lozinka){
        
        $db      = \Config\Database::connect();
        $builder = $db->table('korisnik');
        
        $data = [
          "KorisnickoIme" => $korisnickoime,
          "Lozinka" => $lozinka
        ];
        
        $builder->insert($data);
        
        $builder->select("SifK");
        $builder->where("KorisnickoIme", $korisnickoime);
        $id = ($builder->get()->getResult())[0]->SifK;
        
        $builder = $db->table('obicankorisnik');
        
        
        $data = [
          "SifK" => $id,
          "Ime" => $ime,
          "Prezime" => $prezime,
          "Email" => $email,
          "BrTel" => $brtel
        ];
        
        $builder->insert($data);
        
    }
    
    public function pretraga($prevoznoSredstvo, $mestoOd, $mestoDo, $minimalnaCena, $maksimalnaCena, $brojPutnika, $datumOd, $datumDo, $vremeOd, $vremeDo){
        
        $db      = \Config\Database::connect();
        $builder = $db->table('ponuda');
        
        $builder->select("mOd.Naziv as MestoOd, mDo.Naziv as MestoDo, ponuda.DatumOd as DatumOd, ponuda.DatumDo as DatumDo, ponuda.BrMesta as BrMesta, ponuda.CenaKarte as CenaKarte");
        $builder->join("mesto as mOd", "mOd.SifM = ponuda.SifMesOd");
        $builder->join("mesto as mDo", "mDo.SifM = ponuda.SifMesDo");
        $builder->join("prevoznosredstvo", "prevoznosredstvo.SifSred = ponuda.SifSred");
        $builder->join("korisnik", "korisnik.SifK = ponuda.SifK");
       
        if($prevoznoSredstvo != null)
            $builder->like("prevoznosredstvo.Naziv", $prevoznoSredstvo);
        if($mestoOd != null)
            $builder->like("mOd.Naziv" , $mestoOd);
        if($mestoDo != null)
            $builder->like("mDo.Naziv", $mestoDo);
        if($minimalnaCena != null)
            $builder->where("ponuda.CenaKarte >=", $minimalnaCena);
        if($maksimalnaCena != null)
            $builder->where("ponuda.CenaKarte <=", $maksimalnaCena);
        if($brojPutnika != null)
            $builder->where ("ponuda.BrMesta <=", $brojPutnika);
        if($datumOd != null)
            $builder->where("ponuda.DatumOd >=", $datumOd);
        if($datumDo != null)
            $builder->where("ponuda.DatumDo <=", $datumDo);
        if($vremeOd != null)
            $builder->where("ponuda.VremeOd >=", $vremeOd);
        if($vremeDo != null)
            $builder->where("ponuda.VremeDo <=", $vremeDo);
        
        return $builder->get()->getResult();
        
    }
}