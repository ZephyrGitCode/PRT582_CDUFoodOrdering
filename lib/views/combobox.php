<p class="danger"><?php echo $error ?></p>

<section class="products">

<button class = "btn btn-primary" onclick="goBack()">&#8678; Back</button>

<div class="productcontainer">
  <form action="/combobox" method="POST">

    <div class="selections">
      <select name = "selectionone">
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
      <select name = "selectiontwo">
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
      <select name = "selectionthree">
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

    <input type='hidden' name='_method' value='post' />
    <input type='hidden' name='itemNo' value='<?php echo($id) ?>' />
    <input type="submit" class="btn btn-default cart" value="Add to Cart" name="Add to Cart">
  </form>
</div>

<script>
  function goBack() {
    window.history.back();
  }
</script>
