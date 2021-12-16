<?php

class User {
    private $id;
    public $login;
    public $email;
    public $firstname;
    public $lastname;

    function __construct($id, $login, $email, $firstname, $lastname){
        $this->id = $id;
        $this->login = $login;
        $this->email = $email;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
    }
}

$User1= new User("1", "bg", "bg@gmail.com", "bb", "gg");
var_dump($User1);
print($User1->login);

// on ne peut print quune seule chose :: comme le foreach tableau de ton sqli, si tu veux print plusieurs trucs à chaque fois il faut un nouveau print/echo
?>


