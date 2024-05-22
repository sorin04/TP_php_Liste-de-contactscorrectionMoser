<?php
require_once 'Contact.php';
require_once 'Bdd.php';
class Bdd
{
    private $host ='localhost';
    private $base = 'contacts';
    private $user = 'root';
    private $password = '';
    private function Connection(){
        try{
            $this->bdd = new PDO('mysql:host='.$this->host.';dbname='.$this->base, $this->user, $this->password);
        }catch(PDOException $e){

            echo 'Echec de connexion : '.$e->getMessage();
            $this->bdd = null;
        }
    }
    public function __construct() {
        $this->Connection();
        $this->getContacts();
        $this->deleteContact();
        $this->postContact();
        $this->getContact();

    }
    public function getContacts() {
        try {
            $stmt = $this->bdd->query('SELECT * FROM contact');
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
            return [];
        }
    }

    public function deleteContact(){
        if ($this->bdd){
            try {
                $stmt = $this->bdd->prepare('DELETE FROM contacts WHERE id = :id');
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->execute();


            }catch (PDOException $e){
                echo 'Erreur :'.$e->getMessage();
            }
        }





    }
    public function postContact($nom,$prenom){
        if ($this->bdd) {
            try {
                $stmt = $this->bdd->prepare('INSERT INTO contact (nom, prenom) VALUES (?, ?)');
                $stmt->bindParam(':nom', $nom);
                $stmt->bindParam(':prenom', $prenom);
                $stmt->execute();
            } catch (PDOException $e) {
                echo 'Erreur : ' . $e->getMessage();
            }
        }
    }


    public function getContact($id){
        if ($this->bdd) {
            try {
                $stmt = $this->bdd->prepare('SELECT * FROM contact WHERE id = :id');
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->execute();
                return $stmt->fetch(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                echo 'Erreur : ' . $e->getMessage();
                return null;
            }
        }
        return null;
    }







}