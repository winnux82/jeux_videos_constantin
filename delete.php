// delete.php
<?php

include ('connect.php') ;
/*
try {
    $db = new PDO('mysql:dbname=gebd;host=127.0.0.1', 'root', '');
} catch (Exception $e) {
    echo $e;
}
*/
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Requête effectuée en GET
    // Affichage du message de confirmation de suppression

    if (isset($_GET['id'])) { // Vérifions que l'url comporte un paramètre `id`
	      $id = (int) $_GET['id']; // Castons la chaîne de caractères en nombre
        // $id = intval($_GET['id']);
        // Préparation de la requête
        $q = $bdd->prepare('SELECT * FROM jeux_video WHERE ID=:id');

        // Liaison du paramètre :id
        $q->bindParam(':id', $id);

        // Exécution de la requête
        $q->execute();

        // Récupération du premier résultat dans une variable
        $data = $q->fetch(PDO::FETCH_ASSOC);

        // Vérification que notre requête correspond à une ligne en base de données
        if ($data) {
            // Affichage du formulaire

	          $html = '<form method="POST" action="">';
            $html .= '<label for="id">ID</label>';
            $html .= '<input type="text" name="id" value="'.$data['ID'].'"  />';
            $html .= '<p>Voulez-vous supprimer l\'enregistrment ayant pour nom ' . $data['nom'] . '?</p>';
            $html .= '<input type="submit" name="bSubmit" value="Submit" />';

            echo $html;

        } else {
            throw new Exception('No row found with id '.$id);
        }
    } else {
        throw new Exception('No id specified.'); // S'il n'y a pas d'id dans la requête, générons une erreur
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Requête effectuée en POST
    // Suppression des données

    $id = (int) $_POST['id'];

    // Préparation de la requête
    $q = $bdd->prepare('DELETE FROM jeux_video WHERE ID=:id');

    // Liaison des paramètres
    $q->bindParam(':id', $id);

    // Exécution de la requête
    $q->execute();

    // Redirection
    header('Location: index.php');
}