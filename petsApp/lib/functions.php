<?php

// Function for returning all pets from the pets table
// Contains PDO obj that has config data to connect to DB
// Queries and limits the number of animals displayed
// fetchAll() returns a numeric array from a result set (the SQL query below)
function get_pets($limit = null)
{
    $config = require 'lib/config.php';

    $pdo = new PDO(
        $config['database_dsn'],
        $config['database_user'],
        $config['database_pass']
    );
    // TODO - PREVENT SQL INJECTION
    $query = 'SELECT * FROM pets';
    if ($limit) {
        $query = $query.' LIMIT '. $limit;
    }
    $result = $pdo->query($query); 
    $pets = $result->fetchAll(); 

    return $pets;
}

// Function that saves newly added pets
function save_pets($petsToSave)
{
    $json = json_encode($petsToSave, JSON_PRETTY_PRINT);
    // TODO - Create a new entry to the pet DB not the pets file.
    file_put_contents('data/pets.json', $json);
}
