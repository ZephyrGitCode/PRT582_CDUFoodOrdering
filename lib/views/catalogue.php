<p><?php echo $message ?></p>

<?php
if(!empty($items)){
  echo "<h2>Menu</h2>";
  
  foreach($items As $item){
    $itemno = htmlspecialchars($item['itemNo'],ENT_QUOTES, 'UTF-8');
    $vendorno = htmlspecialchars($item['vendorNo'],ENT_QUOTES, 'UTF-8');
    $itemname = htmlspecialchars($item['itemName'],ENT_QUOTES, 'UTF-8');
    $itemdesc = htmlspecialchars($item['itemDesc'],ENT_QUOTES, 'UTF-8');
    $price = htmlspecialchars($item['price'],ENT_QUOTES, 'UTF-8');
    $itemimage = htmlspecialchars($item['itemImage'],ENT_QUOTES, 'UTF-8');
    ?>
    <div class="itemlist">
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
      <a href="<?php echo "/"."singleitem/"."{$itemno}"?>" class="inspect"><p>Inspect</p></a>
      <?php
?>
      </div>
<?php
    }
  }
  else{
    echo "<h2>Database Failed to load.</h2>";
}
?>