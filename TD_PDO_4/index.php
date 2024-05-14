<?php
require_once 'GestionContacts.php';
$gestion = new GestionContacts();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['buttonNom'])) {
        $gestion->triNomAsc();
    } elseif (isset($_POST['buttonPrenom'])) {
        $gestion->triPrenomAsc();
    } elseif (isset($_POST['ajoutContact'])) {
        $nom = $_POST['nom'] ?? '';
        $prenom = $_POST['prenom'] ?? '';
        if ($nom && $prenom) {
            $gestion->ajoutContact($nom, $prenom);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Le Titre</title>
    <meta charset="utf-8">
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <!-- Compiled and minified JavaScript -->
    <script async src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</head>

<body>

<header>
</header>

<div class="row">
    <div class="col m4 offset-m4">
        <div class="card teal z-depth-5">
            <div class="card-image" style="width:fit-content">
                <img width="auto" src="../images/R.png" alt="Liste de contacts">
                <span class="card-title black-text"><b>Card Title</b></span>
            </div>
            <div class="card-content white-text">
                <div class="card-content">
                    <?php
                    $gestion->afficheContacts();
                    ?>
                </div>
            </div>
            <div class="card-action">
                <form action="index.php" method="post">
                    <!-- Bouton pour trier par nom -->
                    <button class="btn waves-effect waves-light" type="submit" name="buttonNom">
                        <b>Nom</b>
                    </button>
                    <!-- Bouton pour trier par prénom -->
                    <button class="btn waves-effect waves-light" type="submit" name="buttonPrenom">
                        <b>Prénom</b>
                    </button>
                </form>
                <br>
                <form action="index.php" method="post">
                    <div class="input-field">
                        <input id="nom" type="text" name="nom" required>
                        <label for="nom">Nom</label>
                    </div>
                    <div class="input-field">
                        <input id="prenom" type="text" name="prenom" required>
                        <label for="prenom">Prénom</label>
                    </div>
                    <!-- Bouton pour ajouter un contact -->
                    <button class="btn waves-effect waves-light" type="submit" name="ajoutContact">
                        <b>Ajouter Contact</b>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<footer>
</footer>

</body>
</html>
