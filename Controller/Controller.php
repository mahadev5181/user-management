<?php
/**
 *  
 *  Description: This is Controller. Controller is communicator between model and view. 
 *  It manipulate model and decide which view to display to the user based on the user request.
 *  Author: Mahadev
 *  Version: 1
 */
session_start();
include_once('Model/Model.php');
include_once('View/View.php');
include_once('Session.php');

class Controller{
  private $model;
  private $view;
  private $session;

  /**
    *  Load Model, View, Session in Constructor
    */
  function __construct(){
    $this->model = new Model();
    $this->view = new View();
    $this->session = new Session();
  }

 /**
  *  Display Home page
  */
  public function index(){
    $this->view->display('View/header.html');
    $this->view->display('View/index.html');
    $this->view->display('View/footer.html');
  }

  /**
    *  Display Login page when user clicks Login link
    */
  public function logout(){
    $this->view->display('View/header.html');
    $this->view->display('View/index.html');
    $this->view->display('View/footer.html');
  }

  /**
    *  Display Login page when user clicks Login link
    */
  public function validation(){
    $username = $_POST['username'];
    $user_password = md5($_POST['user_password']);
    if(!empty($username)){ 
      $row = $this->model->validateUser($username, $user_password);
      $user_id = 0;
      if($row){
        $user_id = (int) $row->id;
        if($user_id > 0){
          //Set session value
          $this->session->set($username);
        }
    }
      echo $user_id;
      die;
    }

    $this->view->display('View/header.html');
    $this->view->display('View/index.html');
    $this->view->display('View/footer.html');

  }

  /**
    *  Display Success page when user is successful logged in and display Username from Session variable
    */
  public function sucess(){
    $this->view->display('View/header.html');
    $this->view->display('View/dashboard.html');
    $this->view->display('View/footer.html');
  }

  /**
    *  Display Success page when user is successful logged in and display Username from Session variable
    */
  public function newuser(){
    //displays the "html" file that will present data from the model
    $this->view->display('View/header.html');
    $this->view->display('View/newuser.html');
    $this->view->display('View/footer.html');
  }

  public function edituser($id){
    //displays the "html" file that will present data from the model

     $ch = curl_init();
    $headers = array(
    'Accept: application/json',
    'Content-Type: application/json',

    );
    curl_setopt($ch, CURLOPT_URL, 'http://localhost/rest-user-api/user/'.$id);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    $body = '{}';

    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET"); 
    curl_setopt($ch, CURLOPT_POSTFIELDS,$body);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Timeout in seconds
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);

    $resultData = curl_exec($ch);
    $resultData = json_decode($resultData);
    $this->view->assign('userid',$id);
    $this->view->assign('fullname',$resultData->result[0]->name);
    $this->view->assign('email',$resultData->result[0]->email);
    $this->view->assign('address',$resultData->result[0]->address);
    $this->view->display('View/header.html');
    $this->view->display('View/edituser.html');
    $this->view->display('View/footer.html');
  }
  public function forgotpassword(){
    if(isset($_POST['email'])){
      $row = $this->model->validateEmail($_POST['email']);
      if($row){
        // the message
        $msg = "Click on the ink to update password <a href='./index.php?Controller/updatepassword/".$row->id."'>Update Password</a>";
        $msg = wordwrap($msg,70);
        // send email
        mail("someone@example.com","Update Password",$msg);
        echo $row->id;
      }else{
        echo "0";
      }
    }else{
      $this->view->display('View/header.html');
      $this->view->display('View/forgotpassword.html');
      $this->view->display('View/footer.html');
    }
  }
  public function updatepassword(){
    if(isset($_POST['email']) && isset($_POST['password'])){
      //Update password Code
    }else{
      $this->view->display('View/header.html');
      $this->view->display('View/updatepassword.html');
      $this->view->display('View/footer.html');
    }
  }
}  
