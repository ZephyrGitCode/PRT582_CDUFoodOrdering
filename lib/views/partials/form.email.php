<label for='email'>Email *</label>
<input type='text' id='email' name='email' placeholder=""/>
<p id="emailtext"></p>

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