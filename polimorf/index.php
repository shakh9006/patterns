<?php

abstract class Employee
{
    protected $name;
    public static $types = ['Minion', 'CluedUp', 'WellConnected'];

    public static function recruit($name)
    {
        $num = rand(1, count(self::$types)) - 1;
        $class = self::$types[$num];
        return new $class($name);
    }

    public function __construct($name)
    {
        $this->name = $name;
    }

    abstract public function fire();
}

class Minion extends Employee
{
    public function fire()
    {
        // TODO: Implement fire() method.
        echo $this->name . " take away from the table<br>";
    }
}

class CluedUp extends Employee
{
    public function fire()
    {
        // TODO: Implement fire() method.
        echo $this->name . " Call the lawyer<br>";
    }
}

class WellConnected extends Employee
{
    public function fire()
    {
        echo $this->name . " get the folder<br>";
    }
}

class NastyBoss
{
    private $employees = [];

    public function addEmployee(Employee $employee)
    {
        $this->employees[] = $employee;
    }

    public function projectFails()
    {
        if (count($this->employees) > 0) {
            while (count($this->employees)) {
                $emp = array_pop($this->employees);
                $emp->fire();
            }
        }
    }
}

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$boss = new NastyBoss();
$boss->addEmployee(Employee::recruit('Mark'));
$boss->addEmployee(Employee::recruit('Jack'));
$boss->addEmployee(Employee::recruit('Harry'));
$boss->addEmployee(Employee::recruit('Michael'));
$boss->projectFails();