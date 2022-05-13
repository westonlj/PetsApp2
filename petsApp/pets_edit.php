<?php
require 'lib/functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['name'])) {
        $name = $_POST['name'];
    } else {
        $name = 'A dog without a name';
    }

    if (isset($_POST['breed'])) {
        $breed = $_POST['breed'];
    } else {
        $breed = '';
    }

    if (isset($_POST['weight'])) {
        $weight = $_POST['weight'];
    } else {
        $weight = '';
    }

    if (isset($_POST['age'])) {
        $age = $_POST['age'];
    } else {
        $age = 'Unknown';
    }

    if (isset($_POST['information'])) {
        $information = $_POST['information'];
    } else {
        $information = '';
    }

    if (isset($_POST['petId'])) {
        $id = $_POST['petId'];
        if (!get_pet($id)) {
            echo 'PET NOT FOUND';
            die;
        }
    } else {
        throw new \Exception('NO ID FOUND');
        // or could catch and die the error
    }

    $pet = [
        'name' => $name,
        'breed' => $breed,
        'weight' => $weight,
        'information' => $information,
        'age' => $age,
        'image' => '',
        'id' => $id
    ];

    update_pet($pet);
    
    header('Location: /show.php?id='.$pet['id']);
    die;
}

$id = $_GET['id'];
$pet = get_pet($id);
?>

<?php require 'layout/header.php'; ?>

<div class="container">
    <div class="row">
        <div class="col-xs-6">
            <h1>Edit your Pet! Squirrel!</h1>

            <form action="/pets_edit.php" method="POST">
                <!-- could put the id in an input inside of a div tag with a style saying it's not visible -->
                <div class="form-group">
                    <label for="pet-name" class="control-label">Pet Name</label>
                    <input type="text" name="name" id="pet-name" class="form-control" value="<?php echo $pet['name'];?>"/>
                </div>
                <div class="form-group">
                    <label for="pet-breed" class="control-label">Breed</label>
                    <input type="text" name="breed" id="pet-breed" class="form-control" value="<?php echo $pet['breed'];?>"/>
                </div>
                <div class="form-group">
                    <label for="pet-weight" class="control-label">Weight (lbs)</label>
                    <input type="number" name="weight" id="pet-weight" class="form-control" value="<?php echo $pet['weight'];?>"/>
                </div>
                <div class="form-group">
                    <label for="pet-age" class="control-label">Age (Years)</label>
                    <input type="number" name="age" id="pet-age" class="form-control" value="<?php echo $pet['age'];?>"/>
                </div>
                <div class="form-group">
                    <label for="pet-bio" class="control-label">Pet Bio</label>
                    <textarea name="information" id="pet-bio" class="form-control"><?php echo $pet['information'];?></textarea>
                </div>

                <button type="submit" class="btn btn-primary" name="petId" value="<?php echo $id?>"><span class="glyphicon glyphicon-heart"></span> Submit </button>
            </form>

        </div>
    </div>
</div>


Squirrel!

<?php require 'layout/footer.php'; ?>