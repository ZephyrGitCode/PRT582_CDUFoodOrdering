<p><?php echo $message ?></p>

<h2>Menu</h2>

<div class="foodmenu">
  
<?php
if(!empty($items)){
  
  
  foreach($items As $item){
    $itemno = htmlspecialchars($item['itemNo'],ENT_QUOTES, 'UTF-8');
    $vendorno = htmlspecialchars($item['vendorNo'],ENT_QUOTES, 'UTF-8');
    $itemname = htmlspecialchars($item['itemName'],ENT_QUOTES, 'UTF-8');
    $itemdesc = htmlspecialchars($item['itemDesc'],ENT_QUOTES, 'UTF-8');
    $price = htmlspecialchars($item['price'],ENT_QUOTES, 'UTF-8');
    $itemimage = htmlspecialchars($item['itemImage'],ENT_QUOTES, 'UTF-8');
    ?>
    <div class="menuitem">
    <a href="<?php echo "/"."singleitem/"."{$itemno}"?>">
          <div class="fimage">
            <img href="" src="<?php echo "{$itemimage}"?>" class="itemimage"/>
          </div>
        </a>
<?php
      echo "<div class=\"singlelist\">";
      echo "<li>{$itemname}</li>";
      echo "<li>\${$price}</li>";
      echo "</div>";
?>
      <!-- <a href="<?php //echo "/"."singleitem/"."{$itemno}"?>" class="inspect"><p>Inspect</p></a>-->
      </div>
<?php
    }
  }
  else{
    echo "<h2>Database Failed to load.</h2>";
}
?>
</div>

<?php
  require PARTIALS."/footer.html.php";
?>