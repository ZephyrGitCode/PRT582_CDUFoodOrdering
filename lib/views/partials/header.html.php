<header class="navbar">
  <span style="font-size:30px;cursor:pointer;color:white" onclick="openNav()">&#9776;</span>
  <a href="/"><span><img src="https://ask.cdu.edu.au/euf/assets/images/edm/logos/intl-wedge-left-base-hd.png" width="50px" height="50px"></span></a>
  <h2 class="main-h2">CDU Food Ordering</h2>
  <a href="<?php if ($_SESSION['userno'] != ""){echo "/myaccount/{$_SESSION['userno']}";}else{echo "/myaccount/123";}?>"><span class="material-icons usericon">&#xe8a6</span></a>
  <a href="/cart"><span class="material-icons usericon">&#xe854</span></a>
  <div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    
    
    <h2 class="form-h2 navforms"><img class="logo-nav" src="https://www.eesysoft.com/wp-content/uploads/2018/08/charles-logo-1024x296.png" width="220px"></h2>
    <hr style="margin-bottom:0;"/>
    <h2 class="form-h2 navforms">Browse</h2>
    <hr style="margin-bottom:0;"/>
    <div class="navforms forms">
      <a href="/catalogue/1"><p><span class="material-icons" style="font-size: 1.6rem;padding: 0 8px 0 5px;vertical-align: bottom;">&#xe3ad</span><span style="margin-bottom:5px;">The Lunch Room</span></p></a>
      <a href="/catalogue/2"><p><span class="material-icons" style="font-size: 1.6rem;padding: 0 8px 0 5px;vertical-align: bottom;">&#xe3ad</span><span style="margin-bottom:5px;">Ugly Duckling Cafe</span></p></a>
      <a href="/catalogue/3"><p><span class="material-icons" style="font-size: 1.6rem;padding: 0 8px 0 5px;vertical-align: bottom;">&#xe3ad</span><span style="margin-bottom:5px;">Art House Cafe</span></p></a>
    </div>

    <h2 class="form-h2 navforms">Manage</h2>
    
    <hr style="margin-bottom:0;"/>
    <div class="navforms forms">
    <?php
      if (is_authenticated()){
    ?>
      <a href="<?php if ($_SESSION['userno'] != ""){echo "/myaccount/{$_SESSION['userno']}";}else{echo "/myaccount/123";}?>"><p><span class="material-icons" style="font-size: 1.6rem;padding: 0 8px 0 5px;vertical-align: bottom;">&#xe869</span>My Account</p></a>
      <a href="<?php if ($_SESSION['userno'] != ""){echo "/change/{$_SESSION['userno']}";}else{echo "/change/123";}?>"><p><span class="material-icons" style="font-size: 1.6rem;padding: 0 8px 0 5px;vertical-align: bottom;">&#xe8a6</span>Change Password</p></a>
      <a href="/signout"><p><span class="material-icons" style="font-size: 1.6rem;padding: 0 8px 0 5px;vertical-align: bottom;">&#xe8a6</span>Signout</p></a>
    <?php
        }else{
    ?>
      <a href="/signup"><p><span class="material-icons" style="font-size: 1.6rem;padding: 0 8px 0 5px;vertical-align: bottom;">&#xe8a6</span>Signup</p></a>
      <a href="/signin"><p><span class="material-icons" style="font-size: 1.6rem;padding: 0 8px 0 5px;vertical-align: bottom;">&#xe8a6</span>Signin</p></a>
    <?php
      }
    ?>
</header>