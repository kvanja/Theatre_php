<?php
include 'dbh.php';
switch($_SERVER['REQUEST_METHOD']){
	case 'GET': 
        if (isset($_GET['method'])){
            switch ($_GET['method']) {
                case 'rezervacija_k':
                    $var = $_GET['q'];
                    $rows= rezervacija($var);
                    break;
                case 'rezervacija1':
                    $rows=  rezervacija($var);
                    signUp();
					break;
					case 'DohvatiTjedniRaspo':
						$rezervacija = new Rezervacije();
						$rezervacija->DohvatiTjedniRaspo();
					case 'DohvatiDvoranuFilma':
						$rezervacija = new Rezervacije();
						if(isset($_GET['id'])){
							$id = $_GET['id'];
							$rezervacija->DohvatiDvoranuFilma($id); 
						}
					break;
					case 'RezervirajSjedalo':
						$rezervacija = new Rezervacije();
						if(isset($_GET['email']) /*&& isset($_GET['pass']) && isset($_GET['sjedalo']) && isset($_GET['red']) && isset($_GET['idRaspo'])*/){
							$email = $_GET['email'];
							$pass = $_GET['pass'];
							$sjedalo = $_GET['sjedalo'];
							$red = $_GET['red'];
							$idRaspo = $_GET['idRaspo'];
							$rezervacija->RezervirajSjedalo($email,$pass,$sjedalo,$red,$idRaspo);      /* $email,$password,$sjedalo,$red,$idRaspo*/
						}
					break;

					case 'DohvatiTrailerFilma':
						$filmovi = new Filmovi();
						$filmovi->DohvatiTrailerFilma();
			}
        }
    break;
	case 'POST':
            if(isset($_POST['submit'])){
                switch($_POST['method']){
                    case 'registracija':
                        $ime = $_POST['ime'];
                        $prezime = $_POST['prezime'];
                        $email = $_POST['email'];
						$password = $_POST['password'];
						/*----------------------KORISNICI----------------------*/
						$korisnik = new Korisnici();
						$korisnik->RegistrirajSe($ime,$prezime,$email,$password);
						//$korisnik->UpdateImena('kvanja@vub.hr','kristijan',1);
						//$korisnik->UpdatePrezimena('kvanja@vub.hr', 'vanja',1);
						//$korisnik->UpdateEmaila('kvanja@vub.hr','kvanja1@vub.hr',1);
						//$korisnik->UpdateKorisnika("vanjakristijan02@gmail.com","ime","prezime","pass","vanjakristijan01@gmail.com");
						//$korisnik->BrisanjeKorisnika("anajitsjirk@vub.hr");
						//$korisnik->ThanosSnap();
						//$korisnik->DohvatiPodatke("korisnici");
						//$korisnik->UpdateImena("kvanja@vub.hr","kristijan","1");	
						/*-----------------------FILMOVI-----------------------*/
						//$film = new Filmovi();
						//$film->ubaciFilm("kvanja@vub.hr","Ford vs Ferrari","triler","190","https://cdn.flickeringmyth.com/wp-content/uploads/2019/10/Ford-v-Ferrari-IMAX-poster-600x751.jpg","fvf","American car designer Carroll Shelby and driver Ken Miles battle corporate interference, the laws of physics and their own personal demons to build a revolutionary race car for Ford and challenge Ferrari at the 24 Hours of Le Mans in 1966.","Christian Bale, Matt Damon,Neka luda ženska itd");
						//$film->updateFilma("kvanja@vub.hr","NStar wars:The last jedi","Star wars:The last jedi","zanrFilma1","","swBro","swBro");			
						//$film->UpdateNaziva("ipazur@vub.hr","IT","Warcraft",1);
						//$film->ObrisiFilm("kvanja@vub.hr","bla12345");
						//$film->DohvatiPodatke("filmovi");
						//$film->DohvatiTrailerFilma();
						/* -----------------------RASPORED----------------------*/
						//$raspored = new Raspored();
						//$raspored->ProvjeriUnesenoVriPrikaz("18:30");
						//$raspored->ProvjeriRaspo("20.11.2019.","19:00");
						//$raspored->UnesiRaspored("kvanja@vub.hr","Avengers:Endgame","20.11.2019.","12:00","3D");
						//$raspored->UpdateIdFilma("kvanja@vub.hr",1,"Hans solo",1);
						//$raspored->UpdateDatVriPrikaz("kvanja@vub.hr",2,"10.12.2019.","19:30",1);
						//$raspored->Update2D3D("kvanja@vub.hr",5,"3d",1);
						//$raspored->UpdateRasporeda("kvanja@vub.hr",8,"","20.11.2019.","18:30",""); /*$ovlasteniEmail,$idRaspo(upisat Naziv filma),$idFilma,$datPrikaz,$vriPrikaz,$dim2D3D*/
						//$raspored->BrisanjeRaspo("kvanja@vub.hr","5");
						//$raspored->DohvatiPodatke("raspored");
						/*--------------------REZERVACIJE------------------------*/
						//$rezervacija = new Rezervacije();
						//$rezervacija->NapraviPraznuDvoranu("kvanja@vub.hr", 2);
						break; 
					}
				}  
			break;

    default:
}

class Korisnici{
	private $ime;
	private $prezime;
	private $email;
	private $email_domena;
	private $password;
	private $ovlasti;
	private $id_creaUpda;
	private $vrijeme;
	private $stmt;

	public function __construct(){
		$this->vrijeme = date('Y-m-d H:i:s');
		$this->ovlasti= 1;
		$this->id_creaUpda = 1;
	}

	public function ProvjeraInputa(){
		if(empty($this->ime) || empty($this->prezime) || empty($this->email) || empty($this->password)){
			header("Location:./Registracija.php?error=praznapolja&ime=$this->ime &prezime=$this->prezime &email=$this->email &password=?");
			exit();
		}
		else if(!preg_match("/^[a-zščćžđA-ZŠČĆŽĐ]*$/",$this->ime)){
		header("Location:./Registracija.php?error=nepravilnoIme=$this->ime");
		exit();
		}
		else if(!preg_match("/^[a-zščćžđA-ZŠČĆŽĐ]*$/",$this->prezime)){
		header("Location:./Registracija.php?error=nepravilnoPrezime=$this->prezime");
		exit();
		}
		else if(!filter_var($this->email,FILTER_VALIDATE_EMAIL)){/*provjerava je li Email ispravno unesen*/
		header("Location:./Registracija.php?error=neispravanEmail");
		exit();
		}
	}

