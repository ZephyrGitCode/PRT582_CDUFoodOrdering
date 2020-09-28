<section class="products">
<?php

session_start();
$isadmin = $_SESSION['isadmin'];
session_write_close();
$item = $item[0];
// Can utilize the following code for single food info
if(!empty($item)){
    //foreach($items As $item){
    $itemno = htmlspecialchars($item['itemNo'],ENT_QUOTES, 'UTF-8');
    if ($itemno == $id){
      $title = htmlspecialchars($item['itemName'],ENT_QUOTES, 'UTF-8');
      $itemdesc = htmlspecialchars($item['itemDesc'],ENT_QUOTES, 'UTF-8');
      $price = htmlspecialchars($item['price'],ENT_QUOTES, 'UTF-8');
      $image = htmlspecialchars($item['itemImage'],ENT_QUOTES, 'UTF-8');
  ?>
    <script src='jquery-3.2.1.min.js'></script>
    <script type="text/javascript">
function increaseValue() {
  var value = parseInt(document.getElementById('quantity').value, 10);
  value = isNaN(value) ? 0 : value;
  value++;
  document.getElementById('quantity').value = value;
  price = 'AUD $'+`<span>${(p * value).toFixed(2)}</span>`;
  document.getElementById('price').innerHTML=price;
}

function decreaseValue() {
  var value = parseInt(document.getElementById('quantity').value, 10);
  value = isNaN(value) ? 0 : value;
  value < 1 ? value = 1 : '';
  value--;
  document.getElementById('quantity').value = value;
  price = 'AUD $'+`<span>${(p * value).toFixed(2)}</span>`;
  document.getElementById('price').innerHTML=price;
}
var p= <?php echo "{$price}";?>;
var price = 'AUD $ '+`<span>${p}</span>`;
document.getElementById('price').innerHTML=price;
    </script>

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
      <div class="productcontainer">
        <img class="productimage" src="<?php echo "{$image}" ?>" class="itemimage"/>
        <div class="producttext">
          <h2><i><?php echo "{$title}"?></i></h2>
          <p class="itemdesc"><?php echo "{$itemdesc}" ?></p>
          <p id="price">AUD $<?php echo "{$price}" ?></p>
          
          <form action="/singleitem" method="POST">
            <input type='hidden' name='_method' value='post' />
            <input type='hidden' name='itemNo' value='<?php echo($itemno) ?>' />
            

            <?php
            // Start if NOT combo
            if (!preg_match('/Combo/', $title))
            {
              ?>
              
            <label  class="productlabel">Quantity:</label>
            <div class="input-group plus-minus-input">
              <div class="input-group-button">
                <button type="button" class="button hollow circle" data-quantity="minus" data-field="quantity" id="decrease" onclick="decreaseValue()" value="Decrease Value">
                <i class="fa fa-minus" aria-hidden="true"></i>
                </button>
              </div>
              <div class="input-custom">
                <input class="input-group-field" type="number" id= "quantity" name="quantity" value="1">
              </div>
              <div class="input-group-button">
                <button type="button" class="button hollow circle" data-quantity="plus" data-field="quantity" id="increase" onclick="increaseValue()" value="Increase Value">
                  <i class="fa fa-plus" aria-hidden="true"></i>
                </button>
              </div>
            </div>




            <?php
            // Start Add to cart submit
              if (is_authenticated()){
            ?>
              <input type="submit" class="btn btn-default cart" value="Add to Cart" name="Add to Cart">
          
            <?php
              }else{
            ?>
              <a href='/signin'><button type="button" class="btn btn-default cart">Please sign in to add to cart</button></a>
            <?php
              }
            // End add to cart submit
            ?>

            <?php
              // End if Notcombo
            }
            else
            {
              
              // start if combo
              if (preg_match('/Small/', $title))
              {
                echo "<a href='#' ><button class='btn btn-default'>Combo selection Small</button></a>";
              }elseif (preg_match('/Medium/', $title))
              {
                echo "<a href='#' ><button class='btn btn-default'>Combo selection Medium</button></a>";
              }elseif (preg_match('/Large/', $title))
              {
                echo "<a href='#' ><button class='btn btn-default'>Combo selection Large</button></a>";
              }
              // end if combo
            }
            
            ?>
           
            
          </form>
        </div>
      </div>
<?php
      //}
    }
  }
  else{
    echo "<h2>Food item failed to load</h2>";
}
?>