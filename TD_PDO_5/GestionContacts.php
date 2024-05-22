<?php
require_once 'Contact.php';

class GestionContacts
{
    public $tabContacts;

    public function __construct()
    {
        $this->tabContacts = array();
        if (file_exists("archive.txt")) {
            if (filesize("archive.txt") !== 0) {
                $fileContent = file_get_contents("archive.txt");
                foreach (explode(PHP_EOL, $fileContent) as $row) {
                    $object = unserialize($row);
                    if ($object) {
                        $this->tabContacts[] = $object;
                    }
                }
            } else {
                $this->initDonnees();
            }
        } else {
            $this->initDonnees();
        }
    }

    public function initDonnees()
    {
        $this->tabContacts[] = new Contact('jolivet', 'max');
        $this->tabContacts[] = new Contact('mory', 'rémi');
        $this->tabContacts[] = new Contact('helly', 'fred');
        $this->tabContacts[] = new Contact('dupond', 'walter');
        foreach ($this->tabContacts as $contact) {
            file_put_contents("archive.txt", serialize($contact) . PHP_EOL, FILE_APPEND);
        }
    }

    public function triNomAsc()
    {
        usort($this->tabContacts,
            function ($c1, $c2) {
                return $c1->getNom() <=> $c2->getNom();  // <=> est l'opérateur de comparaison introduit en PHP 7
            }
        );
    }

    public function triPrenomAsc()
    {
        usort($this->tabContacts,
            function ($c1, $c2) {
                return $c1->getPrenom() <=> $c2->getPrenom(); // <=> est l'opérateur de comparaison introduit en PHP 7
            }
        );
    }

    public function ajoutContact($nom, $prenom)
    {
        $this->tabContacts[] = new Contact(str_replace(' ', '',$nom),str_replace(' ', '',$prenom));
        $this->tabContacts = $this->supprimeDoublons($this->tabContacts);
        $this->misAJourFichier("archive.txt");

    }

    public function supprimeDoublons($tab)
    {
        //Convertir les objets en chaînes de caractères pour pouvoir utiliser array_unique()
        $tabObjetStr = array_map('serialize', $tab);
        $tabObjetStr = array_unique($tabObjetStr);
        return array_map('unserialize', $tabObjetStr);
    }

    public function misAJourFichier($path)
    {
        //vide le fichier
        file_put_contents($path, '');
        foreach ($this->tabContacts as $contact) {
            file_put_contents($path, serialize($contact) . PHP_EOL, FILE_APPEND);
        }
    }


    public function afficheContacts()
    {
        foreach ($this->tabContacts as $contact) {
            echo '<ul>' .
                '<li>' . $contact->getNom() . ' ' . $contact->getPrenom() . '</li>' .
                '</ul>';
        }
    }

    public function supprimeContact($nom, $prenom)
    {
        $tabObjetTemp = array();
        foreach ($this->tabContacts as $contact) {
            if (!($contact->getNom() == str_replace(' ', '',$nom) && $contact->getPrenom() == str_replace(' ', '',$prenom))) {
                $tabObjetTemp[] = $contact;
            }
        }
        $this->tabContacts = [];
        $this->tabContacts = $tabObjetTemp;
        $this->misAJourFichier("archive.txt");
    }

}