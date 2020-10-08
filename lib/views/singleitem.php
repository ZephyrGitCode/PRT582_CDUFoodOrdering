<section class="products">

<button class = "btn btn-primary" onclick="goBack()">&#8678; Back to Menu</button>

<script>
  function goBack() {
    window.history.back();
  }
</script>

<?php
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
      $vendorNo = htmlspecialchars($item['vendorNo'],ENT_QUOTES, 'UTF-8');
  ?>

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
      <div class="productcontainer">
        <img class="productimage" src="<?php echo "{$image}" ?>"/>
        <div class="producttext">
          <h3><i><?php echo "{$title}"?></i></h3>
          <p class="itemdesc"><?php echo "{$itemdesc}" ?></p>
          <p id="price">AUD $<?php echo "{$price}" ?></p>
          
          <form action="/singleitem" method="POST">
            <input type='hidden' name='_method' value='post' />
            <input type='hidden' name='itemNo' value='<?php echo($itemno) ?>' />
            <input type='hidden' name='vendorNo' value='<?php echo($vendorNo) ?>' />
            
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
                <input class="input-group-field" type="number" id= "quantity" name="quantity" value="1" min="1">
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
            }
            // End if Notcombo
            ?>
          </form>
          <?php

          // Start Add to cart submit
            
            // start if combo
            if (preg_match('/Small/', $title))
            {
              if (!is_authenticated()){ echo "<a href='/signin'><button type='button' class='btn btn-default cart'>Please sign in to add to cart</button></a>";}
              else{
                echo "<a href='/combobox/{$id}' ><button class='btn btn-default cart'>Create Small Combo</button></a>";
              }
            }elseif (preg_match('/Medium/', $title))
            {
              if (!is_authenticated()){ echo "<a href='/signin'><button type='button' class='btn btn-default cart'>Please sign in to add to cart</button></a>";}
              else{
                echo "<a href='/combobox/{$id}' ><button class='btn btn-default cart'>Create Medium Combo</button></a>";
              }
            }elseif (preg_match('/Large/', $title))
            {
              if (!is_authenticated()){ echo "<a href='/signin'><button type='button' class='btn btn-default cart'>Please sign in to add to cart</button></a>";}
              else{
                echo "<a href='/combobox/{$id}' ><button class='btn btn-default cart'>Create Large Combo</button></a>";
              }
            }
              // end if combo
            ?>
        </div>
      </div>
<?php
      //}
    }
  }
  else{
    echo "<h2>Food item failed to load</h2>";
}

require PARTIALS."/quantityscript.html.php";
?>
