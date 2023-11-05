<?php 

namespace app\models;

/**
 * City model
 * 
 * Represents a city in the application
 * 
 * @package app\models
 */ 
class CityModel {

    /**
     * City id
     * 
     * @var integer $idCity
     */
    private $idCity;

    /**
     * City name
     * 
     * @var string $name
     */
    private $name;

    /**
     * City unity federation (state)
     * 
     * @var string $uf
     */
    private $uf;

    /**
     * City idState
     * 
     * @var integer $idState
     */
    private $idState;

    /**
     * Class constructor
     * 
     * @param integer $idCity city id
     * @param string $name city name
     * @param string $uf city state
     * @param string $idState city state(fk)
     * 
     * @return CityModel city
     */
    public function __construct($idCity, $name, $uf, $idState) {
        $this->idCity = $idCity;
        $this->name = $name;
        $this->uf = $uf;
        $this->idState = $idState;
    }

    /**
     * Get city id
     * 
     * @return integer Returns the city id
     */
    public function getIdCity() {
        return $this->idCity;
    }

    /**
     * Get city name
     * 
     * @return string Returns city name
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Get city uf
     * 
     * @return string Returns city uf
     */
    public function getUf() {
        return $this->uf;
    }

    /**
     * Get city id state (fk)
     * 
     * @return integer Returns city id state
     */
    public function getIdState() {
        return $this->idState;
    }

    /**
     * Set city id
     * 
     * @param integer $idCity city id
     */
    public function setIdCity($idCity) {
        $this->idCity = $idCity;
    }

    /**
     * Set city name
     * 
     * @param string $name city name
     */
    public function setName($name) {
        $this->name = $name;
    }

    /**
     * Set city uf
     * 
     * @param string $uf city uf
     */
    public function setUf($uf) {
        $this->uf = $uf;
    }

    /**
     * Set id State (fk)
     * 
     * @param string $idState state id
     */
    public function setIdState($idState) {
        $this->idState = $idState;
    }


    /**
     * Converts the city to an array.
     * 
     * @return array Returns the city as an array
     */
    public function toArray() {
        return [
            'idCity' => $this->idCity,
            'name' => $this->name,
            'uf' => $this->uf,
            'idState' => $this->idState,
        ];
    }

}
