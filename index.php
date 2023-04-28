<?php

try{
    $db = new PDO(
        'mysql:host=localhost;dbname=gaulois;charset=utf8',
        'root',
        '',
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION],
    );
}
catch (Exception $e){
    die('Erreur : ' .$e->getMessage());
}
//---------------------------------------------------------------------------------------
echo "Exercice Gaulois PDO<br><br>1. Afficher la liste des gaulois avec nom du personnage, spécialité et lieu d'habitation (de la table lieu)<br><br>";
    
    $sqlQuery1 = //On déclare notre requête SQL dans une variable
        "SELECT nom_personnage, specialite.nom_specialite, lieu.nom_lieu FROM personnage
        INNER JOIN lieu ON personnage.id_lieu = lieu.id_lieu
        INNER JOIN specialite ON personnage.id_specialite = specialite.id_specialite";

                //On va récupérer les données envoyées à notre data base, qu'on stocke dans une autre variable
    $personnageGaulois = $db->prepare($sqlQuery1);
                //On exécute la requête
    $personnageGaulois->execute();
                //FetchAll = quand la requête SQL renvoie plusieurs lignes
    $gaulois = $personnageGaulois->fetchAll();

    echo "<table cellpadding=2 cellspacing=2 style='text-align : center'>
            <tr>
                <td>Nom</td>
                <td>Lieu</td>
                <td>Specialite</td>
            </tr>";

    foreach($gaulois as $perso){
        echo  "<table cellpadding=2 cellspacing=2>
                <td>".$perso['nom_personnage']."</td>
                <td>".$perso['nom_lieu']."</td>
                <td>".$perso['nom_specialite']."</td>
            </table>";
}
//----------------------------------------------------------------------------------------
    echo "<br>2. Afficher la liste des spécialités : nom de la spécialité et nombre de gaulois par spécialité<br><br>";

    $sqlQuery2 = 
        "SELECT nom_specialite, COUNT(personnage.id_personnage) AS 'nb_persos' FROM specialite
        INNER JOIN personnage ON specialite.id_specialite = personnage.id_specialite
        GROUP BY specialite.id_specialite
        ORDER BY COUNT(personnage.id_personnage) DESC";

    $specaliteGaulois = $db->prepare($sqlQuery2);
    $specaliteGaulois->execute();
    $gaulois2 = $specaliteGaulois->fetchAll();

    foreach($gaulois2 as $specialite){
        echo "<table cellpadding=2 cellspacing=2>
                <td>".$specialite['nom_specialite']."</td>
                <td>".$specialite['nb_persos']."</td>
            <table>";
    }

//------------------------------------------------------------------------------------------

    echo "<br>3. Afficher la liste des potions : nom de la potion et nombre d'ingrédients de la potion<br><br>";

    $sqlQuery3 = 
        "SELECT potion.nom_potion, COUNT(ingredient.id_ingredient) AS 'nb_ingredients' FROM potion
        INNER JOIN composer ON potion.id_potion = composer.id_potion
        INNER JOIN ingredient ON composer.id_ingredient = ingredient.id_ingredient
        GROUP BY potion.id_potion
        ORDER BY COUNT('nb_ingredients')";
 
    $potionGaulois = $db->prepare($sqlQuery3);
    $potionGaulois->execute();
    $gaulois3 = $potionGaulois->fetchAll();

    foreach($gaulois3 as $potion){
        echo "<table cellpadding=2 cellspacing=2>
                <td>".$potion['nom_potion']."</td>
                <td>".$potion['nb_ingredients']."</td>
            </table>";
    }
?>