<?php 
require 'lib/functions.php';
require 'layout/header.php';

// Get the ID of the selected pet from index.
// delete button throughs an error that we are missing 'id' 
$id = $_GET['id'];
$pet = get_pet($id);

// Similar to the pets_new file we check if the button has been pressed and then run the needed functions
// aim is to pass id to a delete pet function
if(isset($_POST['deletePet'])) {
    //echo $id;
    echo 'ATTEMPTING TO DELETE';
    die;

    // TODO -> redirect to home page/ display a message "DELETED"
}
?>

<h1>Meet <?php echo $pet['name']; ?></h1>

<div class="container">
    <div class="row">
        <div class="col-xs-3 pet-list-item">
            <img src="/images/<?php echo $pet['image'] ?>" class="pull-left img-rounded" />
        </div>
        <div class="col-xs-6">
            <p>
                <?php echo $pet['information']; ?>
            </p>
        <form action="/show.php?id=<?php echo $id; ?>" method="GET">
            <table class="table">
                <tbody>
                    <tr>
                        <th>Breed</th>
                        <td><?php echo $pet['breed']; ?></td>
                    </tr>
                    <tr>
                        <th>Age</th>
                        <td><?php echo $pet['age']; ?></td>
                    </tr>
                    <tr>
                        <th>Weight</th>
                        <td><?php echo $pet['weight']; ?></td>
                    </tr>
                </tbody>
            </table>

            <!-- EDIT BUTTON NEXT TO DELETE BUTTON -->
            <button type="submit" class="btn btn-danger" name="deletePet" value="<?php $id?>">
                <span class="glyphicon glyphicon-remove"></span>
                    DELETE THIS FRIEND
            </button>
        </form>
        </div>
    </div>
</div>

<?php require 'layout/footer.php'; ?>