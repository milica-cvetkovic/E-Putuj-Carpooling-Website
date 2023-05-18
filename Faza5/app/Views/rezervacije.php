<div class="back-image-inbox">
    <div class="row">
        <div class="col-md-12 ">
            <div class="titlepage" style="margin-top: 20px;">
                <h2>Moje rezervacije</h2>
                <span> </span>
            </div>
        </div>
    </div>
    <div class="row" style="margin-top: 40px;">
        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
            <a href="#">
                <div class="traveling-box">
                    <i><img src="https://www.vivatravel.rs/photo/56518/p/16:10" alt="icon" style="object-fit: scale-down; margin-top: 10px; width: 250px; height: 250px;" /></i>
                    <h2>Beograd -> Budimpesta</h2>
                    24/7/2023 <br><img src="<?php echo base_url('images/car_transparent.png') ?>" height="35" width="35"><br>
                    5 <span><img src="<?php echo base_url('images/stickman.svg.png') ?>" height="15" width="15"></span>
                    <h3>28€</h3>
                </div>
            </a>
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 kupovina">
                <button type="button" class="btn make-offer-btn open-button" onclick="openForm()" style="position: relative; left: 100%; margin-right: -55px;">Kupi</button>
                <div class="form-popup" id="myForm" style="bottom:0%">
                    <table class="table table-borderless" style="opacity:95%;color:white;background-color: #6181aa;width:400px;">
                        <form class="form-container ">

                            <tr>
                                <td colspan='2'>
                                    <h1 class="boja" style="font-weight:bold;color:white;">Rezervacija
                                        <hr />
                                    </h1>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="brtel"><b>Broj telefona</b></label></td>
                                <td><span id="brtel">060123456</span></td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <hr />
                                </td>
                            </tr>
                            <tr>
                                <td><label for="psw"><b>Broj mesta</b></label></td>
                                <td><span id="psw">5</span></td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <hr />
                                </td>
                            </tr>
                            <tr>
                                <td><label for="cena"><b>Iznos</b></label></td>
                                <td> <span id="cena">1500€</span></td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <hr />
                                </td>
                            </tr>
                            <tr>
                                <td><label for="placanje"><b>Način plaćanja</b></label></td>
                                <td> <select name="placanje" id="placanje">
                                        <option value="gotovina">Gotovina</option>
                                        <option value="kartica">Kartica</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <hr />
                                </td>
                            </tr>
                            <tr>
                                <td text-align="center"><button type="submit" class="btn " style="background-color: pink;width:100px;">Kupi</button></td>
                                <td text-align="center"><button type="button" class="btn cancel" style="background-color: pink;width:100px" onclick="closeForm()">Odustani</button></td>
                            </tr>
                        </form>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
            <a href="#">
                <div class="traveling-box">
                    <i><img src="https://media.danubeogradu.rs/2014/06/beograd-na-vodi.jpg" alt="icon" style="object-fit: scale-down; margin-top: 10px; width: 250px; height: 250px;" /></i>
                    <h2>Prag -> Beograd</h2>
                    8/9/2023 <br><img src="<?php echo base_url('images/car_transparent.png') ?>" height="35" width="35"><br>
                    2 <span><img src="<?php echo base_url('images/stickman.svg.png') ?>" height="15" width="15"></span>
                    <h3>45€</h3>
                </div>
            </a>
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 kupovina">
                <button type="button" class="btn make-offer-btn open-button" onclick="openForm()" style="position: relative; left: 100%; margin-right: -55px;">Kupi</button>
            </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
            <a href="#">
                <div class="traveling-box">
                    <i><img src="https://balkanfun.travel/sites/default/files/styles/putovanje_velika_845x450/public/berlin-sumrak-grad.jpg?itok=yBwuHer8" alt="icon" style="object-fit: scale-down; margin-top: 10px; width: 250px; height: 250px;" /></i>
                    <h2>Bec -> Berlin</h2>
                    10/5/2023 <br><img src="<?php echo base_url('images/car_transparent.png') ?>" height="35" width="35"><br>
                    1 <span><img src="<?php echo base_url('images/stickman.svg.png') ?>" height="15" width="15"></span>
                    <h3>50€</h3>
                </div>
            </a>
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 kupovina">
                <button type="button" class="btn make-offer-btn open-button" onclick="openForm()" style="position: relative; left: 100%; margin-right: -55px;">Kupi</button>

            </div>
        </div>
    </div>

    <!--dugmad za pregled stranica-->
    <div class="row justify-content-center" style="margin-top: 40px; text-align: center;">
        <div class="col-xl-2">
            <ul class="pagination" style="margin-bottom: 40px; display: flex;">
                <li class="page-item"><a class="page-link make-offer-btn" href="#">Prošla</a></li>
                <li class="page-item"><a class="page-link make-offer-btn" href="#">1</a></li>
                <li class="page-item"><a class="page-link make-offer-btn" href="#">2</a></li>
                <li class="page-item"><a class="page-link make-offer-btn" href="#">3</a></li>
                <li class="page-item"><a class="page-link make-offer-btn" href="#">Sledeća</a></li>
            </ul>
        </div>
    </div>

</div>

<script>
    function openForm() {
        document.getElementById("myForm").style.display = "block";
    }

    function closeForm() {
        document.getElementById("myForm").style.display = "none";
    }
</script>