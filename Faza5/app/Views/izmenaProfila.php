<div class="main background">
   <div class="forma">
      <div class="polje" style="margin-left:10px">
      <form action="<?= base_url("KorisnikController/izmenaProfila")?>" method="post">
         <table>
            <tr>
               <td> <label style="color: rgb(210, 62, 153);">Ime</label></td>
               <td><label style="color: rgb(210, 62, 153);">Prezime &nbsp; </label></td>
            </tr>
            <tr>
               <td> <input name="ime" class="ime" type="text"> &nbsp; &nbsp; </td>
               <td><input name="prezime" class="ime" type="text"></td>
            </tr>
            <tr>
               <td> <label style="color: rgb(210, 62, 153);">Lozinka</label></td>
               <td><label style="color: rgb(210, 62, 153);">E-mail &nbsp; </label></td>
            </tr>
            <tr>
               <td> <input name="lozinka" class="ime" type="text"> &nbsp; &nbsp; </td>
               <td><input name ="email" class="ime" type="text"></td>
            </tr>
            <tr>
               <td> <label style="color: rgb(210, 62, 153);">Broj telefona</label></td>
            </tr>
            <td> <input  name="brojtelefona" class="ime" type="tel"> &nbsp; &nbsp; </td>
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
         <img style=" margin-top: 50px; border-style: dotted; border-color: beige; width: 200px; height: 300px" src="<?php echo base_url('images/profile.jpg') ?>" alt="">
      </form>
      </div>
   </div>
</div>