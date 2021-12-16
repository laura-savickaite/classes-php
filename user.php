<?php



class User {
    private $id;
    public $login;
    public $password;
    public $email;
    public $firstname;
    public $lastname;

    public function __construct(){
        // $this->login = $login;
        // $this->password = $password;
        // $this->email = $email;
        // $this->firstname = $firstname;
        // $this->lastname = $lastname;
    }


    public function register($login, $password, $email, $firstname, $lastname){
        $this->login = $login;
        $this->password = $password;
        $this->email = $email;
        $this->firstname = $firstname;
        $this->lastname = $lastname;

        require('bdd_connect.php');

        $querySql=mysqli_query($connect, "INSERT INTO utilisateurs SET login='$login', password='$password', email='$email', firstname='$firstname', lastname='$lastname'");

    }
}

// $User1= new User("bg","bg","bg@gmail.com", "bb", "gg");
$User1= new User();
// var_dump($User1);
// print($User1->login);
// on ne peut print quune seule chose :: comme le foreach tableau de ton sqli, si tu veux print plusieurs trucs à chaque fois il faut un nouveau print/echo

$User1 -> register("bg","bg","bg@gmail.com", "bb", "gg");
// si je veux utiliser la fonction register, il faut que je créé lobjet dabord sinon : quoi envoyer ??? les paramètres de mon construct peuvent être vides, seulement il faut TOUT DE MEME construire un objet comme vu au-dessous, sinon décommenter les this dans construct, rajouter les paramètres dans la fonctions et décommenter le second $User1 new 

// ATTENTION LA CLASSE ETANT HERMETIQUE JE DOIS CONNECTER A MA BASE DE DONNEES A LINTERIEUR SINON IL NE VA PAS SAVOIR CE QUEST LE CONNECT

?>


