 <?php 
 /**
 *  
 *  Description: The index.php serves as the front controller, initializing the base resources needed to run
 *  Author: Mahadev Shetye    
 *  Date: 5 - June -2018
 *  Version: 1
 */
 include_once('Controller/Controller.php');
 
 if(!empty($_SERVER['QUERY_STRING'])){
   //reads and explodes the querystring into array 
   $queryArray = explode('/',$_SERVER['QUERY_STRING']);
   $controller = new $queryArray[0];
   //calls the method in the controller that gets data from the model
   //and assigns it to a view that presents it
   //$controller->login();
   
   if(isset($queryArray[2])){
      $function = $queryArray[1];
      $parameter = $queryArray[2];
      $controller->$function($parameter);
   }
   else{ 
    $function = $queryArray[1];
    $controller->$function();
   }
 }else{
    $controller = new Controller;
    $controller->index();
  }

 ?> 