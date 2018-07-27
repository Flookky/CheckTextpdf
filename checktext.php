<?php
    $hostname="localhost";
    $userhost="root";
    $password="";
    $database="myDB";
    //session_start();
    //create connection
    $conn = new mysqli($hostname, $userhost, $password, $database);
    //check connection
    if ($conn->connect_error) {
    exit("Connection failed: " . $conn->connect_error);}
    else{
    //    echo "Connected successfully"; echo "<br>";
    }

?>

<html>
<head>
<body>           
    <br><br>
    <?php 
    //-----รับค่า input form จาก pdf.php เพื่อส่งเข้า mysql-----
        $os_post =$_POST["os_add"];
        $lang_post=$_POST["lang"];
        $db_post=$_POST["db_add"];
        $java_post=$_POST["javatech"];
        $tools_post=$_POST["tools"];
        $other_post=$_POST["others"];

        $getstr_os="";
        $getstr_lang="";
        $getstr_db="";
        $getstr_javatech="";
        $getstr_tools="";
        $getstr_adobe="";
        $getstr_ms="";
        $getstr_others="";
        $i=0;

        if($os_post!=null){
            $os_post=strtolower($os_post);
            if(strpos($os_post,",")){
                for($i=0;$i<strlen($os_post);$i++){
                    if($os_post[$i]!==","){
                      $getstr_os.=$os_post[$i];                     
                    }
                    else{
                      echo $getstr_os;
                      echo "<br>";                    
                      $sql_table="INSERT INTO operation (ostools) VALUES ('$getstr_os')";
                      if ($conn->query($sql_table) === TRUE) {
                      echo "New record operation created successfully";
                      echo "<br>";
                      }
                      else {echo "Error: " . $sql_table . "<br>" . $conn->error;
                      }
                      echo " ";
                      $getstr_os="";
                    }                  
                } 
                    echo $getstr_os;
                    echo "<br>";                    
                      $sql_table="INSERT INTO operation (ostools) VALUES ('$getstr_os')";
                      if ($conn->query($sql_table) === TRUE) {
                      echo "New record operation created successfully";
                      echo "<br>";
                      }
                      else {echo "Error: " . $sql_table . "<br>" . $conn->error;
                      }
                      echo " ";
                      $getstr_os="";         
            }
            else{
                echo $os_post;
                echo "<br>";
                $sql_table="INSERT INTO operation (ostools) VALUES ('$os_post')";
                if ($conn->query($sql_table) === TRUE) {
                echo "New record operation created successfully";
                echo "<br>";
                }
                else {echo "Error: " . $sql_table . "<br>" . $conn->error;}
            }
                
        }
        
        if($lang_post!=null){
            $lang_post=strtolower($lang_post);
            if(strpos($lang_post,",")){
                for($i=0;$i<strlen($lang_post);$i++){
                    if($lang_post[$i]!==","){
                      $getstr_lang.=$lang_post[$i];                     
                    }
                    else{
                      echo $getstr_lang;
                      echo "<br>";                    
                      $sql_table2="INSERT INTO programming (language) VALUES ('$getstr_lang')";
                      if ($conn->query($sql_table2) === TRUE) {
                      echo "New record language created successfully";
                      echo "<br>";
                      }
                      else {echo "Error: " . $sql_table2 . "<br>" . $conn->error;
                      }
                      echo " ";
                      $getstr_lang="";
                    }                  
                } 
                      echo $getstr_lang;
                      echo "<br>";                    
                      $sql_table2="INSERT INTO programming (language) VALUES ('$getstr_lang')";
                      if ($conn->query($sql_table2) === TRUE) {
                      echo "New record language created successfully";
                      echo "<br>";
                      }
                      else {echo "Error: " . $sql_table2 . "<br>" . $conn->error;
                      }
                      echo " ";
                      $getstr_lang="";  
            }
            else{
                echo $lang_post;
                echo "<br>";
                $sql_table2="INSERT INTO programming (language) VALUES ('$lang_post')";
                if ($conn->query($sql_table2) === TRUE) {
                echo "New record language created successfully";
                echo "<br>";
                }
                else {echo "Error: " . $sql_table2 . "<br>" . $conn->error;}
            }
        }
        if($db_post!=null){
            $db_post=strtolower($db_post);
            if(strpos($db_post,",")){
                for($i=0;$i<strlen($db_post);$i++){
                    if($db_post[$i]!==","){
                        $getstr_db.=$db_post[$i];                     
                    }
                    else{
                        echo $getstr_db;
                        echo "<br>";
                        $sql_table3="INSERT INTO databasetools (dbtools) VALUES ('$getstr_db')";
                        if ($conn->query($sql_table3) === TRUE) {
                        echo "New record database created successfully";
                        echo "<br>";
                        }
                        else {echo "Error: " . $sql_table3 . "<br>" . $conn->error;
                        }
                        echo " ";
                        $getstr_db="";
                    }
                }
                    echo $getstr_db;
                    echo "<br>";
                    $sql_table3="INSERT INTO databasetools (dbtools) VALUES ('$getstr_db')";
                    if ($conn->query($sql_table3) === TRUE) {
                    echo "New record database created successfully";
                    echo "<br>";
                    }
                    else {echo "Error: " . $sql_table3 . "<br>" . $conn->error;}
            }
            else{
                echo $db_post;
                echo "<br>";
                $sql_table3="INSERT INTO databasetools (dbtools) VALUES ('$db_post')";
                if ($conn->query($sql_table3) === TRUE) {
                echo "New record database created successfully";
                echo "<br>";
                }
                else {echo "Error: " . $sql_table3 . "<br>" . $conn->error;}
            }           
        }

        if($java_post!=null){
            $java_post=strtolower($java_post);
            if(strpos($java_post,",")){
                for($i=0;$i<strlen($java_post);$i++){
                    if($java_post[$i]!==","){
                        $getstr_javatech.=$java_post[$i];                     
                    }
                    else{
                        echo $getstr_javatech;
                        echo "<br>";
                        $sql_table4="INSERT INTO javatechs (javatech) VALUES ('$getstr_javatech')";
                        if ($conn->query($sql_table4) === TRUE) {
                        echo "New record Java Technologies created successfully";
                        echo "<br>";
                        }
                        else {echo "Error: " . $sql_table4 . "<br>" . $conn->error;
                        }
                        echo " ";
                        $getstr_javatech="";
                    }
                }
                        echo $getstr_javatech;
                        echo "<br>";
                        $sql_table4="INSERT INTO javatechs (javatech) VALUES ('$getstr_javatech')";
                        if ($conn->query($sql_table4) === TRUE) {
                        echo "New record Java Technologies created successfully";
                        echo "<br>";
                        }
                        else {echo "Error: " . $sql_table4 . "<br>" . $conn->error;}
            }
            else{
                echo $java_post;
                echo "<br>";
                $sql_table4="INSERT INTO javatechs (javatech) VALUES ('$java_post')";
                if ($conn->query($sql_table4) === TRUE) {
                    echo "New record Java Technologies created successfully";
                    echo "<br>";
                }
                else {echo "Error: " . $sql_table4 . "<br>" . $conn->error;}
            }
        }

        //----- เช็ค textก่อนส่ง ว่าเป็น adobe หรือ microsoft -----//
        if($tools_post!=null){
            $tools_post=strtolower($tools_post);
            if(strpos($tools_post,",")){
                for($i=0;$i<strlen($tools_post);$i++){
                    if($tools_post[$i]!==","){
                        $getstr_tools.=$tools_post[$i];
                    }
                    else{
                        checktools($getstr_tools);
                        echo " ";
                        $getstr_tools="";
                    }
                }
                checktools($getstr_tools);
                echo " ";
                $getstr_tools="";
            }
            else{
                $tools_post=strtolower($tools_post);
                if(strpos($tools_post,"adobe")!==false){
                echo $tools_post;
                echo "<br>";
                $sql_table7="INSERT INTO adobe (adobetools) VALUES ('$tools_post')";
                if ($conn->query($sql_table7) === TRUE) {
                    echo "New record Adobe tools created successfully";
                    echo "<br>";
                }
                else {echo "Error: " . $sql_table7 . "<br>" . $conn->error;}
            }
            else if(strpos($tools_post,"microsoft")!==false){
                echo $tools_post;
                echo "<br>";
                $sql_table8="INSERT INTO microsoft(mstools) VALUES ('$tools_post')";
                if ($conn->query($sql_table8) === TRUE) {
                    echo "New record Microsoft tools created successfully";
                    echo "<br>";
                }
                else {echo "Error: " . $sql_table8 . "<br>" . $conn->error;}
            }
            else if(strpos($tools_post,"ms")!==false){
                echo $tools_post;
                echo "<br>";
                $sql_table8="INSERT INTO microsoft(mstools) VALUES ('$tools_post')";
                if ($conn->query($sql_table8) === TRUE) {
                    echo "New record Microsoft tools created successfully";
                    echo "<br>";
                }
                else {echo "Error: " . $sql_table8 . "<br>" . $conn->error;}
            }
            else{
                echo $tools_post;
                echo "<br>";
                $sql_table5="INSERT INTO tools(tools) VALUES ('$tools_post')";
                if ($conn->query($sql_table5) === TRUE) {
                    echo "New record Tools created successfully";
                    echo "<br>";
                }
                else {echo "Error: " . $sql_table5 . "<br>" . $conn->error;}
            }
        }   
    }

        if($other_post!=null){
            $other_post=strtolower($other_post);
            if(strpos($other_post,",")){
                for($i=0;$i<strlen($other_post);$i++){
                    if($other_post[$i]!==","){
                        $getstr_others.=$other_post[$i];                     
                    }
                    else{
                        echo $getstr_others;
                        echo "<br>";
                        $sql_table6="INSERT INTO others (other) VALUES ('$getstr_others')";
                        if ($conn->query($sql_table6) === TRUE) {
                        echo "New record Other created successfully";
                        echo "<br>";
                        }
                        else {echo "Error: " . $sql_table6 . "<br>" . $conn->error;}
                    }
                }
                echo $getstr_others;
                echo "<br>";
                $sql_table6="INSERT INTO others (other) VALUES ('$getstr_others')";
                if ($conn->query($sql_table6) === TRUE) {
                echo "New record Other created successfully";
                echo "<br>";
                }
                else {echo "Error: " . $sql_table6 . "<br>" . $conn->error;}
            }
            else{
                echo $other_post;
                echo "<br>";
                $sql_table6="INSERT INTO others (other) VALUES ('$other_post')";
                if ($conn->query($sql_table6) === TRUE) {
                echo "New record Other created successfully";
                echo "<br>";
                }
                else {echo "Error: " . $sql_table6 . "<br>" . $conn->error;}
            }
        }

        mysqli_close($conn);
    ?>


