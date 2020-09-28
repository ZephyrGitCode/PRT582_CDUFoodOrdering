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
  ?>
    <script src='jquery-3.2.1.min.js'></script>
    <script type="text/javascript">
    jQuery(document).ready(function(){
    // This button will increment the value
    $('[data-quantity="plus"]').click(function(e){
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        fieldName = $(this).attr('data-field');
        // Get its current value
        var currentVal = parseInt($('input[name='+fieldName+']').val());
        // If is not undefined
        if (!isNaN(currentVal)) {
            // Increment
            $('input[name='+fieldName+']').val(currentVal + 1);
        } else {
            // Otherwise put a 0 there
            $('input[name='+fieldName+']').val(0);
        }
    });
    // This button will decrement the value till 0
    $('[data-quantity="minus"]').click(function(e) {
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        fieldName = $(this).attr('data-field');
        // Get its current value
        var currentVal = parseInt($('input[name='+fieldName+']').val());
        // If it isn't undefined or its greater than 0
        if (!isNaN(currentVal) && currentVal > 0) {
            // Decrement one
            $('input[name='+fieldName+']').val(currentVal - 1);
        } else {
            // Otherwise put a 0 there
            $('input[name='+fieldName+']').val(0);
        }
    });
});
    </script>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
      <div class="productcontainer">
        <img class="productimage" src="<?php echo "{$image}" ?>" class="itemimage"/>
        <div class="producttext">
          <h2><i><?php echo "{$title}"?></i></h2>
          <p class="itemdesc"><?php echo "{$itemdesc}" ?></p>
          <p class="price">AUD $<?php echo "{$price}" ?></p>
          
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
                <button type="button" class="button hollow circle" data-quantity="minus" data-field="quantity">
                <i class="fa fa-minus" aria-hidden="true"></i>
                </button>
              </div>
              <div class="input-custom">
                <input class="input-group-field" type="number" name="quantity" value="1">
              </div>
              <div class="input-group-button">
                <button type="button" class="button hollow circle" data-quantity="plus" data-field="quantity">
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

