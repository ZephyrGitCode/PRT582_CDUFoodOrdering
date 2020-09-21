<?php
/* SET to display all warnings in development. Comment next two lines out for production mode*/
ini_set('display_errors','On');
error_reporting(E_ERROR | E_PARSE);

/* Set the path to the Application folder */
DEFINE("LIB",$_SERVER['DOCUMENT_ROOT']."/lib/");

/* SET VIEWS path */
DEFINE("VIEWS",LIB."views/");
DEFINE("PARTIALS",VIEWS."/partials");


# Paths to actual files
DEFINE("MODEL",LIB."/model.php");
DEFINE("APP",LIB."/application.php");

# Define a layout
DEFINE("LAYOUT","standard");

# This inserts our application code which handles the requests and other things
require APP;

/* Here is our Controller code i.e. API if you like.  */

// Start get ---------------------------------------
get("/",function($app){
   $app->set_message("title","CDU Food Ordering");
   $app->set_message("message","Welcome to CDU Food ordering. Please select a vendor.");
   require MODEL;
   $app->render(LAYOUT,"home");
});

get("/signup",function($app){ 
   require MODEL;
   $is_authenticated=false;
   try{
      $is_authenticated = is_authenticated();
   }
   catch(Exception $e){
      $app->set_flash("Failed to signup"); 
      $app->redirect_to("/");
   }   
   if($is_authenticated){
       $app->set_message("message","You are already signed in.");
       $app->set_flash("message","You are already signed in."); 
       header("location: /");
   }
  $app->set_message("title","Sign up");
  $app->render(LAYOUT,"signup");
});

get("/signin",function($app){
   $app->set_message("title","Sign in");
   require MODEL;
   try{
     if(is_authenticated()){
        $app->set_message("message","You are already signed in.");
        $app->set_flash("You are already signed in");
        $app->redirect_to("/"); 
      }   
   }
   catch(Exception $e){
       $app->set_message("message",$e->getMessage($app));
   }
   $app->render(LAYOUT,"signin");
});

get("/myaccount/:id;[\d]+",function($app){
   $id = $app->route_var("id");
   $app->set_message("title","Darwin Art Company");
   require MODEL;
   if ($id != get_user_id()){
      $app->redirect_to("/myaccount/".get_user_id()."");
   }
   try{
      if(is_authenticated()){
         try{
            $app->set_message("user", get_user($id));
            $app->render(LAYOUT,"myaccount");
         }catch(Exception $e){
            $app->set_flash("Could not access your page");
         }
       }   
    }
    catch(Exception $e){
        $app->set_message("message",$e->getMessage($app));
    }
   $app->set_message("note", "You must be logged in to see your account");
   $app->render(LAYOUT,"signin");
});

get("/catalogue/:id;[\d]+",function($app){
   require MODEL;
   $id = $app->route_var("id");
   $app->set_message("items", get_products($id));
   $app->set_message("id", $id);
   //$app->set_message("testimonials", get_testimonials($id));
   $app->render(LAYOUT,"catalogue");
});

get("/singleitem/:id;[\d]+",function($app){
   require MODEL;
   $id = $app->route_var("id");
   $app->set_message("items", get_item($id));
   $app->set_message("id", $id);
   //$app->set_message("testimonials", get_testimonials($id));
   $app->render(LAYOUT,"singleitem");
});

get("/cart",function($app){
   require MODEL;
   try{
      if(is_authenticated()){
         try{
            $userid = get_user_id();
            $app->set_message("cartitems", get_cartitems($userid));
            $app->set_message("id", $userid);
            //$app->set_message("testimonials", get_testimonials($id));
            $app->render(LAYOUT,"cart");
         }catch(Exception $e){
            // Failed to load DB
         }
      }
   }  catch(Exception $e){
      $app->set_message("message",$e->getMessage($app));
  }
  $app->set_message("note", "You must be logged in to access the shopping cart");
  $app->render(LAYOUT,"/signin");
});