	private function provjeriSqliKonekciju($sql){
		require "dbh.php";
		global $conn;
		$this->stmt = mysqli_stmt_init($conn);
		if(!mysqli_stmt_prepare($this->stmt,$sql)){
			header("Location:./Registracija.php?SqlError");
			exit();
		}
	}

	protected function PostojiLiKorisnik($email){	 /*provjerava postoji li uneseni email već u bazi*/
		$sqlSelect = "SELECT email FROM korisnici WHERE email = ?";
		$this->provjeriSqliKonekciju($sqlSelect);
		mysqli_stmt_bind_param($this->stmt, "s" , $email);
		mysqli_stmt_execute($this->stmt);
		mysqli_stmt_store_result($this->stmt);/*uzima dobiveni rezultat iz baze i pohranjuje u varijablu $stmt*/
		$resaultCheck = mysqli_stmt_num_rows($this->stmt); /*provjerava koliko rezultata ima u varijabli $stmt*/
		if($resaultCheck > 0 ){
			return true;			
		}
		return false;
	}

	public function RegistrirajSe($ime,$prezime,$email,$password){
		$this->ime = $ime;
		$this->prezime = $prezime;
		$this->email = $email;
		$this->email_domena = explode('@', $email)[1];
		$this->password = $password;
		$this->vrijeme = date('Y-m-d H:i:s');
		$this->ovlasti= 1;
		$this->id_creaUpda = 1;

		$sqlInsert = "INSERT INTO korisnici(ime,prezime,email,email_domena,password,ovlasti,created,updated,id_created,id_updated)
		VALUES			   (?,?,?,?,?,?,?,?,?,?)";
		$this->ProvjeraInputa(); 
		if(!$this->PostojiLiKorisnik($this->email)){
			$this->provjeriSqliKonekciju($sqlInsert);
			$hashed_pwd = password_hash($password, PASSWORD_DEFAULT);/*radi sigurnosti password se hashira, dobivaju se random brojevi/slova*/
			mysqli_stmt_bind_param($this->stmt,"sssssissii",$this->ime,$this->prezime,$this->email,$this->email_domena,$hashed_pwd,$this->ovlasti,$this->vrijeme,$this->vrijeme,$this->id_creaUpda,$this->id_creaUpda);
			mysqli_stmt_execute($this->stmt);
			header("Location:./Registracija.php?Uspješna&registracija!");
			exit();			
		} else {
			$this->ObavijestZauzetEmail($this->email);
		}
	}

	private function ObavijestZauzetEmail($email){
		header("Location:./Registracija.php?error=emailAlreadyTaken!&email=$email");
		exit();
	}

	protected function ObavijestKorNePostoji($email){
		header("Location:./Registracija.php?error=KorisnikNePostoji&email=$email");
		exit();
	}

		
	protected function jeLiBroj($broj){
		if(!is_numeric($broj)){
			header("Location:./Registracija.php?$broj&mora&biti&broj!");
			exit();
		}
	}
	
	protected function provjeraJedanIliDva($broj){
		$this->jeLiBroj($broj);
		if($broj != 1 && $broj != 2){
			header("Location:./Registracija.php?$broj&mora&biti&1&ili&2");
			exit();
		}
	}

	protected function provjeraDuzineUpdatea($update){
		if(strlen($update) < 2){
			header("Location:./Registracija.php?update&mora&biti&veci&od&jednog&znaka");
			exit();
		}
	}

	private function SqlUpdate($update,$email,$sqlUpdate,$jedanIliDva){ /*funkcija prima i izvršava SQL naredbu*/
		$this->provjeraJedanIliDva($jedanIliDva);
		if($this->PostojiLiKorisnik($email)){
			$this->provjeriSqliKonekciju($sqlUpdate);
			mysqli_stmt_bind_param($this->stmt,"ssis",$update,$this->vrijeme,$this->id_creaUpda,$email);
			mysqli_stmt_execute($this->stmt);	
			if($jedanIliDva == 1){
				header("Location:./Registracija.php?Uspješan&update!");
				exit();	
			}
		} else {
			$this->ObavijestKorNePostoji($email);
		}
	}

	public function UpdateKorisnika($stariEmail,$ime,$prezime,$password,$noviEmail){ /*Update cjelokupnog korisnika, funkcija prima parametre koji se unose u druge funkcije koje se izvršavaju*/
		$jedanIliDva = 2;
		if($ime != ""){															 /* ako jedan od parametara nije zadan korisnik će se i dalje updateat ali taj dio koji nije zadan neće*/
		$this->UpdateImena($stariEmail,$ime,$jedanIliDva);
		}							 /* jedanIliDva varijabla se odnosi na to hoće li biti pozvana samo jedna funkcija ili više funkcija(zbog vraćanja na file i url ispisa za uspejšan update)*/
		if($prezime != ""){
		$this->UpdatePrezimena($stariEmail,$prezime,$jedanIliDva);
		}
		if($password){
		$this->UpdatePassworda($stariEmail,$password,$jedanIliDva);
		}
		if($noviEmail != ""){
		$this->UpdateEmaila($stariEmail,$noviEmail,$jedanIliDva);
		header("Location:./Registracija.php?Uspješan&update!");
		}
		exit();
	}
	

	public function UpdateImena($email,$ime,$jedanIliDva){ /*prima email korisnika i ime na koje se želi promijeniti*/
		$sqlUpdate = "UPDATE korisnici SET ime = ?, updated = ?, id_updated = ? WHERE email = ?"; 
		$this->SqlUpdate($ime,$email,$sqlUpdate,$jedanIliDva);
	}

	public function UpdatePrezimena($email,$prezime,$jedanIliDva){ /*prima email korisnika i prezime koje se želi promijeniti*/
		$sqlUpdate = "UPDATE korisnici set prezime = ?, updated = ?, id_updated = ? WHERE email = ?"; 
		$this->SqlUpdate($prezime,$email,$sqlUpdate,$jedanIliDva);
	}

	public function UpdatePassworda($email,$password,$jedanIliDva){ /*prima email korisnika i password koju se želi promijeniti*/
		$hashed_pwd = password_hash($password, PASSWORD_DEFAULT);
		$sqlUpdate = "UPDATE korisnici set password = ?, updated = ?, id_updated = ? WHERE email = ?"; 
		$this->SqlUpdate($hashed_pwd,$email,$sqlUpdate,$jedanIliDva);
	}

