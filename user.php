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

        $querySignup=mysqli_query($connect, "INSERT INTO utilisateurs SET login='$login', password='$password', email='$email', firstname='$firstname', lastname='$lastname'");

    }

    public function connect($login, $password){
        require('bdd_connect.php');
        session_start();
        $queryLogin=mysqli_query($connect, "SELECT `login` FROM `utilisateurs` WHERE login='".$_POST['login']."'");

        if(mysqli_num_rows($queryLogin)){
            $queryPassword = mysqli_query($connect, "SELECT `password` FROM `utilisateurs` WHERE `login`= '".$_POST['mdp']. "'"); 
        
                if(mysqli_num_rows($queryPassword)){
                    echo "ok";
                    $_SESSION['login']=$_POST['login'];
                    var_dump($_SESSION['login']);
                }else {
                    echo "pas ok";
                }
        }
    }

    public function disconnect(){
        session_start();

        session_destroy();
    }

    public function delete(){
        require('bdd_connect.php');
        session_start();

        session_destroy();

        $queryDelete = mysqli_query($connect, "DELETE FROM `utilisateurs` WHERE login = '".$_SESSION['login']."'");
    }


}

// $User1= new User("bg","bg","bg@gmail.com", "bb", "gg");
// $User1= new User();
// var_dump($User1);
// print($User1->login);
// on ne peut print quune seule chose :: comme le foreach tableau de ton sqli, si tu veux print plusieurs trucs à chaque fois il faut un nouveau print/echo

if(isset($_POST['inscription'])){
    $User= new User();
    $User -> register($_POST['login'],$_POST['mdp'],$_POST['email'], $_POST['firstname'], $_POST['lastname']);   
}
// si je veux utiliser la fonction register, il faut que je créé lobjet dabord sinon : quoi envoyer ??? les paramètres de mon construct peuvent être vides, seulement il faut TOUT DE MEME construire un objet comme vu au-dessous, sinon décommenter les this dans construct, rajouter les paramètres dans la fonctions et décommenter le second $User1 new 

// ATTENTION LA CLASSE ETANT HERMETIQUE JE DOIS CONNECTER A MA BASE DE DONNEES A LINTERIEUR DE MA FONCTION SINON IL NE VA PAS SAVOIR CE QUEST LE CONNECT

if(isset($_POST['connexion'])){
    $User= new User();
    $User -> connect($_POST['login'], $_POST['mdp']);
}
//pareillement ici, ne pas oublier de rajouter la connexion dans la fonction sinon ne reconnait pas et rajouter le construct aussi même en connexion.

if(isset($_POST['deco'])){
    $User= new User();
    $User -> disconnect();
}

if(isset($_POST['suppression'])){
    $User= new User();
    $User -> delete();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User</title>
</head>
<body>

    <form action="user.php" method="post">
        <label for="name">Login: </label>
        <input type="text" name="login" id="loginn">  

        <label for="name">Mot de passe: </label>
        <input type="password" name="mdp" id="mdp">

        <label for="name">Email: </label>
        <input type="text" name="email" id="email">  

        <label for="name">Firstname: </label>
        <input type="text" name="firstname" id="firstname">  

        <label for="name">Lastname: </label>
        <input type="text" name="lastname" id="lastname"> 

        <button type="submit" name="inscription">Inscription</button>

    </form>



    <form action="user.php" method="post">
        <label for="name">Login: </label>
        <input type="text" name="login" id="loginn">  

        <label for="name">Mot de passe: </label>
        <input type="password" name="mdp" id="mdp">

        <button type="submit" name="connexion">Log in</button>

    </form>

    <form action="user.php" method="post">
        <button value="deconnexion" name="deco" id="deco">deconnexion</button>
    </form>

    <form action="user.php" method="post">
        <button value="suppression" name="suppression" id="suppression">suppression</button>
    </form>
</body>
</html>

