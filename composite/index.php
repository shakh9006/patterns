<?php

class UnitException extends Exception
{
}

abstract class Unit
{
    public function getComposite()
    {
        return null;
    }

    abstract function bombardStrength();
}

abstract class CompositeUnite extends Unit {

    private $units = [];

    public function getComposite()
    {
        return $this;
    }

    protected function getUnits()
    {
        return $this->units;
    }

    public function removeUnit(Unit $unit)
    {
        $this->units = array_udiff($unit, $this->units, function ($a, $b){
           return $a === $b ? 0 : 1;
        });
    }

    public function addUnit(Unit $unit)
    {
        if(in_array($unit, $this->units)) return '';

        $this->units = $unit;
    }

}

class CUextneds extends  CompositeUnite {
    public function bombardStrength()
    {
        return 1;
    }
}

class Army extends Unit
{
    private $units = [];

    /**
     * @param Unit $unit
     * @return mixed|void
     */
    public function addUnit(Unit $unit)
    {
        // TODO: Implement addUnit() method.
        if (in_array($unit, $this->units)) return '';

        $this->units[] = $unit;
    }

    /**
     * @param Unit $unit
     * @return mixed|void
     */
    public function removeUnit(Unit $unit)
    {
        // TODO: Implement removeUnit() method.
        $this->units = array_udiff($unit, $this->units, function ($a, $b) {
            return ($a === $b) ? 0 : 1;
        });
    }

    /**
     * @return integer
     */

    public function bombardStrength()
    {
        // TODO: Implement bombardStrength() method.
        $ret = 0;

        foreach ($this->units as $unit) {
            $ret += $unit->bombardStrength();
        }

        return $ret;
    }
}

class Archer extends Unit
{
    public function bombardStrength()
    {
        // TODO: Implement bombardStrength() method.
        return 4;
    }
}

class LaserCannonUnit extends Unit
{
    public function bombardStrength()
    {
        // TODO: Implement bombardStrength() method.
        return 44;
    }
}


class UnitScript {
    private $comp;
    public static function joinExisting(Unit $newUnit, Unit $occupyUnit){
        if( !is_null($comp = $occupyUnit->getComposite()) ) {
            $comp->addUnit($newUnit);
        }else{
            $comp = new Army();
            $comp->addUnit(new Archer());
            $comp->addUnit(new LaserCannonUnit());
        }

        return $comp;
    }
}
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$arm = UnitScript::joinExisting(new Archer(), new CUextneds());
echo "<pre>";
print_r($arm->bombardStrength());
echo "</pre>";
die();