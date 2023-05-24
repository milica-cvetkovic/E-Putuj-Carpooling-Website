<?php
// Željko Urošević 2020/0073 

namespace App\Controllers;

class PrivatnikController extends BaseController {

    private function prikaz($stranica, $podaci){

        
        echo view("sabloni/headerprivatnik");
        echo view($stranica, $podaci);
        echo view("sabloni/footer");
    }

    public function index() {

        // samo za testing deo
        // u sustini dohvatanje korisnika ide iz sesije i preko njeva se samo proslede ponude
        $db      = \Config\Database::connect();
        $builder = $db->table('korisnik');

        $korisnik = ($builder->where("KorisnickoIme", "mika")->get()->getResult())[0];
        $this->session->set("korisnik", $korisnik);

        $builder = $db->table("ponuda");
        $ponude = $builder->where("SifK", $korisnik->SifK)->get()->getResult();
        $this->prikaz("indexprivatnik", ["ponude" => $ponude]);
    }

    public function izborPonudeAzuriranje(){

        // samo za testing deo
        // u sustini dohvatanje korisnika ide iz sesije i preko njega se samo proslede ponude
        $db      = \Config\Database::connect();
        $builder = $db->table('korisnik');

        $korisnik = ($builder->where("KorisnickoIme", "mika")->get()->getResult())[0];
        $this->session->set("korisnik", $korisnik);

        $builder = $db->table("ponuda");
        $ponude = $builder->where("SifK", $korisnik->SifK)->get()->getResult();

        $this->prikaz("izborPonudeAzuriranje", ["ponude" => $ponude]);
    }

    // prikaz ponude koju je postavio
    public function prikazPonude($sifP){
        $db      = \Config\Database::connect();
        $builder = $db->table("ponuda");
        $ponuda = ($builder->where("SifP", $sifP)->get()->getResult())[0];

        $this->prikaz("prikazPonudePrivatnik", ["ponuda" => $ponuda]);
    }

    // $sifP je sifra ponude
    public function azurirajPonudu(){
        $this->prikaz("azurirajPonudu", []);
    }

    public function inboxPrivatnik(){
        $this->prikaz("inboxPrivatnik", []);
    }

    // ova stranica vrv nece da postoji, nego ce se ugraditi prikaz direktno
    public function inboxPrivatnikPoruka(){
        $this->prikaz("inboxPrivatnikPoruka", []);
    }

    public function napraviPonudu(){
        $this->prikaz("napraviPonudu", []);
    }

    public function otkaziPonudu(){
        $this->prikaz("otkaziPonudu", []);
    }

    public function promenaPretplate(){
        $this->prikaz("promenaPretplate", []);
    }

    public function izmenaProfila(){
        $this->prikaz("izmenaProfila", []);
    }
}
