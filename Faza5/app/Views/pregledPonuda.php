<div class="back-image-inbox">
    <div class="row">
        <div class="col-md-12 ">
            <div class="titlepage" style="margin-top: 20px;">
                <h2>Ponude</h2>
                <span> </span>
            </div>
        </div>
    </div>
    <div class="container">
        <form class="main-form">
            <h3>Pretraži ponudu</h3>
            <div class="row">
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
                            <label>Prevozno sredstvo</label>
                            <select class="form-control" name="Any">
                                <option>Automobil</option>
                                <option>Autobus</option>
                                <option>Brod</option>
                            </select>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
                            <label>Mesto do</label>
                            <select class="form-control" name="Any">
                                <option>Subotica</option>
                                <option>Beograd</option>
                                <option>Novi Sad</option>
                                <option>Niš</option>
                            </select>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
                            <label>Mesto od</label>
                            <select class="form-control" name="Any">
                                <option>Subotica</option>
                                <option>Beograd</option>
                                <option>Novi Sad</option>
                                <option>Niš</option>
                            </select>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
                            <label>Minimalna cena</label>
                            <input class="form-control" placeholder="0" type="text" name="00.0">
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
                            <label>Maksimalna cena</label>
                            <input class="form-control" placeholder="0" type="text" name="00.0">
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
                            <label> Broj putnika</label>
                            <input class="form-control" placeholder="0" type="text" name="00.0">
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-3 col-sm-6 col-12">
                            <label>Datum do</label>
                            <input class="form-control" placeholder="Any" type="date" name="Any">
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-3 col-sm-6 col-12">
                            <label>Datum od</label>
                            <input class="form-control" placeholder="Any" type="date" name="Any">
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-3 col-sm-6 col-12">
                            <label>Vreme do</label>
                            <input class="form-control" placeholder="Any" type="time" name="Any">
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-12">
                            <label>Vreme od</label>
                            <input class="form-control" placeholder="Any" type="time" name="Any">
                        </div>


                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <a href="pregled_ponuda_gost.html" style="background-color: rgb(6, 47, 60);">Pretraži</a>
                </div>


            </div>
        </form>
    </div>

    <!-- prikaz ponuda-->
    <!-- prvi red ponuda-->
    <div class="row" style="margin-top: 40px;">
        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
            <a href="prikaz_ponude_gost.html">
                <div class="traveling-box">
                    <i><img src="https://www.vivatravel.rs/photo/56518/p/16:10" alt="icon" style="object-fit: scale-down; margin-top: 10px; width: 250px; height: 250px;" /></i>
                    <h2>Beograd -> Budimpesta</h2>
                    24/7/2023 <br><img src="<?php echo base_url('images/car_transparent.png') ?>" height="35" width="35"><br>
                    5 <span><img src="<?php echo base_url('images/stickman.svg.png') ?>" height="15" width="15"></span>
                    <h3>28€</h3>
                </div>
            </a>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
            <a href="prikaz_ponude_gost.html">
                <div class="traveling-box">
                    <i><img src="https://media.danubeogradu.rs/2014/06/beograd-na-vodi.jpg" alt="icon" style="object-fit: scale-down; margin-top: 10px; width: 250px; height: 250px;" /></i>
                    <h2>Prag -> Beograd</h2>
                    8/9/2023 <br><img src="<?php echo base_url('images/car_transparent.png') ?>" height="35" width="35"><br>
                    2 <span><img src="<?php echo base_url('images/stickman.svg.png') ?>" height="15" width="15"></span>
                    <h3>45€</h3>
                </div>
            </a>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
            <a href="prikaz_ponude_gost.html">
                <div class="traveling-box">
                    <i><img src="https://balkanfun.travel/sites/default/files/styles/putovanje_velika_845x450/public/berlin-sumrak-grad.jpg?itok=yBwuHer8" alt="icon" style="object-fit: scale-down; margin-top: 10px; width: 250px; height: 250px;" /></i>
                    <h2>Bec -> Berlin</h2>
                    10/5/2023 <br><img src="<?php echo base_url('images/car_transparent.png') ?>" height="35" width="35"><br>
                    1 <span><img src="<?php echo base_url('images/stickman.svg.png') ?>" height="15" width="15"></span>
                    <h3>50€</h3>
                </div>
            </a>
        </div>
    </div>

    <!-- drugi red ponuda-->
    <div class="row" style="margin-top: 40px;">
        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
            <a href="prikaz_ponude_gost.html">
                <div class="traveling-box">
                    <i><img src="https://upload.wikimedia.org/wikipedia/commons/0/0c/Subotica_Town_Hall_View_2.jpg" alt="icon" style="object-fit: scale-down; margin-top: 10px; width: 250px; height: 250px;" /></i>
                    <h2>Beograd -> Subotica</h2>
                    25/4/2023 <br><img src="<?php echo base_url('images/bus_transparent.png') ?>" height="35" width="35"><br>
                    20 <span><img src="<?php echo base_url('images/stickman.svg.png') ?>" height="15" width="15"></span>
                    <h3>10€</h3>
                </div>
            </a>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
            <a href="prikaz_ponude_gost.html">
                <div class="traveling-box">
                    <i><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/6f/Nisgradnocu.jpg/293px-Nisgradnocu.jpg" alt="icon" style="object-fit: scale-down; margin-top: 10px; width: 250px; height: 250px;" /></i>
                    <h2>Paracin -> Nis</h2>
                    8/9/2023 <br><img src="<?php echo base_url('images/car_transparent.png') ?>" height="35" width="35"><br>
                    3 <span><img src="<?php echo base_url('images/stickman.svg.png') ?>" height="15" width="15"></span>
                    <h3>11€</h3>
                </div>
            </a>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
            <a href="prikaz_ponude_gost.html">
                <div class="traveling-box">
                    <i><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/cf/Novi_Sad_-_Vojvodina.jpg/640px-Novi_Sad_-_Vojvodina.jpg" alt="icon" style="object-fit: scale-down; margin-top: 10px; width: 250px; height: 250px;" /></i>
                    <h2>Nis -> Novi Sad</h2>
                    5/4/2023 <br><img src="<?php echo base_url('images/car_transparent.png') ?>" height="35" width="35"><br>
                    1 <span><img src="<?php echo base_url('images/stickman.svg.png') ?>" height="15" width="15"></span>
                    <h3>24€</h3>
                </div>
            </a>
        </div>
    </div>

    <!-- treci red ponuda-->
    <div class="row" style="margin-top: 40px;">
        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12" style="margin-bottom: 40px;">
            <a href="prikaz_ponude_gost.html">
                <div class="traveling-box" style="margin-top: 5px;">
                    <i><img src="https://media.danubeogradu.rs/2015/02/bec-1.jpg" alt="icon" style="object-fit: scale-down; margin-top: 10px; width: 250px; height: 250px;" /></i>
                    <h2>Novi Sad -> Bec</h2>
                    28/9/2023 <br><img src="<?php echo base_url('images/car_transparent.png') ?>" height="35" width="35"><br>
                    4 <span><img src="<?php echo base_url('images/stickman.svg.png') ?>" height="15" width="15"></span>
                    <h3>32€</h3>
                </div>
            </a>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
            <a href="prikaz_ponude_gost.html">
                <div class="traveling-box">
                    <i><img src="http://sacr3-files.s3-eu-west-1.amazonaws.com/_processed_/csm_Bratislavsky%2520hrad_94d492b936.jpg" alt="icon" style="object-fit: scale-down; margin-top: 10px; width: 250px; height: 250px;" /></i>
                    <h2>Bec -> Bratislava</h2>
                    8/9/2023 <br><img src="<?php echo base_url('images/boat_transparent.png') ?>" height="35" width="35"><br>
                    13 <span><img src="<?php echo base_url('images/stickman.svg.png') ?>" height="15" width="15"></span>
                    <h3>52€</h3>
                </div>
            </a>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
            <a href="prikaz_ponude_gost.html">
                <div class="traveling-box">
                    <i><img src="https://lidertravel.rs/wp-content/uploads/2015/03/Pariz-avionom-1-3.jpg" alt="icon" style="object-fit: scale-down; margin-top: 10px; width: 250px; height: 250px;" /></i>
                    <h2>Rim -> Pariz</h2>
                    6/8/2023 <br><img src="<?php echo base_url('images/car_transparent.png') ?>" height="35" width="35"><br>
                    3 <span><img src="<?php echo base_url('images/stickman.svg.png') ?>" height="15" width="15"></span>
                    <h3>72€</h3>
                </div>
            </a>
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