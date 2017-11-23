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

function choixDesClasses() {
    return array ('Personnage', 'Personnage' );
}

function creationDesPersonnages($classeJoueur1, $classeJoueur2) {
    $personnageJoueur1 = new $classeJoueur1();
    $personnageJoueur2 = new $classeJoueur2();
    
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

$personnageLent instanceof Personnage;
$personnageRapide instanceof Personnage;

// TANT QUE LES DEUX JOUEURS SONT VIVANTS LE JEU CONTINUE

while($personnageRapide->getPv() > 0 && $personnageLent->getPv() > 0){
    
    // while ...
    
    // CHOIX DES DEPLACEMENTS DES DEUX JOUEURS
    deplacementDesPersonnages($personnageRapide, $personnageLent);
    
    // ANNULATION DE DEPLACEMENT LE CAS ECHEANT
    annulationDesDeplacements($personnageRapide, $personnageLent);
    
    // ATTAQUE JOUEUR LE + RAPIDE
    $personnageRapide->attaquer();

    // VERIFICATION DE LA SANTE DES JOUEURS
    if($personnageLent->getPv() > 0) {
        // ATTAQUE DU JOUEUR LE - RAPIDE SI IL Y A LIEU
        $personnageLent->attaquer();
    }

    // fin de la boucle de jeu
    
}

// ANNONCE DU VAINQUEUR
if($personnages[0]->getPv() > 0){
    echo 'Le joueur 1 a gagné !!';
} else {
    echo 'Le joueur 2 a gagné !!';
}