	public function UpdateEmaila($stariEmail,$noviEmail,$jedanIliDva){ /*prima stari email korisnika i novi email u koji se želi promijeniti*/
		if($this->PostojiLiKorisnik($noviEmail)){
			$this->ObavijestZauzetEmail($noviEmail);
		} else {
			$sqlUpdate = "UPDATE korisnici set email = ?, updated = ?, id_updated = ? WHERE email = ?"; 
			$this->SqlUpdate($noviEmail,$stariEmail,$sqlUpdate,$jedanIliDva);
		}			
	}

	private function SqlDelete($email,$sqlDelete){ /*funkcija prima i izvršava SQL naredbu*/
		$this->provjeriSqliKonekciju($sqlDelete);
		mysqli_stmt_bind_param($this->stmt,"s",$email);
		mysqli_stmt_execute($this->stmt);	
		header("Location:./Registracija.php?Korisnik&$email&uspjesno&obrisan!");
		exit();
	}

	public function BrisanjeKorisnika($email){
		if($this->PostojiLiKorisnik($email)){
			$sqlDelete = "DELETE FROM korisnici WHERE email = ?";
			$this->SqlDelete($email,$sqlDelete);
		} else {
		$this->ObavijestKorNePostoji($email);
		}
	}

	public function DohvatiPodatke($podaci){
		$sqlSelect = "SELECT * FROM $podaci WHERE id != ?";
		$id = "NULL";

		$this->provjeriSqliKonekciju($sqlSelect);
			mysqli_stmt_bind_param($this->stmt,'s', $id);
			mysqli_stmt_execute($this->stmt);
			$rezultat = mysqli_stmt_get_result($this->stmt);
			while($red = mysqli_fetch_assoc($rezultat)){
				$rows[] = $red;
			}
			echo json_encode($rows,JSON_UNESCAPED_UNICODE);
		}
}

class Filmovi extends Korisnici{
	private $ovlasteniEmail;
	private $nazivFilma;
	private $zanrFilma;
	private $trajFilmaUMin;
	private $posterLink;
	private $trailerLink;
	private $vrijeme;
	private $ovlastiEmaila;
	private $stmt;
	private $opis;
	private $uloge;

	public function __construct(){
		$this->vrijeme = $this->vrijeme = date('Y-m-d H:i:s');
	}

	private function provjeriSqliKonekciju($sql){
		require "dbh.php";
		global $conn;
		$this->stmt = mysqli_stmt_init($conn);
		if(!mysqli_stmt_prepare($this->stmt,$sql)){
			header("Location:./Registracija.php?SqlError");
			exit();
		}
	}
	protected function ovlastiEmaila($ovlasteniEmail){ /*provjerava je li email ispravno unesen, postoji li email te koje su njegove ovlasti*/
		if(!filter_var($ovlasteniEmail,FILTER_VALIDATE_EMAIL)){
			header("Location:./Registracija.php?Molimo&unesite&ispravan&email");
			exit();
		} else {
			$sqlSelect = "SELECT ovlasti FROM korisnici WHERE email = ?";
			if(parent::PostojiLiKorisnik($ovlasteniEmail)){
				$this->provjeriSqliKonekciju($sqlSelect);
					mysqli_stmt_bind_param($this->stmt,"s",$ovlasteniEmail);
					mysqli_stmt_execute($this->stmt);
					$rezultat1 = mysqli_stmt_get_result($this->stmt);
					while($red = mysqli_fetch_assoc($rezultat1)){
						$rowsOvlasti[] = $red;
					}
					$this->ovlastiEmaila = $rowsOvlasti[0] ["ovlasti"]; 
					if($this->ovlastiEmaila < 2){
						header("Location:./Registracija.php?Niste&ovlasteni&za&ovu&radnju!");
						exit();
					}
					return $ovlstiSu = $rowsOvlasti[0] ['ovlasti']; 
			} else {
				parent::ObavijestKorNePostoji($ovlasteniEmail);
			}
		}
	}

	private function provjeriTrajFilma($broj){
		parent::jeLiBroj($broj);
		if($broj < 120){
			header("Location:./Registracija.php?Trajanje&filma&mora&biti&veće&od&120&min!");
			exit();
		} else if($broj > 240){
			header("Location:./Registracija.php?Trajanje&filma&mora&biti&manje&od&240&min!");
			exit();
		}
	}

	private function ProvjeraUniquePolja($nazivFilma,$posterLink,$trailerLink){/*provjerava postoje li već naziv,link trailera ili link postera, ako postoje izbaciti će error*/
		$sqlSelect = "SELECT naziv,poster_link,trailer_link FROM filmovi WHERE id != ?";
		$id = 0;
		$this->provjeriSqliKonekciju($sqlSelect);
		mysqli_stmt_bind_param($this->stmt,"i",$id);
		mysqli_stmt_execute($this->stmt);
		$rezultat = mysqli_stmt_get_result($this->stmt);
		while($red = mysqli_fetch_assoc($rezultat)){
			$rows[] = $red;
		}
		for($i = 0; $i < count($rows); $i++){
			if($rows[$i] ["naziv"] == $this->nazivFilma){
				header("Location:./Registracija.php?Naziv&filma&vec&postoji!");
				exit();
			}
			else if($rows[$i] ["poster_link"] == $this->posterLink){
				header("Location:./Registracija.php?Link&postera&vec&postoji!");
				exit();
			}
			else if($rows[$i] ["trailer_link"] == $this->trailerLink){
				header("Location:./Registracija.php?Link&trailera&vec&postoji!");
				exit();
			}
		}
	}

	public function ubaciFilm($ovlasteniEmail,$nazivFilma,$zanrFilma,$trajFilmaUMin,$posterLink,$trailerLink,$opis,$uloge){ 
		if($nazivFilma && $zanrFilma && $posterLink && $trailerLink != ""){ /*Provjerava jesu li sva polja unesena*/
			$this->provjeriTrajFilma($trajFilmaUMin);
			$this->ovlasteniEmail = $ovlasteniEmail;
			$this->nazivFilma = $nazivFilma;
			$this->zanrFilma = $zanrFilma;
			$this->trajFilmaUMin = $trajFilmaUMin;
			$this->posterLink = $posterLink;
			$this->trailerLink = $trailerLink;
			$this->opis = $opis;
			$this->uloge = $uloge;
		} else {
			header("Location:./Registracija.php?Molimo&unesite&sva&polja");
			exit();
		}
		$this->ovlastiEmaila($this->ovlasteniEmail);
		$this->ProvjeraUniquePolja($this->nazivFilma,$this->posterLink,$this->trailerLink);
		$sqlInsert = "INSERT INTO filmovi(naziv,zanr,trajanje,poster_link,trailer_link,opis,uloge,created,updated,id_created,id_updated)
								VALUES(?,?,?,?,?,?,?,?,?,?,?)";
		$this->provjeriSqliKonekciju($sqlInsert);
		mysqli_stmt_bind_param($this->stmt,'ssissssssii',$this->nazivFilma,$this->zanrFilma,$this->trajFilmaUMin,$this->posterLink,$this->trailerLink,$this->opis,$this->uloge,$this->vrijeme,$this->vrijeme,$this->ovlastiEmaila,$this->ovlastiEmaila);
		mysqli_stmt_execute($this->stmt);
		header("Location:./Registracija.php?Uspjesno&unesen&film!");
	}

