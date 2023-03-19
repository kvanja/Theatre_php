<!DOCTYPE html>
    <html lang="hr">
    <head>
        <title>Rezervacija kino ulaznica</title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta charset="utf-8" />

        <link rel="stylesheet" type="text/css" href="../Css/Kino.css">
        <link rel="icon" href="../Slike/ikonica.jpg" type="image/gif" sizes="16x16">

        <link rel="stylesheet" href="../css/bootstrap.min.css">

        <script src="../kikiJS/Naslovna.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
        <script src="https://unpkg.com/react@15.5.4/dist/react.js"></script>
        <script src="https://unpkg.com/react-dom@15.5.4/dist/react-dom.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/babel-standalone/6.25.0/babel.min.js"></script>

        <script type="text/babel">
            var napraviNaslov = <h1 id="danas_prikazujemo">Ovaj tjedan prikazujemo</h1>
            var destination = document.getElementById("app");
            ReactDOM.render(napraviNaslov, destination);
        </script>
    </head>
    <body>
        <header>
            <div class="navbar">
                <a class="active" href="index.php">Naslovna</a>
                <a class="rezervacija" href="Rezervacija.php">Rezerviraj</a>
                <a class="registracija" href="Registracija.php">Registracija</a>
            </div>
        </header>
        <div class="bgimg" id="bg">
            <div id="app">React se još nije renderirao...</div>
            <h2 class="film" id="naziv_filma"></h2>
            <div class="film" id="link_filma">
            </div>
            <div>
                <img src="../Slike/strijelica-lijevo.png" alt="Prev" id="prev" style="margin-left: 48.4%;" />
                <img src="../Slike/strijelica-desno.png" alt="Next" id="next" />
                <form method="get" id="rez_sada" action="Rezervacija.php#row_tablica"></form>
            </div>
        </div>
    </body>
    </html>