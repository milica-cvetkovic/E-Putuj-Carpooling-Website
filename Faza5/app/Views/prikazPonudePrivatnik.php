<?php
$db = \Config\Database::connect();
$builder = $db->table('mesto');
$mestoOd = ($builder->where("SifM", $ponuda->SifMesOd)->get()->getResult())[0]->Naziv;
$mestoDo = ($builder->where("SifM", $ponuda->SifMesDo)->get()->getResult())[0]->Naziv;

$danOd = explode("-", $ponuda->DatumOd)[2];
$mesecOd = explode("-", $ponuda->DatumOd)[1];
$godinaOd = explode("-", $ponuda->DatumOd)[0];
$datumOd = $danOd."/".$mesecOd."/".$godinaOd;

$danDo = explode("-", $ponuda->DatumDo)[2];
$mesecDo = explode("-", $ponuda->DatumDo)[1];
$godinaDo = explode("-", $ponuda->DatumDo)[0];
$datumDo = $danDo."/".$mesecDo."/".$godinaDo;

$satiOd = explode(":", $ponuda->VremeOd)[0];
$minutiOd = explode(":", $ponuda->VremeOd)[1];
$vremeOd = $satiOd.":".$minutiOd;

$satiDo = explode(":", $ponuda->VremeDo)[0];
$minutiDo = explode(":", $ponuda->VremeDo)[1];
$vremeDo = $satiDo.":".$minutiDo;

$brMesta = $ponuda->BrMesta;

$builder = $db->table("prevoznosredstvo");
$prevoznoSredstvo = ($builder->where("SifSred", $ponuda->SifSred)->get()->getResult())[0]->Naziv;

$builder = $db->table("postavljenaponuda");
$postavljenaponuda = ($builder->where("SifP", $ponuda->SifP)->get()->getResult())[0];
$rokZaOtkaz = $postavljenaponuda->RokZaOtkazivanje;

$cena = $ponuda->CenaKarte;
?>


<hr style="height:1px;border:none;color:#333;background-color:#333;">
<div class="back-image-message">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12" align="center" style="margin-top: 20px;">
                <h1 style="font-size: 3em;"><?= $mestoOd ?> -> <?= $mestoDo ?></h1>
            </div>
            <div class="col-sm-4" style="margin-top: 30px;"><img src="https://www.vivatravel.rs/photo/56518/p/16:10" style="border: 5px solid white;"></div>
            <div class="col-sm-8" style="margin-top: 30px;">
                <table class="table">
                    <tr>
                        <!-- nzm sta da radim sa ovim ?? nemamo ocenu u bazi nigde -->
                        <td>Privatnik <?= session()->get("korisnik")->KorisnickoIme ?></td>
                        <td><span class="fa fa-star star-checked"></span>
                            <span class="fa fa-star star-checked"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                        </td>
                    </tr>
                    <tr>
                        <td>Datum polaska: <?= $datumOd ?></td>
                        <td>Datum dolaska: <?= $datumDo ?></td>
                    </tr>
                    <tr>
                        <td>Vreme polaska: <?= $vremeOd ?></td>
                        <td>Vreme dolaska: <?= $vremeDo ?></td>
                    </tr>
                    <tr>
                        <td>Broj slobodnih mesta:</td>
                        <td><?= $brMesta ?>
                            <span>
                                <img src="<?php echo base_url('images/stickman.png') ?>" height="25" width="25">
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td>Prevozno Sredstvo:</td>
                        <td><?= $prevoznoSredstvo ?>
                            <img src='<?php echo base_url("images/{$prevoznoSredstvo}_transparent.png") ?>' height="30" width="30">
                        </td>
                    </tr>
                    <tr>
                        <td>Rok za otkaz rezervacije:</td>
                        <td><?= $rokZaOtkaz ?> dana</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6"></div>
            <div class="col-sm-6">
                <h1 style="font-size: 2em;">Cena: <?= $cena ?>€</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-5"></div>
            <div class="col-sm-1"><a href="<?php echo base_url("PrivatnikController/azurirajPonudu") ?>"><button type="button" class="btn make-offer-btn" style="position: relative; left: 50%;">Ažuriraj ponudu</button></a></div>
            <div class="col-sm-1"></div>
            <div class="col-sm-1" style="margin-bottom: 15px;"><a href="#"><button type="button" class="btn make-offer-btn" style="position: relative; left: 50%;">Otkaži ponudu</button></a></div>
        </div>
    </div>
</div>