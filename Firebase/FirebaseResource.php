<?php


namespace firebase\models;
require_once './vendor/autoload.php';

class FirebaseResource
{
    protected $database;
    protected $dbname; // Name of the Firebase Table

    public function __construct($firebase, $resource) {

        $this->database = $firebase->createDatabase();
        $this->dbname = $resource;
    }

    /**
     * @param int|NULL $userID
     * @return bool|mixed
     * @throws \Kreait\Firebase\Exception\ApiException
     *
     * Getting data from the Firebase
     */
    public function get(int $userID = NULL){
        if (empty($userID) || !isset($userID)) { return false; }

        if ($this->database->getReference($this->dbname)->getSnapshot()->hasChild($userID)) {
            return $this->database->getReference($this->dbname)->getChild($userID)->getValue();
        } else {
            return false;
        }
    }

    /**
     * @param array $data
     * @return bool
     * @throws \Kreait\Firebase\Exception\ApiException
     *
     * Adding data inside the Firebase
     */
    public function insert(array $data) {
        if (empty($data) || !isset($data)) {return false; }

        foreach ($data as $key => $value) {
            //You can set push() in order to get generated keys. Read more in docs.
            $this->database->getReference()->getChild($this->dbname)->getChild($key)->set($value);
        }
        return true;
    }

    /**
     * @param int $userID
     * @return bool
     * @throws \Kreait\Firebase\Exception\ApiException
     *
     * Deleting data from the Firebase
     */
    public function delete(int $userID) {
        if (empty($userID) || !isset($userID)) { return false; }

        if ($this->database->getReference($this->dbname)->getSnapshot()->hasChild($userID)) {
            $this->database->getReference($this->dbname)->getChild($userID)->remove();
            return true;
        } else {
            return false;
        }
    }
}