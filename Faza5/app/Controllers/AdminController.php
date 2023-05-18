<?php

namespace App\Controllers;

class AdminController extends BaseController {

    private function prikaz($stranica, $podaci){
        echo view("sabloni/headeradmin");
        echo view($stranica, $podaci);
    }

    public function index() {
        $this->prikaz("indexadmin", []);
    }

    // dalje su samo testiranja prikaza, vrv ce se neke stranice spojiti jedna sa drugom
    // ali dok se ne krene implementacija jos ne moze
    public function detaljiPrivatnikaPosleReporta(){
        $this->prikaz("detaljiPrivatnikaPosleReporta", []);
    }

    public function dodajMesto(){
        $this->prikaz("dodajMesto", []);
    }

    public function potvrdiBrisanje(){
        $this->prikaz("potvrdiBrisanje", []);
    }

    public function potvrdiNalog(){
        $this->prikaz("potvrdiNalog", []);
    }

    public function reportDetalji(){
        $this->prikaz("reportDetalji", []);
    }

    public function ukloniNalog(){
        $this->prikaz("ukloniNalog", []);
    }
}
