<label for='email'>Email *</label>
<input type='text' id='email' name='email' placeholder=""/>

<script>
    var email = document.getElementById('email');
    var regex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/
    email.addEventListener('input', function() {
        if (email.value.match(regex))
        {
            console.log("Valid email")
        }else{
            console.log("Invalid email")
        }
    });
</script>