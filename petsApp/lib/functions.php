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
    return $statement->fetch(PDO::FETCH_ASSOC);
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

function update_pet($pet)
{
    // blah blah logic
    // UPDATE `pet_data`.`pets` SET `age` = '8 years' WHERE `id` = 7;
    $pdo = get_connection();
    $query = 
        'UPDATE pet_data.pets 
        SET name = :nameVal, breed = :breedVal, weight = :weightVal, information = :infoVal, age = :ageVal 
        WHERE id = :idVal';
    $statement = $pdo->prepare($query);
    $statement->bindParam('nameVal', $pet['name']);
    $statement->bindParam('breedVal', $pet['breed']);
    $statement->bindParam('weightVal', $pet['weight']);
    $statement->bindParam('infoVal', $pet['information']);
    $statement->bindParam('ageVal', $pet['age']);
    $statement->bindParam('idVal', $pet['id']);

    $statement->execute();
    
}

// TODO - DELETE_PET
// Function to remove a pet from the pet table.
function delete_pet($petToDelete)
{
    // DELETE FROM `pet_data`.`pets` WHERE `id` = 8;
    $pdo = get_connection();
    $query = 'DELETE FROM pets WHERE id = :petToDelete';

    $statement = $pdo->prepare($query);
    $statement->bindParam('petToDelete', $petToDelete);

    $statement->execute();
}
