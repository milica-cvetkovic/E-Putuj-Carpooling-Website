<?php
$db      = \Config\Database::connect();
$builder = $db->table("mesto");
$mesta = $builder->get()->getResult();

$builder = $db->table("prevoznosredstvo");
$prevoznaSredstva = $builder->get()->getResult();

?>

<section>
   <div class="banner-main">
      <img src="<?php echo base_url('images/GettyImages-185298837.jpg') ?>" style="width:100%" alt="#" />
      <div class="text-block2">
         <div class="titlepage">
            <br /><br /><br />
            <h2>KREIRANJE PONUDE</h2>
         </div>
         <?php
         if (!empty($poruka)) {
            echo "<div style='display: flex; justify-content: center; color: red'
                        <h5>{$poruka}</h5>
                     </div>";
         }
         if (!empty($porukaUspeh)) {
            echo "<div style='display: flex; justify-content: center; color: green'
                        <h5>{$porukaUspeh}</h5>
                     </div>";
         }
         ?>
         <form style="background-image:url(<?php echo base_url('anja/css/slikaPozadine.jpg') ?>);color:#004043;border-radius:10px;" method="post" action="<?= site_url("PrivatnikController/napraviPonuduSubmit") ?>">
            <div class="row" style="margin-top:50px;margin-right:30px;margin-left:30px;">
               <div class="col-md-12">
                  <div class="row">
                     <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12" style="margin-top:30px">
                        <label>Prevozno sredstvo</label>
                        <select class="form-control" name="prevoznoSredstvo">
                           <?php
                           foreach ($prevoznaSredstva as $prevoznoSredstvo) {
                              echo "<option>{$prevoznoSredstvo->Naziv}</option>";
                           }
                           ?>
                        </select>
                     </div>
                     <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12" style="margin-top:30px">
                        <label>Mesto od</label>
                        <select class="form-control" name="mestoPolaska">
                           <?php
                           foreach ($mesta as $mesto) {
                              echo "<option>{$mesto->Naziv}</option>";
                           }
                           ?>
                        </select>
                     </div>
                     <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12" style="margin-top:30px">
                        <label>Mesto do</label>
                        <select class="form-control" name="mestoDolaska">
                           <?php
                           foreach ($mesta as $mesto) {
                              echo "<option>{$mesto->Naziv}</option>";
                           }
                           ?>
                        </select>
                     </div>
                     <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <label>Cena prevoza</label>
                        <input class="form-control" placeholder="0" type="text" name="cenaKarte">
                     </div>
                     <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <label> Broj putnika</label>
                        <input class="form-control" placeholder="0" type="text" name="brMesta">
                     </div>
                     <div class="col-xl-3 col-lg-4 col-md-3 col-sm-6 col-12">
                        <label>Datum polaska</label>
                        <input class="form-control" placeholder="Any" type="date" name="datumOd">
                     </div>
                     <div class="col-xl-3 col-lg-4 col-md-3 col-sm-6 col-12">
                        <label>Datum dolaska</label>
                        <input class="form-control" placeholder="Any" type="date" name="datumDo">
                     </div>
                     <div class="col-xl-3 col-lg-4 col-md-3 col-sm-6 col-12">
                        <label>Vreme polaska</label>
                        <input class="form-control" placeholder="Any" type="time" name="vremeOd">
                     </div>
                     <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-12">
                        <label>Vreme dolaska</label>
                        <input class="form-control" placeholder="Any" type="time" name="vremeDo">
                     </div>
                     <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-12" style="margin-bottom:30px">
                        <label>Izaberite fotografiju</label>
                        <input class="form-control" style="height:40px;width:270px;" placeholder="Any" type="file" name="Izaberi">
                     </div>
                     <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-12" style="margin-bottom:30px">
                        <label style="margin-left:70px;width:150px">Unesite otkazni rok</label>
                        <input class="form-control" style="height:40px;width:250px;margin-left:70px" placeholder="5" type="number" name="rokZaOtkazivanje">
                     </div>
                  </div>
               </div>
            </div>
            <div class="row justify-content-center" style="margin-top:50px; padding-bottom: 50px">
               <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12" style="margin-right:-100px; justify-content: center; display: flex">
                  <input type='submit' class="dugme" value="Napravi">
               </div>
               <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12" style="justify-content: center; display: flex">
                  <input type='reset' class="dugme" value="Resetuj">
               </div>
            </div>
         </form>
      </div>
   </div>
</section>