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
        // u sustini dohvatanje korisnika ide iz sesije i preko njega se samo proslede ponude
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
    public function azurirajPonudu($sifP){
        $db      = \Config\Database::connect();
        $builder = $db->table("ponuda");
        $ponuda = ($builder->where("SifP", $sifP)->get()->getResult())[0];

        $this->prikaz("azurirajPonudu", ["ponuda" => $ponuda]);
    }

    public function azuriranjePonudeSubmit($sifP){
        $db      = \Config\Database::connect();
        $builder = $db->table("ponuda");
        $ponuda = ($builder->where("SifP", $sifP)->get()->getResult())[0];

        $prevoznosredstvo = $this->request->getVar("prevoznoSredstvo"); // ne moze da se apdejtuje
        $mestoOd = $this->request->getVar("mestoPolaska");
        $mestoDo = $this->request->getVar("mestoDolaska");
        $cena = $this->request->getVar("cenaKarte");
        $brMesta = $this->request->getVar("brMesta");
        $datumOd = $this->request->getVar("datumOd");
        $datumDo = $this->request->getVar("datumDo");
        $vremeOd = $this->request->getVar("vremeOd");
        $vremeDo = $this->request->getVar("vremeDo");
        // fotografija.......
        $rokZaOtkazivanje = $this->request->getVar("rokZaOtkazivanje");

        $builder = $db->table("postavljenaponuda");
        $trenutniRokZaOtkaz = ($builder->where("SifP", $ponuda->SifP)->get()->getResult())[0]->RokZaOtkazivanje;

        $builder = $db->table("rezervacija");
        $rezervacije = $builder->where("SifP", $ponuda->SifP)->get()->getResult();
        $brojRezervisanihMesta = 0;
        foreach($rezervacije as $rezervacija){
            $brojRezervisanihMesta += $rezervacija->BrMesta;
        }
        if ($brojRezervisanihMesta > $brMesta){
            $poruka = "Rezervisano je ".$brojRezervisanihMesta." tako da se ne moze smanjiti broj mesta za ponudu na ".$brMesta.".";
            $this->prikaz("azurirajPonudu", ["ponuda" => $ponuda, "poruka" => $poruka]);
        }
        else if ($cena <= 0){
            $poruka = "Cena mora da bude pozitivan broj.";
            $this->prikaz("azurirajPonudu", ["ponuda" => $ponuda, "poruka" => $poruka]);
        }
        else if ($brojRezervisanihMesta == 0 && 
            ($datumOd." ".$vremeOd <= date("Y-m-d H:i:s") || $datumDo." ".$vremeDo <= date("Y-m-d H:i:s"))
        ){
            $poruka = "Uneti datum i vreme moraju biti kasnije od trenutnog datuma i vremena.";
            $this->prikaz("azurirajPonudu", ["ponuda" => $ponuda, "poruka" => $poruka]);
        }
        else if ($brojRezervisanihMesta == 0 && $datumOd > $datumDo){
            $poruka = "Datum dolaska mora biti kasnije od datuma polaska.";
            $this->prikaz("azurirajPonudu", ["ponuda" => $ponuda, "poruka" => $poruka]);
        }
        else if ($brojRezervisanihMesta == 0 && $datumOd == $datumDo && $vremeOd >= $vremeDo){
            $poruka = "Vreme dolaska mora biti kasnije od vremena polaska.";
            $this->prikaz("azurirajPonudu", ["ponuda" => $ponuda, "poruka" => $poruka]);
        }
        else if ($brojRezervisanihMesta == 0 && $mestoOd == $mestoDo){
            $poruka = "Mesto polaska i dolaska moraju biti različiti.";
            $this->prikaz("azurirajPonudu", ["ponuda" => $ponuda, "poruka" => $poruka]);
        }
        else if ($rokZaOtkazivanje <= 0 || $rokZaOtkazivanje > $trenutniRokZaOtkaz){
            $poruka = "Rok za otkazivanje rezervacije mora da bude pozitivan broj i ne veći od trenutnog roka.";
            $this->prikaz("azurirajPonudu", ["ponuda" => $ponuda, "poruka" => $poruka]);
        }
        else {
            $builder = $db->table("mesto");
            $SifMesOd = ($builder->where("Naziv", $mestoOd)->get()->getResult())[0]->SifM;
            $SifMesDo = ($builder->where("Naziv", $mestoDo)->get()->getResult())[0]->SifM;

            $builder = $db->table("ponuda");
            $data = [
                "BrMesta" => $brMesta,
                "DatumOd" => $datumOd,
                "DatumDo" => $datumDo,
                "VremeOd" => $vremeOd,
                "VremeDo" => $vremeDo,
                "CenaKarte" => $cena,
                "SifMesDo" => $SifMesDo,
                "SifMesOd" => $SifMesOd,
            ];

            $builder->where("SifP", $sifP);
            $builder->update($data);

            $builder = $db->table("ponuda");
            $ponuda = ($builder->where("SifP", $sifP)->get()->getResult())[0];

            $builder = $db->table("postavljenaponuda");
            $data = [
                "RokZaOtkazivanje" => $rokZaOtkazivanje
            ];
            $builder->where("SifP", $sifP);
            $builder->update($data);

            $this->prikaz("azurirajPonudu", ["ponuda" => $ponuda, "porukaUspeh" => "Uspesno azuriranje!"]);
        }
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
