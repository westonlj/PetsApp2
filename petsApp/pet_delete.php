<?php 
// Page to display message that a pet was deleted and return to home page
// this will let me play with routing a little
require 'lib/functions.php';

require 'layout/header.php';

if (isset($_POST['deletePet'])) {
    $id = $_POST['deletePet'];
        
    delete_pet($id);
    echo '<h1> Your pet is DEAD </h1>';
    die;
    //header();
}

echo 'No pet was found';
// header to redirect

require 'layout/footer.php';