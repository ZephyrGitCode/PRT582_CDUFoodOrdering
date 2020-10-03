<script src='jquery-3.2.1.min.js'></script>

<head>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
</head>

<body class="accountBody">
    <p id="response"></p>
    <div class="userBox">
        
    <?php
        echo"<h3>Shopping Cart</h3>"; 
        $total =0;     
    ?>
    <table class="shoppingcart">
        <tr>
        <th>Item</th>
        <th>Qty</th>
        <th>Cost</th>
        <th></th>
        </tr>
        <?php
        $count = 0;
        if(!empty($cartitems)){
            foreach($cartitems As $item){
                $cartno = htmlspecialchars($item['cartNo'],ENT_QUOTES, 'UTF-8');
                $itemno = htmlspecialchars($item['itemNo'],ENT_QUOTES, 'UTF-8');
                $vendorno = htmlspecialchars($item['vendorNo'],ENT_QUOTES, 'UTF-8');
                $itemname = htmlspecialchars($item['itemName'],ENT_QUOTES, 'UTF-8');
                $itemdesc = htmlspecialchars($item['itemDesc'],ENT_QUOTES, 'UTF-8');
                $price = htmlspecialchars($item['price'],ENT_QUOTES, 'UTF-8');
                $itemimage = htmlspecialchars($item['itemImage'],ENT_QUOTES, 'UTF-8');
                $quantity = htmlspecialchars($item['quantity'],ENT_QUOTES, 'UTF-8');
                //Get get selections where
                //foreach selection as 
                if ($item['comboNo'] != null){
                    $combos = get_combo($item['comboNo']);
                    foreach($combos As $thing){
                        $selectone = get_selection($thing['selectionOne']);
                        foreach($selectone As $s){
                            $s1 = $s['selectionName'];
                        }
                        $selecttwo= get_selection($thing['selectionTwo']);
                        foreach($selecttwo As $s){
                            $s2 = $s['selectionName'];
                        }
                        $selectthree = get_selection($thing['selectionThree']);
                        foreach($selectthree As $s){
                            $s3 = $s['selectionName'];
                        }
                    }
                $selections = $s1.", ".$s2." and ".$s3;
                }
                $cost = $price * $quantity;
                $count +=1;
        ?>

        <tr>
        <td><div class="fimage">
        <img href="" src="<?php echo "{$itemimage}"?>" class="itemimage"/>
        </div>
        <?php echo "{$itemname}"?>
        <?php
        if (preg_match('/Combo/', $title)){
            echo "{$itemdesc}</td>";
        }else{
            echo "{$selections}</td>";
        }
        ?>
        </td>
        <td>
            <button type="button" class="button hollow circle" data-quantity="plus" data-field="quantity" id="increase" onclick="increaseValue(<?php echo $count; ?>)" value="Increase Value">
                <i class="fa fa-plus" aria-hidden="true"></i>
            </button>
            <p id = "quantity<?php echo $count; ?>"><?php echo "{$quantity}"?></p>
            <button type="button" class="button hollow circle" data-quantity="minus" data-field="quantity" id="decrease" onclick="decreaseValue(<?php echo $count; ?>)" value="Decrease Value">
                <i class="fa fa-minus" aria-hidden="true"></i>
            </button>

        </td>
        <td>$<?php echo "{$cost}"; $total += $cost?></td>
        <td>
        <form action="/cart" method="POST">
            <input type='hidden' name='_method' value='delete' />
            <input type='hidden' name='cartNo' value='<?php echo($cartno) ?>' />
            <input type="submit" class="btn btn-default cart" name="RemovefromCart" value="X">
        </form>
        </td>
        </tr>           
            
        <?php }}   ?>    
        
    </table>
    <p style="text-align:center">Total : $<?php echo"$total"?>
    <form action="/cart" method="POST">
            <input type='hidden' name='_method' value='post' />
            <div class="pickup_time">
            <label for="pickup_time">Pickup time:</label>
            <input style="width:200px; text-align:center;" type ='time' name='pickup_time'  id='pickup_time'/>
            </div>
            <input type='hidden' name='total' value='<?php echo($total) ?>' />
            <input type="submit" class="btn btn-default cart" name="Checkout" value="Checkout">
    </form>
    </div>

    
    <script>
        function increaseValue(id){
            var value = parseInt(document.getElementById('quantity'+id).innerHTML, 10);
            value = isNaN(value) ? 0 : value;
            value++;
            document.getElementById('quantity'+id).value = value;
            document.getElementById('quantity'+id).innerHTML = value;
        }

        function decreaseValue(id){
            var value = parseInt(document.getElementById('quantity'+id).innerHTML, 10);
            value = isNaN(value) ? 0 : value;
            value--;
            document.getElementById('quantity'+id).value = value;
            document.getElementById('quantity'+id).innerHTML = value;
        }
    </script>