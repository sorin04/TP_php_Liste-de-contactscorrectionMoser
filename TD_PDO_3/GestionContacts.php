<?php


require_once 'Contact.php';

class GestionContacts {
    public $tabContacts;

    public function __construct(){
        $this->tabContacts = array();
        $this->tabContacts[] = new Contact('jolivet', 'max');
        $this->tabContacts[] = new Contact('mory', 'rémi');
        $this->tabContacts[] = new Contact('helly', 'fred');
        $this->tabContacts[] = new Contact('dupond', 'walter');
    }

    public function triNomAsc(){
        usort($this->tabContacts,
            function ($c1, $c2) {
                return $c1->getNom() <=> $c2->getNom();  // <=> est l'opérateur de comparaison introduit en PHP 7
            }
        );
    }

    public function triPrenomAsc(){
        usort($this->tabContacts,
            function ($c1, $c2) {
                return $c1->getPrenom()<=> $c2->getPrenom(); // <=> est l'opérateur de comparaison introduit en PHP 7
            }
        );
    }

    public function ajoutContact($nom, $prenom){
        $this->tabContacts[] = new Contact($nom, $prenom);
        echo '<h3>Nouveau contact à ajouter: '.$nom.' '.$prenom.'</h3>';
    }


    public function afficheContacts(){
        foreach ($this->tabContacts as $contact) {
            echo '<ul>' .
                '<li>' . $contact->getNom() . ' ' . $contact->getPrenom() . '</li>' .
                '</ul>';
        }
    }

}