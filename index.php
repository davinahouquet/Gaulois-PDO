<?php

    echo "Exercice Gaulois PDO<br>
    <br>
    Afficher (dans des tableaux HTML): <br>
    <br>
    -- la liste des gaulois avec nom du personnage, spécialité et lieu d'habitation (de la table lieu)
    <br>
    -- la liste des spécialités : nom de la spécialité et nombre de gaulois par spécialité 
    <br>
    -- la liste des potions : nom de la potion et nombre d'ingrédients de la potion
    <br>";

try{
    $db = new PDO(
        'mysql:host=127.0.0.1;dbname=gaulois;charset=utf8',
        'root',
        '',
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION],
    );
}
catch (Exception $e){
    die('Erreur : ' .$e->getMessage());
}

$sqlQuery = "SELECT nom_personnage FROM personnage";

$personnageGaulois = $db->prepare($sqlQuery);
$personnageGaulois->execute();
$gaulois = $personnageGaulois->fetchAll();

foreach($gaulois as $perso){
    echo "<p>".$perso['nom_personnage']."</p>";
}

?>