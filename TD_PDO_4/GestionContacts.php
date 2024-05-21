<?php
require_once 'Contact.php';

class GestionContacts {
    public $tabContacts;

    public function __construct() {
        $this->tabContacts = array();

        if (file_exists("archive.txt")) {
            $fileContent = file_get_contents("archive.txt");
            foreach (explode(PHP_EOL, $fileContent) as $row) {
                if (filesize("archive.txt") !== 0) {
                    $object = unserialize($row);
                    if ($object) {
                        $this->tabContacts[] = $object;
                    }
                } else {
                    $this->adData();
                }
            }
        } else {
            $this->adData();
        }
    }

    public function adData() {
        $this->tabContacts[] = new Contact('jolivet', 'max');
        $this->tabContacts[] = new Contact('mory', 'rémi');
        $this->tabContacts[] = new Contact('helly', 'fred');
        $this->tabContacts[] = new Contact('dupond', 'walter');
        foreach ($this->tabContacts as $contact) {
            file_put_contents("archive.txt", serialize($contact) . PHP_EOL, FILE_APPEND);
        }
    }

    public function triNomAsc() {
        usort($this->tabContacts,
            function ($c1, $c2) {
                return $c1->getNom() <=> $c2->getNom();  // <=> est l'opérateur de comparaison introduit en PHP 7
            }
        );
    }

    public function triPrenomAsc() {
        usort($this->tabContacts,
            function ($c1, $c2) {
                return $c1->getPrenom() <=> $c2->getPrenom(); // <=> est l'opérateur de comparaison introduit en PHP 7
            }
        );
    }

    public function ajoutContact($nom, $prenom) {
        $this->tabContacts[] = new Contact($nom, $prenom);
        file_put_contents("archive.txt", serialize($this->tabContacts[count($this->tabContacts) - 1]).PHP_EOL, FILE_APPEND);
        $this->supprimerDoublons();
        echo '<h3>Nouveau contact à ajouter: ' . $nom . ' ' . $prenom . '</h3>';
    }

    public function supprimerDoublons() {
        $contactsUniques = [];
        $contactsSansDoublons = [];

        foreach ($this->tabContacts as $contact) {
            $identifiantContact = $contact->getNom() . ' ' . $contact->getPrenom();
            if (!isset($contactsUniques[$identifiantContact])) {
                $contactsUniques[$identifiantContact] = true;
                $contactsSansDoublons[] = $contact;
            }
        }

        $this->tabContacts = $contactsSansDoublons;

        // Mise à jour du fichier archive.txt
        file_put_contents("archive.txt", '');
        foreach ($this->tabContacts as $contact) {
            file_put_contents("archive.txt", serialize($contact) . PHP_EOL, FILE_APPEND);
        }
    }

    public function afficheContacts() {
        foreach ($this->tabContacts as $contact) {
            echo '<ul>' .
                '<li>' . $contact->getNom() . ' ' . $contact->getPrenom() . '</li>' .
                '</ul>';
        }
    }
}
