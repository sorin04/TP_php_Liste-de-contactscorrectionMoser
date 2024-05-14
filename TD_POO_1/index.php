<?php
require_once 'GestionContacts.php';
$gestion = new GestionContacts();
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Le Titre</title>
        <meta charset="utf-8">
    </head>

    <body>

        <header>
            <div>
                <h2>TD1_PHP_POO</h2>
            </div>
        </header>

        <section>
            <h3>Liste de contacts</h3>
            <?php $gestion ->afficheContacts();?>
        </section>

        <footer>
            BTS CIEL LPO ASTIER 2024
        </footer>

    </body>
</html>