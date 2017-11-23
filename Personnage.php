<?php

/**
 * Description of Personnage
 *
 * @author Etudiant
 */
class Personnage {
    
    private $pv;
    private $vitesseAttaque;
    private $vitesseDeplacement;
    private $position;
    private $dernierePosition;
    
    public function __construct($positionInitiale) {
        $this->position = $positionInitiale;
    }

    public function bouger($nbCase) {
        // TODO
    }
    
    public function attaquer($puissance) {
        // TODO
    }
    
    public function annulerBouger($nbCase) {
        // TODO
    }
    
    public function getPv() {
        return $this->pv;
    }

    public function getVitesseAttaque() {
        return $this->vitesseAttaque;
    }

    public function getVitesseDeplacement() {
        return $this->vitesseDeplacement;
    }

    public function getPosition() {
        return $this->position;
    }
    
    public function getDernierePosition() {
        return $this->dernierePosition;
    }

    public function setPv($pv) {
        $this->pv = $pv;
    }

    public function setVitesseAttaque($vitesseAttaque) {
        $this->vitesseAttaque = $vitesseAttaque;
    }

    public function setVitesseDeplacement($vitesseDeplacement) {
        $this->vitesseDeplacement = $vitesseDeplacement;
    }

    public function setPosition($position) {
        $this->position = $position;
    }


}
