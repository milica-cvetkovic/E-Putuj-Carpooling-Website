<!-- <section>
   <div class="banner-main">
      <img src="<?php echo base_url('images/GettyImages-185298837.jpg') ?>" style="width:100%" alt="#" />
      <div id="travel" class="traveling text-block3">
         <div class="container" style="display:unset">
            <div class="row">
               <div class="col-md-12 ">
                  <div class="titlepage" id="ponude" style="margin:80px">
                     <h2>AŽURIRANJE PONUDE</h2>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
                  <a href="azuriraj2.html">
                     <div class="traveling-box">
                        <i><img src="https://www.vivatravel.rs/photo/56518/p/16:10" alt="icon" style="width:250px;height:200px" style="object-fit: scale-down;" /></i>
                        <h2>Beograd -> Budimpešta</h2>
                        24/7/2023 <br><img src="<?php echo base_url('images/car_transparent.png') ?>" height="35" width="35"><br>
                        5 <span><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/d/d8/Person_icon_BLACK-01.svg/1924px-Person_icon_BLACK-01.svg.png" height="15" width="15"></span>
                        <h3>28€</h3>
                        <a href="azuriraj2.html"><button class="dugme" style="float:none">Ažuriraj
                              ponudu</button></a>
                     </div>
                  </a>
               </div>
               <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
                  <a href="azuriraj2.html">
                     <div class="traveling-box">
                        <i><img src="https://media.danubeogradu.rs/2014/06/beograd-na-vodi.jpg" alt="icon" style="width:250px;height:200px" style="object-fit: scale-down;" /></i>
                        <h2>Prag -> Beograd</h2>
                        8/9/2023 <br><img src="<?php echo base_url('images/car_transparent.png') ?>" height="35" width="35"><br>
                        2 <span><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/d/d8/Person_icon_BLACK-01.svg/1924px-Person_icon_BLACK-01.svg.png" height="15" width="15"></span>
                        <h3>50€</h3>
                        <a href="azuriraj2.html"><button class="dugme" style="float:none">Ažuriraj
                              ponudu</button></a>
                     </div>
                  </a>
               </div>
               <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
                  <a href="ayuriraj2.html">
                     <div class="traveling-box">
                        <i><img src="https://balkanfun.travel/sites/default/files/styles/putovanje_velika_845x450/public/berlin-sumrak-grad.jpg?itok=yBwuHer8" alt="icon" style="width:250px;height:200px" style="object-fit: scale-down;" /></i>
                        <h2>Beč -> Berlin</h2>
                        10/5/2023 <br><img src="<?php echo base_url('images/car_transparent.png') ?>" height="35" width="35"><br>
                        1 <span><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/d/d8/Person_icon_BLACK-01.svg/1924px-Person_icon_BLACK-01.svg.png" height="15" width="15"></span>
                        <h3>45€</h3>
                        <a href="azuriraj2.html"><button class="dugme" style="float:none">Ažuriraj
                              ponudu</button></a>
                     </div>
                  </a>
               </div>
            </div>
            <div class="row" style="margin-top: 20px;">
               <div class="col-sm-6" align="right"><button type="button" class="btn arrow-btn">
                     <h1>&lt;</h1>
                  </button></div>
               <div class="col-sm-6" align="left"><button type="button" class="btn arrow-btn">
                     <h1>&gt;</h1>
                  </button></div>
            </div>
         </div>
      </div>
   </div>
</section> -->

<section>
   <div class="banner-main">
      <img src="<?php echo base_url('images/GettyImages-185298837.jpg') ?>" style="width:100%" alt="#" />
      <div id="travel" class="traveling text-block3">
         <div class="container" style="display:unset">
            <div class="row">
               <div class="col-md-12 ">
                  <div class="titlepage" id="ponude" style="margin:80px">
                     <h2>AŽURIRANJE PONUDE</h2>
                  </div>
               </div>
            </div>
            
            <?php
         if (empty($ponude)){
            echo '<div class="titlepage" id="ponude">
            <h3>Nema postavljenih ponuda</h3>
               </div>';
         }
         else {
            echo '<div class="row">';
            echo '<div id="postavljenePonude" class="carousel slide" data-bs-ride="carousel" data-bs-interval="false">';
            echo '<div class="carousel-inner">';
            $postavljeniDivovi = false;
            foreach($ponude as $i=>$ponuda) {
               if ($i % 3 == 0){
                  if ($i == 0){
                     echo '<div class="carousel-item active">';
                  }
                  else {
                     echo '<div class="carousel-item">';
                  }
                  echo '<div class="row">';
               }
               $db = \Config\Database::connect();
               $builder = $db->table('mesto');
               $mestoOd = ($builder->where("SifM", $ponuda->SifMesOd)->get()->getResult())[0]->Naziv;
               $mestoDo = ($builder->where("SifM", $ponuda->SifMesDo)->get()->getResult())[0]->Naziv;
               $builder = $db->table("prevoznosredstvo");
               $prevoznoSredstvo = ($builder->where("SifSred", $ponuda->SifSred)->get()->getResult())[0]->Naziv;
               $dan = explode("-", $ponuda->DatumOd)[2];
               $mesec = explode("-", $ponuda->DatumOd)[1];
               $godina = explode("-", $ponuda->DatumOd)[0];
               $datum = $dan."/".$mesec."/".$godina;
               echo '<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">';
               echo "<a href='"; echo base_url("PrivatnikController/azurirajPonudu"); echo "'>";  
               echo '<div class="traveling-box" >';   
               echo '<i><img src="https://www.vivatravel.rs/photo/56518/p/16:10" alt="icon" style="width:250px;height:200px" style="object-fit: scale-down; margin-top: 10px" /></i>
               <h2>'.$mestoOd.' -> '.$mestoDo.'</h2>
               '.$datum.' <br><img src="'; echo base_url("images/{$prevoznoSredstvo}_transparent.png");
               echo '"'; echo ' height="35" width="35"><br>
               '.$ponuda->BrMesta.' <span><img src="'; echo base_url("images/stickman.png");
               echo '"'; echo ' height="15" width="15"></span>
               <h3>'.$ponuda->CenaKarte.'€</h3>';
               
               
               echo '<a href="'; echo base_url("PrivatnikController/azurirajPonudu"); echo '">'; 
               echo '<button class="dugme" style="float:none">Ažuriraj
                              ponudu</button></a>';

               echo '</div>';
               echo '</a>';
               echo '</div>';
               if ($i % 3 == 2){
                  $postavljeniDivovi = true;
                  echo '</div>';
                  echo '</div>';
               }
               else {
                  $postavljeniDivovi = false;
               }
            }
            if (!$postavljeniDivovi){
               echo '</div>';
               echo '</div>';
            }
            echo '</div>';
            echo '</div>';
            echo '</div>';

            echo '<div class="row" style="justify-content: center;">
            <div class="col-md-12">
               <button class="carousel-control-prev" type="button" data-bs-target="#postavljenePonude" data-bs-slide="prev" style="left: 30%;">
                  <span class="carousel-control-prev-icon" style="color: black !important; 
                                                               font-size: 50px;
                                                               background-image: unset;">&lt;</span>
               </button>
               <button class="carousel-control-next" type="button" data-bs-target="#postavljenePonude" data-bs-slide="next" style="left: 55%">
                  <span class="carousel-control-next-icon" style="color: black !important; 
                                                               font-size: 50px; 
                                                               background-image: unset;">&gt;</span>
               </button>
            </div>
         </div>';
         }
      ?>

         </div>
      </div>
   </div>
</section>