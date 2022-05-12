<?php

// The following string contains our locally host db 'pet_data' hosted on localhost
// 'root' and 'null' are where our username and password to the DB would go. 
// accessing all pets from the pets table
// fetch all returns a numeric array from a result set (the SQL query below)
function get_pets()
{
    $config = require 'lib/config.php';

    $pdo = new PDO(
        $config['database_dsn'],
        $config['database_user'],
        $config['database_pass']
    );
    $result = $pdo->query('SELECT * FROM pets'); 
    $pets = $result->fetchAll(); 

    return $pets;
}

function save_pets($petsToSave)
{
    $json = json_encode($petsToSave, JSON_PRETTY_PRINT);
    file_put_contents('data/pets.json', $json);
}
