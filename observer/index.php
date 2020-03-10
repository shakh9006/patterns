<?php

interface Observable
{
    public function attach(Observer $observer);
    public function detach(Observer $observer);
    public function notify();
}

interface Observer
{
    public function update(Observable $observable);
}

class Login implements Observable
{
    private $observers = [];
    private $storage;

    const LOGIN_SUCCESS = 1;
    const LOGIN_PASS_WRONG = 2;
    const LOGIN_EMAIL_WRONG = 3;

    public function setStatus($status, $user, $ip)
    {
        $this->storage = [$status, $user, $ip];
    }

    public function getStatus()
    {
        return $this->storage;
    }

    public function handleLogin($user, $ip, $pass)
    {
        $status = null;
        $is_valid = false;
        switch (rand(1,3)){
            case 1:
                $status = self::LOGIN_SUCCESS;
                $is_valid = true;
                break;
            case 2:
                $status = self::LOGIN_PASS_WRONG;
                $is_valid = false;
                break;
            case 3:
                $status = self::LOGIN_EMAIL_WRONG;
                $is_valid = false;
                break;
        }

        $this->setStatus($status, $user, $ip);
        $this->notify();
        return $is_valid;
    }

    public function attach(Observer $observer)
    {
        // TODO: Implement attach() method.
        $this->observers = $observer;
    }

    public function detach(Observer $observer)
    {
        // TODO: Implement detach() method.
        $this->observers = array_filter($this->observers, function ($a) use ($observer){
            return !( $a === $observer );
        });
    }

    public function notify()
    {
        // TODO: Implement notify() method.
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }

    public function __construct()
    {
        $this->observers = [];
    }
}

abstract class LoginObserver implements Observer
{
    private $login;

    public function __construct(Login $login)
    {
        $this->login = $login;
        $this->login->attach($this);
    }

    public function update(Observable $observable)
    {
        if($this->login === $observable){
            $this->doUpdate( $observable );
        }
    }

    abstract function doUpdate(Login $login);
}

class SecurityMonitor extends LoginObserver
{
    public function doUpdate(Login $login)
    {
        $status = $login->getStatus();

        if($status[0] === Login::LOGIN_SUCCESS)
        {
            echo __CLASS__. "<br>Sending to sysadmin's<br>";
        }
    }
}

class GeneralLogger extends LoginObserver
{
    public function doUpdate(Login $login)
    {
        $status = $login->getStatus();
        echo  __CLASS__ . "<br>Do general Log<br>";
    }
}

class  PartnerLogger extends LoginObserver
{
    public function doUpdate(Login $login)
    {
        $login = $login->getStatus();

        echo __CLASS__ . "<br>sending cookie-files<br>";
    }
}


$login = new Login();
new SecurityMonitor($login);
new GeneralLogger($login);
new PartnerLogger($login);

echo "<pre>";
print_r($login);
echo "</pre>";
die();