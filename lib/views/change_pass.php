<div class="container signup-body userBox">
    <h3 class="accounth3">My Account</h3>
    <p style="color:red;text-align:center;"><?php echo $error ?> </p>   
    <div class="container form-container">
        <?php
        $user = $user[0];
        if(!empty($user)){
        ?>
        <form action='/change/<?php if(!empty($user['userNo']))echo $user['userNo']?>' method='POST'>
            <input type='hidden' name='_method' value='put' />

            <?php
            require PARTIALS."/form.old-password.php";
            require PARTIALS."/form.password.php";
            require PARTIALS."/form.password-confirm.php";
            ?>

            <input type="submit" name="" value="Save">
        </form>

        <?php
        }else{
            echo "User data failed to load.";
        }
        ?>
    </div>
</div>