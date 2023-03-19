<!DOCTYPE html>
<html class="registracija" lang="hr">
<head>
    <title>Rezervacija kino ulaznica</title>
    
    <link rel="icon" href="../Slike/ikonica.jpg" type="image/gif" sizes="16x16">
    <link rel="stylesheet" href="../Css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../Css/Kino.css">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="../kikiJS/Registracija.js" defer></script>

</head>
<body class="registracija">
    <audio id="myAudio">
        <source src="..Zvuk/Accessdenied.mp3" type="audio/mpeg">
    </audio>
    <header>
        <div clas="container">
            <nav class="navbar .navbar-expand{-sm|-md|-lg|-xl} navbar-expand-lg navbar-light" style="background-color: #000000" id="registracija">
                <a class="naslovnica_reg" href="index.php">Naslovna</a>
                <a class="rezervacija_reg" href="Rezervacija.php">Rezerviraj</a>
                <a class="active_reg bg-primary ml-auto" href="Registracija.php">Registracija</a>
            </nav>
        </div>
    </header>
    <div class="container-fluid" id="unos_podataka">
        <div class="container-fluid text-primary border border-primary rounded" id="naslov" style="background-color: #000000; ">Molimo unesite svoje podatke</div>
    </div>
    <div class="podaci">
        <form method="POST" action="funkcije.php" id="tablica">
            <div class="form-group text-white">
                <label for="ime">Ime:</label>
                <input type="text" name="ime" class="form-control" id="ime" placeholder="Ime"  minlength="2" maxlength="15"  >
            </div>
            <div class="form-group text-white">
                <label for="prezime">Prezime:</label>
                <input type="text" name="prezime" class="form-control" id="prezime" placeholder="Prezime" minlength="2" maxlength="15" >
            </div>
            <div class="form-group text-white">
                <label for="email">Email:</label>
                <input type="email" name="email" class="form-control" id="email" placeholder="Email" minlength="2" maxlength="40" >
            </div>
            <div class="form-group text-white">
                <label for="pwd">Password:</label>
                <input type="password" name="password" class="form-control" id="pwd" placeholder="Password" minlength="2" maxlength="15" >
            </div>
            <div class="checkbox text-white" id="zapamti_moje_podatke">
                <label id="zapamti_podatke"><input type="checkbox" id="zapamti_me"></label>
                <div id="zapamti_me_text">Zapamti moje podatke</div>
            </div>

            <div class="container-fluid" id="button-submit">
                <input type="hidden" value="registracija" name="method">
                <button type="submit" class=".container-fluid btn btn-outline-primary text-sm-center" id="submit" name="submit">
                    <div id="registriraj_se_txt">
                        Registriraj se
                    </div>
                </button>
            </div>
        </form>
    </div>
</body>
</html>