   <?php 
       session_start();
   ?>
   <!DOCTYPE html>
    <html class="registracija" lang="hr">
        <head>
            <title>Rezervacija kino ulaznica</title>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta charset="utf-8">

            <link rel="icon" href="../Slike/ikona.jpg" type="../Slike/image.gif" sizes="16x16">
            <link rel="stylesheet" type="text/css" href="../Css/Kino.css">
            <link rel="stylesheet" href="../css/bootstrap.min.css">

            <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
        </head>
        <body class="registracija">
            <audio id="myAudio">
                <source src="../Zvuk/Accessdenied.mp3" type="audio/mpeg">
            </audio>
            <header>
                <div clas="container">
                    <nav class="navbar .navbar-expand{-sm|-md|-lg|-xl} navbar-expand-lg navbar-light" style="background-color: #000000" id="registracija">
                        <a class="naslovnica_reg" href="index.php">Naslovna</a>
                        <a class="rezervacija_reg" href="Rezervacija.php">Rezerviraj</a>
                        <a class="login_reg bg-primary ml-auto" id="login" href="Login.php">Login</a>
                        <a class="active_reg ml-1" href="Registracija.php" id="aRegistracija">Registracija</a>
                    </nav>
            </header>
            <?php 
            if(isset($_SESSION['idKorisnika'])){
                echo' 
                <div style="margin:23% 0 0 33%; font-size:2.3vw; color:white";>
                    Uspješno ste se ulogirali, dobrodošli!
                </div>';

                header("refresh:3,url=Rezervacija.php");
            }
            else {
                echo'
                <div class=".container-fluid" id="unos_podataka">
                    <div class=".container-fluid text-primary border border-primary rounded" id="naslov" style="background-color: #000000; ">
                        Molimo unesite svoje podatke
                    </div>
                </div>
                <div class="podaci">
                    <form method="post" action="funkcije.php" id="tablica">
                        <div class="form-group text-white">
                            <label for="email">Email:</label>
                            <input type="email" name="email" class="form-control" id="email" placeholder="Email" required>
                        </div>
                        <div class="form-group text-white">
                            <label for="pwd">Password:</label>
                            <input type="password" name="password" class="form-control" id="pwd" placeholder="Password" minlength="3" maxlength="10" required>
                        </div>
                        <div class="container-fluid" id="button-submit">
                            <button type="submit" id="submit" class=".container-fluid btn btn-outline-primary text-sm-center" name="login-submit" style="width:auto">
                                <div id="registriraj_se_txt">
                                    Prijavi se
                                </div>
                            </button>
                        </div>
                    </form>
                </div>';
            }
            ?>
        </body>
</html>

<?php 
    global $sesija;

    if (isset($_SESSION['idKorisnika'])) {
        $sesija = 1;
    };

    echo'
    <script type="text/javascript">
    $(document).ready(function (){
        if ('. $sesija. ') {
            $("#login").remove();
            $("#aRegistracija").addClass("bg-primary ml-auto");
        }
    });
    </script>';
?>