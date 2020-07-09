<?php
   include("config.php");
   session_start();
   $error = "";
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myusername = mysqli_real_escape_string($db,$_POST['username']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']); 
      
      $sql = "SELECT * FROM user WHERE username = '$myusername'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      
      $username = $row['username'];
      $password = $row['password'];

      $count = mysqli_num_rows($result);


      if($count == 1) {

			if (password_verify($mypassword, $password)) {
				
				$row['message']  = 'success' ;
			    echo(json_encode($row));
			} else {
			    $data = [ 'message' => 'failed' ];
				echo json_encode( $data );
			}
      }else {
			$data = [ 'message' => 'failed' ];
			echo json_encode( $data );

      }
   }
?>