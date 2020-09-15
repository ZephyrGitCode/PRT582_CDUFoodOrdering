<head>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
</head>

<body class="accountBody">
    <p id="response"></p>
    <div class="userBox">
      
        <?php
            require MODEL;
             if(!empty($cartitems)){
                echo"<h3>Shopping Cart</h3>"; 
        ?>
        <div>Item</div>
            <div class="shoppingcart">
                
                <div>Quantity</div>
                <div>Price/Item</div>
                <div>Total Cost</div>
                
                <?php
                    foreach($cartitems As $item){
                        $itemno = htmlspecialchars($item['itemNo'],ENT_QUOTES, 'UTF-8');
                        $vendorno = htmlspecialchars($item['vendorNo'],ENT_QUOTES, 'UTF-8');
                        $itemname = htmlspecialchars($item['itemName'],ENT_QUOTES, 'UTF-8');
                        $itemdesc = htmlspecialchars($item['itemDesc'],ENT_QUOTES, 'UTF-8');
                        $price = htmlspecialchars($item['price'],ENT_QUOTES, 'UTF-8');
                        $itemimage = htmlspecialchars($item['itemImage'],ENT_QUOTES, 'UTF-8');
                        $quantity = htmlspecialchars($item['quantity'],ENT_QUOTES, 'UTF-8');
                        $cost = $price * $quantity;
                ?>
            
                
                <div><div class="fimage">
                    <img href="" src="<?php echo "{$itemimage}"?>" class="itemimage"/>
                </div></div>
                <div><?php echo "{$itemname}"?></div>
                <div><?php echo "{$quantity}"?></div>
                <div>$<?php echo "{$price}"?></div>
                <div>$<?php echo "{$cost}"?></div>
                </tr>           
            </table>
            
                    <?php } }else{
            echo "<h2>Database Failed to load.</h2>";
            } 
    ?>
