<head>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
</head>

<body class="accountBody">
    <p id="response"></p>
    <div class="userBox">
        
        <?php
            echo"<h3>Shopping Cart</h3>"; 
            
                
        ?>
        
            <table class="shoppingcart">
                <tr>
                <th style="text-align:center;" colspan ="2">Item</th>
                <th>Qty</th>
                <th>Cost</th>
                <th></th>
                </tr>
                <?php
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
                        $cost = $price * $quantity;
                ?>
            
                <tr>
                <td><div class="fimage">
                    <img href="" src="<?php echo "{$itemimage}"?>" class="itemimage"/>
                </div></td>
                <td><?php echo "{$itemname}"?></td>
                <td><?php echo "{$quantity}"?></td>
                <td>$<?php echo "{$cost}"?></td>
                <td>
            <form action="/cart" method="POST">
                <input type='hidden' name='_method' value='post' />
                <input type='hidden' name='cartNo' value='<?php echo($cartno) ?>' />
                <input type="submit" class="btn btn-default cart" name="RemovefromCart" value="X">
            </form>
                </td>
                </tr>           
            </table>
            
                    <?php }}
    ?>
