<?php
/**
 *   Author: Mahadev
 */
include_once('DB.php');
class Model {
  private $cars;
  private $instance;
  private $conn;
  private $mydb;

  /**
   *
   * Constructor 
   * Create DB object
   */
  function __construct(){
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $name = 'user-management';

    /**
    *
    * @uses $mydb database object
    */
    if ( !isset($mydb) ) {
      // Reference mydb database object
      $this->mydb = mydb::instance();

      // Connect to the MySQL database
      if ( !$this->mydb->connect($host, $user, $password, $name) )
      printf("Could not connect to database: %s", $this->mydb->last_error);
    }

  } 

  /**
   *
   * Get user ID if matches user name and password
   */
  public function validateUser($username, $user_password){
    return $result = $this->mydb->get_row("SELECT id FROM users WHERE email='". $this->mydb->escape($username)."' AND password='".$this->mydb->escape($user_password)."' AND role = 1");
  }

  public function validateEmail($email){
    return $result = $this->mydb->get_row("SELECT id FROM users WHERE email='". $this->mydb->escape($email)."'");
  }

  public function insertCode($id){
    $code = rand(10,100);
    return $result = $this->mydb->insert_row("INSERT INTO update_password ('user_id','code') VALUES('".$id."','".$code."')");
  }

  /**
   *
   * Desstructor 
   * Destroy the DB object
   */
  function __destruct() {
    $this->mydb->close();
  }
}
