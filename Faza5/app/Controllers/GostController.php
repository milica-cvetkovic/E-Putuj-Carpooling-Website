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
        $svePonude = $this->dohvatiSvePonude();
        $this->prikaz("index", ["svePonude"=> $svePonude]);
    }
    
    public function login($poruke = null){
        $this->prikaz("login.php", ["poruke" => $poruke]);
    }
    
    public function loginSubmit(){
        
        // ne valja css
        
        $korisnickoime = $this->request->getVar("username-input");
        $lozinka = $this->request->getVar("password-input");
        
        $korisnik = $this->dohvatiKorisnika($korisnickoime);
        
        if($korisnickoime == null || $lozinka == null){
            $poruke['prazno'] = "Popunjavanje svih polja je obavezno.";
            return $this->login($poruke);
        }
        
        if($this->proveraKorisnickoIme($korisnickoime) == 0){
            $poruke['korisnickoime'] = "Neispravno korisničko ime.";
            return $this->login($poruke);
        }
        
        if($this->proveraLozinka($korisnickoime, $lozinka) == 0){
             $poruke['lozinka'] = "Neispravna lozinka.";
            return $this->login($poruke);
        }
        
        $this->session->set("korisnik", $korisnik);
        return redirect()->to(site_url("KorisnikController"));
        
    }

    public function registracija($poruke = null){
        $this->prikaz("registracija.php", ["poruke" => $poruke]);
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
        
        if($ime == null || $prezime == null || $brtel == null || $email == null || $tip == null
                || $korisnickoime == null || $lozinka == null || $ponovnalozinka == null){
            $poruke['prazno'] = "Popunjavanje svih polja je obavezno.";
            return $this->registracija($poruke);
        }
       
        if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
            $poruke['email'] = "Email adresa u pogrešnom formatu.";
            return $this->registracija($poruke);
        }
        
        if($this->proveraKorisnickoIme($korisnickoime) != 0){
            $poruke['korisnickoime'] = "Korisničko ime je zauzeto.";
            return $this->registracija($poruke);
        }
       
         // dodaj 14 karaktera max
        $regex = "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/";
        if(preg_match($regex, $lozinka) == 0){
            $poruke['lozinka'] = "Lozinka u neispravnom formatu.";
            return $this->registracija($poruke);
        }
        
        if($lozinka != $ponovnalozinka){
            $poruke['ponovna'] = "Lozinka u polju potvrde nije usta kao prva unesena.";
            return $this->registracija($poruke);
        }
        
        switch($tip){
            case "Korisnik":
                $this->sacuvajObicnogKorisnika($ime, $prezime, $brtel, $email, $korisnickoime, $lozinka);
                break;
            case "Privatnik":
                // pretplata ? 
                $this->sacuvajPrivatnika($ime, $prezime, $brtel, $email, $korisnickoime, $lozinka);
                break;
        }
        return redirect()->to(site_url("GostController/index"));
    }
    
    public function zaboravljenalozinka(){
        $this->prikaz("zaboravljenalozinka", []);
    }

    public function pregledPonuda(){
        
        $totalPages = count($this->dohvatiSvePonude());
        
        $page = $this->request->getVar("page") != null ? $this->request->getVar("page"): 1;
        
        $numOfResultsOnPage = 9;
        
        $ponude = $this->dohvatiSvePonudeLimit($page, $numOfResultsOnPage);
        $svePonude = $this->dohvatiSvePonude();
        return $this->prikaz("pregledPonuda", ["ponude" => $ponude, "svePonude" => $svePonude, "page"=> $page, "numOfResultsOnPage" => $numOfResultsOnPage, "totalPages" => $totalPages]);
    }
   
    public function pretragaPonuda(){
        
        // popravi da se salju sva mesta i sve ponude ?
        // treba da se uveze slika odgovarajuceg mesta na kraju
        
        $totalPages = count($this->dohvatiSvePonude());
        
        $page = $this->request->getVar("page") != null ? $this->request->getVar("page"): 1;
        
        $numOfResultsOnPage = 9;
        
        $prevoznoSredstvo = $this->request->getVar("prevoznoSredstvo");
        $mestoOd = $this->request->getVar("mestoOd");
        $mestoDo = $this->request->getVar("mestoDo");
        $minimalnaCena = $this->request->getVar("minimalnaCena");
        $maksimalnaCena = $this->request->getVar("maksimalnaCena");
        $brojPutnika = $this->request->getVar("brojPutnika");
        $datumOd = $this->request->getVar("datumOd");
        $datumDo = $this->request->getVar("datumDo");
        $vremeOd = $this->request->getVar("vremeOd");
        $vremeDo = $this->request->getVar("vremeDo");
        
        // proveri datum i vreme
        
        $svePonude = $this->dohvatiSvePonude();
        
        $ponude = $this->pretraga($prevoznoSredstvo, $mestoOd, $mestoDo, $minimalnaCena, $maksimalnaCena, $brojPutnika, $datumOd, $datumDo, $vremeOd, $vremeDo, $page, $numOfResultsOnPage);
        
        return $this->prikaz("pregledPonuda", ["ponude" => $ponude, "svePonude" => $svePonude, "page"=> $page, "numOfResultsOnPage" => $numOfResultsOnPage, "totalPages" => $totalPages]);
                
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
    
    public function sacuvajPrivatnika($ime, $prezime, $brtel, $email, $korisnickoime, $lozinka){
        
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
        
        $builder = $db->table('privatnik');
        
        $data = [
          "SifK" => $id,
          "Ime" => $ime,
          "Prezime" => $prezime,
          "Email" => $email,
          "BrTel" => $brtel
        ];
        
        $builder->insert($data);
        
    }
    
    public function proveraKorisnickoIme($korisnickoIme){
        
        $db      = \Config\Database::connect();
        $builder = $db->table('korisnik');
        
        $builder->where("KorisnickoIme", $korisnickoIme);
        
        $count = $builder->get()->getResult();
        
        return count($count);
        
    }
    
    public function proveraLozinka($korisnickoIme, $lozinka){
        
        $db      = \Config\Database::connect();
        $builder = $db->table('korisnik');
        
         $builder->where("KorisnickoIme", $korisnickoIme);
         $builder->where("Lozinka", $lozinka);
         
         $count = $builder->get()->getResult();
        
        return count($count);
        
    }
    
    public function pretraga($prevoznoSredstvo, $mestoOd, $mestoDo, $minimalnaCena, $maksimalnaCena, $brojPutnika, $datumOd, $datumDo, $vremeOd, $vremeDo, $page, $numOfResultsOnPage){
        
        $db      = \Config\Database::connect();
        $builder = $db->table('ponuda');
        
        $builder->select("mOd.Naziv as MestoOd, mDo.Naziv as MestoDo, ponuda.DatumOd as DatumOd, ponuda.DatumDo as DatumDo, ponuda.BrMesta as BrMesta, ponuda.CenaKarte as CenaKarte, prevoznosredstvo.Naziv as prevoznoSredstvo");
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
            $builder->where("CenaKarte <=", (float)$maksimalnaCena);
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
                    
        /*if($pretragaCenaRastuce != null)
            $builder->orderBy("ponuda.CenaKarte", "asc");*/
        
        $start = ($page - 1) * $numOfResultsOnPage;
        
        $builder->limit($start, $numOfResultsOnPage);
        
        return $builder->get()->getResult();
        
    }
    
    // date('y-m-d'));
    
    public function dohvatiSvePonude(){
        
        $db      = \Config\Database::connect();
        $builder = $db->table('ponuda');
        
        $builder->select("mOd.Naziv as MestoOd, mDo.Naziv as MestoDo, ponuda.DatumOd as DatumOd, ponuda.DatumDo as DatumDo, ponuda.BrMesta as BrMesta, ponuda.CenaKarte as CenaKarte, prevoznosredstvo.Naziv as prevoznoSredstvo");
        $builder->join("mesto as mOd", "mOd.SifM = ponuda.SifMesOd");
        $builder->join("mesto as mDo", "mDo.SifM = ponuda.SifMesDo");
        $builder->join("prevoznosredstvo", "prevoznosredstvo.SifSred = ponuda.SifSred");
        $builder->join("korisnik", "korisnik.SifK = ponuda.SifK");
        
        return $builder->get()->getResult();
        
    }
    
        public function dohvatiSvePonudeLimit($page, $numOfResultsOnPage){
        
        $db      = \Config\Database::connect();
        $builder = $db->table('ponuda');
        
        $builder->select("mOd.Naziv as MestoOd, mDo.Naziv as MestoDo, ponuda.DatumOd as DatumOd, ponuda.DatumDo as DatumDo, ponuda.BrMesta as BrMesta, ponuda.CenaKarte as CenaKarte, prevoznosredstvo.Naziv as prevoznoSredstvo");
        $builder->join("mesto as mOd", "mOd.SifM = ponuda.SifMesOd");
        $builder->join("mesto as mDo", "mDo.SifM = ponuda.SifMesDo");
        $builder->join("prevoznosredstvo", "prevoznosredstvo.SifSred = ponuda.SifSred");
        $builder->join("korisnik", "korisnik.SifK = ponuda.SifK");
        
        $start = ($page - 1) * $numOfResultsOnPage;
        
        $builder->limit($start, $numOfResultsOnPage);
        return $builder->get()->getResult();
        
    }
    
}