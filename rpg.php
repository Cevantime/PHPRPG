<?php

if( ! function_exists('readline')){
    function input($prompt) {
        echo $prompt;
        return stream_get_line(STDIN, 1024, PHP_EOL);
    }
} else {
    function input($prompt) {
        echo $prompt;
        return readline($prompt);
    }
}

require_once 'Personnage.php';
require_once 'Guerrier.php';
require_once 'Archer.php';
require_once 'Mage.php';

function choixDesClasses() {
    return array ('Guerrier', 'Mage' );
}

function creationDesPersonnages($classeJoueur1, $classeJoueur2) {
    $nom1 = input("Quel est le nom du joueur 1 ? ");
    $personnageJoueur1 = new $classeJoueur1($nom1, 0);
    $nom2 = input("Quel est le nom du joueur 2 ? ");
    $personnageJoueur2 = new $classeJoueur2($nom2, 6);
    
    return array($personnageJoueur1, $personnageJoueur2);
}

function deplacementDesPersonnages($personnageRapide, $personnageLent) {
    $personnageRapide->bouger();
    $personnageLent->bouger();
}

function annulationDesDeplacements($personnageRapide, $personnageLent) {
    if($personnageLent->getPosition() === $personnageRapide->getPosition()){
        if($personnageLent->getPosition() === $personnageLent->getDernierePosition()){
            $personnageRapide->annulerBouger();
        } else {
            $personnageLent->annulerBouger();
        }
    }
}

function afficherPlateau($personnage1, $personnage2) {
    for($i = 0; $i <= 6; $i++) {
        if($i === $personnage2->getPosition()){
            echo '2';
        } else if($i === $personnage1->getPosition()) {
            echo '1';
        } else {
            echo '.';
        }
    }
    echo "\n";
}

function afficherPV($personnage1, $personnage2) {
    echo "{$personnage1->getNom()} : {$personnage1->getPv()} PVs\n";
    echo "{$personnage2->getNom()} : {$personnage2->getPv()} PVs\n";
}

echo "Bienvenue sur notre mini-RPG !\n\n";

// CHOIX DE LA CLASSE DU PERSONNAGE POUR LES DEUX JOUEURS
$classes = choixDesClasses();

$classeJoueur1 = $classes[0];
$classeJoueur2 = $classes[1];

// CREATION DES PERSONNAGES
$personnages = creationDesPersonnages($classeJoueur1, $classeJoueur2);

if($personnages[0]->getVitesseDeplacement() >= $personnages[1]->getVitesseDeplacement()){
    $personnageRapide = $personnages[0];
    $personnageLent = $personnages[1];
} else {
    $personnageLent = $personnages[0];
    $personnageRapide = $personnages[1];
}

if($personnages[0]->getVitesseAttaque() >= $personnages[1]->getVitesseAttaque()) {
    $personnageAttaqueRapide = $personnages[0];
    $personnageAttaqueLent = $personnages[1];
} else {
    $personnageAttaqueRapide = $personnages[1];
    $personnageAttaqueLent = $personnages[0];
}

$personnageLent instanceof Personnage;
$personnageRapide instanceof Personnage;

echo "La partie commence ! \n";

// TANT QUE LES DEUX JOUEURS SONT VIVANTS LE JEU CONTINUE


while($personnageRapide->getPv() > 0 && $personnageLent->getPv() > 0){
    
    // while ...
    afficherPlateau($personnages[0], $personnages[1]);
    
    // CHOIX DES DEPLACEMENTS DES DEUX JOUEURS
    deplacementDesPersonnages($personnageRapide, $personnageLent);
    
    // ANNULATION DE DEPLACEMENT LE CAS ECHEANT
    annulationDesDeplacements($personnageRapide, $personnageLent);
    
    afficherPlateau($personnages[0], $personnages[1]);
    
    // ATTAQUE JOUEUR LE + RAPIDE
    $personnageAttaqueRapide->attaquer($personnageAttaqueLent);

    // VERIFICATION DE LA SANTE DES JOUEURS
    if($personnageAttaqueLent->getPv() > 0) {
        // ATTAQUE DU JOUEUR LE - RAPIDE SI IL Y A LIEU
        $personnageAttaqueLent->attaquer($personnageAttaqueRapide);
    }
    
    afficherPV($personnageRapide, $personnageLent);
    
    // fin de la boucle de jeu
    
}

// ANNONCE DU VAINQUEUR
if($personnages[0]->getPv() > 0){
    echo 'Le joueur 1 a gagne !!';
} else {
    echo 'Le joueur 2 a gagne !!';
}