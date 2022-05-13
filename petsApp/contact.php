<?php
require 'lib/functions.php';

$contacts = [
    'user1' => [
        'name' => 'Smith Johnson',
        'position' => 'Business Guy',
        'contact' => 'email@email.org',
        'passions' => 'Mini-Golf'
    ],
    'user2' => [
        'name' => 'Jane Bro',
        'position' => 'Marketing Boss',
        'contact' => 'emails@email.org',
        'passions' => 'Lifting'
    ],
    'user3' => [
        'name' => 'Baby Face',
        'position' => 'Poster Child',
        'contact' => 'MyFaceIsOnAPoster@email.com',
        'passions' => 'Interpretive dance'
    ],
]
?>

<?php require 'layout/header.php'; ?>

<div class="container">
    <div>
        <h1>
            Helping you find your new best friend from over <?php echo count(get_pets()); ?> pets.
        </h1>
        <!-- GRID OF LINKS/ CONTACTS -->
        <div class="row">
            <?php foreach ($contacts as $contact) {?>
            <div class="col">
                <h3><?php echo $contact['name'];?></h3>
                <blockquote>
                    <span>My Job: <?php echo $contact['position']?></span>
                    <p>I am passionate about: <?php echo $contact['passions'] ?></p>
                    <a>Contact me: <?php echo $contact['contact']?></a>
                </blockquote>
            </div>
            <?php }?>
        </div>
    </div>
</div>


<?php require 'layout/footer.php'; ?>
