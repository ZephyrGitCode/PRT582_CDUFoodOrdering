<body class="accountBody">
    <div class="userBox">
        <h3 class="accounth3">My Account</h3>
        <label class="userPic" for="userImage">
        <input type="file" name="userImage" id="userImage" style="display:none;">
        <img class="userPic" src="https://i.imgur.com/cmDNHJ7.png" id="avatar" style="cursor:pointer"/>
        </label>
        <?php
        $user = $user[0];
        if(!empty($user)){
        ?>
        <form action='/change/<?php if(!empty($user['id']))echo $user['id']?>' method='POST'>
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
</body>