get("/change/:id;[\d]+",function($app){
   $id = $app->route_var("id");
   $app->set_message("title","Darwin Art Company");
   $app->set_message("message","Welcome".$id);
   require MODEL;
   try{
      if(is_authenticated()){
         try{
            $app->set_message("user", get_user($id));
            $app->render(LAYOUT,"change_pass");
         }catch(Exception $e){
            // Failed to load DB
         }
       }
    }
    catch(Exception $e){
        $app->set_message("message",$e->getMessage($app));
    }
   $app->set_message("note", "You must be logged in to see your account");
   $app->render(LAYOUT,"/signin");
});

get("/signout",function($app){
   // should this be GET or POST or PUT?????
   require MODEL;
   if(is_authenticated()){
      try{
         sign_out();
         $app->set_flash("You are now signed out.");
         $app->redirect_to("/");
      }
      catch(Exception $e){
        $app->set_flash("Something wrong with the sessions.");
        $app->redirect_to("/");        
     }
   }
   else{
        $app->set_flash("You can't sign out if you are not signed in!");
        $app->redirect_to("/signin");
   }   
});
// End get ----------------------------------------
// Start Post -------------------------------------
post("/signup",function($app){
    require MODEL;
    try{
        if(!is_authenticated()){
          $fname = $app->form('fname');
          $lname = $app->form('lname');
          $email = $app->form('email');
          $pw = $app->form('password');
          $confirm = $app->form('passw-c');
   
          if($fname && $lname && $email && $pw && $confirm){
              try{
                sign_up($fname,$lname,$email,$pw,$confirm);
                $app->set_flash("Welcome ".$fname.", now please sign in"); 
                $app->redirect_to("/");   
             }
             catch(Exception $e){
                  $app->set_flash($e->getMessage());  
                  $app->redirect_to("/signup");          
             }
          }
          else{
             $app->set_flash("You are not signed up. Try again and don't leave any fields blank.");  
             $app->redirect_to("/signup");
          }
          $app->redirect_to("/signup");
        }
        else{
           $app->set_flash("You are not authenticated, please login");  
           $app->redirect_to("/");           
        }
    }
    catch(Exception $e){
         $app->set_flash("{$e->getMessage()}");  
         $app->redirect_to("/");
    }
});

post("/signin",function($app){
  $email = $app->form('email');
  $password = $app->form('password');
  if($email && $password){
    require MODEL;
    try{
       sign_in($email,$password);
    }
    catch(Exception $e){
      $app->set_flash("Could not sign you in. Try again. {$e->getMessage()}");
      $app->redirect_to("/signin");      
    }
  }
  else{
     $app->set_flash("Something wrong with your email or password. Please try again.");
     $app->redirect_to("/signin");
  }
  $app->set_flash("Lovely, you are now signed in!");
  $app->redirect_to("/");
});

/*
post("/singleitem/:id[\d]+",function($app){
   require MODEL;
   $artno = $app->route_var("id");
   $id = get_user_id();
   $test = $app->form('test');
   if($artno && $id && $test){
     try{
        add_testimonial($id,$artno,$test);
        $app->redirect_to("/art/".$artno);
     }
     catch(Exception $e){
       $app->set_flash("Failed to add testimonial. {$e->getMessage()}");
       $app->redirect_to("/art/".$artno);      
     }
   }
   else{
        $app->set_flash("Please enter all fields.");
        $app->redirect_to("/art/".$artno);
   }
   $app->set_flash("Failed");  
   $app->redirect_to("/art/".$artno);        
});*/


