<!DOCTYPE html>
<html lang="en">

<head>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <title>ePutuj|Korisnik</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="stylesheet" href="<?php echo base_url('anja/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('anja/css/style.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('anja/css/responsive.css') ?>">
    <link rel="icon" href="<?php echo base_url('images/fevicon.png') ?>" type="image/gif" />
    <link rel="stylesheet" href="<?php echo base_url('anja/css/jquery.mCustomScrollbar.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('anja/css/owl.carousel.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('anja/css/owl.theme.default.min.css') ?>">

    <link rel="stylesheet" href="<?php echo base_url('zeljko/css/style.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('lana/css/pozadina.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('lana/css/korisnik.css') ?>">
</head>

<body class="main-layout">
    <header>
        <div class="header">
            <div class="header_white_section">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="header_information" style="height: 60px;">
                                <table>

                                    <!-- INFO -->
                                    <tr>
                                        <td><img src="<?php echo base_url('images/1.png') ?>" alt="#" /> Bulevar Kralja Aleksandra 73, Beograd
                                            &nbsp; &nbsp;</td>
                                        <td><img src="<?php echo base_url('images/2.png') ?>" alt="#" /> +381 65 432 1010 &nbsp; &nbsp;</td>
                                        <td><img src="<?php echo base_url('images/3.png') ?>" alt="#" /> eputuj@gmail.com &nbsp; &nbsp;</td>
                                        <td>
                                            <div class="dropdown dugme" style="background-color: white; top: 0; position: absolute;">
                                                <button class="btn btn-primary" style="background-color: rgb(242, 243, 223); margin-left: 50px;" data-bs-toggle="collapse" data-bs-target="#profil_lista">
                                                    <img src="<?php echo base_url('images/user.png') ?>" alt="#" style="width: 0.75cm;" /> <span style="color: black;">ivkoviclana</span>
                                                </button>
                                                <div id="profil_lista" class="collapse">
                                                    <ul class="dropdown-menu">
                                                        <li><a href="korisnik1.html" class="dropdown-item">Izmeni
                                                                profil</a></li>
                                                        <li><a href="index.html" class="dropdown-item">Log out</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- NAVIGACIJA -->
            <div class="container">
                <div class="row">
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col logo_section">
                        <div class="full">
                            <div class="center-desk">
                                <div class="logo"> <a href="privatnikPocetna.html"><img src="<?php echo base_url('images/logo.jfif') ?>" style="height:50%; width:50%" alt="#"></a> </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9">
                        <div class="menu-area">
                            <div class="limit-box">
                                <nav class="main-menu">
                                    <ul class="menu-area-main">

                                        <li class="active"><a href="indexkorisnik.html">Početna</a></li>
                                        <li><a href="#contact">Kontakt</a></li>
                                        <li> <a href="inbox_korisnik.html">Inbox <span class="badge bg-danger"><?php if($brPoruka>0)echo $brPoruka;?></span></a> </li>
                                        <li> <a href="indexkorisnik.html#about">O nama</a> </li>
                                        <li><a href="pregled_ponuda.html">Pretraži ponude</a></li>
                                        <li><a href="trazenje_voznje.html">Zatraži vožnju</a></li>
                                        <li><a href="KorisnikController/rezervacije">Moje rezervacije</a></li>
                                        <li><a href="spinthewheel.html">Točak sreće</a></li>
                                        <li><a href="KorisnikController/report">Report</a></li>

                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>