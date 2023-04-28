<?php

    echo "Exercice Gaulois PDO<br><br>1.Afficher la liste des gaulois avec nom du personnage, spécialité et lieu d'habitation (de la table lieu)<br><br>";

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

$sqlQuery1 = 
    "SELECT nom_personnage, specialite.nom_specialite, lieu.nom_lieu FROM personnage
    INNER JOIN lieu ON personnage.id_lieu = lieu.id_lieu
    INNER JOIN specialite ON personnage.id_specialite = specialite.id_specialite";

$personnageGaulois = $db->prepare($sqlQuery1);
$personnageGaulois->execute();
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

?>