<?php
include ('connect.php') ;

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Requête effectuée en GET
    // Affichage du formulaire prérempli

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
            $html .= '<table>';
            $html .= '<tr><td><label for="id">ID</label></td>';
            $html .= '<td><input type="text" name="id" value="'.$data['ID'].'" readonly /><br></td></tr>';
            $html .= '<tr><td><label for="nom">nom</label></td><td> <input type="text" name="nom" value="'.$data['nom'].'" /></td></tr>';
            $html .= '<tr><td><label for="possesseur">possesseur</label></td><td> <input type="text" name="possesseur" value="'.$data['possesseur'].'" /></td></tr>';
            $html .= '<tr><td><label for="console">console</label></td><td> <input type="text" name="console" value="'.$data['console'].'" /></td></tr>';
            $html .= '<tr><td><label for="prix">prix</label></td><td> <input type="text" name="prix" value="'.$data['prix'].'" pattern="[0-9]+" maxlength="3"/></td></tr>';
            $html .= '<tr><td><label for="nbre_joueurs_max">nbre_joueurs_max</label></td><td> <input type="text" name="nbre_joueurs_max" value="'.$data['nbre_joueurs_max'].'" pattern="[0-9]+" maxlength="3"/></td></tr>';
            $html .= '<tr><td><label for="commentaires">commentaires</label></td><td> <input type="text" name="commentaires" value="'.$data['commentaires'].'" /></td></tr>';
            $html .= '</table>';
            $html .= '<input type="submit" name="bSubmit" value="Editer" />';

            echo $html;

        } else {
            throw new Exception('No row found with ID '.$id);
        }
    } else {
        throw new Exception('No id specified.'); // S'il n'y a pas d'id dans la requête, générons une erreur
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Requête effectuée en POST
    // Sauvegarde des données

    $id = (int) $_POST['id'];
    $nom = $_POST['nom'];
    $possesseur=$_POST['possesseur'];
    $console=$_POST['console'];
    $prix=(int) $_POST['prix'];
    $nbre_joueurs_max= (int) $_POST['nbre_joueurs_max'];
    $commentaires=$_POST['commentaires'];

        // Préparation de la requête
        $q = $bdd->prepare('UPDATE jeux_video set nom =:nom,possesseur=:possesseur,console=:console, prix=:prix, nbre_joueurs_max=:nbre_joueurs_max, commentaires=:commentaires WHERE ID=:id');

        // Liaison du paramètre :id
        $q->bindParam(':id', $id);
        $q->bindParam(':nom', $nom);
        $q->bindParam(':possesseur', $possesseur);
        $q->bindParam(':console', $console);
        $q->bindParam(':prix', $prix);
        $q->bindParam(':nbre_joueurs_max', $nbre_joueurs_max);
        $q->bindParam(':commentaires', $commentaires);


        // Exécution de la requête
        $q->execute();

        // Redirection
        header('Location: index.php');

}