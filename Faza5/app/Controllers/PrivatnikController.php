<?php

namespace App\Controllers;

class PrivatnikController extends BaseController {

    private function prikaz($stranica, $podaci){
        echo view("sabloni/headerprivatnik");
        echo view($stranica, $podaci);
        echo view("sabloni/footer");
    }

    public function index() {
        $this->prikaz("indexprivatnik", []);
    }

    // dalje su metode za testiranje da li radi prikaz
    public function izborPonudeAzuriranje(){
        $this->prikaz("izborPonudeAzuriranje", []);
    }

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
    
    // prikaz ponude koju je postavio
    public function prikazPonude(){
        $this->prikaz("prikazPonudePrivatnik", []);
    }

    public function promenaPretplate(){
        $this->prikaz("promenaPretplate", []);
    }

    public function izmenaProfila(){
        $this->prikaz("izmenaProfila", []);
    }   
}
