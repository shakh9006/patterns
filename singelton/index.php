<?php

class Preference {
    private $props = [];
    private static $instance;

    private function __construct(){}

    public static function getInstance()
    {
        if(empty(self::$instance)){
            self::$instance = new Preference();
        }

        return self::$instance;
    }

    /**
     * @param string $name
     * @param $value
     */
    public function setProps($name, $value)
    {
        $this->props[$name] = $value;
    }

    /**
     * @param string $name
     * @return string
     */
    public function getProps($name)
    {
        return $this->props[$name];
    }
}

$pref = Preference::getInstance();
$pref->setProps("name", "Mark");
unset($pref);
$pref2 = Preference::getInstance();
print $pref2->getProps("name");