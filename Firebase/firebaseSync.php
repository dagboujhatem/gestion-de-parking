<?php

require_once 'FirebaseResource.php';

use firebase\models\FirebaseResource;
use Kreait\Firebase\Factory;

function firebaseSync($query, $resource)
{
    /**
     * create firebase config
     */

    $firebase = (new Factory)->withServiceAccount(__DIR__ . './secret/parking-81cb5-firebase-adminsdk-rnt56-1916e91393.json')
        ->withDatabaseUri('https://parking-81cb5-default-rtdb.europe-west1.firebasedatabase.app');
    /**
     *  Firebase sync data
     */
    while($row= $query->fetch_assoc()):
        // create firebase resource
        $firebaseUser = new FirebaseResource($firebase,  $resource);
        //// Adding the data to the database
        $firebaseUser->insert([$row['id'] => $row]);
    endwhile;
}