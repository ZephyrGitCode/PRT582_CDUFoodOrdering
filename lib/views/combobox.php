<p class="danger"><?php echo $error ?></p>

<section class="products">

<button class = "btn btn-primary" onclick="goBack()">&#8678; Back to Menu</button>

<script>
  function goBack() {
    window.history.back();
  }
</script>

<?php
// Can utilize the following code for single food info
if(!empty($selection)){
    //foreach($items As $item){
    foreach($selection As $selection){
      $selectionNo = htmlspecialchars($selection['selectionNo'],ENT_QUOTES, 'UTF-8');
      $selectionName = htmlspecialchars($selection['selectionName'],ENT_QUOTES, 'UTF-8');
      $selectionDesc = htmlspecialchars($selection['selectionDesc'],ENT_QUOTES, 'UTF-8');
  ?>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
      <div class="productcontainer">
        <div class="producttext">
          <h3><i><?php echo "{$selectionName}"?></i></h3>
          <p class="itemdesc"><?php echo "{$selectionDesc}" ?></p>
        </div>
      </div>
<?php
    }
  }
  else{
    echo "<h2>Selections failed to load</h2>";
}
?>

<form action="/combobox" method="POST">
  <input type='hidden' name='_method' value='post' />
  <input name='selectionOne' value='' />
  <input name='selectionTwo' value='' />
  <input name='selectionThree' value='' />
</form>