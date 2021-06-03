<?php


namespace firebase\models;

require_once './vendor/autoload.php';
use Kreait\Firebase\Factory;

class User
{
    protected $database;
    protected $dbname = 'users'; // Name of the Firebase Table

    public function __construct() {
        $firebase = (new Factory)->withServiceAccount(__DIR__ . './parking-81cb5-firebase-adminsdk-rnt56-1916e91393.json')
            ->withDatabaseUri('https://parking-81cb5-default-rtdb.europe-west1.firebasedatabase.app');

        $this->database = $firebase->createDatabase();
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


$user = new User();

// Adding the data to the database
var_dump($user->insert([
    '1' => ["nom"=> "hatem", "prenom"=> "dagbouj"],
    '2' => 'Input 2.2',
    '3' => 'Input 3.3'
]));

 var_dump($user->get(1)); // pull the data from the database

 var_dump($user->delete(3)); // deleting data from the database
die();