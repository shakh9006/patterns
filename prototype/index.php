<?php

class Sea {}
class MarsTerrainSea extends Sea {}
class EarthTerrainSea extends Sea {}

class Plain {}
class MarsTerrainPlain extends Plain {}
class EarthTerrainPlain extends Plain {}

class Forest {}
class MarsTerrainForest extends Forest {}
class EarthTerrainForest extends Forest {}

class TerrainFactory {
    private $sea;
    private $plain;
    private $forest;

    public function __construct($sea, $plain, $forest)
    {
        $this->sea = $sea;
        $this->plain = $plain;
        $this->forest = $forest;
    }

    /**
     * @return Sea
     */
    public function getSea(){
        return clone $this->sea;
    }

    /**
     * @return Plain
     */
    public function getPlain() {
        return clone $this->plain;
    }

    /**
     * @return Forest
     */
    public function getForest(){
        return clone $this->forest;
    }
}

$factory = new TerrainFactory(new EarthTerrainSea(), new MarsTerrainPlain(), new EarthTerrainForest());
echo "<pre>";
print_r($factory->getSea());
print_r($factory->getPlain());
print_r($factory->getForest());
echo "</pre>";
