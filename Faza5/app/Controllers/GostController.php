<?php

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

    // na dalje metode su samo test prikaza stranica
    public function login(){
        $this->prikaz("login", []);
    }

    public function registracija(){
        $this->prikaz("registracija", []);
    }

    public function zaboravljenalozinka(){
        $this->prikaz("zaboravljenalozinka", []);
    }

    public function pregledPonuda(){
        $this->prikaz("pregledPonuda", []);
    }

    public function prikazPonude(){
        $this->prikaz("prikazPonude", []);
    }
}