	protected function PostojiLiFilm($film){ /*provjerava postoji li samo taj film, potrebno za brisanje i updateanje filma*/		
		$sqlSelect = "SELECT naziv FROM filmovi WHERE naziv = ?";
		$this->provjeriSqliKonekciju($sqlSelect);
		mysqli_stmt_bind_param($this->stmt,"s",$film);
		mysqli_stmt_execute($this->stmt);
		mysqli_stmt_store_result($this->stmt);
		$resaultCheck = mysqli_stmt_num_rows($this->stmt); 
		if($resaultCheck > 0 ){
			return true;			
		} else {
			return false;
		}
	}

	protected function SqlUpdate($ovlasteniEmail,$stariPodatak,$noviPodatak,$sqlUpdate,$jedanIliDva){ /*funkcija prima i izvršava SQL naredbu*/
		if($noviPodatak != ""){
			$this->ovlastiEmaila($ovlasteniEmail);
			if(!$this->PostojiLiFilm($stariPodatak)){
				header("Location:./Registracija.php?Film&ne&postoji!");
				exit();
			} else {
				parent::provjeraJedanIliDva($jedanIliDva);
				$this->provjeraDuzineUpdatea($noviPodatak);
				$this->provjeriSqliKonekciju($sqlUpdate);
				mysqli_stmt_bind_param($this->stmt,"ssis",$noviPodatak,$this->vrijeme,$this->ovlastiEmaila,$stariPodatak);
				mysqli_stmt_execute($this->stmt);	
				if($jedanIliDva == 1){
					header("Location:./Registracija.php?Uspješan&update&filma!");
					exit();
				}
			}
		}
	}

	public function updateFilma($ovlasteniEmail,$stariNazivFilma,$nazivFilma,$zanrFilma,$trajFilmaUMin,$posterLink,$trailerLink){
		$this->nazivFilma = $nazivFilma;
		$this->posterLink = $posterLink;
		$this->trailerLink = $trailerLink;
		$this->ProvjeraUniquePolja($nazivFilma,$posterLink,$trailerLink);
		$jedanIliDva = 2;															 /* ako jedan od parametara nije zadan korisnik će se i dalje updateat ali taj dio koji nije zadan neće*/							 /* jedanIliDva varijabla se odnosi na to hoće li biti pozvana samo jedna funkcija ili više funkcija(zbog vraćanja na file i url ispisa za uspejšan update)*/
		$this->UpdateZanra($ovlasteniEmail,$stariNazivFilma,$zanrFilma,$jedanIliDva);
		$this->UpdateTrajFilmaUMin($ovlasteniEmail,$stariNazivFilma,$trajFilmaUMin,$jedanIliDva);
		$this->UpdateTrailerLink($ovlasteniEmail,$stariNazivFilma,$trailerLink,$jedanIliDva);
		$this->UpdatePosterLink($ovlasteniEmail,$stariNazivFilma,$posterLink,$jedanIliDva);
		$this->UpdateNaziva($ovlasteniEmail,$stariNazivFilma,$nazivFilma,$jedanIliDva);
		$this->UpdateUloga($ovlasteniEmail,$naziv,$noveUloge,$jedanIliDva);
		$this->UpdateOpisa($ovlasteniEmail,$naziv,$noviOpis,$jedanIliDva);
		header("Location:./Registracija.php?Uspješan&update!");
		exit();
	}

	public function UpdateNaziva($ovlasteniEmail,$stariNaziv,$noviNaziv,$jedanIliDva){ /*nije dovršeno, treba se doraditi, provjera postoji li stari naziv u bazi i postoji li novi naziv u bazi*/
		$sqlUpdate = "UPDATE filmovi SET naziv = ?, updated = ?, id_updated = ? WHERE naziv = ?"; 
		$this->SqlUpdate($ovlasteniEmail,$stariNaziv,$noviNaziv,$sqlUpdate,$jedanIliDva);
	}

	public function UpdateZanra($ovlasteniEmail,$naziv,$noviZanr,$jedanIliDva){
		$sqlUpdate = "UPDATE filmovi SET zanr = ?, updated = ?, id_updated = ? WHERE naziv = ?"; 
		$this->SqlUpdate($ovlasteniEmail,$naziv,$noviZanr,$sqlUpdate,$jedanIliDva);
	}

	public function UpdateTrajFilmaUMin($ovlasteniEmail,$naziv,$trajFilmaUMin,$jedanIliDva){
		if($trajFilmaUMin != ""){
		$this->provjeriTrajFilma($trajFilmaUMin);
		$sqlUpdate = "UPDATE filmovi SET trajanje = ?, updated = ?, id_updated = ? WHERE naziv = ?"; 
		$this->SqlUpdate($ovlasteniEmail,$naziv,$trajFilmaUMin,$sqlUpdate,$jedanIliDva);
		}
	}

	public function UpdatePosterLink($ovlasteniEmail,$naziv,$posterLink,$jedanIliDva){
		$sqlUpdate = "UPDATE filmovi SET poster_link = ?, updated = ?, id_updated = ? WHERE naziv = ?"; 
		$this->SqlUpdate($ovlasteniEmail,$naziv,$posterLink,$sqlUpdate,$jedanIliDva);
	}

	public function UpdateTrailerLink($ovlasteniEmail,$naziv,$trailerLink,$jedanIliDva){
		$sqlUpdate = "UPDATE filmovi SET trailer_link = ?, updated = ?, id_updated = ? WHERE naziv = ?"; 
		$this->SqlUpdate($ovlasteniEmail,$naziv,$trailerLink,$sqlUpdate,$jedanIliDva);
	}

