<?php

// Contains PDO obj that has config data to connect to DB
// Returns the data for our queries
function get_connection()
{
    $config = require 'lib/config.php';

    return new PDO(
        $config['database_dsn'],
        $config['database_user'],
        $config['database_pass']
    );
}

// Function for returning all pets from the pets table
// Queries and limits the number of animals displayed
// fetchAll() returns a numeric array from a result set (the SQL query below)
function get_pets($limit = null)
{
    $config = require 'lib/config.php';

    $pdo = get_connection();
    // TODO - PREVENT SQL INJECTION
    $query = 'SELECT * FROM pets';
    if ($limit) {
        $query = $query.' LIMIT '. $limit;
    }
    $result = $pdo->query($query); 
    $pets = $result->fetchAll(); 

    return $pets;
}

function get_pet($id)
{
    $pdo = get_connection();
    // TODO - SECURITY RISK
    $query = 'SELECT * FROM pets WHERE id = '.$id;
    $result = $pdo->query($query);
    $pet = $result->fetch();

    return $pet;
}
// Function that saves newly added pets
function save_pets($petsToSave)
{
    $json = json_encode($petsToSave, JSON_PRETTY_PRINT);
    // TODO - Create a new entry to the pet DB not the pets file.
    file_put_contents('data/pets.json', $json);
}
