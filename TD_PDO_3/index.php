<?php
require_once 'GestionContacts.php';
$gestion = new GestionContacts();
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Le Titre</title>
        <meta charset="utf-8">

        <!-- Compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">


    </head>

    <body>

        <header>
            <div>
                <h2>TD1_PHP_POO</h2>
            </div>
        </header>
        <h3>Liste de contacts</h3>

        <section>
            <div class="row">
                <div class="col s4 offset">
                    <div class="card teal">
                        <div class="card-image">
                            <img src="../images/R.png">
                            <span class="card-title black-text"><b>Card Title</b></span>
                        </div>
                        <div class="card-content">
                            <?php
                            if(isset($_POST['buttonNom'])) {
                                $gestion->triNomAsc();
                            }
                            if(isset($_POST['buttonPrenom'])) {
                                $gestion->triPrenomAsc();
                            }
                            $gestion->afficheContacts();
                            ?>
                            <form action="index.php" method="post">
                                <!-- Bouton pour trier par nom -->
                                <input type="submit" name="buttonNom" value="Tri->nom"/>
                                <!-- Bouton pour trier par prénom -->
                                <input type="submit" name="buttonPrenom" value="Tri->prénom"/>
                            </form>
                        </div>
                    </div>
                </div>
            </div>





        </section>


        <footer>
            <br>
            BTS CIEL LPO ASTIER 2024
        </footer>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    </body>
</html>