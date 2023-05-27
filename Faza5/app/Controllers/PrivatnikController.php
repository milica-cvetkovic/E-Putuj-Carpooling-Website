<?php
// Željko Urošević 2020/0073 

namespace App\Controllers;

use App\Models\ModelPoruka;
use App\Models\ModelKorisnik;
use App\Models\ModelZahtevPonuda;
use App\Models\ModelPonuda;
use App\Models\ModelMesto;
use App\Models\ModelSredstvo;

class PrivatnikController extends BaseController {

    //....

    private function prikaz($stranica, $podaci) {

        $SifK=session()->get("korisnik")->SifK;
        $model=new ModelPoruka();
        $br=$model->select("count(*) as br")->where("SifPriv",$SifK)->where("SmerPoruke",1)->findAll()[0]->br;
        echo view("sabloni/headerprivatnik",["brPoruka"=>$br]);
        echo view($stranica, $podaci);
        echo view("sabloni/footer");
    }

    public function index() {

        // samo za testing deo
        // u sustini dohvatanje korisnika ide iz sesije i preko njega se samo proslede ponude
        $db      = \Config\Database::connect();
        $builder = $db->table('korisnik');

        $korisnik = ($builder->where("KorisnickoIme", "zeljko123")->get()->getResult())[0];
        $this->session->set("korisnik", $korisnik);

        $builder = $db->table("ponuda");
        $ponude = $builder->where("SifK", $korisnik->SifK)->get()->getResult();
        $this->prikaz("indexprivatnik", ["ponude" => $ponude]);
    }

    public function izborPonudeAzuriranje() {

        // samo za testing deo
        // u sustini dohvatanje korisnika ide iz sesije i preko njega se samo proslede ponude
        $db      = \Config\Database::connect();
        $builder = $db->table('korisnik');

        $korisnik = ($builder->where("KorisnickoIme", "zeljko123")->get()->getResult())[0];
        $this->session->set("korisnik", $korisnik);

        $builder = $db->table("ponuda");
        $ponude = $builder->where("SifK", $korisnik->SifK)->get()->getResult();

        $this->prikaz("izborPonudeAzuriranje", ["ponude" => $ponude]);
    }

    // prikaz ponude koju je postavio
    public function prikazPonude($sifP) {
        $db      = \Config\Database::connect();
        $builder = $db->table("ponuda");
        $ponuda = ($builder->where("SifP", $sifP)->get()->getResult())[0];

        $this->prikaz("prikazPonudePrivatnik", ["ponuda" => $ponuda]);
    }

    // $sifP je sifra ponude
    public function azurirajPonudu($sifP) {
        $db      = \Config\Database::connect();
        $builder = $db->table("ponuda");
        $ponuda = ($builder->where("SifP", $sifP)->get()->getResult())[0];

        $this->prikaz("azurirajPonudu", ["ponuda" => $ponuda]);
    }

    public function azuriranjePonudeSubmit($sifP) {
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
        foreach ($rezervacije as $rezervacija) {
            $brojRezervisanihMesta += $rezervacija->BrMesta;
        }
        if ($brojRezervisanihMesta > $brMesta) {
            $poruka = "Rezervisano je " . $brojRezervisanihMesta . " tako da se ne moze smanjiti broj mesta za ponudu na " . $brMesta . ".";
            $this->prikaz("azurirajPonudu", ["ponuda" => $ponuda, "poruka" => $poruka]);
        } else if ($cena <= 0) {
            $poruka = "Cena mora da bude pozitivan broj.";
            $this->prikaz("azurirajPonudu", ["ponuda" => $ponuda, "poruka" => $poruka]);
        } else if (
            $brojRezervisanihMesta == 0 &&
            ($datumOd . " " . $vremeOd <= date("Y-m-d H:i:s") || $datumDo . " " . $vremeDo <= date("Y-m-d H:i:s"))
        ) {
            $poruka = "Uneti datum i vreme moraju biti kasnije od trenutnog datuma i vremena.";
            $this->prikaz("azurirajPonudu", ["ponuda" => $ponuda, "poruka" => $poruka]);
        } else if ($brojRezervisanihMesta == 0 && $datumOd > $datumDo) {
            $poruka = "Datum dolaska mora biti kasnije od datuma polaska.";
            $this->prikaz("azurirajPonudu", ["ponuda" => $ponuda, "poruka" => $poruka]);
        } else if ($brojRezervisanihMesta == 0 && $datumOd == $datumDo && $vremeOd >= $vremeDo) {
            $poruka = "Vreme dolaska mora biti kasnije od vremena polaska.";
            $this->prikaz("azurirajPonudu", ["ponuda" => $ponuda, "poruka" => $poruka]);
        } else if ($brojRezervisanihMesta == 0 && $mestoOd == $mestoDo) {
            $poruka = "Mesto polaska i dolaska moraju biti različiti.";
            $this->prikaz("azurirajPonudu", ["ponuda" => $ponuda, "poruka" => $poruka]);
        } else if ($rokZaOtkazivanje <= 0 || $rokZaOtkazivanje > $trenutniRokZaOtkaz) {
            $poruka = "Rok za otkazivanje rezervacije mora da bude pozitivan broj i ne veći od trenutnog roka.";
            $this->prikaz("azurirajPonudu", ["ponuda" => $ponuda, "poruka" => $poruka]);
        } else {

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

            $this->prikaz("azurirajPonudu", ["ponuda" => $ponuda, "porukaUspeh" => "Uspesno napravljena ponuda!"]);
        }
    }

