<?php 

namespace app\models;

/**
 * State model
 * 
 * Represents a state in the application
 * 
 * @package app\models
 */ 
class StateModel {

    /**
     * State id
     * 
     * @var integer $idState
     */
    private $idState;

    /**
     * State name
     * 
     * @var string $name
     */
    private $name;

    /**
     * State acronym 
     * 
     * @var string $acronym
     */
    private $acronym;

    /**
     * Class constructor
     * 
     * @param integer $idState state id
     * @param string $name state name
     * @param string $acronym state acronym
     * 
     * @return StateModel state
     */
    public function __construct($idState, $name, $acronym) {
        $this->idState = (int)$idState || null;
        $this->name = $name;
        $this->acronym = $acronym;
    }

    /**
     * Get State id
     * 
     * @return integer Returns state id
     */
    public function getIdState() {
        return $this->idState;
    }

    /**
     * Get state name
     * 
     * @return string Returns state name
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Get state acronym
     * 
     * @return string Returns state acronym
     */
    public function getAcronym() {
        return $this->acronym;
    }

      /**
     * Set state id
     * 
     * @param integer $idState state id
     */
    public function setIdCity($idState) {
        $this->idState = $idState;
    }

    /**
     * Set state name
     * 
     * @param string $name state name
     */
    public function setName($name) {
        $this->name = $name;
    }

    /**
     * Set state acronym
     * 
     * @param string $uf city acronym
     */
    public function setAcronym($acronym) {
        $this->acronym = $acronym;
    }

    /**
     * Converts the state to an array.
     * 
     * @return array Returns the state as an array
     */
    public function toArray() {
        return [
            'idState' => $this->idState,
            'name' => $this->name,
            'acronym' => $this->acronym,
        ];
    }

}
