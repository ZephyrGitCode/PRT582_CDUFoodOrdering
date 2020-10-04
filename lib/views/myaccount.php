<head>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
</head>

<div class="container signup-body userBox">
    <h3 class="accounth3">My Account</h3>
    <p style="color:red;text-align:center;"><?php echo $error ?> </p>   
    <div class="container form-container" style="text-align:left;">
        <?php
        $user = $user[0];
        // if user is not empty
        if(!empty($user) && $user['userNo'] == get_user_id()){
        ?>
        <form action='/myaccount/<?php if(!empty($user['userNo']))echo $user['userNo']?>' method='POST'>
            <input type='hidden' name='_method' value='put' />

            <p class="acctext">Email:</p>
            <div class="inputBox">
                <input type="text" name="email" id="email" value="<?php echo $user['email']?>">
                <span><i class="fa fa-envelope fa-icon" aria-hidden="true"></i></span>
                <p id="emailtext"></p>
            </div>

            <p class="acctext">First Name:</p>
            <div class="inputBox">
                <input type="text" id="fname" name="fname" value="<?php echo $user['fname']?>">
                <span><i class="fa fa-user fa-icon" aria-hidden="true"></i></span>
            </div>

            <p class="acctext">Last Name:</p>
            <div class="inputBox">
                <input type="text" id="lname" name="lname" value="<?php echo $user['lname']?>">
                <span><i class="fa fa-user fa-icon" aria-hidden="true"></i></span>
            </div>

            <p class="acctext">Phone:</p>
            <div class="inputBox">
                <input type="text" id="phone" name="phone" value="<?php echo $user['phone']?>" pattern="^[0-9]*$" onkeypress='return restrictAlphabets(event)' maxlength="10">
                <span><i class="fa fa-user fa-icon" aria-hidden="true"></i></span>
            </div>

            <input type="submit" name="" value="Save">
        </form>
        <?php
        }else{
            echo "User data failed to load.";
        }
        ?>
    </div>
</div>

<script>
    var email = document.getElementById('email');
    var etext = document.getElementById('emailtext');
    var regex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/
    email.addEventListener('input', function() {
        if (email.value.match(regex))
        {
            etext.style.color = "Green"
            etext.innerHTML = "Email is Valid"
        }else{
            etext.style.color = "Red"
            etext.innerHTML = "Invalid Email"
        }
    });

    function restrictAlphabets(e){
       var x = e.which || e.keycode;
        if((x>=48 && x<=57))
            return true;
        else
            return false;
    }
</script>