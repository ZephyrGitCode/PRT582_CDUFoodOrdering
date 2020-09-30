<p class="danger"><?php echo $error ?></p>

<section class="products">

<button class = "btn btn-primary" onclick="goBack()">&#8678; Back to Menu</button>

<script>
  function goBack() {
    window.history.back();
  }
</script>
<p>Message to self: Need to create a "combo" SQL table.</p>
<div class="productcontainer">

  <div class="selections">
    <select>
    <?php
    // setting permanant variable
    $selections = $selection;
    if(!empty($selections)){
      //foreach($items As $item){
      foreach($selections As $selection){
        $selectionNo = htmlspecialchars($selection['selectionNo'],ENT_QUOTES, 'UTF-8');
        $selectionName = htmlspecialchars($selection['selectionName'],ENT_QUOTES, 'UTF-8');
        $selectionDesc = htmlspecialchars($selection['selectionDesc'],ENT_QUOTES, 'UTF-8');
    ?>
      <option value="<?php echo "{$selectionNo}"?>"><?php echo "{$selectionName}"?></option>
    <?php
      }
    }
    else{
      echo "<h2>Selections failed to load</h2>";
    }
    ?>
    </select>
  </div>

  <div class="selections">
    <select>
    <?php
    if(!empty($selection)){
      //foreach($items As $item){
      foreach($selections As $selection){
        $selectionNo = htmlspecialchars($selection['selectionNo'],ENT_QUOTES, 'UTF-8');
        $selectionName = htmlspecialchars($selection['selectionName'],ENT_QUOTES, 'UTF-8');
        $selectionDesc = htmlspecialchars($selection['selectionDesc'],ENT_QUOTES, 'UTF-8');
    ?>
      <option value="<?php echo "{$selectionNo}"?>"><?php echo "{$selectionName}"?></option>
    <?php
      }
    }
    else{
      echo "<h2>Selections failed to load</h2>";
    }
    ?>
    </select>
  </div>
  <div class="selections">
    <select>
    <?php
    if(!empty($selection)){
      //foreach($items As $item){
      foreach($selections As $selection){
        $selectionNo = htmlspecialchars($selection['selectionNo'],ENT_QUOTES, 'UTF-8');
        $selectionName = htmlspecialchars($selection['selectionName'],ENT_QUOTES, 'UTF-8');
        $selectionDesc = htmlspecialchars($selection['selectionDesc'],ENT_QUOTES, 'UTF-8');
    ?>
      <option value="<?php echo "{$selectionNo}"?>"><?php echo "{$selectionName}"?></option>
    <?php
      }
    }
    else{
      echo "<h2>Selections failed to load</h2>";
    }
    ?>
    </select>
  </div>
</div>

<form action="/combobox" method="POST">
  <input type='hidden' name='_method' value='post' />
  <input type = 'hidden' name='selectionOne' value='' />
  <input type = 'hidden' name='selectionTwo' value='' />
  <input type = 'hidden' name='selectionThree' value='' />
</form>