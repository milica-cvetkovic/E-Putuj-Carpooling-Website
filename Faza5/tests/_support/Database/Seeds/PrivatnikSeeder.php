<?php

namespace Tests\Support\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PrivatnikSeeder extends Seeder
{
    public function run()
    {
        $korisnici = [
            [
                'SifK' => 0,
                'KorisnickoIme' => 'zeljko123',
                'Lozinka' => 'zeljko123',
                'TraziBrisanje' => 0,
                'Ime' => 'Zeljko',
                'Prezime' => 'Urosevic',
                'BrTel' => 432678900,
                'Email' => 'pomocniEPUTUJ2@outlook.com',
                'PrivatnikIliKorisnik' => 'P',
                'Novac' => 400,
                'ProfilaSlika' => '3_20230531220122_RE4wwtb.jpg'
            ],
        ];

        $builder = $this->db->table('korisnik');
        foreach ($korisnici as $korisnik) {
            $builder->insert($korisnik);
        }
        
        $ponude = [
            [
                'SifP' => 31,
                'BrMesta' => 1,
                'DatumOd' => '2023-06-14',
                'DatumDo' => '2023-06-30',
                'VremeOd' => '22:22:00',
                'VremeDo' => '14:00:00',
                'CenaKarte' => 10.00,
                'SifMesDo' => 0,
                'SifMesOd' => 14,
                'SifSred' => 2,
                'SifK' => 3,
                'Slika' => '31_20230605185505_beograd-na-vodi.jpg',
                'SifPriv' => 0
            ],
        ];
        
        $builder = $this->db->table('ponuda');
        foreach ($ponude as $ponuda) {
            $builder->insert($ponuda);
        }
        
        
        $mesta = [
            
        ];
        
        
        
        
    }
}
