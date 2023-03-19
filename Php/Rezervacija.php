﻿<!DOCTYPE html>
<html class="rezervacija" lang="hr">
<head>
    <title>Rezervacija kino ulaznica</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <script src="../kikiJS/Rezervacija.js"></script>
    
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../Css/Kino.css">
    <link rel="icon" href="../Slike/ikonica.jpg" type="image/gif" sizes="16x16">
</head>
<body class="rezervacija">
    <audio id="myAudio">
        <source src="../Zvuk/Accessdenied.mp3" type="audio/mpeg">
    </audio>
    <header>
        <div clas="container-fluid">
            <nav class="navbar .navbar-expand{-sm|-md|-lg|-xl} navbar-expand-lg navbar-light" style="background-color: #000000" id="rezervacija">
                <a class="naslovnica_reg" id="rez_naslovna" href="index.php">Naslovna</a>
                <a class="active_reg" id="rez_active" href="Rezervacija.php">Rezerviraj</a>
                <a class="registracija ml-auto" id="rez_registracija" href="Registracija.php">Registracija</a>
            </nav>
        </div>
    </header>
    <div class="container-fluid" id="tjedan" style="height: 15%;">
        <div class="row" style="background-color:#000000;height: 100%;">
            <div class="col h-100 text-white bg-dark" id="col_dan" style="text-align:center;border:5%;border-style:dotted;border-color:#8c0707;border-radius:5%;margin:0 0.2% 0 0.2%;padding:0">
                <h5 class="dan" style="background-color:#000000; height:30%; margin:0;padding-top:1%;">Ponedjeljak</h5>
                <div class="row" id="dat_vri" style="margin:0%">
                    <div class="col" id="col_dat_vri" style="height:5%; background-color: #8c0707; color:black; text-align:center; padding-top:2%">
                        <h5 id="h_Monday"></h5>
                    </div>
                </div>
                <div class="row" id="row_naz_filma" style="margin:0%; height:42.3%;">
                    <div class="col" id="col_naz_filma" style="background-color:#000000;padding:0;">
                        <button class="btn-link" id="btn_Monday" style="height:100%; font-family:verdana; background-color:#000000;color:white;width:100%; letter-spacing:0.1em;font-size: 0.7vw"></button>
                    </div>
                </div>
            </div>
            <div class="col h-100 text-white bg-dark" id="col_dan" style="text-align:center;border:5%;border-style:dotted;border-color:#8c0707;border-radius:5%;margin:0 0.2% 0 0.2%;padding:0">
                <h5 class="dan" style="background-color:#000000; height:30%; margin:0;padding-top:1%;">Utorak</h5>
                <div class="row" id="dat_vri" style="margin:0%">
                    <div class="col" id="col_dat_vri" style="height:5%; background-color: #8c0707; color:black; text-align:center; padding-top:2%">
                        <h5 id="h_Tuesday"></h5>
                    </div>
                </div>
                <div class="row" id="row_naz_filma" style="margin:0%; height:42.3%;">
                    <div class="col" id="col_naz_filma" style="background-color:#000000;padding:0;">
                        <button class="btn-link" id="btn_Tuesday" style="height:100%; font-family:verdana; background-color:#000000;color:white;width:100%; letter-spacing:0.1em;font-size: 0.7vw"></button>
                    </div>
                </div>
            </div>
            <div class="col h-100 text-white bg-dark" id="col_dan" style="text-align:center;border:5%;border-style:dotted;border-color:#8c0707;border-radius:5%;margin:0 0.2% 0 0.2%;padding:0">
                <h5 class="dan" style="background-color:#000000; height:30%; margin:0;padding-top:1%;">Srijeda</h5>
                <div class="row" id="dat_vri" style="margin:0%">
                    <div class="col" id="col_dat_vri" style="height:5%; background-color: #8c0707; color:black; text-align:center; padding-top:2%">
                        <h5 id="h_Wednesday"></h5>
                    </div>
                </div>
                <div class="row" id="row_naz_filma" style="margin:0%; height:42.3%;">
                    <div class="col" id="col_naz_filma" style="background-color:#000000;padding:0;">
                        <button class="btn-link" id="btn_Wednesday" style="height:100%; font-family:verdana; background-color:#000000;color:white;width:100%; letter-spacing:0.1em;font-size: 0.7vw"></button>
                    </div>
                </div>
            </div>
            <div class="col h-100 text-white bg-dark" id="col_dan" style="text-align:center;border:5%;border-style:dotted;border-color:#8c0707;border-radius:5%;margin:0 0.2% 0 0.2%;padding:0">
                <h5 class="dan" style="background-color:#000000; height:30%; margin:0;padding-top:1%;">Četvrtak</h5>
                <div class="row" id="dat_vri" style="margin:0%">
                    <div class="col" id="col_dat_vri" style="height:5%; background-color: #8c0707; color:black; text-align:center; padding-top:2%">
                        <h5 id="h_Thursday"></h5>
                    </div>
                </div>
                <div class="row" id="row_naz_filma" style="margin:0%; height:42.3%;">
                    <div class="col" id="col_naz_filma" style="background-color:#000000;padding:0;">
                        <button class="btn-link" id="btn_Thursday" style="height:100%; font-family:verdana; background-color:#000000;color:white;width:100%; letter-spacing:0.1em; font-size: 0.7vw;"></button>
                    </div>
                </div>
            </div>
            <div class="col h-100 text-white bg-dark" id="col_dan" style="text-align:center;border:5%;border-style:dotted;border-color:#8c0707;border-radius:5%;margin:0 0.2% 0 0.2%;padding:0">
                <h5 class="dan" style="background-color:#000000; height:30%; margin:0;padding-top:1%;">Petak</h5>
                <div class="row" id="dat_vri" style="margin:0%">
                    <div class="col" id="col_dat_vri" style="height:5%; background-color: #8c0707; color:black; text-align:center; padding-top:2%">
                        <h5 id="h_Friday"></h5>
                    </div>
                </div>
                <div class="row" id="row_naz_filma" style="margin:0%; height:42.3%;">
                    <div class="col" id="col_naz_filma" style="background-color:#000000;padding:0;">
                        <button class="btn-link" id="btn_Friday" style="height:100%; font-family:verdana; background-color:#000000;color:white;width:100%; letter-spacing:0.1em;font-size: 0.7vw"></button>
                    </div>
                </div>
            </div>
            <div class="col h-100 text-white bg-dark" id="col_dan" style="text-align:center;border:5%;border-style:dotted;border-color:#8c0707;border-radius:5%;margin:0 0.2% 0 0.2%;padding:0">
                <h5 class="dan" style="background-color:#000000; height:30%; margin:0;padding-top:1%;">Subota</h5>
                <div class="row" id="dat_vri" style="margin:0%">
                    <div class="col" id="col_dat_vri" style="height:5%; background-color: #8c0707; color:black; text-align:center; padding-top:2%">
                        <h5 id="h_Saturday"></h5>
                    </div>
                </div>
                <div class="row" id="row_naz_filma" style="margin:0%; height:42.3%;">
                    <div class="col" id="col_naz_filma" style="background-color:#000000;padding:0;">
                        <button class="btn-link" id="btn_Saturday" style="height:100%; font-family:verdana; background-color:#000000;color:white;width:100%; letter-spacing:0.1em;font-size: 0.7vw"></button>
                    </div>
                </div>
            </div>
            <div class="col width-25 h-100 text-white bg-dark" id="col_dan_nedjelja" style="text-align:center;border:5%;border-style:dotted;border-color:#8c0707;border-radius:5%;margin:0 0.2% 0 0.2%;padding:0">
                <h5 class="dan_nedjelja" style="background-color:#000000; height:30%; margin:0;padding-top:1%;">Nedjelja</h5>
                <div class="row" id="dat_vri_nedjelja" style="margin:0%">
                    <div class="col" id="col_dat_vri_nedjelja" style="height:5%; background-color: #8c0707; color:black; text-align:center; padding-top:2%">
                        <h5 id="h_Sunday"></h5>
                    </div>
                </div>
                <div class="row" id="row_naz_filma_nedjelja" style="margin:0%; height:42.3%;">
                    <div class="col" id="col_naz_filma_nedjelja" style="background-color:#000000;padding:0;">
                        <button class="btn-link" id="btn_Sunday" style="height:100%; font-family:verdana; background-color:#000000;color:white;width:100%;padding:6% 3% 3% 3%; letter-spacing:0.1em; font-size: 0.7vw"></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid" id="rezervacija_pozadina">
        <row class="row" id="objašnjenje_tablice" style="width:70%;height: 15%;margin-top:2%; margin-right:30%;float:left;">
            <div class="row" id="legenda_slobodno" style="margin-left: 2%; width: 10%">
                <div class="col" id="slobodno" style="height:100%; padding:30% 0% 0% 0%;float:left;margin-left:5%;background-color: white; color:#000000;border-radius:50%;text-align: center; opacity:0.5">
                    <strong>
                        Slobodno
                    </strong>
                </div>
            </div>
            <div class="row" id="legenda_invalidi_slobodno" style="margin-left:2%;width:10%">
                <div class="col" id="invalidi_slobodno" style="height:100%; padding:25% 0% 0% 0%;float:left;margin-left:1%;background-color: #1259cc; color:white;border-radius:50%;text-align:center;font-size:0.8vw; opacity:0.5">
                    <strong>
                        Invalidi<br>
                        slobodno
                    </strong>
                </div>
            </div>
            <div class="row" id="legenda_zauzeto" style="margin-left:2%;width:10%">
                <div class="col" id="zauzeto" style="height:100%; padding:30% 0% 0% 0%;float:left;margin-left:1%;background-color:#8c0707; color:#000000;border-radius:50%;text-align: center; opacity:0.5">
                    <strong>
                        Zauzeto
                    </strong>
                </div>
            </div>
            <div class="row" id="legenda_odabrano" style="margin-left:2%;width:10%">
                <div class="col" id="odabrano" style="width:10%;height:100%; padding:30% 0% 0% 0%;float:left;margin-left:1%;background-color:#000000; color:white;border-radius:50%;text-align: center;border-style:solid;font-size: 0.8vw; opacity:0.5">
                    <strong>
                        Odabrano
                    </strong>
                </div>
            </div>
            <div class="row" id="legenda_ljubavno" style="margin-top:2%; margin-left:3%;width:14%">
                <div class="col" id="ljubavno_slobodno" style="width:17%;height:100%; padding:10% 0% 0% 0%;float:left;background-color:#8c0707; color:white;border-radius:50%;text-align:center;font-size: 0.8vw; opacity:0.5">
                    <strong>
                        Ljubavno<br>
                        slobodno
                    </strong>
                </div>
            </div>
            <div class="row" id="legenda_ljubavno" style="margin-top:2%; margin-left:3%;width:14%;">
                <div class="col" id="ljubavno_slobodno" style="width:17%;height:100%; padding:10% 0% 0% 0%;float:left;background-color:gray; color:white;border-radius:50%;text-align:center;font-size: 0.8vw; opacity:0.5">
                    <strong>
                        Ljubavno<br>
                        Zauzeto
                    </strong>
                </div>
            </div>
        </row>
        <row class="row" id="row_tablica" style="width: 45%; height:71%; margin:2% 0 0% 2%; float:left ">
            <col class="col" id="dvorana">
            <table class="tablica" width="100%">
                <thead>
                    <tr>
                        <th class="red text-white" id="red_txt" style="text-align: center;color:white; background-color:#8c0707; border-radius: 50%">RED</th>
                        <th class="platno" id="platno_txt" colspan="15" style="text-align: center; background-color:white; color:#000000; letter-spacing: 1em; opacity: .8 ">PLATNO</th>
                    </tr>
                </thead>
                <tbody align="center" id="tablica_rezervacije"></tbody>
            </table>
        </row>
        <row class="row" id="row_podaci" style="width: 48%; height:73%; margin:2% 2% 0% 3%; float:left ">
            <div class="col-xl-4 col-sm-2" id="poster_filma" style="height:100%;padding: 0; margin:0; float:left;">
                <img class="img-fluid" style="height:100% !important; width: 100% !important;" src="" id="poster_filma_slika">
            </div>
            <div class="col-xl-3 col-sm-2 ml-auto" id="rez_filma" style="height: 100%; width: 30% !important;float:left; padding:0; margin-left: 2%;">
                <div class="col text-center" id="col_naziv_filma" style="background-color: #000000; color:white; opacity: 0.8; font-size: 1.2vw"></div>
                <div class="col" id="dat_vri_cijena" style="height:15%; margin-top: 2%; float:left;background-color:#000000;float:left;color:white;opacity:0.5;font-size: 0.9vw; text-align: center; ">
                </div>
                <div class="col text-center" id="glumci" style="height:20%; float:left;margin-top: 2%; padding: 0;background-color: #000000;color:white; opacity: 0.5">

                </div>
                <div class="col text-center" id="opis_filma" style="height: 55.5%; margin-top:2%; background-color:#000000;float:left; font-size: 100%;color:white; opacity:0.5; font-size: 0.8vw;">

                </div>
            </div>
            <div class="col-xl-3 ml-auto" id="unos_podataka_rez">
                <div class="col xl-5" id="sing_up_pod" style="height:39%; margin: 50% 0%;">
                    <form group="/action_page.php" method="post" id="email_pass_rez">
                        <div class="form-group text-center" id="email_rez" style="color:white; font-size:1vw">
                            <label for="email" id="label_email">Email:</label>
                            <input class="form-control" type="ime" id="email" placeholder="Email">
                        </div>
                        <div class="form-group text-center" id="pass_rez" style="color:white; font-size:1vw">
                            <label for="pass" id="label_pass">Password:</label>
                            <input class="form-control" type="password" id="pass_rez" placeholder="Password">
                        </div>
                        <button type="submit" id="rezerviraj_btn" class="btn btn-default" style="height: 5%; width: 100%;margin-top:7%;background-color:#8c0707;border-style:dashed; border-color: white; font-size: 0.9vw; ">Rezerviraj</button>
                    </form>
                </div>

            </div>
        </row>
    </div>

    <script>
        var tablica = ' ';
        for (i = 1; i <= 10; i++) {
            tablica += '<tr class="text-white">';
            tablica += '<td style="color:white; background-color:#8c0707; border-radius: 50%;"><strong>' + i + '.</strong></td>';
            for (j = 1; j <= 15; j++) {
                if (i == 1) {
                    if ((j == 1) || (j == 2) || (j == 14) || (j == 15)) {
                        tablica += '<td class="special_seat_free">' + j + '</td>';
                    }
                }

                if (i==10) {
                    if ((j==1) || (j==7) || (j==12)) {
                    tablica += '<td class="love_seat_free" colspan="2"><strong>' + j + '</strong></td>';
                    } else {
                        if (j < 13) {
                            tablica += '<td class="seat_free">'+ j + '</td>';
                        }
                    }
                } else {
                    if((i == 1) && (j == 1) || (i == 1) && (j == 2) || (i == 1) && (j == 14) || (i == 1) && (j == 15))
                    continue;
                    tablica += '<td class="seat_free" style="padding:12px">' + j + '</td>';
                }
            }
            tablica += '</tr>';
        }

        $("#tablica_rezervacije").append(tablica);

        //hendlanje klik eventa
        $('td').click(function () {
        var colIndex = $(this).parent().children().index($(this));
        var rowIndex = $(this).parent().parent().children().index($(this).parent()) + 1;
        var myClass = $(this).attr("class");

        if (myClass == "seat_free sjedalo_zauzeto" || myClass == "special_seat_free sjedalo_zauzeto" || myClass == "love_seat_free ljubavno_sjedalo_zauzeto") {
            document.getElementById("myAudio").play();

        } else {
            $(".sjedalo_odabrano").removeClass("sjedalo_odabrano");

            //mijenjaj samo slobodna mjesta i ona koja su trenutno odabrana, nisu još zapisana u tablicu
            if (colIndex > 0 && (myClass == "seat_free" || myClass == "seat_free sjedalo_odabrano" || myClass == "love_seat_free" || myClass == "love_seat_free sjedalo_odabrano" || myClass == "special_seat_free" || myClass == "special_seat_free sjedalo_odabrano")) {
                $(this).toggleClass("sjedalo_odabrano");
            }
        }
        });

        function validateEmail(email) {
            var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(String(email).toLowerCase());
        }

        $('#rezerviraj_btn').click(function () {
            var odabrano = $(".sjedalo_odabrano");
            var redak = $(odabrano).parent();
            var sjedaloBr = $(redak).children().index($(odabrano));
            var redakBr = $(redak).parent().children().index($(redak)) + 1;
            var email = $("#email").val();
            var pass = $("#pass_rez input").val();
            var idRaspo = $('.odabrano').attr('id_raspo');
            var URL = `http://localhost/Projekt/Php/funkcije.php?method=RezervirajSjedalo&email=${email}&pass=${pass}&sjedalo=${sjedaloBr}&red=${redakBr}&idRaspo=${idRaspo}`;

            if ($(odabrano).length == 0) {
                document.getElementById("myAudio").play();
                alert("Molimo odaberite sjedalo!");
                return;
            }
            if (email == "") {
                document.getElementById("myAudio").play();
                alert("Molimo unesite email!");
                return;
            }
            if (!validateEmail(email)) {
                document.getElementById("myAudio").play();
                alert("Molimo unesite ispravan format emaila!");
                return;
            }
            if (pass == "") {
                document.getElementById("myAudio").play();
                alert("Molimo unesite password!");
                return;
            }
            if (pass.length > 10) {
                document.getElementById("myAudio").play();
                alert("Password ne smije biti duži od 10 znakova!");
                return;
            }
            $.ajax({
                type: "GET",
                url: URL,
                data: JSON.stringify({ }),
                dataType: "json",
                contentType: "application/json",
                async: false,
                cache: false,
                success: function (r) {
                    alert("Uspješno ste rezervirali sjedalo broj: " + sjedaloBr + " u redu broj: " + redakBr + ".");
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                }
            });
        });

        $('.btn-link').click(function () {
            $('.odabrano').removeClass('odabrano');
            $(this).addClass('odabrano');
            idRaspo = $(this).attr("id_raspo");

            dohvatiDetaljeFilma();
            dohvatiDvoranu(idRaspo);
        });

        var idRaspo = 0;
        function dohvatiDetaljeFilma() {
            var btn = $(".odabrano");

            $('#poster_filma_slika').attr("src", $(btn).attr('poster_link'));
            $('#col_naziv_filma').text($(btn).attr('naziv'));
            $('#dat_vri_cijena').html($(btn).attr('dat_vri_prikaz') + "<br />" + $(btn).attr('cijena'));
            $('#glumci').text($(btn).attr('uloge'));
            $('#opis_filma').text($(btn).attr('opis'));
        };

        $(document).ready(function () {
            dohvatiTjedniRaspo();

            if (idRaspo == 0) {
                var btn = $(".btn-link").first();
                $(btn).addClass('odabrano');
                idRaspo = $(btn).attr("id_raspo");
            }

            dohvatiDetaljeFilma();
            dohvatiDvoranu(idRaspo);
        });
    </script>

</body>
</html>