<div class="main background">
   <div class="forma">
      <div class="polje" style="margin-left:10px">
         <?php
         if (!empty($poruka)) {
            echo "<div style='display: flex; justify-content: center; color: red'
                              <h5>{$poruka}</h5>
                           </div>";
         }
         ?>
         <form action="<?= base_url("{$kontroler}/izmenaProfila") ?>" enctype="multipart/form-data" method="post">
            <table>
               <tr>
                  <td> <label style="color: rgb(210, 62, 153);">Ime</label></td>
                  <td><label style="color: rgb(210, 62, 153);">Prezime &nbsp; </label></td>
               </tr>
               <tr>
                  <td> <input name="ime" class="ime" type="text" value="<?= session()->get("korisnik")->Ime ?>"> &nbsp; &nbsp; </td>
                  <td><input name="prezime" class="ime" type="text" value="<?= session()->get("korisnik")->Prezime ?>"></td>
               </tr>
               <tr>
                  <td> <label style="color: rgb(210, 62, 153);">Lozinka</label></td>
                  <td><label style="color: rgb(210, 62, 153);">E-mail &nbsp; </label></td>
               </tr>
               <tr>
                  <td> <input name="lozinka" class="ime" type="text"> &nbsp; &nbsp; </td>
                  <td><input name="email" class="ime" type="text" value="<?= session()->get("korisnik")->Email ?>"></td>
               </tr>
               <tr>
                  <td> <label style="color: rgb(210, 62, 153);">Broj telefona</label></td>
                  <td><label style="color: rgb(210, 62, 153);">Izaberite fotografiju</label></td>
               </tr>
               <tr>
                  <td> <input name="brojtelefona" class="ime" type="tel" value="<?= session()->get("korisnik")->BrTel ?>"> &nbsp; &nbsp; </td>
                  <td><input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
                     <input class="ime" placeholder="Any" type="file" name="slika">
                  </td>
               </tr>
            </table>

      </div>
      <div class="dugme-sacuvaj">
         <div style="margin-left: 260px;">
            <br>
            <input type="submit" value="Sačuvaj" class="btn " style="background-color: rgb(87, 203, 203);" style="color: aliceblue;"></td>
            <input type="submit" value="Obriši moj nalog" class="btn " style="background-color: rgb(87, 203, 203);" style="color: aliceblue;"></td>

         </div>
      </div>
      <div class="profilna" style="margin-left: 700px;
                ; width: 200px; height: 00px">
         <img style=" margin-top: 50px; border-style: dotted; border-color: beige; width: 200px; height: 300px" alt="" src="<?php if (session()->get("korisnik")->ProfilnaSlika == null) {
                                                                                                                                 echo base_url('images/profile.jpg');
                                                                                                                              } else {
                                                                                                                                 echo base_url('images/profilne/'.session()->get("korisnik")->ProfilnaSlika);
                                                                                                                              } ?>">
         </form>
      </div>
   </div>
</div>