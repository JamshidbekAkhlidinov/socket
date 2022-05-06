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
        $sql = "INSERT INTO `users`(`id`, `name`, `email`, `password`, `login_status`, `last_login`) VALUES (null,:name,:email,:pass,:loginSatatus,:lastLogin)";
        $stmt = $this->dbConnect->prepare($sql);
        $stmt->bindParam(":name",$this->name);
        $stmt->bindParam(":email",$this->email);
        $stmt->bindParam(":pass",$this->pass);
        $stmt->bindParam(":loginStatus",$this->loginStatus);
        $stmt->bindParam(":lastLogin",$this->lastLogin);

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

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPass()
    {
        return $this->pass;
    }

    /**
     * @param mixed $pass
     */
    public function setPass($pass)
    {
        $this->pass = $pass;
    }

    /**
     * @return mixed
     */
    public function getLoginStatus()
    {
        return $this->loginStatus;
    }

    /**
     * @param mixed $loginStatus
     */
    public function setLoginStatus($loginStatus)
    {
        $this->loginStatus = $loginStatus;
    }

    /**
     * @return mixed
     */
    public function getLastLogin()
    {
        return $this->lastLogin;
    }

    /**
     * @param mixed $lastLogin
     */
    public function setLastLogin($lastLogin)
    {
        $this->lastLogin = $lastLogin;
    }





}