<?php
    function checktools($getstr_tools){
        $hostname="localhost";
        $userhost="root";
        $password="";
        $database="myDB";
        //session_start();
        //create connection
        $conn = new mysqli($hostname, $userhost, $password, $database);
        //check connection
        if ($conn->connect_error) {
        exit("Connection failed: " . $conn->connect_error);}
        else{
        //    echo "Connected successfully"; echo "<br>";
        }

        if(strpos($getstr_tools,"adobe")!==false){
            echo $getstr_tools;
            echo "<br>";
            $sql_table7="INSERT INTO adobe (adobetools) VALUES ('$getstr_tools')";
            if ($conn->query($sql_table7) === TRUE) {
                echo "New record Adobe tools created successfully";
                echo "<br>";
            }
            else {echo "Error: " . $sql_table7 . "<br>" . $conn->error;}
            echo " ";
            $getstr_tools="";
        }
        else if(strpos($getstr_tools,"microsoft")!==false){
            echo $getstr_tools;
            echo "<br>";
            $sql_table8="INSERT INTO microsoft(mstools) VALUES ('$getstr_tools')";
            if ($conn->query($sql_table8) === TRUE) {
                echo "New record Microsoft tools created successfully";
                echo "<br>";
            }
            else {echo "Error: " . $sql_table8 . "<br>" . $conn->error;}           
        }
        else if(strpos($getstr_tools,"ms")!==false){
            echo $getstr_tools;
            echo "<br>";
            $sql_table8="INSERT INTO microsoft(mstools) VALUES ('$getstr_tools')";
            if ($conn->query($sql_table8) === TRUE) {
                echo "New record Microsoft tools created successfully";
                echo "<br>";
            }
            else {echo "Error: " . $sql_table8 . "<br>" . $conn->error;}
        }
        else{
            echo $getstr_tools;
            echo "<br>";
            $sql_table5="INSERT INTO tools(tools) VALUES ('$getstr_tools')";
            if ($conn->query($sql_table5) === TRUE) {
                echo "New record Tools created successfully";
                echo "<br>";
            }
            else {echo "Error: " . $sql_table5 . "<br>" . $conn->error;}
        }
    }
?>
    
<form name="form2" action="pdf.php">
    <br><br>
    <!-ตรงนี้เป็นปุ่ม back ถอยกลับไปหน้า pdf.php เพื่อเปิดไฟล์ pdfใหม่->
	<div id="back">
    <input type="submit" id="goback" value="Back" />
		<br>
    </div>
</form>

</body>
</head>
</html>


