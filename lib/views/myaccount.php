<head>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
</head>

<body class="accountBody">
    <div class="userBox">
        <h3 class="accounth3">My Account</h3>
        <label class="userPic" for="userImage">
        <input type="file" name="userImage" id="userImage" style="display:none;">
        <img class="userPic" src="https://i.imgur.com/cmDNHJ7.png" id="avatar" style="cursor:pointer"/>
        </label>
        <?php
        $user = $user[0];
        // if user is not empty
        if(!empty($user) && $user['id'] == get_user_id()){
        ?>
        <form action='/myaccount/<?php if(!empty($user['id']))echo $user['id']?>' method='POST'>
            <input type='hidden' name='_method' value='put' />
            <h4>User Details</h4>
            
            <p class="acctext">Title:</p>
            <select name="title" class="titledrop">
                <option value="Mr."> Mr.</option>
                <option value="Mrs."> Mrs.</option>
                <option value="Miss"> Miss</option>
                <option value="Ms."> Ms.</option>
                <option value="Dr."> Dr.</option>
            </select>
            <br/>

            <p class="acctext">Email:</p>
            <div class="inputBox">
                <input type="text" name="email" id="email" value="<?php echo $user['email']?>">
                <span><i class="fa fa-envelope" aria-hidden="true"></i></span>
            </div>

            <p class="acctext">First Name:</p>
            <div class="inputBox">
                <input type="text" id="fname" name="fname" value="<?php echo $user['fname']?>">
                <span><i class="fa fa-user" aria-hidden="true"></i></span>
            </div>

            <p class="acctext">Last Name:</p>
            <div class="inputBox">
                <input type="text" id="lname" name="lname" value="<?php echo $user['lname']?>">
                <span><i class="fa fa-user" aria-hidden="true"></i></span>
            </div>

            <p class="acctext">Phone:</p>
            <div class="inputBox">
                <input type="text" id="phone" name="phone" value="<?php echo $user['phone']?>">
                <span><i class="fa fa-user" aria-hidden="true"></i></span>
            </div>

            <h4>Shipping Details</h4>
            <p class="acctext">Country:</p>
            <div class="inputBox">
                <input type="text" id="country" name="country" value="<?php echo $user['country']?>">
                <span><i class="fa fa-user" aria-hidden="true"></i></span>
            </div>

            <p class="acctext">Address:</p>
            <div class="inputBox">
                <input type="text" id="address" name="address" value="<?php echo $user['city']?>">
                <span><i class="fa fa-user" aria-hidden="true"></i></span>
            </div>
            
            <p class="acctext">Shipping State:</p>
            <div class="inputBox">
                <input type="text" id="state" name="state" value="<?php echo $user['shipping_state']?>">
                <span><i class="fa fa-user" aria-hidden="true"></i></span>
            </div>

            <p class="acctext">City:</p>
            <div class="inputBox">
                <input type="text" id="city" name="city" value="<?php echo $user['city']?>">
                <span><i class="fa fa-user" aria-hidden="true"></i></span>
            </div>

            <p class="acctext">Postcode:</p>
            <div class="inputBox">
                <input type="text" id="postcode" name="postcode" value="<?php echo $user['postcode']?>">
                <span><i class="fa fa-user" aria-hidden="true"></i></span>
            </div>

            <input type="submit" name="" value="Save">
        </form>
        <?php
        }else{
            echo "User data failed to load.";
        }
        ?>

    </div>
</body>