	public function UpdateUloga($ovlasteniEmail,$naziv,$noveUloge,$jedanIliDva){
		$sqlUpdate = "UPDATE filmovi SET uloge = ?, updated = ?, id_updated = ? WHERE naziv = ?";
		$this->SqlUpdate($ovlasteniEmail,$naziv,$noveUloge,$jedanIliDva);
	}

	public function UpdateOpisa($ovlasteniEmail,$naziv,$noviOpis,$jedanIliDva){
		$sqlUpdate = "UPDATE filmovi SET opis = ?, updated = ?, id_updated = ? WHERE naziv = ?";
		$this->SqlUpdate($ovlasteniEmail,$naziv,$noviOpis,$jedanIliDva);
	}


	private function SqlDelete($ovlasteniEmail,$naziv,$sqlDelete){ /*funkcija prima i izvršava SQL naredbu*/
		$this->ovlastiEmaila($ovlasteniEmail);
		if(!$this->PostojiLiFilm($naziv)){
			header("Location:./Registracija.php?Film&ne&postoji!");
			exit();
		} else {
			$this->provjeriSqliKonekciju($sqlDelete);
			mysqli_stmt_bind_param($this->stmt,"s",$naziv);
			mysqli_stmt_execute($this->stmt);	
			header("Location:./Registracija.php?film&$naziv&uspjesno&obrisan!");
			exit();	
		}
	}

	public function ObrisiFilm($ovlasteniEmail,$naziv){
		$sqlDelete = "DELETE FROM filmovi WHERE naziv = ?";
		$this->SqlDelete($ovlasteniEmail,$naziv,$sqlDelete);
	}

	protected function DohvatiIdFilma($nazivFilma){
		$sqlSelect = "SELECT id FROM filmovi WHERE naziv = ?";
		if(!$this->PostojiLiFilm($nazivFilma)){
			header("Location:./Registracija.php?Film&ne&postoji!");
			exit();
		}
		$this->provjeriSqliKonekciju($sqlSelect);
		mysqli_stmt_bind_param($this->stmt,"s",$nazivFilma);
		mysqli_stmt_execute($this->stmt);
		$rezultat = mysqli_stmt_get_result($this->stmt);
		while($red = mysqli_fetch_assoc($rezultat)){
			$rows[] = $red;
		}
		return $id = $rows[0] ['id'] ;
	}

	public function DohvatiTrailerFilma(){
		$sqlSelect = "	SELECT
		fi.naziv,
		fi.trailer_link
	FROM
		filmovi fi
	JOIN
		raspored ra ON fi.id = ra.id_filma
	WHERE
		ra.dat_prikaz BETWEEN FIRST_DAY_OF_WEEK(now()) AND LAST_DAY_OF_WEEK(now()) ORDER BY ra.dat_prikaz";
		require "dbh.php";
		$result = $conn->query($sqlSelect);
		$i = 0;
		if ($result->num_rows > 0) {
			while($red = $result->fetch_assoc()) {
				$rows[] = $red;
				$url = $rows[$i] ['trailer_link']; /* dohvaca sve urlove youtubea iz objekta */
				$obj[$i] = ['naziv' => $rows[$i]['naziv']]; /* dohvaca nazive filmova iz objekta rows i popunjava ih u objekt obj */
				parse_str(parse_url($url, PHP_URL_QUERY),$obj[$i] ['trailer_link']); /* parsira string od urla, makiva sve i ostavlja samo youtube VIDEO_ID */
				$i += 1; /* povecava varijablu za jedan da bi se mogao ubaciti novi podatak u objekt obj */
			}
		} else {
			header("Location:./Rezervacija.php?Nema&filmova&za&ovaj&tjedan");
			exit();
		}
		echo json_encode($obj,JSON_UNESCAPED_UNICODE);
	}
}


class Raspored extends Filmovi{
	private $nazivFilma;
	private $idFilma;
	private $datPrikaz;
	private $vriPrikaz;
	private $dim2D3D;
	private $cijena;
	private $vrijeme;
	private $ovlastiEmaila;
	private $stmt;

	public function __construct(){
		$this->vrijeme = $this->vrijeme = date('Y-m-d H:i:s');
	}

	private function provjeriSqliKonekciju($sql){
		require "dbh.php";
		global $conn;
		$this->stmt = mysqli_stmt_init($conn);
		if(!mysqli_stmt_prepare($this->stmt,$sql)){
			header("Location:./Registracija.php?SqlError");
			exit();
		}
	}
	private function ProvjeriUneseniDatum($datum){
		$dan = substr($datum,0,2);
		$mjesec = substr($datum,3,2);
		$godina = substr($datum,6,4);

		if(strpos($dan, ".")){ /*provjerava sadrzi li dan . na drugom mjestu stringa i baca grešku, ako ne onda postavlja dan na 3 char*/
			header("Location:./Registracija.php?ispravno&unesite&dan!");
			exit();
		} else {
			$dan = substr($datum,0,3);
			if(substr($dan,2,1) != "."){
				header("Location:./Registracija.php?dan&mora&imati&tocku&na&kraju!");
				exit();
			}		
		}
 
		if(strpos($mjesec, ".")){ /*provjerava sadrzi li mjesec . na drugom mjestu stringa i baca grešku, ako ne onda postavlja mjesec na 3 char*/
			header("Location:./Registracija.php?ispravno&unesite&mjesec!");
			exit();
		} else {
			$mjesec = substr($datum,3,3);
			if(substr($mjesec,2,1) != "."){
				header("Location:./Registracija.php?mjesec&mora&imati&tocku&na&kraju!");
				exit();
			}	
		}

		if(strpos($godina,".")){
			header("Location:./Registracija.php?ispravno&unesite&godinu!");
			exit();
		} else {
			$godina = substr($datum,6,5);
			if(substr($godina,4,1) != "."){
				header("Location:./Registracija.php?godina&mora&imati&tocku&na&kraju!");
				exit();
			}
		}

		if($mjesec < date("m")){
			header("Location:./Registracija.php?mjesec&ne&smije&biti&&manji&od&" . date("m") . "!");
			exit();			
		}

		if($dan < date("d") && $mjesec == date("m")){
			header("Location:./Registracija.php?dan&ne&smije&biti&&manji&od&" . date("d") . "!");
			exit();			
		}

		if($godina < date("Y")){ /*provjerava je li var godina manja od trenutne godine*/
			header("Location:./Registracija.php?Godina&ne&smije&biti&&manja&od&" . date("Y") . "!");
			exit();
		} else if($godina > date("Y") + 1){ /* provjerava je li var godina veća od trenutne godine + 1*/
			header("Location:./Registracija.php?Godina&ne&može&biti&veća&od&" . (date("Y") + 1) . "!");
			exit();
		}

	   if(!checkDate($mjesec,$dan,$godina)){ /*provjerava cjelokupan datum, ako nije ispravno unesen baca grešku*/
			header("Location:./Registracija.php?Upisite&ispravan&datum!");
			exit();
	   }

		$this->datPrikaz = $godina . $mjesec . $dan;
	}

