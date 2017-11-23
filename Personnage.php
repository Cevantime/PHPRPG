<?php

/**
 * Description of Personnage
 *
 * @author Etudiant
 */
class Personnage {
    
    private $pv = 20;
    private $vitesseAttaque = 2;
    private $vitesseDeplacement = 2;
    private $position;
    private $dernierePosition;
    private $nom;
    
    private $deplacementMax = 2;
    
    public function __construct($nom, $positionInitiale) {
        $this->nom = $nom;
        $this->position = $positionInitiale;
        echo "{$this->getNom()} a ete cree !\n";
    }

    public function bouger() {
        $this->dernierePosition = $this->getPosition();
        $nbCase = input("De combien de cases doit bouger {$this->getNom()} ? ");
        if(is_numeric($nbCase)){
            if($nbCase >= - $this->deplacementMax && $nbCase <= $this->deplacementMax){
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
        echo "La nouvelle position de {$this->getNom()} est {$this->getPosition()}\n";
    }
        
    public function attaquer($adversaire) {
        if(abs($this->getPosition() - $adversaire->getPosition()) === 1){
            $adversaire->setPv($adversaire->getPv() - 3);
            echo "{$this->getNom()} attaque {$adversaire->getNom()}\n";
            echo "{$adversaire->getNom()} perd 3 PVs !!\n";
        } else {
            echo "{$this->getNom()} n'a pas touche {$adversaire->getNom()}!\n";
        }
    }
    
    public function annulerBouger() {
        $this->setPosition($this->getDernierePosition());
        echo "{$this->getNom()} doit annuler son deplacement !\n";
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
    
    public function getNom() {
        return $this->nom;
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
