<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" type="text/css" href="style.css" /> -->
    <title>Document</title>
</head>

<body>

</body>

</html>

<?php
// connexion à la base 
include('connect.php');

//préparation de la requete 

$req = $bdd->query('select*from jeux_video') or die(print_r($bdd->errorInfo()));

echo "<H1> Liste des jeux vidéos</H1>";

//si on affiche toute la table

echo '<table border="1"  class="blueTable" >';
echo '<tr><td>ID</td><td>nom</td><td>possesseur</td><td>console</td><td>prix</td><td>joueurs</td><td>commentaires</td><td>modifier</td><td>supprimer</td></tr>';

while ($donnees = $req->fetch()) {
    echo '<tr><td>' . $donnees['ID'] . '</td>';
    echo '<td>' . $donnees['nom'] . '</td>';
    echo '<td>' . $donnees['possesseur'] . '</td>';
    echo '<td>' . $donnees['console'] . '</td>';
    echo '<td>' . $donnees['prix'] . '</td>';
    echo '<td>' . $donnees['nbre_joueurs_max'] . '</td>';
    echo '<td>' . $donnees['commentaires'] . '</td>';
    echo '<td><a href="edit.php?id=' . $donnees['ID'] . '">modifier</a></td>';
    echo '<td><a href="delete.php?id=' . $donnees['ID'] . '">delete</a></td></tr>';
};
echo '</table>';

?>