<section class="products">
<?php
session_start();
$isadmin = $_SESSION['isadmin'];
session_write_close();
?>

<?php
if(!empty($items)){
  echo "<h2>Items</h2>";
  foreach($items As $item){
    $itemno = htmlspecialchars($item['itemNo'], ENT_QUOTES, 'UTF-8');
    if ($itemno == $id){
      $itemname = htmlspecialchars($item['itemName'], ENT_QUOTES, 'UTF-8');
    }
    echo "Item Name: ".$itemname;
  }
}


/*
// Can utilize the following code for single food info
if(!empty($arts)){
    echo "<h2>Artworks</h2>";
    foreach($arts As $art){
      $artno = htmlspecialchars($art['artNo'],ENT_QUOTES, 'UTF-8');
      if ($artno == $id){
        $title = htmlspecialchars($art['title'],ENT_QUOTES, 'UTF-8');
        //$author = htmlspecialchars($art['author'],ENT_QUOTES, 'UTF-8');
        $artdesc = htmlspecialchars($art['artdesc'],ENT_QUOTES, 'UTF-8');
        $price = htmlspecialchars($art['price'],ENT_QUOTES, 'UTF-8');
        $category = htmlspecialchars($art['category'],ENT_QUOTES, 'UTF-8');
        $size = htmlspecialchars($art['size'],ENT_QUOTES, 'UTF-8');
        $image = htmlspecialchars($art['link'],ENT_QUOTES, 'UTF-8');
      ?>
      <div class="productcontainer">
        <img class="productimage" src="<?php echo "{$image}" ?>" class="artimage"/>
        <div class="producttext">
          <h2><i><?php echo "{$title}"?></i></h2>
          <p><b>Author: 0nyxheart<?php //echo "{$author}" ?></b></p>
          <p class="price">AUD $<?php echo "{$price}" ?></p>
          <p><b>Size: </b><?php echo "{$size}" ?></P>

          <label class="productlabel">Quantity:</label>
          <input class="productinput" id="quantity" type="number" value="1" min=0 oninput="validity.valid||(value='');">
          <?php 
          if (is_authenticated()){
          ?>
          <button type="button" class="btn btn-default cart" >Add to cart</button>
          <?php
          }else{
          ?>
          <button type="button" class="btn btn-default cart" disabled>Please sign in to add to cart</button>
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