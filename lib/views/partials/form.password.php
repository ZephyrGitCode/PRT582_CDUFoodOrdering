<label for='password'>Password (At least 8 characters, one Capital letter and one number) *</label>
<input type='password' id='password' name='password' placeholder=""/>
<!--<meter max="4" id="password-strength-meter"></meter>-->
<p id="password-strength-text"></p>
<span class="showBtn btn" id="showBtn" style="margin-bottom:15px;">Reveal Password</span>
<script src="https://cdnjs.cloudflare.com/ajax/libs/zxcvbn/4.2.0/zxcvbn.js"></script>

<script>
    var strength = {
    0: "Worst",
    1: "Bad",
    2: "Weak",
    3: "Good",
    4: "Strong"
    }
    var result = 0;
    var password = document.getElementById('password');
    //var meter = document.getElementById('password-strength-meter');
    var text = document.getElementById('password-strength-text');

    password.addEventListener('input', function() {
    var val = password.value;
    var result = zxcvbn(val);

    // Update the password strength meter
   //meter.value = result.score;

    // Update the text indicator
    if (val !== "") {
        text.innerHTML = "Strength: " + strength[result.score]; 
    } else {
        text.innerHTML = "";
    }
    });

    var showBtn = document.getElementById('showBtn');
    showBtn.onclick = function(){
        if(password.type == "password"){
            password.type = "text";
            showBtn.textContent = "Hide";
        }else{
            password.type = "password";
            showBtn.textContent = "Show";
        }
    };
</script>