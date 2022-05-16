<?php

// Account creation page

/* Style notes: 
    Center the creation box, accepting an email address, username 
    -> which can then be added to the pets pages to show ownership and be common keys between the pets table and users table

    username -> will need to check for availability of a username after form submission is attempted.
        -> async I think would allow for us to check for availability as they enter it.

    password -> validate password to conform to certain fields/ length.

    User objects? -> easier to get the data if we can refer to an object. 
*/
?>

<?php require 'layout/header.php'?>

<div class="container">
    <div class="row">
        <h3>Create An Account!</h3>
        <form>
            <div>
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email">
            </div>
            <div>
                <label for="email">Username</label>
                <input type="text" id="email" name="email">
            </div>
            <div>
                <label for="pwd">Password</label>
                <input type="password" id="pwd" name="pwd">
            </div>
        </form>
    </div>
</div>