	public function ProvjeriUnesenoVriPrikaz($vrij){
		$sati = substr($vrij,0,2);
		$minute = substr($vrij,3,2);

		parent::jeLiBroj($sati);
		$sati = substr($vrij,0,3);
		parent::jeLiBroj($minute);

		if($sati > 24 || $sati < 0){
			header("Location:./Registracija.php?Sati&ne&mogu&biti&manji&od&0&i&veci&od&24");
			exit();
		}

		if($minute > 60 || $minute < 0){
			header("Location:./Registracija.php?Minute&ne&mogu&biti&manje&od&0&i&vece&od&60");
			exit();
		}

		$this->vriPrikaz = $sati . $minute;
	}

	private function provjeriUnos2D3D($dim2D3D){ /*Provjerava je li film 2D ili 3D ako nije uneseno ništa ili ako je uneseno samo 2 unosi se 2D film i automatski postavlja cijena na 30, ako je uneseno 3 postavlja se na 3D film i 35 kn ulaz*/
		if(!$dim2D3D || $dim2D3D == 2){
			$dim2D3D = "2D";
		} else if($dim2D3D == 3){
			$dim2D3D = "3D";
		}
		if(is_string($dim2D3D)){
			if(strtoupper($dim2D3D) != "2D" && strtoupper($dim2D3D) != "3D"){
				header("Location:./Registracija.php?Dimenzija($dim2D3D)&mora&biti&2D&ili3D!");
				exit();				
			} else {
				$this->dim2D3D = $dim2D3D;
				if($dim2D3D == "2D"){
					$this->cijena = 30;	
				} else {
					$this->cijena = 35;
				}
			}
		} else {
			header("Location:./Registracija.php?Dimenzija($dim2D3D)&mora&biti&string&ili2&ili3!");
			exit();
		}
	}

	private function ProvjeriRaspo($datPrikaz,$vriPrikaz){ /*provjerava postoji li već raspored za uneseni datum i vrijeme*/
		$this->ProvjeriUneseniDatum($datPrikaz);
		$this->ProvjeriUnesenoVriPrikaz($vriPrikaz);
		$sqlSelect = "SELECT dat_prikaz,vri_prikaz FROM raspored WHERE id != ?";
		$id = 0;		
		$this->provjeriSqliKonekciju($sqlSelect);
		mysqli_stmt_bind_param($this->stmt,"i",$id);
		mysqli_stmt_execute($this->stmt);
		$rezultat = mysqli_stmt_get_result($this->stmt);
		while($red = mysqli_fetch_assoc($rezultat)){
			$rows[] = $red;
		}
		for($i = 0; $i < count($rows);$i++){
			$BDatPrikaz = $rows[$i] ['dat_prikaz'];
			$dan = substr($BDatPrikaz,8,2);
			$mjesec = substr($BDatPrikaz,5,2);
			$godina = substr($BDatPrikaz,0,4);
			$BDatPrikaz = $dan . '.' . $mjesec . '.' . $godina . '.';
			$BVriPrikaz = $rows[$i] ['vri_prikaz'];
			$sati = substr($BVriPrikaz,0,2);
			$minute = substr($BVriPrikaz,3,2);
			$BVriPrikaz = $sati . ':' . $minute;
			if($BVriPrikaz == $vriPrikaz && $BDatPrikaz == $datPrikaz){
				header("Location:./Registracija.php?vec&postoji&prikazivanje&$datPrikaz&u&$vriPrikaz");
				exit();
			}			
		}
	}

	public function UnesiRaspored($ovlasteniEmail,$nazivFilma,$datPrikaz,$vriPrikaz,$dim2D3D){ /*provjerava unesene paremetre pomoću drugih metoda, ako je sve uredu unosi raspored prikazivanja*/
		$this->ovlastiEmaila = parent::ovlastiEmaila($ovlasteniEmail);
		if(!parent::PostojiLiFilm($nazivFilma)){
			header("Location:./Registracija.php?Film&ne&postoji!");
			exit();
		} else {
			$this->nazivFilma = $nazivFilma;
			$this->ProvjeriRaspo($datPrikaz,$vriPrikaz);
			$this->provjeriUnos2D3D($dim2D3D);
			$this->idFilma = parent::DohvatiIdFilma($this->nazivFilma);
			$sqlInsert = "INSERT INTO raspored(id_filma,dat_prikaz,vri_prikaz,dimenzija,cijena,created,updated,id_crea,id_upda)
										VALUES(?,?,?,?,?,?,?,?,?)";
			$this->provjeriSqliKonekciju($sqlInsert);
			mysqli_stmt_bind_param($this->stmt,"issssssii",$this->idFilma,$this->datPrikaz,$this->vriPrikaz,$this->dim2D3D,$this->cijena,$this->vrijeme,$this->vrijeme,$this->ovlastiEmaila,$this->ovlastiEmaila);
			mysqli_stmt_execute($this->stmt);
			header("Location:./Registracija.php?Uspjesno&unesen&raspored!");
		}
	}

	private function SqlUpdateRaspo($ovlasteniEmail,$idRaspo,$noviPodatak,$sqlUpdate,$jedanIliDva){
		$this->jeLiBroj($idRaspo);
		parent::provjeraJedanIliDva($jedanIliDva);
		$this->ovlastiEmaila = parent::ovlastiEmaila($ovlasteniEmail);
		$this->provjeriSqliKonekciju($sqlUpdate);
		mysqli_stmt_bind_param($this->stmt,"ssss",$noviPodatak,$this->vrijeme,$this->ovlastiEmaila,$idRaspo);
		mysqli_stmt_execute($this->stmt);
		if($jedanIliDva == 1){
			header("Location:./Registracija.php?Uspješan&update!");
			exit();
		}	
	}

	public function UpdateRasporeda($ovlasteniEmail,$idRaspo,$idFilma,$datPrikaz,$vriPrikaz,$dim2D3D){
		$jedanIliDva = 2;
		$this->UpdateIdFilma($ovlasteniEmail,$idRaspo,$idFilma,$jedanIliDva);
		$this->UpdateDatVriPrikaz($ovlasteniEmail,$idRaspo,$datPrikaz,$vriPrikaz,$jedanIliDva);
		$this->Update2D3D($ovlasteniEmail,$idRaspo,$dim2D3D,$jedanIliDva);
		header("Location:./Registracija.php?Uspješan&update!");
		exit();
	}

