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

    public function bouger() {
        $this->dernierePosition = $this->getPosition();
        $nbCase = input('De combien de cases doit bouger Personnage ?');
        if(is_numeric($nbCase)){
            $nbMax = 2;
            $nbMin = -2;
            if($nbCase >= $nbMin && $nbCase <= $nbMax){
                $this->setPosition($this->getPosition() + $nbCase);
            } else {
                $nbCase = 0;
            }
        } else {
            $nbCase = 0;
        }
        
        if($this->getPosition() < 0){
            $this->setPosition(0);
        } else if($this->getPosition() > 6){
            $this->setPosition(6);
        }
    }
    
    public function attaquer($adversaire) {
        $adversaire->setPv($adversaire->getPv() - 3);
    }
    
    public function annulerBouger() {
        $this->setPosition($this->getDernierePosition());
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
