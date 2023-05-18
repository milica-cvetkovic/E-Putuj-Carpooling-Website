<?php

namespace App\Controllers;

class KorisnikController extends BaseController {

    private function prikaz($stranica, $podaci){
        echo view("sabloni/headerkorisnik");
        echo view($stranica, $podaci);
        echo view("sabloni/footer");
    }

    public function index() {
        $this->prikaz("indexkorisnik", []);
    }

    // dalje su samo fje za testiranje prikaza
    public function inboxKorisnik(){
        $this->prikaz("inboxPrivatnik", []);
    }

    // ova stranica vrv nece da postoji, nego ce se ugraditi prikaz direktno
    public function inboxKorisnikPoruka(){
        $this->prikaz("inboxKorisnikPoruka", []);
    }

    public function izmenaProfila(){
        $this->prikaz("izmenaProfila", []);
    }

    public function ocenjivanje(){
        $this->prikaz("ocenjivanje", []);
    }

    public function pregledPonuda(){
        $this->prikaz("pregledPonuda", []);
    }

    // vrv ce moci da se ujedini sa prikazom ponude posto se samo dugmici razlikuju
    public function prikazPonudeInbox(){
        $this->prikaz("prikazPonudeInbox", []);
    }

    public function prikazPonude(){
        $this->prikaz("prikazPonude", []);
    }

    public function report(){
        $this->prikaz("report", []);
    }

    public function rezervacije(){
        $this->prikaz("rezervacije", []);
    }

    public function trazenjeVoznje(){
        $this->prikaz("trazenjeVoznje", []);
    }
}