    /**
     * Anja Curic 2020/0513
     */
    public function inboxPrivatnik() {
        $Kime=session()->get("korisnik")->KorisnickoIme;
        $model=new ModelPoruka();
        $modelK=new ModelKorisnik();
        $modelP=new ModelPonuda(); 
        $modelM=new ModelMesto();

        $korisnik=$modelK->where("KorisnickoIme",$Kime)->findAll()[0];

        $poruke=$model->where("SifPriv",$korisnik->SifK)->where("SmerPoruke",1)->findAll();
        foreach($poruke as $poruka){ 
            $ponuda=$modelP->where("SifP",$poruka->SifPonuda)->findAll()[0];
            $poruka->mestoOd=$modelM->where("SifM",$ponuda->SifMesOd)->findAll()[0];
            $poruka->korisnik=$modelK->where("SifK",$poruka->SifKor)->findAll()[0]->KorisnickoIme;
        }
        
        $this->prikaz("inboxPrivatnik", ["poruke"=>$poruke]);
    }

    // ova stranica vrv nece da postoji, nego ce se ugraditi prikaz direktno
    public function inboxPrivatnikPoruka() {
        $izbor=$this->request->getVar("poruka");
        $Kime=session()->get("korisnik")->KorisnickoIme;
        $model=new ModelPoruka();
        $modelK=new ModelKorisnik();
        $modelZ=new ModelZahtevPonuda();
        $modelP=new ModelPonuda(); 
        $modelM=new ModelMesto();
        $modelS=new ModelSredstvo();

        $korisnik=$modelK->where("KorisnickoIme",$Kime)->findAll()[0];

        $poruke=$model->where("SifPriv",$korisnik->SifK)->where("SmerPoruke",1)->findAll();
        foreach($poruke as $poruka){ 
            $ponuda=$modelP->where("SifP",$poruka->SifPonuda)->findAll()[0];
            $poruka->mestoOd=$modelM->where("SifM",$ponuda->SifMesOd)->findAll()[0];
            $poruka->korisnik=$modelK->where("SifK",$poruka->SifKor)->findAll()[0]->KorisnickoIme;
        }
        
        $izbor=$model->where("SifPor",$izbor)->findAll()[0];
        $odabrana=$modelP->where("SifP",$izbor->SifPonuda)->findAll()[0];
        $odabrana->CenaOd=$modelZ->where("SifP",$izbor->SifPonuda)->findAll()[0]->CenaOd;
        $odabrana->CenaDo=$modelZ->where("SifP",$izbor->SifPonuda)->findAll()[0]->CenaDo;
        $odabrana->mestoOd=$modelM->where("SifM",$odabrana->SifMesOd)->findAll()[0];
        $odabrana->mestoDo=$modelM->where("SifM",$odabrana->SifMesDo)->findAll()[0];
        $odabrana->sredstvo=$modelS->where("SifSred",$odabrana->SifSred)->findAll()[0]->Naziv;
        $this->prikaz("inboxPrivatnik", ["poruke"=>$poruke,"odabrana"=>$odabrana]);
    }

    public function napraviPonudu() {
        $SifK=$this->request->getVar("SifK");
        $this->prikaz("napraviPonudu", ["SifK"=>$SifK]);
    }

