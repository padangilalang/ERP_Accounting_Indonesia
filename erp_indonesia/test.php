    <?php


    $conn = mysql_connect("localhost","root","1234qwe");
    mysql_select_db("erp_indonesia");

    $query = "SELECT * FROM s_user WHERE username = 'admin'";
    $result = mysql_query($query) or die("Unable to verify user because : " . mysql_error());

   if (mysql_num_rows($result) == 1){
   
	    echo 1;
	}
   else {
 
	    // print status message
   	   echo 0;
	}

    ?>

