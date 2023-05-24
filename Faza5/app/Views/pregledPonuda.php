<!-- Milica Cvetkovic 2020/0003 -->

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
        <form class="main-form" action="<?= site_url("GostController/pretragaPonuda") ?>" method="post">
            <h3>Pretraži ponudu</h3>
            <div class="row">
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
                            <label>Prevozno sredstvo</label>
                            <select class="form-control" name="prevoznoSredstvo">
                                <option>Automobil</option>
                                <option>Autobus</option>
                                <option>Brod</option>
                            </select>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
                            <label>Mesto do</label>
                            <select class="form-control" name="mestoDo">
                                <option>Subotica</option>
                                <option>Beograd</option>
                                <option>Novi Sad</option>
                                <option>Niš</option>
                            </select>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
                            <label>Mesto od</label>
                            <select class="form-control" name="mestoOd">
                                <option>Subotica</option>
                                <option>Beograd</option>
                                <option>Novi Sad</option>
                                <option>Niš</option>
                            </select>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
                            <label>Minimalna cena</label>
                            <input class="form-control" placeholder="0" type="number" name="minimalnaCena">
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
                            <label>Maksimalna cena</label>
                            <input class="form-control" placeholder="0" type="number" name="maksimalnaCena">
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
                            <label> Broj putnika</label>
                            <input class="form-control" placeholder="0" type="number" name="brojPutnika">
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-3 col-sm-6 col-12">
                            <label>Datum do</label>
                            <input class="form-control" placeholder="Any" type="date" name="datumDo">
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-3 col-sm-6 col-12">
                            <label>Datum od</label>
                            <input class="form-control" placeholder="Any" type="date" name="datumOd">
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-3 col-sm-6 col-12">
                            <label>Vreme do</label>
                            <input class="form-control" placeholder="Any" type="time" name="vremeDo">
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-12">
                            <label>Vreme od</label>
                            <input class="form-control" placeholder="Any" type="time" name="vremeOd">
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <a href="#" style="background-color: rgb(6, 47, 60);" onclick="this.closest('form').submit();return false;">Pretraži</a>
                </div>
            </div>
        </form>
    </div>

    <?php
    // popravi kad dodajes stranice
    for($i = 0, $j = 0; $i<3 && $j < count($ponude); $i++){
        echo "<div class='row' style='margin-top: 40px;'>";
        $count = 3;
        while($count != 0 && $j < count($ponude)){
            echo "<div class='col-xl-4 col-lg-4 col-md-6 col-sm-12'>
                        <a href='prikaz_ponude_gost.html'>
                            <div class='traveling-box'>"; // ne valja
            echo "<i><img src='https://www.vivatravel.rs/photo/56518/p/16:10' alt='icon' style='object-fit: scale-down; margin-top: 10px; width: 250px; height: 250px;' /></i>";
            echo "<h2>{$ponude[$j]->MestoOd} - {$ponude[$j]->MestoDo}</h2>";
            echo "<p>Datum od: {$ponude[$j]->DatumOd} <br/> Datum do: {$ponude[$j]->DatumDo}</p>";
            echo "<br><img src='";
            echo base_url('images/car_transparent.png');
            echo "' height='35' width='35'><br>";
            echo "Broj sedišta: {$ponude[$j]->BrMesta}";
            echo "<span><img src='";
            echo base_url('images/stickman.svg.png'); // promena ikone na osnovu odgovarajuceg prevoznog sredstva - DODATI
            echo "' height='15' width='15'></span>";
            echo "<h3>{$ponude[$j]->CenaKarte} din.</h3>";
            echo "</div></a></div>";
            $j++;
            $count--;
        }
        
        echo "</div>";
    }
    
    ?>
    

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