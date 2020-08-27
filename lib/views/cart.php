<head>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
</head>

<body class="accountBody">
    <p id="response"></p>
    <div class="userBox">
        <h3 style="padding: 0 0 20px;">Shopping Cart</h3>
        
        <div class="artworks" id="artworks"></div>
       

        <div class="checkout">
            <button id="checkoutbtn" onclick="purchase()">Checkout</button>
        </div>
    </div>
    
    <div class="processing" id="processing">
        <br/>
        <p>Processing Purchase</p>
        <p>Please be patient, You will be redirected shortly.</p>
    </div>
</body>

<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
<script>
    // Loops through each artwork and displays them on screen
    for(var i = 0; i < 11; i++) {
        var data = JSON.parse(localStorage.getItem("art"+i));
        if (data != null && "artno" in data){

            var newart = document.createElement('div');
            newart.setAttribute("style","margin-bottom: 20px;")

            var artimg = document.createElement('img');
            var desc = document.createElement('p');

            artimg.setAttribute("src", data["url"]);
            artimg.setAttribute("class", "productimage");

            desc.innerHTML = data['title']+", Quantity: "+data['quantity']+" Total: $"+ (data['price'] * data['quantity']);
            desc.setAttribute("style", "margin-bottom:.4rem;");

            // Adds a delete button for each entry
            var deleteRow = document.createElement('td');
            var deleteButton = document.createElement('button');
            deleteButton.setAttribute('class', 'delbtn');
            deleteButton.setAttribute('id', 'delbtn');
            deleteButton.innerHTML = 'Delete';
            deleteButton.dataset.key = i;
            deleteButton.addEventListener('click', deleteart, false);

            newart.appendChild(artimg);
            newart.appendChild(desc);
            newart.appendChild(deleteButton);

            document.querySelector('.artworks').appendChild(newart);
        }  
    }

    function deleteart(evt){
        var key = parseInt(evt.target.dataset.key);
        localStorage.removeItem("art"+key);
        // Reloads the window
        window.location.href = "/";
    }

    function purchase(){
        date="";
        date = "<?php echo $datetime ?>";
        
        // Displays processing text
        document.getElementById("processing").style.display = "block";
        // For each artwork possble (max 10)
        for(var i = 0; i < 11; i++) {
            // Convert data to javascript object
            var data = JSON.parse(localStorage.getItem("art"+i));
            // Checks if data is correct
            if (data != null && "artno" in data){
                // Calls send data function
                senddata(i, data, date);
            }
        }
        setTimeout(function(){window.location.href ="/";},1000*i);
    }

    function senddata(i, data, date){
        //total = data['quantity'] * data['price'];
        // Timeout function to allow for delayed calls to server
        setTimeout(function() {
            $.ajax({
                dataType: 'json',
                type: 'POST',  
                url: '/cart',
                // Sending data to be processed
                data: {
                    artno:data['artno'],
                    quantity:data['quantity'],
                    date:date,
                    total:(data['quantity']*data['price'])
                },
                success: function(response) {
                    $("#response").html(response);
                }
            });
            localStorage.removeItem("art"+i);
        }, 1000*i);
    }
</script>