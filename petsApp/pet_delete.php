<?php 
// Page to display message that a pet was deleted and return to home page
// this will let me play with routing a little
require 'lib/functions.php';

require 'layout/header.php';

if (isset($_POST['deletePet'])) {
    $id = $_POST['deletePet'];
        
    delete_pet($id);
    echo '<h1> Your pet is DEAD </h1>';
    //header();
} else {
    echo '<h1> There is no pet to delete!</h1>';
}

?>
<!-- option to create a new pet if someone reaches this page via the search bar-->
<!-- also want to style the page more -->
<div class="container">
    <div class="row justify-items-center">
        <div class="col-lg-2">
            <h2><a class="btn btn-primary" href="/pets_new.php">Post another pet!</a></h2>
        </div>
    </div>
</div>

<?php require 'layout/footer.php'; ?>