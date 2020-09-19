<label for='password'>Password (At least 8 characters, one Capital letter and one number) *</label>
<input type='password' id='password' name='password' placeholder=""/>
<meter max="4" id="password-strength-meter"></meter>
<p id="password-strength-text"></p>

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
    var meter = document.getElementById('password-strength-meter');
    var text = document.getElementById('password-strength-text');

    password.addEventListener('input', function() {
        var val = password.value;
        
        var strongRegex = new RegExp("([A-Za-z0-9!-*]){8,}");
        var myArray = val.match(strongRegex);
        console.log(myArray);
        if (myArray != null){
            result = 4;
            meter.innerHTML = "100%";
        }else{
            result = 1;
            meter.innerHTML = "20%";
        }

        if (val.length < 4){
            meter.innerHTML = "0%";
        }
        
        // Update the password strength meter
        meter.value = result;

        // Update the text indicator
        if (val !== "") {
            text.innerHTML = "Strength: " + strength[result]; 
        } else {
            text.innerHTML = "";
        }
    });
</script>