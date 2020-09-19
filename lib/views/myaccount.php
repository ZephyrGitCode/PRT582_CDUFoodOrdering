<head>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
</head>

<body class="accountBody">
    <div class="userBox">
        <h3 class="accounth3">My Account - Update Details</h3>
        </label>
        <?php
        $user = $user[0];
        // if user is not empty
        if(!empty($user) && $user['id'] == get_user_id()){
        ?>
        <form action='/myaccount/<?php if(!empty($user['id']))echo $user['id']?>' method='POST'>
            <input type='hidden' name='_method' value='put' />
            
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
                <p id="emailtext"></p>
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

            <input type="submit" name="" value="Save">
        </form>
        <?php
        }else{
            echo "User data failed to load.";
        }
        ?>

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
    </script>
</body>