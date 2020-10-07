<div class="vendorselect">

  <a href="catalogue/1">
    <img src="lib/views/images/lunchroom.png" class="vendorimage" height=200 width=200/>
  </a>

  <a href="catalogue/2">
    <img src="lib/views/images/uglyduckling.png" class="vendorimage" height=200 width=200/>
  </a>
  
  <a href="catalogue/3">
    <img src="lib/views/images/arthouse.png" class="vendorimage" height=200 width=200/>
  </a>


</div>

<?php
  if(is_authenticated()){
    require PARTIALS."/footer.html.php";
  }
?>