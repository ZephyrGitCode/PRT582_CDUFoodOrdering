<section class="products">
<?php
session_start();
$isadmin = $_SESSION['isadmin'];
session_write_close();




// Can utilize the following code for single food info
if(!empty($items)){
    echo "<h2>Artworks</h2>";
    foreach($items As $item){
      $itemno = htmlspecialchars($item['itemNo'],ENT_QUOTES, 'UTF-8');
      if ($itemno == $id){
        $title = htmlspecialchars($item['itemName'],ENT_QUOTES, 'UTF-8');
        $itemdesc = htmlspecialchars($item['itemDesc'],ENT_QUOTES, 'UTF-8');
        $price = htmlspecialchars($item['price'],ENT_QUOTES, 'UTF-8');
        $image = htmlspecialchars($item['itemImage'],ENT_QUOTES, 'UTF-8');
      
    
  ?>
      <div class="productcontainer">
        <img class="productimage" src="<?php echo "{$image}" ?>" class="itemimage"/>
        <div class="producttext">
          <h2><i><?php echo "{$title}"?></i></h2>
          <p class="itemdesc"><?php echo "{$itemdesc}" ?></p>
          <p class="price">AUD $<?php echo "{$price}" ?></p>
          
          <form action="/singleitem" method="POST">
            <input type='hidden' name='_method' value='post' />
            <input type='hidden' name='itemNo' value='<?php echo($itemno) ?>' />
            <label  class="productlabel">Quantity:</label>
            <input name="quantity" class="productinput" id="quantity" type="number" value="1" min=0 oninput="validity.valid||(value='');">
            <?php 
            if (is_authenticated()){
            ?>
            <input type="submit" class="btn btn-default cart" name="Add to Cart">
          </form>
          <?php
          }else{
          ?>
          <a href='/signin'><button type="button" class="btn btn-default cart" >Please sign in to add to cart</button></a>
          <?php
          }
          ?>
          </div>
      </div>
<?php
      }
    }
  }
  else{
    echo "<h2>Artwork failed to load</h2>";
}
/*
?>

<div id="showcart" class="showcart">
  <a href="javascript:void(0)" class="closecart" onclick="closecart()">×</a>
  <br/>
  <br/>
  <h4>Artwork added to cart</h4>
  <p id="artadd"></p>
</div>

<div class="testimonials">
  <form action="/art/<?php echo $id ?>" method='POST'>
    <input type='hidden' name='_method' value='post' />
    <h4>Testimonials</h4>
    <p class="acctext">Share a message about this artwork</p>
    <textarea id="test" name="test"></textarea>

    <input type="submit" name="" value="Send Message">
  </form>

  <div class="test-list">
    <?php
    if(!empty($testimonials)){
      foreach($testimonials As $test){
        $approved = htmlspecialchars($test['approved'],ENT_QUOTES, 'UTF-8');
        if ($approved == 'true' || $usertype == "admin"){
          $userno = htmlspecialchars($test['id'],ENT_QUOTES, 'UTF-8');
          $testtext = htmlspecialchars($test['test'],ENT_QUOTES, 'UTF-8');
          $testid = htmlspecialchars($test['testNo'],ENT_QUOTES, 'UTF-8');
    ?>
    <div class="test">
      <p style="font-weight: 500; margin: .2rem 1rem;">User id: <?php echo $userno ?></p>
      <p style="margin: .2rem 1rem";><?php echo $testtext ?></p>
      <?php

      if ($usertype == 'admin' && $approved == 'false'){
        //echo "admin";
        ?>
        <form action="/art/<?php echo $testid ?>" method='POST'>
          <input type='hidden' name='_method' value='put' />
          <p style="display: inline;margin: .2rem 1rem;">Comment awaiting approval</p><input type="submit" name="" value="Approve" style="display:inline;">
        </form>
        <?php
      }else{
        //echo "user";
      }
      ?>
    </div>
    <?php
        }
      }
    }else{
      echo "<h4>No previous testiments</h4>";
    }
    ?>
    

  </div>
</div>
<script>
   //Convert this to session storage stuff - Maybe Alvin
  document.querySelector(".cart").addEventListener('click', addtocart);

  function addtocart(evt){
    var quant = document.getElementById("quantity").value;
    if ("art"+<?php //echo $id ?> in localStorage){
      var localdata = JSON.parse(localStorage.getItem("art"+<?php //echo $id ?>));
      var localquant = localdata["quantity"];
      var quant = parseInt(localquant) + parseInt(quant);
    }
    artdata = {"artno":<?php //echo $id ?>,"quantity":parseInt(quant),"title":"<?php echo $title ?>", "price":<?php echo $price ?>, "url":"<?php echo $image ?>"};
    var saveinputs = JSON.stringify(artdata);
    var totalkeys = localStorage.length;
    localStorage.setItem("art"+<?php //echo $id ?>, saveinputs);
    
    document.getElementById("artadd").innerHTML="Artwork: "+"<?php //echo $title ?>"+". Quantity: "+quant;
    document.getElementById("showcart").style.display = "block";
  }
  
  function closecart() {
    document.getElementById("showcart").style.display = "none";
  }

</script>
*/
?>