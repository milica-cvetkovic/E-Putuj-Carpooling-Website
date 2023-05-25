<hr style="height:1px;border:none;color:#333;background-color:#333;">
<div class="back-image-message">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12" align="center" style="margin-top: 20px;">
                <h1 style="font-size: 3em;">Beograd -> Budimpešta</h1>
            </div>
            <div class="col-sm-4" style="margin-top: 30px;"><img src="https://www.vivatravel.rs/photo/56518/p/16:10" style="border: 5px solid white;"></div>
            <div class="col-sm-8" style="margin-top: 30px;">
                <table class="table">
                    <tr>
                        <td>Privatnik zex</td>
                        <td><span class="fa fa-star star-checked"></span>
                            <span class="fa fa-star star-checked"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                        </td>
                    </tr>
                    <tr>
                        <td>Datum polaska: 24/7/2023</td>
                        <td>Datum dolaska: 25/7/2023</td>
                    </tr>
                    <tr>
                        <td>Vreme polaska: 18:00</td>
                        <td>Vreme dolaska: 01:00</td>
                    </tr>
                    <tr>
                        <td>Broj slobodnih mesta:</td>
                        <td>5
                            <span>
                                <img src="<?php echo base_url('images/stickman.svg.png') ?>" height="25" width="25">
                                <span>
                    </tr>
                    <tr>
                        <td>Prevozno Sredstvo:</td>
                        <td>Automobil
                            <img src="<?php echo base_url('images/car_transparent.png') ?>" height="30" width="30">
                        </td>
                    </tr>
                    <tr>
                        <td>Rok za otkaz rezervacije</td>
                        <td>3 dana</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6"></div>
            <div class="col-sm-6">
                <h1 style="font-size: 2em;">Cena: 28€</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-8">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <button type="button" class="btn make-offer-btn open-button" style="position: relative; left: 20%;" onclick="openForm()">
                                Rezerviši
                            </button>
                            <div class="form-popup" id="myForm">
                                <table class="table table-borderless" style="opacity:95%;color:white;background-color: #004043;width:400px;height:500px;">
                                    <form class="form-container ">

                                        <tr>
                                            <td colspan='2'>
                                                <h1 class="boja" style="font-weight:bold;color:white;text-align:center;height:25%">Rezervacija
                                                    <hr />
                                                </h1>
                                            </td>
                                        </tr>
                                        <tr rowspan="2">
                                            <td width="50%"><label for="brtel"><b>Broj telefona</b></label></td>
                                            <td align="center"><input type="text" placeholder="065 123 456 7" style="width:100%;"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <hr />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label for="psw"><b>Broj mesta</b></label></td>
                                            <td align="center"><input type="number" id="psw" style="width:100%"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <hr />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="center"><button type="submit" class="btn " style="background-color: pink;width:100px;">Rezerviši</button></td>
                                            <td align="center"><button type="button" class="btn cancel" style="background-color: pink;width:100px" onclick="closeForm()">Odustani</button></td>
                                        </tr>
                                    </form>
                                </table>
                            </div>
                        </div>
                        <div class="col-sm-6" style="margin-bottom: 15px;">
                            <button type="button" class="btn make-offer-btn" style="position: relative; left: -10%;" onclick="openForm1()">
                                Kupi kartu
                            </button>
                            <div class="form-popup" id="myForm1">
                                <table class="table table-borderless" style="opacity:95%;color:white;background-color: #004043;width:400px;height:500px;">
                                    <form class="form-container ">

                                        <tr>
                                            <td colspan='2'>
                                                <h1 class="boja" style="font-weight:bold;color:white;text-align:center">Kupovina karte</h1hr />
                                                </h1>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="50%"><label for="brtel"><b>Broj telefona</b></label></td>
                                            <td align="center"><input type="text" placeholder="065 123 456 7" style="width:100%"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <hr />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label for="psw"><b>Broj mesta</b></label></td>
                                            <td align="center"><input type="number" id="psw" style="width:100%"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <hr />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label for="placanje"><b>Način plaćanja</b></label></td>
                                            <td align="center"> <select name="placanje" id="placanje" style="width:100%">
                                                    <option value="gotovina">Gotovina</option>
                                                    <option value="kartica">Kartica</option>
                                                </select>
                                        <tr>
                                            <td colspan="2">
                                                <hr />
                                            </td>
                                        </tr>
                                        </td>
                                        </tr>
                                        <tr>
                                            <td align="center"><button type="submit" class="btn " style="background-color: pink;width:100px;">Kupi</button></td>
                                            <td align="center"><button type="button" class="btn cancel" style="background-color: pink;width:100px" onclick="closeForm1()">Odustani</button></td>
                                        </tr>
                                    </form>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function openForm() {
        document.getElementById("myForm").style.display = "block";
    }

    function openForm1() {
        document.getElementById("myForm1").style.display = "block";
    }

    function closeForm() {
        document.getElementById("myForm").style.display = "none";
    }

    function closeForm1() {
        document.getElementById("myForm1").style.display = "none";
    }
</script>