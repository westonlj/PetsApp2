<?php
require 'lib/functions.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    if (!empty($_POST['name'])) {
        $name = $_POST['name'];
    } else {
        $errors[] = 'This pet needs a name!';
    }

    if (!empty($_POST['breed'])) {
        $breed = $_POST['breed'];
    } else {
        $errors[] = 'This pet needs a breed!';
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

    if (isset($_POST['bio'])) {
        $information = $_POST['bio'];
    } else {
        $information = '';
    }

    // add an image to the local directory:
    if (isset($_POST['image']) && count($errors) == 0) {
        $image = $_FILES['image'];
        var_dump($_FILES);
        die;
        //move_uploaded_file($image['newImage'], "/images/".$image[$name]);
    }

    // explicit way of seeing the errors array is EMPTY
    if (count($errors) == 0) {

        $newPet = array(
            'name' => $name,
            'breed' => $breed,
            'weight' => $weight,
            'information' => $information,
            'age' => $age,
            'image' => '',
        );

        save_pet($newPet);
        header('Location: /');
        die;
    }
    // We do have errors

}
?>

<?php require 'layout/header.php'; ?>

<div class="container">
    <div class="row">
        <div class="col-xs-6">
            <h1>Add your Pet! Squirrel!</h1>
            <?php if (count($errors) > 0) {?>
                <div class="alert alert-danger" role="alert">
                    <h3>ERROR - Please correct the following...</h3>
                    <ul>
                        <?php foreach ($errors as $error) { ?>                    
                            <li><?php echo $error . "<br />"; ?></li>
                        <?php } ?>
                    </ul>
                </div>
            <?php } ?>
            <form action="/pets_new.php" method="POST">
                <div class="form-group">
                    <label for="pet-name" class="control-label">Pet Name</label>
                    <input type="text" name="name" id="pet-name" class="form-control" />
                </div>
                <div class="form-group">
                    <label for="pet-breed" class="control-label">Breed</label>
                    <input type="text" name="breed" id="pet-breed" class="form-control" />
                </div>
                <div class="form-group">
                    <label for="pet-weight" class="control-label">Weight (lbs)</label>
                    <input type="number" name="weight" id="pet-weight" class="form-control" />
                </div>
                <div class="form-group">
                    <label for="pet-age" class="control-label">Age (Years)</label>
                    <input type="number" name="age" id="pet-age" class="form-control" />
                </div>
                <div class="form-group">
                    <label for="pet-image" class="control-label">Upload an Image</label>
                    <input type="file" name="image" id="pet-image"/>
                </div>
                <div class="form-group">
                    <label for="pet-bio" class="control-label">Pet Bio</label>
                    <textarea name="bio" id="pet-bio" class="form-control"></textarea>
                </div>

                <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-heart"></span> Add</button>
            </form>

        </div>
    </div>
</div>


Squirrel!

<?php require 'layout/footer.php'; ?>
