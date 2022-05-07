<?php

class users {

    private $id;
    private $name;
    private $email;
    private $pass;
    private $loginStatus;
    private $lastLogin;
    private $dbConnect;

    public function __construct()
    {
        require_once "DbConnect.php";
        $db = new DbConnect();
        $this->dbConnect = $db->connect();
    }

    public function save(){
        $sql = "INSERT INTO `users`(`id`, `name`, `email`, `password`, `login_status`, `created_at`) VALUES (null, :name, :email, :pass, :loginstatus, :lastlogin)";

        $stmt = $this->dbConnect->prepare($sql);
        $stmt->bindParam(":name",$this->name);
        $stmt->bindParam(":email",$this->email);
        $stmt->bindParam(":pass",$this->pass);
        $stmt->bindParam(":loginstatus",$this->loginStatus);
        $stmt->bindParam(":lastlogin",$this->lastLogin);
        
        
        try {
            if ($stmt->execute()){
                return true;
            }else{
                return  false;
            }
        }catch (Exception $e){
            echo "Usesga ulamishda xatolik: ".$e->getMessage();
        }

    }

    public function getUserbyId(){
        $sql = "SELECT * FROM `users` WHERE id=:id";
        $stmt = $this->dbConnect->prepare($sql);
        $stmt->bindParam(":id",$this->id);
  
        try {
            if ($stmt->execute()){
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
            }
        }catch (Exception $e){
            echo "getUserbyId xatolik: ".$e->getMessage();
        }
        return $user;

    }
    public function getUserEmail(){
        $sql = "SELECT * FROM `users` WHERE email=:email";
        $stmt = $this->dbConnect->prepare($sql);
        $stmt->bindParam(":email",$this->email);
  
        try {
            if ($stmt->execute()){
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
            }
        }catch (Exception $e){
            echo "getUserEmailda xatolik: ".$e->getMessage();
        }
        return $user;

    }

    public function updatedloginStatus(){
        $sql = "UPDATE `users` SET `login_status`=:loginstatus, `created_at`=:lastlogin WHERE id=:id";
        $stmt = $this->dbConnect->prepare($sql);
        $stmt->bindParam(":id",$this->id);
        $stmt->bindParam(":loginstatus",$this->loginStatus);
        $stmt->bindParam(":lastlogin",$this->lastLogin);
  
        try {
            if ($stmt->execute()){
                return true;
            }else{
                return  false;
            }
        }catch (Exception $e){
            echo "updatedloginStatusda xatolik: ".$e->getMessage();
        }


    }

    public function getAllUsers(){
        $sql = "SELECT * FROM `users`";
        $stmt = $this->dbConnect->prepare($sql);
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $users;
    }

    /**
     * @return mixed
     */
    function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    function getPass()
    {
        return $this->pass;
    }

    /**
     * @param mixed $pass
     */
    function setPass($pass)
    {
        $this->pass = $pass;
    }

    /**
     * @return mixed
     */
    function getLoginStatus()
    {
        return $this->loginStatus;
    }

    /**
     * @param mixed $loginStatus
     */
    function setLoginStatus($loginStatus)
    {
        $this->loginStatus = $loginStatus;
    }

    /**
     * @return mixed
     */
    function getLastLogin()
    {
        return $this->lastLogin;
    }

    /**
     * @param mixed $lastLogin
     */
    function setLastLogin($lastLogin)
    {
        $this->lastLogin = $lastLogin;
    }





}