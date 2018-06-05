<?php
 /**
 *  
 *  Description: Session handling class
 *  Author: Mahadev
 *  Version: 1
 */
class Session {
	
  /**
   * Set loggedin user to session variable 
   */
  public function set($username){ echo $username;exit;   
  	session_start();
    $_SESSION['username'] = $username;
  }

  /**
   * Set loggedin user to session variable 
   */
  public function logout(){    
    unset($_SESSION['username']);
  }
}
?>