	public function UpdateIdFilma($ovlasteniEmail,$idRaspo,$noviNazivFilma,$jedanIliDva){ /*PREKO NOVOG NAZIVA FILMA ĆEMO DOBITI ID_FILMA*/
		if($noviNazivFilma != ""){
			$noviIDFilma = parent::DohvatiIdFilma($noviNazivFilma);
			$sqlUpdate = "UPDATE raspored SET id_filma = ?, updated = ?, id_upda = ? WHERE id = ?";
			$this->SqlUpdateRaspo($ovlasteniEmail,$idRaspo,$noviIDFilma,$sqlUpdate,$jedanIliDva);
		}
	}

	public function UpdateDatVriPrikaz($ovlasteniEmail,$idRaspo,$datPrikaz,$vriPrikaz,$jedanIliDva){
		if($datPrikaz && $vriPrikaz != ""){
			$this->ProvjeriRaspo($datPrikaz,$vriPrikaz);
			$SqlUpdate = "UPDATE raspored SET dat_prikaz = ?, updated = ?, id_upda = ? WHERE id = ?";
			if($jedanIliDva == 1){ /*zato da se nastavi izvršavanje programa ako je samo taj update posebno pozvan*/
			$this->SqlUpdateRaspo($ovlasteniEmail,$idRaspo,$this->datPrikaz,$SqlUpdate,2); 
			} else {
				$this->SqlUpdateRaspo($ovlasteniEmail,$idRaspo,$this->datPrikaz,$SqlUpdate,$jedanIliDva);
			}
			$SqlUpdate = "UPDATE raspored SET vri_prikaz = ?, updated = ?, id_upda = ? WHERE id = ?";
			$this->SqlUpdateRaspo($ovlasteniEmail,$idRaspo,$this->vriPrikaz,$SqlUpdate,$jedanIliDva);
		}
	}

	public function Update2D3D($ovlasteniEmail,$idRaspo,$dim2D3D,$jedanIliDva){
		$this->ovlastiEmaila($ovlasteniEmail);
		$this->provjeriUnos2D3D($dim2D3D);
		$sqlUpdate = "UPDATE raspored SET dimenzija = ?, updated = ?, id_upda = ? WHERE id = ?";
		if($jedanIliDva == 1){
		$this->SqlUpdateRaspo($ovlasteniEmail,$idRaspo,$this->dim2D3D,$sqlUpdate,2);
		} else {
			$this->SqlUpdateRaspo($ovlasteniEmail,$idRaspo,$this->dim2D3D,$sqlUpdate,$jedanIliDva);
		}
		$sqlUpdate = "UPDATE raspored SET cijena = ?, updated = ?, id_upda = ? WHERE id = ?";
		$this->SqlUpdateRaspo($ovlasteniEmail,$idRaspo,$this->cijena,$sqlUpdate,$jedanIliDva);
	}

	public function SqlDelete($ovlasteniEmail,$id,$sqlDelete){
		parent::ovlastiEmaila($ovlasteniEmail);
		$this->provjeriSqliKonekciju($sqlDelete);
		mysqli_stmt_bind_param($this->stmt,"i",$id);
		mysqli_stmt_execute($this->stmt);
		header("Location:./Registracija.php?Uspjesno&obrisano!");
	}

	protected function ProvjeriIdRaspo($id){
		$sqlSelect = "SELECT id FROM raspored WHERE id = ?";
		$this->provjeriSqliKonekciju($sqlSelect);
		mysqli_stmt_bind_param($this->stmt,"i",$id);
		mysqli_stmt_execute($this->stmt);
		mysqli_stmt_store_result($this->stmt);/*uzima dobiveni rezultat iz baze i pohranjuje u varijablu $stmt*/
		$rezultat = mysqli_stmt_num_rows($this->stmt); /*provjerava koliko rezultata ima u varijabli $stmt*/
		if($rezultat > 0 ){
			return true;			
		} else {
			header("Location:./Registracija.php?id&ne&postoji!");
			exit();
		}
	}
	
	public function BrisanjeRaspo($ovlasteniEmail,$idRaspo){
		$sqlDelete = "DELETE FROM raspored WHERE id = ?";
		$this->jeLiBroj($idRaspo);
		$this->ProvjeriIdRaspo($idRaspo);
		$this->SqlDelete($ovlasteniEmail,$idRaspo,$sqlDelete);
	}
}


class Rezervacije extends Raspored{
	private $ovlastiEmaila;
	private $ovlasti;
	private $id_creaUpda;
	private $vrijeme;
	private $sjed;
	private $stmt;

	public function __construct(){
		$this->ovlasti= 1;
		$this->id_creaUpda = 1;
		$this->vrijeme = date('Y-m-d H:i:s');
		$this->sjed = "sjed_";
	}
	private function provjeriSqliKonekciju($sql){
		require "dbh.php";
		global $conn;
		$this->stmt = mysqli_stmt_init($conn);
		if(!mysqli_stmt_prepare($this->stmt,$sql)){
			header("Location:./Registracija.php?SqlError");
			exit();
		}
	}

	private function PostojiLiDvorana($idRaspo){ /*provjerava postoji li dvorana sa određenim prikazivanjem*/
		$sqlSelect = "SELECT id_raspo FROM rezervacije WHERE id_raspo = ?";
		$this->provjeriSqliKonekciju($sqlSelect);
		mysqli_stmt_bind_param($this->stmt,"i",$idRaspo);
		mysqli_stmt_execute($this->stmt);
		mysqli_stmt_store_result($this->stmt);/*uzima dobiveni rezultat iz baze i pohranjuje u varijablu $stmt*/
		$rezultat = mysqli_stmt_num_rows($this->stmt); /*provjerava koliko rezultata ima u varijabli $stmt*/
		if($rezultat > 0 ){
			header("Location:./Registracija.php?dvorana&već&postoji!");
			exit();			
		}
	}

