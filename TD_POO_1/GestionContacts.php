<?php
require_once 'Contact.php';

class GestionContacts{
    public $tabContacts;

    public function __construct(){
        $this->tabContacts = array();
        $this->tabContacts[] = new Contact('jolivet', 'max');
        $this->tabContacts[] = new Contact('mory', 'rémi');
        $this->tabContacts[] = new Contact('helly', 'fred');
        $this->tabContacts[] = new Contact('dupond', 'alban');
    }

    public function triNomAsc(){
        usort($this->tabContacts,
            function ($c1, $c2) {
                return strcmp($c1->getNom(), $c2->getNom());
            }
        );
    }

    public function afficheContacts(){
        $this->triNomAsc();
        foreach ($this->tabContacts as $contact) {
            echo    "<ul>" .
                        '<li>' . $contact->getNom() . ' ' . $contact->getPrenom() . '</li>' .
                    "</ul>";
        }
    }


}