<?php

$host='localhost';
$user='root';
$password='';
$dbname='classes';


// SET DSN

$dsn='mysql:host='.$host.'; dbname='.$dbname.'; charset=utf8';



// INSCRIPTION
if(isset($_POST['inscription'])){
    // il faut dire quand lancer le pdo avant de le créer new donc ici, tu le lances une fois cliqué sur le bouton inscription
// CREATE PDO INSTANCE
$pdo=new PDO($dsn, $user, $password);
    // $utilisateur=setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

// PREPARED STATEMENTS

    $login=$_POST['login'];
    $mdp=$_POST['mdp'];
    $email=$_POST['email'];
    $firstname=$_POST['firstname'];
    $lastname=$_POST['lastname'];

    $sth=$pdo -> prepare('INSERT INTO utilisateurs SET login=:login, password=:mdp, email=:email, firstname=:firstname, lastname=:lastname');
    // $sth -> bindValue($login, PDO::PARAM_STR);
    // $sth -> bindValue($mdp, PDO::PARAM_STR);
    // $sth -> bindValue($email, PDO::PARAM_STR);
    // $sth -> bindValue($firstname, PDO::PARAM_STR);
    // $sth -> bindValue($lastname, PDO::PARAM_STR);

//si on met dans execute les trucs pas besoin de bind si déjà bind alors on peut laisser execute() voir en dessous dans connexion avec lexemple

    $sth -> execute(['login' => $login, 'mdp' => $mdp, 'email' => $email, 'firstname' => $firstname, 'lastname' => $lastname]);
        }


// CONNEXION
if (isset($_POST['connexion'])) {
    $pdo=new PDO($dsn, $user, $password);
    session_start();

    $login=$_POST['login'];
    $mdp=$_POST['mdp'];

        $sth=$pdo -> prepare("SELECT `login` FROM `utilisateurs` WHERE login=:login");
        $sth -> execute(['login' => $login]);
        if($sth->rowCount()){
            $sdh = $pdo -> prepare("SELECT `password` FROM `utilisateurs` WHERE login=:login and password=:mdp"); 
            $sdh -> bindValue($login, PDO::PARAM_STR);
            $sdh -> bindValue($mdp, PDO::PARAM_STR);

            $sth -> execute();
                echo "ok";    

                $_SESSION['login']=$login;
                var_dump($_SESSION['login']);
            }else {
                echo "pas ok";
            }
    }


// DECONNEXION

if(isset($_POST['deco'])){
    session_start();

    session_destroy();
}

// SUPPRESSION

if(isset($_POST['suppression'])){
    $pdo=new PDO($dsn, $user, $password);
    session_start();

    session_destroy();

    $sth=$pdo -> prepare("DELETE FROM `utilisateurs` WHERE login = '".$_SESSION['login']."'");
    $sth -> execute();
}

// UPDATE

if(isset($_POST['update'])){
    
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

    <form action="user-pdo.php" method="post">
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



    <form action="user-pdo.php" method="post">
        <label for="name">Login: </label>
        <input type="text" name="login" id="loginn">  

        <label for="name">Mot de passe: </label>
        <input type="password" name="mdp" id="mdp">

        <button type="submit" name="connexion">Log in</button>

    </form>



    <form action="user-pdo.php" method="post">
        <button value="deconnexion" name="deco" id="deco">deconnexion</button>
    </form>



    <form action="user-pdo.php" method="post">
        <button value="suppression" name="suppression" id="suppression">suppression</button>
    </form>



    <form action="user-pdo.php" method="post">
        <label for="name">Login: </label>
        <input type="text" name="ulogin" id="loginn">  

        <label for="name">Mot de passe: </label>
        <input type="password" name="umdp" id="mdp">

        <label for="name">Email: </label>
        <input type="text" name="uemail" id="email">  

        <label for="name">Firstname: </label>
        <input type="text" name="ufirstname" id="firstname">  

        <label for="name">Lastname: </label>
        <input type="text" name="ulastname" id="lastname"> 

        <button type="submit" name="update">Update</button>

    </form>
</body>
</html>