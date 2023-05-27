<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;

class ModelObicanKorisnikLana extends Model
{
     protected $db;
    
    public function __construct(ConnectionInterface $db)
    {
        $this->db = $db;
    }
    // protected $table      = 'korisnik';
    // protected $primaryKey = 'SifK';

    // protected $useAutoIncrement = false;

    // protected $returnType     = 'object';

    // protected $allowedFields = ['SifK', 'KorisnickoIme','Lozinka','TraziBrisanje','Ime','Prezime','BrTel','Email','PrivatnikIliKoirsnik'];
    public function svaMesta(){
        return $this->db->table('mesto')->get()->getResult();
    }
    public function svaSredstva(){
        return $this->db->table('prevoznosredstvo')->get()->getResult();
    }
    public function mojeRezervacije($SifK){
        return $this->db->table('rezervacija')->where("SifK=",$SifK)->get()->getResult();
    }

    public function izmenaProfila($ime,$prezime,$lozinka,$email,$profilna,$SifK){
        $korisnik = $this->db->table("korisnik")->where("SifK=",$SifK)->get()->getResult()[0];
        
        if($ime!=""){
            $korisnik->Ime=$ime;
        }
        if($prezime!=""){
            $korisnik->Prezime= $prezime;
        }
        if($lozinka!=""){
            $korisnik->Lozinka=$lozinka;
        }
        if($email!=""){
            $korisnik->Email=$email;
        }
        if($profilna!=null){
            // $korisnik->
        }
        $this->db->table('korisnik')->where("SifK=",$SifK)->update($korisnik);

    }
    public function posaljiVandrednuVoznju($voznja){
        $privatnici = $this->db->table('privatnik')->get()->getResult();
        $SifSred = $this->db->table('prevoznosredstvo')->where('Naziv=',$voznja['Sred'])->get()->getResult()[0];

        foreach($privatnici as $privatnik){
                    $VandrednaPonuda =[
                        'DatumOd'=>$voznja['DatumOd'],
                        'DatumDo' =>$voznja['DatumDo'],

                        'VremeOd'=>$voznja['VremeOd'],
                        'VremeDo'=>$voznja['VremeDo'],
                        'SifMesDo'=>$voznja['SifMesDo'],
                        'SifMesOd'=> $voznja['SifMesOd'],
                        'SifSred'=>$SifSred->SifSred,
                        'SifK'=>$privatnik->SifK,
                        'CenaKarte'=>0,
                        'BrMesta'=>$voznja['BrMesta'],
                        
                    ];
                    
                    $this->db->table('ponuda')->insert($VandrednaPonuda);
                    
                    $vandredne = $this->db->table('ponuda')->where('DatumOd=',$VandrednaPonuda['DatumOd'])
                    ->where('DatumDo=',$VandrednaPonuda['DatumDo'])
                    ->where('VremeOd=',$VandrednaPonuda['VremeOd'])
                    ->where('VremeDo=',$VandrednaPonuda['VremeDo'])
                    ->where('SifMesDo=',$VandrednaPonuda['SifMesDo'])
                    ->where('SifMesOd=',$VandrednaPonuda['SifMesOd'])
                    ->where('SifSred=',$VandrednaPonuda['SifSred'])
                    ->where('CenaKarte=',$VandrednaPonuda['CenaKarte'])
                    ->where('BrMesta=',$VandrednaPonuda['BrMesta'])
                    ->get()->getResult();
                    foreach($vandredne as $ponuda){
                        $nadjeni =  $this->db->table('zahtevponuda')->where("SifP=",$ponuda->SifP)->get()->getResult();
                        if ( count($nadjeni)== 0){
                            $ZahtjvPonude=[
                                'SifP'=> $ponuda->SifP,
                                'CenaDo'=>$voznja['CenaDo'],
                                'CenaOd'=>$voznja['CenaOd'],
                            ];
                            

                        $this->db->table('zahtevponuda')->insert($ZahtjvPonude);
                        
                        $poruka =[
                            'SifPonuda'=>$ponuda->SifP,
                            'SifKor'=>$voznja['SifK'],
                            'SifPriv'=>$privatnik->SifK,
                            'SmerPoruke'=>1
                        ];
                        $this->db->table('poruka')->insert($poruka);

                            break;
                        
                        }
                    }
                    
                        

        }
        

        
        
    }

    public function report($SifK,$komentar,$SifPrijavitelja){
        $koga = $this->db->table('korisnik')->where("KorisnickoIme=",$SifK)->get()->getResult();
        if(count($koga)==0){
            return null;
        }
        $koga = $this->db->table('privatnik')->where("SifK=",$koga[0]->SifK)->get()->getResult();
        if(count($koga)==0){
            return null;
        }
        $prijava=[
            'Razlog'=>$komentar,
            'SifPrijavio'=>$SifPrijavitelja,
            'SifPrijavljen'=>$koga[0]->SifK
        ];
       
       return $prijava;
    }
    public function ocenjivanje($Imeprivatnika,$komentar,$ocena,$SifK){
        $koga = $this->db->table('korisnik')->where("KorisnickoIme=",$Imeprivatnika)->get()->getResult();
        if(count($koga)==0){
            
            return null;
        }
        $koga = $this->db->table('privatnik')->where("SifK=",$koga[0]->SifK)->get()->getResult();
        if(count($koga)==0){
            
            return null;
        }
        
        $ocena = [
            'Ocena'=>$ocena,
            'Komentar'=>$komentar,
            'SifPriv'=>$koga[0]->SifK,
            'SifK'=>$SifK

        ];
        return $ocena;

}
}