<section>
   <div class="banner-main">
      <img src="<?php echo base_url('images/GettyImages-185298837.jpg') ?>" style="width:100%" alt="#" />
      <div class="text-block2">
         <div class="titlepage">
            <br/><br/><br/>
            <h2>KREIRANJE PONUDE</h2>
         </div>
         <form style="background-image:url(<?php echo base_url('anja/css/slikaPozadine.jpg') ?>);color:#004043;border-radius:10px;">
            <div class="row" style="margin-top:50px;margin-right:30px;margin-left:30px;">
               <div class="col-md-12">
                  <div class="row">
                     <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12" style="margin-top:30px">
                        <label>Prevozno sredstvo</label>
                        <select class="form-control" name="Any">
                           <option>Automobil</option>
                           <option>Autobus</option>
                           <option>Brod</option>
                        </select>
                     </div>
                     <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12" style="margin-top:30px">
                        <label>Mesto od</label>
                        <select class="form-control" name="Any">
                           <option>Subotica</option>
                           <option>Beograd</option>
                           <option>Novi Sad</option>
                           <option>Niš</option>
                        </select>
                     </div>
                     <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12" style="margin-top:30px">
                        <label>Mesto do</label>
                        <select class="form-control" name="Any">
                           <option>Subotica</option>
                           <option>Beograd</option>
                           <option>Novi Sad</option>
                           <option>Niš</option>
                        </select>
                     </div>
                     <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <label>Cena prevoza</label>
                        <input class="form-control" placeholder="0" type="text" name="00.0">
                     </div>
                     <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <label> Broj putnika</label>
                        <input class="form-control" placeholder="0" type="text" name="00.0">
                     </div>
                     <div class="col-xl-3 col-lg-4 col-md-3 col-sm-6 col-12">
                        <label>Datum polaska</label>
                        <input class="form-control" placeholder="Any" type="date" name="Any">
                     </div>
                     <div class="col-xl-3 col-lg-4 col-md-3 col-sm-6 col-12">
                        <label>Datum dolaska</label>
                        <input class="form-control" placeholder="Any" type="date" name="Any">
                     </div>
                     <div class="col-xl-3 col-lg-4 col-md-3 col-sm-6 col-12">
                        <label>Vreme polaska</label>
                        <input class="form-control" placeholder="Any" type="time" name="Any">
                     </div>
                     <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-12">
                        <label>Vreme dolaska</label>
                        <input class="form-control" placeholder="Any" type="time" name="Any">
                     </div>
                     <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-12" style="margin-bottom:30px">
                        <label>Izaberite fotografiju</label>
                        <input class="form-control" style="height:40px;width:270px;" placeholder="Any" type="file" name="Izaberi">
                     </div>
                     <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-12" style="margin-bottom:30px">
                        <label style="margin-left:70px;width:150px">Unesite otkazni rok</label>
                        <input class="form-control" style="height:40px;width:250px;margin-left:70px" placeholder="5" type="number" name="Any">
                     </div>
                  </div>
               </div>
            </div>
         </form>
         <div class="row justify-content-center" style="margin-top:50px">
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12" style="margin-right:-90px">
               <a href="#"><button class="dugme" style="height:50px;width:120px;background-color:#004043">Kreiraj</button></a>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12" style="margin-left:-90px;margin-right:-120px;">
               <a href="#"> <button class="dugme" style="height:50px;width:120px;background-color:#004043">Resetuj</button></a>
            </div>
         </div>
      </div>
   </div>
</section>