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

echo "Hello RPG\n";

$nom = input("Quel est votre nom ? ");

echo "Votre nom est $nom";