	public function NapraviPraznuDvoranu($ovlasteniEmail,$idRaspo){ /*ako postoji idRasporeda u tablici raspored i ako ne postoji id_raspo u tablici rezervacije
																	 radi praznu dvoranu od 10 redova i 15 slobodnih mjesta u svakom redu*/
		parent::ProvjeriIdRaspo($idRaspo);
		$this->PostojiLiDvorana($idRaspo);
		$this->ovlastiEmaila = parent::ovlastiEmaila($ovlasteniEmail);
		$sqlInsert = "INSERT INTO rezervacije(id_raspo,redovi,sjed_1,sjed_2,sjed_3,sjed_4,sjed_5,sjed_6,sjed_7,sjed_8,sjed_9,sjed_10,sjed_11,sjed_12,sjed_13,sjed_14,sjed_15,created,updated,id_creat,id_updat)
		VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
		$this->provjeriSqliKonekciju($sqlInsert);
		$praznoSjedalo = 0;
		mysqli_stmt_bind_param($this->stmt,"iiiiiiiiiiiiiiiiissii",$idRaspo,$i,$praznoSjedalo,$praznoSjedalo,$praznoSjedalo,$praznoSjedalo,$praznoSjedalo,$praznoSjedalo,$praznoSjedalo,$praznoSjedalo,
		$praznoSjedalo,$praznoSjedalo,$praznoSjedalo,$praznoSjedalo,$praznoSjedalo,$praznoSjedalo,$praznoSjedalo,$this->vrijeme,$this->vrijeme,$this->ovlastiEmaila,$this->ovlastiEmaila);
		for($i = 0; $i < 11; $i++){
			mysqli_stmt_execute($this->stmt);
		}
		header("Location:./Registracija.php?Uspjesno&unesena&dvorana!");
	}

	public function DohvatiTjedniRaspo(){
		$sqlSelect = "	SELECT
		dayname(ra.dat_prikaz) AS dan,
		concat(date_format(ra.dat_prikaz, '%d.%m.%Y.'), ' ', time_format(ra.vri_prikaz, '%H:%i'), 'h', ' ', ra.dimenzija) AS dat_vri_prikaz,
		fi.naziv,
		fi.poster_link,
		fi.trailer_link,
		fi.opis,
		fi.uloge,
		concat(ra.cijena,'kn') as cijena,
		ra.id
	FROM
		raspored ra
	JOIN
		filmovi fi ON ra.id_filma = fi.id
	WHERE
		ra.dat_prikaz BETWEEN FIRST_DAY_OF_WEEK(now()) AND LAST_DAY_OF_WEEK(now()) ORDER BY ra.dat_prikaz";
		require "dbh.php";
		$result = $conn->query($sqlSelect);
		if ($result->num_rows > 0) {
			while($red = $result->fetch_assoc()) {
				$rows[] = $red;
			}
		} else {
			header("Location:./Rezervacija.php?Nema&filmova&za&ovaj&tjedan");
			exit();
		}
		echo json_encode($rows,JSON_UNESCAPED_UNICODE);
	}

	public function DohvatiDvoranuFilma($idRaspo){
		require "dbh.php";
		$sqlSelect = " SELECT * FROM rezervacije WHERE id_raspo = $idRaspo;";
		$result = $conn->query($sqlSelect);
		if ($result->num_rows > 0) {
			while($red = $result->fetch_assoc()) {
				$rows[] = $red;
			}
		} else {
			header("Location:./Rezervacija.php?dvorana&ne&postoji!");
			exit();
		}
		echo json_encode($rows,JSON_UNESCAPED_UNICODE);
	}
	
	public function RezervirajSjedalo($email,$password,$sjedalo,$red,$idRaspo){
		require "dbh.php";
		$idEmaila = 0;
		if(parent::PostojiLiKorisnik($email)){
			$sqlSelect = " SELECT id, password FROM korisnici WHERE email = ? ";
			$this->provjeriSqliKonekciju($sqlSelect);
			mysqli_stmt_bind_param($this->stmt,"s",$email);
			mysqli_stmt_execute($this->stmt);
			$rezultat = mysqli_stmt_get_result($this->stmt);
			while($redovi = mysqli_fetch_assoc($rezultat)){
				$rows[] = $redovi;
			}
			$id = $rows[0] ["id"]; /* dohvaca id iz objekta koji je dobiven iz baze*/
			$passKor = $rows[0] ["password"]; /* iz baze dohvaca kriptirani password korisnika */
			if (!password_verify($password,$passKor)){  /* provjerava jesu li uneseni password i kriptirani password(prvo ga dekriptira) iz baze isti*/
				header("location:./Rezervacija.php?krivi&password!");
				exit();
			}
			$sjedalo2 = 0;
			if($red == 10) {
				if ($sjedalo == 1){
					$sjedalo2 = 2;
				} else if ($sjedalo == 7){
					$sjedalo2 = 8;
				} else if ($sjedalo == 12){
					$sjedalo = 14;
					$sjedalo2 = 15;
				}
			}
			if($sjedalo2 == 0){ /* izvršit će se samo ako nije u pitanju ljubavno sjedalo */
				$sqlUpdate = "UPDATE rezervacije SET sjed_$sjedalo = $id WHERE redovi = $red AND id_raspo = $idRaspo";
				$update = mysqli_query($conn, $sqlUpdate) or die(mysqli_error($conn)); /* odrađuje posao na bazi */
				if(mysqli_affected_rows($conn) > 1) { /* provjerava koliko je redova updateano, ako je updateano više od jednog reda izbaciti će error, te redirectati na drugu stranicu */
					header("location:./Rezervacija.php?&pogreska&u&sistemu&pokusajte&ponovo!");
					exit();
				}
			} else { /* izvršava se samo kada su u pitanju ljubavna sjedala, umjesto jednog sjedala updateaju se 2 */ 
				/*sjedalo koje je odabrano i sjedalo+1(za odabrano sjedalo 1 ili odabrano sjedalo 7) ili sjedalo-1(za odabrano sjedalo 14) */
				$sqlUpdate = "UPDATE rezervacije SET sjed_$sjedalo = $id, sjed_$sjedalo2 = $id WHERE redovi = $red AND id_raspo = $idRaspo";
				$update = mysqli_query($conn, $sqlUpdate) or die(mysqli_error($conn)); /* odrađuje posao na bazi */
				if(mysqli_affected_rows($conn) > 2) { /* provjerava koliko je redova updateano, ako je updateano više od dva(zbog ljubavnog sjedala) reda izbaciti će error, te redirectati na drugu stranicu */
					header("location:./Rezervacija.php?&pogreska&u&sistemu&pokusajte&ponovo!");
					exit();
				}
			}
		} else {
			header("Location:./Registracija.php?email&ne&postoji!");
			exit();
		}
	}
	
}
?>