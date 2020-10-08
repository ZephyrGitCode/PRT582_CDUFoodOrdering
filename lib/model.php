<?php

function get_db(){
    $db = null;
    try{
      $db = new PDO('mysql:host=nwhazdrp7hdpd4a4.cbetxkdyhwsb.us-east-1.rds.amazonaws.com;
         dbname=pqah8dmlwqbvnqav', 'doontmefp1191ii9','xgeggg4zpq4ttehc');
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e){
        throw new Exception("Something wrong with the database connection!".$e->getMessage());
    }
    return $db;
}

function get_user($id){
   $list = null;
   try{
      $db = get_db();
      $query = "SELECT * FROM users where userNo=?";
      if($statement = $db->prepare($query)){
         $binding = array($id);
         if(!$statement -> execute($binding)){
             throw new Exception("Could not execute query.");
         }
      }
      $list = $statement->fetchall(PDO::FETCH_ASSOC);
      return $list;
   }
   catch(PDOException $e){
      throw new Exception($e->getMessage());
      return "";
      }
}

function get_item($id){
   $food = null;
   try{
      $db = get_db();
      $query = "SELECT * from items WHERE itemNo = ?";
      $statement = $db->prepare($query);
      $binding = array($id);
      $statement -> execute($binding);
      $food = $statement->fetchall(PDO::FETCH_ASSOC);
      return $food;
   }
   catch(PDOException $e){
      throw new Exception($e->getMessage());
      return "";
   }
}

function get_selections(){
   $selections = null;
   try{
      $db = get_db();
      $query = "SELECT * from selections";
      $statement = $db->prepare($query);
      $statement -> execute();
      $selections = $statement->fetchall(PDO::FETCH_ASSOC);
      return $selections;
   }
   catch(PDOException $e){
      throw new Exception($e->getMessage());
      return "";
   }
}

// grab single combo
function get_combo($combono){
   $combos = null;
   try{
      $db = get_db();
      $query = "SELECT * from combos where comboNo = ?";
      $statement = $db->prepare($query);
      $binding = array($combono);
      $statement -> execute($binding);
      $combos = $statement->fetchall(PDO::FETCH_ASSOC);
      return $combos;
   }
   catch(PDOException $e){
      throw new Exception($e->getMessage());
      return "";
   }
}

// grab single selection
function get_selection($selectid){
   $selections = null;
   try{
      $db = get_db();
      $query = "SELECT * from selections where selectionNo = ?";
      $statement = $db->prepare($query);
      $binding = array($selectid);
      $statement -> execute($binding);
      $selections = $statement->fetchall(PDO::FETCH_ASSOC);
      return $selections;
   }
   catch(PDOException $e){
      throw new Exception($e->getMessage());
      return "";
   }
}

function post_feedback($userid, $title, $message){
   try{
      $db = get_db();
      $query = "INSERT INTO feedback (feedback.userNo, title, messageText) VALUES (?,?,?)";
      if($statement = $db->prepare($query)){
         $binding = array($userid, $title, $message);
         if(!$statement -> execute($binding)){
            throw new Exception("Could not execute query.");
         }
      }
      else{
      throw new Exception("Could not prepare statement.");
      }
   }
   catch(Exception $e){
       throw new Exception($e->getMessage());
   }
}

function get_cartitems($id){
   $food = null;
   try{
      $db = get_db();
      $query = "SELECT * FROM cartitems,items WHERE cartitems.userId = ? AND cartitems.itemNo = items.itemNo";
      $statement = $db->prepare($query);
      $binding = array($id);
      $statement -> execute($binding);
      $food = $statement->fetchall(PDO::FETCH_ASSOC);
      return $food;
   }
   catch(PDOException $e){
      throw new Exception($e->getMessage());
      return "";
      }
}

function get_orders(){
   $food = null;
   try{
      $db = get_db();
      $query = "SELECT * FROM orders";
      $statement = $db->prepare($query);
      $statement -> execute();
      $food = $statement->fetchall(PDO::FETCH_ASSOC);
      return $food;
   }
   catch(PDOException $e){
      throw new Exception($e->getMessage());
      return "";
      }
}

function get_products($id){
   $food = null;
   try{
      $db = get_db();
      $query = "SELECT * from items WHERE vendorNo = ?";
      $statement = $db->prepare($query);
      $binding = array($id);
      $statement -> execute($binding);
      $food = $statement->fetchall(PDO::FETCH_ASSOC);
      return $food;
   }
   catch(PDOException $e){
      throw new Exception($e->getMessage());
      return "";
   }
}

function sign_up($fname, $lname, $email, $password, $password_confirm){
   try{
      $db = get_db();
      if (validate_passwords($password, $password_confirm) != true){
         throw new Exception("Error: Passwords must match and Password must contain at least 8 characters, one Capital letter and one number.");
      }
      $salt = generate_salt();
      $password_hash = generate_password_hash($password,$salt);
      $query = "INSERT INTO users (fname,lname,email,salt,hashed_password) VALUES (?,?,?,?,?)";
      if($statement = $db->prepare($query)){
        $binding = array($fname,$lname,$email,$salt,$password_hash);
        if(!$statement -> execute($binding)){
           throw new Exception("Could not execute query.");
         }
      }
      else{
         throw new Exception("Could not prepare statement.");
      }
   }
   catch(Exception $e){
      throw new Exception($e->getMessage());
   }
}

function sign_in($useremail,$password){
   try{
      $db = get_db();
      if (validate_user_email($useremail)){
         throw new Exception("Email does not exist");
      }
      if (validate_password($password) === false){
         session_start();
         $_SESSION['logincount'] += 1;

         if ($_SESSION['logincount'] > 5){
            throw new Exception("Too many failed login attempts, please try again later.");
         }
         session_write_close();
         throw new Exception("Password incorrect. Password must contain at least 8 characters, one Capital letter and one number");
      }
      $query = "SELECT userNo, email, salt, isadmin, hashed_password FROM users WHERE email=?";
      if($statement = $db->prepare($query)){
         $binding = array($useremail);
         if(!$statement -> execute($binding)){
            throw new Exception("Could not execute query.");
         }
         else{
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            $salt = $result['salt'];
            $isadmin = $result['isadmin'];
            session_start();
            $_SESSION['salt'] = $salt;
            $_SESSION['hash'] = $result['hashed_password'];
            session_write_close();
            $hashed_password = $result['hashed_password'];
            if(generate_password_hash($password,$salt) != $hashed_password){
               throw new Exception("Password incorrect. Password must contain at least 8 characters, one Capital letter and one number.");
            }
            else{
               $email = $result["email"];
               $userno = $result["userNo"];
               set_authenticated_session($email, $hashed_password, $userno, $isadmin);
            }
         }
      }
      else{
         throw new Exception("Could not prepare statement.");
      }
   }
   catch(Exception $e){
      throw new Exception($e->getMessage());
   }
}

function validate_passwords($password, $password_confirm){
   if($password === $password_confirm && validate_password($password) === true){
      return true;
   }else{
      return false;
   }
}

function validate_password($password){
   $uppercase = preg_match('@[A-Z]@', $password);
   $lowercase = preg_match('@[a-z]@', $password);
   $number    = preg_match('@[0-9]@', $password);

   if($uppercase && $lowercase && $number && strlen($password) >= 8) {
      return true;
   }else{
      return false;
   }
}

function set_authenticated_session($email,$password_hash, $userno, $isadmin){
   session_start();
   // Make it a bit harder to session hijack
   session_regenerate_id(true);
   $_SESSION["userno"] = $userno;
   $_SESSION["email"] = $email;
   $_SESSION["isadmin"] = $isadmin;
   $_SESSION["hash"] = $password_hash;
   session_write_close();
}

function generate_password_hash($password,$salt){
return hash("sha256", $password.$salt, false);
}

function generate_salt(){
 $chars = "0123456789ABCDEF";
 return str_shuffle($chars);
}

function validate_user_email($email){
   try{
      $db = get_db();
      $query = "SELECT hashed_password FROM users WHERE email=?";
      if($statement = $db->prepare($query)){
      $binding = array($email);
         if(!$statement -> execute($binding)){
            return false;
         }
         else{
               $result = $statement->fetch(PDO::FETCH_ASSOC);
               if($result['email'] === $email){
               return true;
               }else{
                  return false;
               }
            }
         }
      }
   catch(Exception $e){
      throw new Exception("Authentication not working properly. {$e->getMessage()}");
   }
}
function is_authenticated(){
 $email = "";
 $hash="";
 session_start();
 if(!empty($_SESSION["email"]) && !empty($_SESSION["hash"])){
    $email = $_SESSION["email"];
    $hash = $_SESSION["hash"];
 }
 session_write_close();
 if(!empty($email) && !empty($hash)){
     try{
        $db = get_db();
        $query = "SELECT hashed_password FROM users WHERE email=?";
        if($statement = $db->prepare($query)){
          $binding = array($email);
          if(!$statement -> execute($binding)){
             return false;
          }
          else{
              $result = $statement->fetch(PDO::FETCH_ASSOC);
              if($result['hashed_password'] === $hash){
                return true;
              }
          }
        }
     }
     catch(Exception $e){
        throw new Exception("Authentication not working properly. {$e->getMessage()}");
     }
 
 }
 return false;

}

function sign_out(){
 session_start();
 if( !empty($_SESSION["email"]) && !empty($_SESSION["hash"]) && !empty($_SESSION["userno"]) ){
    $_SESSION["email"] = "";
    $_SESSION["hash"] = "";
    $_SESSION["userno"] == "";
    $_SESSION = array();
    session_destroy();                     
 }
 session_write_close();
}

function change_password($id, $old_pw, $new_pw, $pw_confirm){
try{
   $db = get_db();
   $query = "SELECT salt, hashed_password FROM users WHERE userNo=?";
   if($statement = $db->prepare($query)){
      $binding = array($id);
      if(!$statement -> execute($binding)){
              throw new Exception("Could not execute query.");
      }
      else{
         $result = $statement->fetch(PDO::FETCH_ASSOC);
         $salt = $result['salt'];
         $hash = $result['hashed_password'];
         if(generate_password_hash($old_pw,$salt) != $hash){
            throw new Exception("Old Password does not match.");
        }
        else{
            if (validate_passwords($new_pw, $pw_confirm)){
               $salt = generate_salt();
               $password_hash = generate_password_hash($new_pw,$salt);
               $query = "UPDATE users SET hashed_password=?, salt=? WHERE userNo=?";
               if($statement = $db->prepare($query)){
                  $binding = array($password_hash, $salt, $id);
                  if(!$statement -> execute($binding)){
                        throw new Exception("Could not execute query.");
                  }else{
                     sign_out();
                  }
               }
               else{
               throw new Exception("Could not prepare statement.");
               }
            }else{
               throw new Exception("Ensure that the New password and confirm password match, also both passwords must contain at least 8 characters, one Capital letter and one number.");
            }
         }
      }
   }
   else{
   throw new Exception("Could not prepare statement.");
   }

 }
 catch(Exception $e){
     throw new Exception($e->getMessage());
 }
}

function update_details($id,$fname,$lname,$email,$phone){
   try{
     $db = get_db();
     if(validate_user_email($email) !== true ){
         $query = "UPDATE users SET fname=?, lname=?, email=?, phone=? WHERE userNo=?";
         if($statement = $db->prepare($query)){
            $binding = array($fname,$lname,$email,$phone,$id);
            if(!$statement -> execute($binding)){
               throw new Exception("Could not execute query.");
            }else{
               session_start();  
               $_SESSION["email"] = $email;
               session_write_close();
            }
         }
         else{
         throw new Exception("Could not prepare statement.");
         }
     }
     else{
        throw new Exception("Please specify a unique email.");
     }
   }
   catch(Exception $e){
       throw new Exception($e->getMessage());
   }
}

function get_user_id(){
   $id="";
   session_start();  
   if(!empty($_SESSION["userno"])){
      $id = $_SESSION["userno"];
   }
   session_write_close();
   return $id;	
}

function get_user_name(){
   $id="";
   $name="";
   session_start();  
   if(!empty($_SESSION["userno"])){
      $id = $_SESSION["userno"];
   }
   session_write_close();
   if(empty($id)){
     throw new Exception("User has no valid id");	
   }
   try{
      $db = get_db();  
      $query = "SELECT fname FROM users WHERE userNo=?";
      if($statement = $db->prepare($query)){
         $binding = array($id);
         if(!$statement -> execute($binding)){
                 throw new Exception("Could not execute query.");
         }
         else{
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            $name = $result['fname'];
         }
      }
      else{
            throw new Exception("Could not prepare statement.");
      }

   }
   catch(Exception $e){
      throw new Exception($e->getMessage());
   }
   return $name;	
}

function checkout($orderNo, $userNo, $pickuptime, $date, $total){
   try{
      $db = get_db();
      $query = "INSERT INTO orders(orderNo, userNo, pickuptime, orderdate, totalPrice) VALUES (?,?,?,?,?)";
      if($statement = $db->prepare($query)){
         $binding = array($orderNo, $userNo,$pickuptime, $date, $total);
         if(!$statement -> execute($binding)){
            throw new Exception("Could not execute query.");
         }
      }
      else{
      throw new Exception("Could not prepare statement.");
      }
   }
   catch(Exception $e){
      throw new Exception($e->getMessage());
  }
}

function checkoutitem($orderNo, $itemNo, $quantity){
   try{
      $db = get_db();
      $query = "INSERT INTO orderitems(orderNo, itemNo, quantity) VALUES (?,?,?)";
      if($statement = $db->prepare($query)){
         $binding = array($orderNo, $itemNo, $quantity);
         if(!$statement -> execute($binding)){
            throw new Exception("Could not execute query.");
         }
      }
      else{
      throw new Exception("Could not prepare statement.");
      }
   }
   catch(Exception $e){
      throw new Exception($e->getMessage());
  }
}

function addtocart($itemNo, $quantity,$userid,$vendorNo, $comboNo = 0){
   try{
      $db = get_db();
      if ($comboNo != 0){
      $query = "INSERT INTO cartitems(itemNo, quantity, userId, Vendorno,comboNo) VALUES (?,?,?,?,?)";
      }else{
         $query = "INSERT INTO cartitems(itemNo, quantity, userId, Vendorno) VALUES (?,?,?,?)";
      }
      if($statement = $db->prepare($query)){
         if ($comboNo != 0){
            $binding = array($itemNo, $quantity,$userid, $vendorNo, $comboNo);
         }
         else{
            $binding = array($itemNo, $quantity,  $userid, $vendorNo,);
         }
         if(!$statement -> execute($binding)){
            throw new Exception("Could not execute query.");
         }
      }
      else{
      throw new Exception("Could not prepare statement.");
      }
   }
   catch(Exception $e){
      throw new Exception($e->getMessage());
   }
}

function updatequantity($quantity, $itemNo,$userid){
   try{
      $db = get_db();
      $query = "UPDATE cartitems SET quantity = ? WHERE itemNo=? AND userId =?";
      if($statement = $db->prepare($query)){
         $binding = array($quantity,$itemNo,$userid);
         if(!$statement -> execute($binding)){
            throw new Exception("Could not execute query.");
         }
      }
      else{
      throw new Exception("Could not prepare statement.");
      }
   }
   catch(Exception $e){
      throw new Exception($e->getMessage());
  }
}

function removefromcart($cartNo){
   try{
      $db = get_db();
      $query = "DELETE FROM cartitems WHERE cartNo=?";
      if($statement = $db-> prepare($query)){
         $binding = array($cartNo);
         if(!$statement -> execute($binding)){
            throw new Exception("Could not execute query.");
        }
      }
   } catch(Exception $e){
      throw new Exception($e->getMessage());
   }
}

function add_combo($selectionone, $selectiontwo, $selectionthree){
   try{
      $db = get_db();
      $query = "INSERT INTO combos(selectionOne, selectionTwo, selectionThree) VALUES (?,?,?)";
      if($statement = $db->prepare($query)){
         $binding = array($selectionone, $selectiontwo, $selectionthree);
         if(!$statement -> execute($binding)){
            throw new Exception("Could not execute query.");
         }
      }
      else{
      throw new Exception("Could not prepare statement.");
      }
   }
   catch(Exception $e){
      throw new Exception($e->getMessage());
  }
  return ($db->lastInsertId());
}