post("/singleitem", function($app){
   require MODEL;
   $quantity = $app->form('quantity');
   $itemNo = $app->form('itemNo');
   $userid = get_user_id();
   $cartitems = get_cartitems($userid);

   foreach($cartitems as $cartitem){
      $item[]=$cartitem["itemNo"];
   }
   if(empty($cartitems)){
      try{
         addtocart($itemNo, $quantity,$userid);
      }
      catch(Exception $e){
         $app->set_flash("Failed to add item to cart. {$e->getMessage()}");   
      }
   }
   else{
         if(in_array($itemNo,$item)){

            try{
               updatequantity($quantity, $itemNo,$userid);
            }
            catch(Exception $e){
               $app->set_flash("Failed to add item to cart. {$e->getMessage()}");   
            }
         }
         else{
            try{
            addtocart($itemNo, $quantity,$userid);
            }
            catch(Exception $e){
            $app->set_flash("Failed to add item to cart. {$e->getMessage()}");   
            }
         }
      }  
   $app->set_flash("Item Added to cart");
   $app->redirect_to("/catalogue/1"); 
   
});
post("/cart",function($app){
   require MODEL;
   $pickuptime = $app->form('pickup_time');
   $userid = get_user_id();
   $cartitems = get_cartitems($userid);
   $date =  date("Y-m-d h:i:s");
   $orders = get_orders();
   $orderNo = 1;
   foreach($orders as $order){
      $orderNo = $orderNo+1;
   }
   checkout($orderNo, $userid, $pickuptime,$date);
   foreach($cartitems as $item){
      checkoutitem($orderNo, $item['itemNo'], $item['quantity']);
      removefromcart($item['cartNo']);

   }
   $app->redirect_to("/");
});


// End post ----------------------------------------
// Start put ---------------------------------------
put("/myaccount/:id[\d]+",function($app){
   $app->set_message("title","Darwin Art Company Account");
   require MODEL;
   try{
       if(is_authenticated()){
         $id = get_user_id();
         $fname = $app->form('fname');
         $lname = $app->form('lname');
         $email = $app->form('email');
         $phone = $app->form('phone');
         try{
            update_details($id,$fname,$lname,$email,$phone);
            $app->set_flash("Details Successfully updated");
            $app->redirect_to("/");   
         }
         catch(Exception $e){
            $app->set_flash($e->getMessage());  
            $app->redirect_to("/");          
         }
       }
       else{
          $app->set_flash("You are not authenticated, please login correctly");  
          $app->redirect_to("/");           
       }
   }
   catch(Exception $e){
        $app->set_flash("{$e->getMessage()}");  
        $app->redirect_to("/");
   }
});

put("/change/:id[\d]+",function($app){
   $id = $app->route_var("id");
   $app->set_message("title","Change password");
   require MODEL;
   try{
      if(is_authenticated()){
         $pw_old = $app->form('old-password');
         $pw_new = $app->form('password');
         $pw_confirm = $app->form('passw-c');
         if($pw_old && $pw_new && $pw_confirm){
            try{
               change_password($id,$pw_old,$pw_new,$pw_confirm);
               $app->set_flash("Password successfully changed.");
               $app->redirect_to("/");   
            }
            catch(Exception $e){
               $app->set_flash($e->getMessage());  
               $app->redirect_to("/change/".$id);         
            }
         }
         else{
            $app->set_flash("You must enter all fields.");  
            $app->redirect_to("/change/".$id);
         }
      }
      else{
         $app->set_flash("You are not logged in.");  
         $app->redirect_to("/signin");           
      }
   }
   catch(Exception $e){
      $app->set_flash("{$e->getMessage()}");  
      $app->redirect_to("/");
   }
});

put("/singleitem/:id;[\d]+",function($app){
   require MODEL;
   $id = $app->route_var("id");
   $app->set_flash("Approval attempt");
   try{
      approve($id);
      $app->set_flash("Testimonial approved.");
      $app->render(LAYOUT,"home");
   }catch(Exception $e){
      $app->set_flash("Failed to approve");
      $app->redirect_to("/");
   }
   $app->redirect_to("/");
});
// End put ---------------------------------------
// Start delete ----------------------------------
# The Delete call back is left for you to work out

delete("/cart", function($app){
   require MODEL;
   $id = $app->form("cartNo");
   removefromcart($id);
   $app->set_flash("item has been removed from cart");
   $app->redirect_to("/cart");
});

delete("/user",function($app){
   //query to delete
   $app->set_flash("User has been deleted");
   $app->redirect_to("/");
});

// Now. If it get this far then page not found
resolve();