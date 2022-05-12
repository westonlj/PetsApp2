<?php

// Contains PDO obj that has config data to connect to DB
// Returns the data for our queries
function get_connection()
{
    $config = require 'lib/config.php';

    $pdo = new PDO(
        $config['database_dsn'],
        $config['database_user'],
        $config['database_pass']
    );

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    return $pdo;
}

// Function for returning all pets from the pets table
// Queries and limits the number of animals displayed
// fetchAll() returns a numeric array from a result set (the SQL query below)
function get_pets($limit = null)
{
    $config = require 'lib/config.php';

    $pdo = get_connection();
    // Prepared statements using placeholders like :resultLimit
    $query = 'SELECT * FROM pets';
    // Our default param is set to null, which our queries hates
    if ($limit) { 
        $query = $query .' LIMIT :resultLimit';
    }
    // Will run even if there is limit is NULL, but will not make our LIMIT query null
    $statement = $pdo->prepare($query);

    if ($limit) { 
        // replaces our placeholder with limit THAT IS AN INT
        $statement->bindParam('resultLimit', $limit, PDO::PARAM_INT); 
    }
    $statement->execute(); 

    return $statement->fetchAll();
}

// Function to return one specific pet
function get_pet($id)
{
    $pdo = get_connection();
    // TODO - Prevent SQL Injection with Prepared Statements
    $query = 'SELECT * FROM pets WHERE id = :idVal';
    // prepare() creates and returns a PDO statement object
    $statement = $pdo->prepare($query);
    // bindParam replaces idVal with the value of $id and execute it
    $statement->bindParam('idVal', $id);
    $statement->execute();
    // we are still calling fetch (to get our data) on the pdo object when we return it
    return $statement->fetch();
}
// Function that saves newly added pets
function save_pet($petToSave)
{
    // $json = json_encode($petToSave, JSON_PRETTY_PRINT);
    // // TODO - Create a new entry to the pet DB not the pets file.
    // // file_put_contents('data/pets.json', $json);
    // var_dump($json);

    $pdo = get_connection();
    $query = 
        'INSERT INTO pets(name, breed, weight, information, image, age)
        VALUES(:nameVal, :breedVal, :weightVal, :infoVal, :imageVal, :ageVal)';
    $statement = $pdo->prepare($query);
    $statement->bindParam('nameVal', $petToSave['name']);
    $statement->bindParam('breedVal', $petToSave['breed']);
    $statement->bindParam('weightVal', $petToSave['weight']);
    $statement->bindParam('infoVal', $petToSave['information']);
    $statement->bindParam('imageVal', $petToSave['image']);
    $statement->bindParam('ageVal', $petToSave['age']);

    $statement->execute();

}
