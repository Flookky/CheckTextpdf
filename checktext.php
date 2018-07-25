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

        if($os_post!=null){
            $os_post=strtolower($os_post);
            echo $os_post;
            echo "<br>";
            $sql_table="INSERT INTO operation (ostools) VALUES ('$os_post')";
            if ($conn->query($sql_table) === TRUE) {
                echo "New record operation created successfully";
                echo "<br>";
            }
            else {echo "Error: " . $sql_table . "<br>" . $conn->error;}
        }
        if($lang_post!=null){
            $lang_post=strtolower($lang_post);
            echo $lang_post;
            echo "<br>";
            $sql_table2="INSERT INTO programming (language) VALUES ('$lang_post')";
            if ($conn->query($sql_table2) === TRUE) {
                echo "New record language created successfully";
                echo "<br>";
            }
            else {echo "Error: " . $sql_table2 . "<br>" . $conn->error;}
        }
        if($db_post!=null){
            $db_post=strtolower($db_post);
            echo $db_post;
            echo "<br>";
            $sql_table3="INSERT INTO databasetools (dbtools) VALUES ('$db_post')";
            if ($conn->query($sql_table3) === TRUE) {
                echo "New record database created successfully";
                echo "<br>";
            }
            else {echo "Error: " . $sql_table3 . "<br>" . $conn->error;}
        }
        if($java_post!=null){
            $java_post=strtolower($java_post);
            echo $java_post;
            echo "<br>";
            $sql_table4="INSERT INTO javatechs (javatech) VALUES ('$java_post')";
            if ($conn->query($sql_table4) === TRUE) {
                echo "New record Java Technologies created successfully";
                echo "<br>";
            }
            else {echo "Error: " . $sql_table4 . "<br>" . $conn->error;}
        }

        //----- เช็ค textก่อนส่ง ว่าเป็น adobe หรือ microsoft -----//
        if($tools_post!=null){
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
        if($other_post!=null){
            $other_post=strtolower($other_post);
            echo $other_post;
            echo "<br>";
            $sql_table6="INSERT INTO others (other) VALUES ('$other_post')";
            if ($conn->query($sql_table6) === TRUE) {
                echo "New record Other created successfully";
                echo "<br>";
            }
            else {echo "Error: " . $sql_table6 . "<br>" . $conn->error;}
        }
        mysqli_close($conn);
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