    public function napraviPonuduSubmit() {
        $prevoznosredstvo = $this->request->getVar("prevoznoSredstvo");
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
        $SifK=$this->request->getVar("SifK");
        if ($cena <= 0) {
            $poruka = "Cena mora da bude pozitivan broj.";
            $this->prikaz("napraviPonudu", ["poruka" => $poruka,"SifK"=>$SifK]);
        } else if ($datumOd . " " . $vremeOd <= date("Y-m-d H:i:s") || $datumDo . " " . $vremeDo <= date("Y-m-d H:i:s")) {
            $poruka = "Uneti datum i vreme moraju biti kasnije od trenutnog datuma i vremena.";
            $this->prikaz("napraviPonudu", ["poruka" => $poruka,"SifK"=>$SifK]);
        } else if ($datumOd > $datumDo) {
            $poruka = "Datum dolaska mora biti kasnije od datuma polaska.";
            $this->prikaz("napraviPonudu", ["poruka" => $poruka,"SifK"=>$SifK]);
        } else if ($datumOd == $datumDo && $vremeOd >= $vremeDo) {
            $poruka = "Vreme dolaska mora biti kasnije od vremena polaska.";
            $this->prikaz("napraviPonudu", ["poruka" => $poruka,"SifK"=>$SifK]);
        } else if ($mestoOd == $mestoDo) {
            $poruka = "Mesto polaska i dolaska moraju biti različiti." . $mestoOd . "|" . $mestoDo;
            $this->prikaz("napraviPonudu", ["poruka" => $poruka,"SifK"=>$SifK]);
        } else if ($rokZaOtkazivanje <= 0 || (strtotime($datumOd) - strtotime(date("Y-m-d"))) / (60 * 60 * 24) < $rokZaOtkazivanje - 1) {
            $poruka = "Rok za otkazivanje rezervacije mora da bude pozitivan broj i da se uklapa u period do realizacije ponude.";
            $this->prikaz("napraviPonudu", ["poruka" => $poruka,"SifK"=>$SifK]);
        } else if ($brMesta <= 0) {
            $poruka = "Broj slobodnih mesta mora da bude pozitivan broj.";
            $this->prikaz("napraviPonudu", ["poruka" => $poruka,"SifK"=>$SifK]);
        } else {
            $db      = \Config\Database::connect();
            $builder = $db->table("mesto");
            $SifMesOd = ($builder->where("Naziv", $mestoOd)->get()->getResult())[0]->SifM;
            $SifMesDo = ($builder->where("Naziv", $mestoDo)->get()->getResult())[0]->SifM;

            $builder = $db->table("prevoznosredstvo");
            $SifSred = ($builder->where("Naziv", $prevoznosredstvo)->get()->getResult())[0]->SifSred;

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
                "SifSred" => $SifSred,
                "SifK" => session()->get("korisnik")->SifK
            ];

            $builder->insert($data);

            $builder = $db->table("postavljenaponuda");
            $data = [
                "SifP" => $db->insertID(),
                "RokZaOtkazivanje" => $rokZaOtkazivanje
            ];
            $builder->insert($data);


            if(!empty($SifK) && $SifK!=-1){ 
                $model=new ModelPoruka();
                $modelP=new ModelPonuda();

                $SifPonuda=$modelP->orderBy("SifP","desc")->findAll()[0]->SifP;
                $SifPriv=session()->get("korisnik")->SifK;

                $model->insert(["SifPondida"=>$SifPonuda,"SifPriv"=>$SifPriv,"SifKor"=>$SifK,"SmerPoruke"=>"2"]);

            }
            session()->remove('zatrazenaPonuda');
            // mozda da se ode na prikaz te ponude??
            $this->prikaz("napraviPonudu", ["porukaUspeh" => "Napravljena ponuda!"]);
        }
    }

    public function otkaziPonudu() {
        $this->prikaz("otkaziPonudu", []);
    }


    public function promenaPretplate() {
        $this->prikaz("promenaPretplate", []);
    }

    public function promenaPretplateSubmit() {
        $dugme = $this->request->getVar("dugme");

        $db      = \Config\Database::connect();
        $korisnikSifK = session()->get("korisnik")->SifK;
        $builder = $db->table("privatnik");
        $privatnikSifPretplata = ($builder->where("SifK", $korisnikSifK)->get()->getResult())[0]->SifPret;
        $builder = $db->table("pretplata");
        $pretplata = ($builder->where("SifPret", $privatnikSifPretplata)->get()->getResult())[0];
        if ($dugme == "Premium") {
            if ($pretplata->Naziv == "Premium") {
                $poruka = "Vec imate premium pretplatu.";
                $this->prikaz("promenaPretplate", ["poruka" => $poruka]);
            } else {
                $data = [
                    "SifPret" => ($builder->where("Naziv", "Premium")->get()->getResult())[0]->SifPret
                ];

                $builder = $db->table("privatnik");

                $builder->where("SifK", $korisnikSifK);
                $builder->update($data);
                $poruka = "Uspesno ažuriranje";
                $this->prikaz("promenaPretplate", ["porukaUspeh" => $poruka]);
            }
        }
        else {
            if ($pretplata->Naziv == "Standard") {
                $poruka = "Vec imate standard pretplatu.";
                $this->prikaz("promenaPretplate", ["poruka" => $poruka]);
            } else {
                $data = [
                    "SifPret" => ($builder->where("Naziv", "Standard")->get()->getResult())[0]->SifPret
                ];

                $builder = $db->table("privatnik");

                $builder->where("SifK", $korisnikSifK);
                $builder->update($data);
                $poruka = "Uspesno ažuriranje";
                $this->prikaz("promenaPretplate", ["porukaUspeh" => $poruka]);
            }
        }
    }
    public function izmenaProfila() {
        $this->prikaz("izmenaProfila", []);
    }
}
