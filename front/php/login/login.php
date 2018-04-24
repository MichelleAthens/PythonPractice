<?php
#===================================================================================
									#host     user    password     database
		$connection = mysqli_connect("localhost","root","password","mmd38");      

#===================================================================================  
      
    $response = file_get_contents('php://input');
    $decoder = json_decode($response,true);                       #Get the response
    
    
    $username = $decoder['Username'];
    $password = $decoder['Password'];


    $result = mysqli_query($connection,"SELECT * FROM usernames WHERE username like '$username'");
    

    $row = mysqli_fetch_assoc($result);   
    $match = mysqli_num_rows($result);
    
    
    if ($match != 0){ 
        #If there is a row that means theres a match
        #Save the information $information = mysqli_fetch_assoc($result); #Get the result
      
        $name       = $row['username'];
        $pass       = $row['pass'];  
        $firstname  = $row['firstname'];
        $lastname   = $row['lastname'];
		

        
        if(password_verify($password,$pass)){
            $array = array("Response"=>"MATCH", "firstname" => $firstname, "lastname" => $lastname);
		
            echo json_encode($array,true);
        }
        else{
			

        $log = array("Response"=>"NO MATCH");
        
        echo json_encode($log,true);                                     #Echo the response
        }  
        
    }
    else{
        $log = array("Response"=>"NO MATCH");
        
        echo json_encode($log,true);                                     #Echo the response
    }
    
    mysqli_close($connection);                                                   #Close the database
    



?>
