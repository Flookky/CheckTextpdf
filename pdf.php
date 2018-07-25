<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale = 1.0, maximum-scale = 1.0, user-scalable=no">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="pdf.js"></script>
<script src="pdf.worker.js"></script>
<link rel="stylesheet" type="text/css" href="inputtext.css">
</head>
<body>
<button id="upload-button2">Select PDF2</button> 


<div id="upload-button">Select PDF
		<img src="search.png" id="searchpic" height="15" width="15">
</div> 
<input type="file" id="file-to-upload" accept="application/pdf" />
<div id="pdf-main-container">
	<div id="pdf-loader">Loading document ...</div>
	<div id="pdf-contents">
		<div id="pdf-meta">
			<div id="pdf-buttons">
				<button id="pdf-prev">Previous</button>
				<button id="pdf-next">Next</button>
			</div>
			<div id="page-count-container">Page <div id="pdf-current-page"></div> of <div id="pdf-total-pages"></div></div>
		</div>
		<canvas id="pdf-canvas" width="400"></canvas>
		<div id="page-loader">Loading page ...</div>
	</div>
</div>

<script>
//----µÃ§¹ÕéäÇé«èÍ¹ button à©Âæ----//
$("#upload-button2").hide();

var __PDF_DOC,
	__CURRENT_PAGE,
	__TOTAL_PAGES,
	__PAGE_RENDERING_IN_PROGRESS = 0,
	__CANVAS = $('#pdf-canvas').get(0),
	__CANVAS_CTX = __CANVAS.getContext('2d');

function showPDF(pdf_url) {
	$("#pdf-loader").show();

	PDFJS.getDocument({ url: pdf_url }).then(function(pdf_doc) {
		__PDF_DOC = pdf_doc;
		__TOTAL_PAGES = __PDF_DOC.numPages;
		

		
	gettext(pdf_url).then(function (text) {
	//-----àà¨é§¢éÍ¤ÇÒÁ•Õè´Ö§¨Ò¡ä¿Åì pdf-----//
	//alert(text);
    var pdftxt=text;
	//document.getElementById("Textgo").innerHTML= pdftxt;
	checktext(pdftxt);
	$("#allinput").show();

}, function (reason) {
  console.error(reason);
});
		// Hide the pdf loader and show pdf container in HTML
		$("#pdf-loader").hide();
		$("#pdf-contents").show();
		$("#pdf-total-pages").text(__TOTAL_PAGES);

		// Show the first page
		showPage(1);
	}).catch(function(error) {
		// If error re-show the upload button
		$("#pdf-loader").hide();
		$("#upload-button").show();
		
		alert(error.message);
	});;
}

function showPage(page_no) {
	__PAGE_RENDERING_IN_PROGRESS = 1;
	__CURRENT_PAGE = page_no;

	// Disable Prev & Next buttons while page is being loaded
	$("#pdf-next, #pdf-prev").attr('disabled', 'disabled');

	// While page is being rendered hide the canvas and show a loading message
	$("#pdf-canvas").hide();
	$("#page-loader").show();

	// Update current page in HTML
	$("#pdf-current-page").text(page_no);
	
	// Fetch the page
	__PDF_DOC.getPage(page_no).then(function(page) {
		// As the canvas is of a fixed width we need to set the scale of the viewport accordingly
		var scale_required = __CANVAS.width / page.getViewport(1).width;

		// Get viewport of the page at required scale
		var viewport = page.getViewport(scale_required);

		// Set canvas height
		__CANVAS.height = viewport.height;

		var renderContext = {
			canvasContext: __CANVAS_CTX,
			viewport: viewport
		};
		
		// Render the page contents in the canvas
		page.render(renderContext).then(function() {
			__PAGE_RENDERING_IN_PROGRESS = 0;

			// Re-enable Prev & Next buttons
			$("#pdf-next, #pdf-prev").removeAttr('disabled');

			// Show the canvas and hide the page loader
			$("#pdf-canvas").show();
			$("#page-loader").hide();
		});
	});
}

// Upon click this should should trigger click on the #file-to-upload file input element
// This is better than showing the not-good-looking file input element
$("#upload-button").on('click', function() {
	$("#file-to-upload").trigger('click');
});

// When user chooses a PDF file
$("#file-to-upload").on('change', function() {
	// Validate whether PDF
    if(['application/pdf'].indexOf($("#file-to-upload").get(0).files[0].type) == -1) {
        alert('Error : Not a PDF');
        return;
    }

	$("#upload-button").hide();
	// Send the object url of the pdf
	showPDF(URL.createObjectURL($("#file-to-upload").get(0).files[0]));


});

// Previous page of the PDF
$("#pdf-prev").on('click', function() {
	if(__CURRENT_PAGE != 1)
		showPage(--__CURRENT_PAGE);
});

// Next page of the PDF
$("#pdf-next").on('click', function() {
	if(__CURRENT_PAGE != __TOTAL_PAGES)
		showPage(++__CURRENT_PAGE);
});

function gettext(pdfUrl){
var pdf = PDFJS.getDocument(pdfUrl);
return pdf.then(function(pdf) { // get all pages text
     var maxPages = pdf.pdfInfo.numPages;
     var countPromises = []; // collecting all page promises
     for (var j = 1; j <= maxPages; j++) {
        var page = pdf.getPage(j);

        var txt = "";
        countPromises.push(page.then(function(page) { // add page promise
            var textContent = page.getTextContent();
            return textContent.then(function(text){ // return content promise
                return text.items.map(function (s) { return s.str; }).join(''); // value page text 

            });
        }));
     }
     // Wait for all pages and join text
     return Promise.all(countPromises).then(function (texts) {
       
       return texts.join('');
     });
});
}
</script>

<script>
	//¿Ñ§¡ìªÑè¹¹Õé äÇéàªç¤¤Óà¡ÕèÂÇ¡Ñº ÀÒÉÒ database os tool framework Í×è¹æ
	var skilltxt="Technical Skill";
	var osmode="Operating System: ";
	var language="Programming Language: ";
	var database="Database: ";
	var javaother="Java Technologies: "
	var toolprogram="Tool: ";
	var othertxt="Other: "
	function checktext(pdftxt){
		var str=pdftxt;
		var gotext=str.toLowerCase();
		var i;
		for(i=0;i<=lang_arraydb.length;i++){
			if(gotext.includes(lang_arraydb[i])){
				var langscap;
				langscap=lang_arraydb[i].charAt(0).toUpperCase() + lang_arraydb[i].slice(1);
				language=language+langscap+",";
			}
		}
		document.getElementById("skill").innerHTML=skilltxt;
		document.getElementById("language").innerHTML=language;
		Dbcheck(gotext);
	}
	function Dbcheck(gotext){
		var i;
		for(i=0;i<=db_arraydb.length;i++){
			if(gotext.includes(db_arraydb[i])){
				var dbcap;
				dbcap=db_arraydb[i].charAt(0).toUpperCase() + db_arraydb[i].slice(1);
				database=database+dbcap+",";
			}
		}
		document.getElementById("database").innerHTML=database;
		javatech(gotext);
	}
	function javatech(gotext){
		var i=0;
		for(i;i<=java_arraydb.length;i++){
			if(gotext.includes(java_arraydb[i])){
				var javacap;
				javacap=java_arraydb[i].charAt(0).toUpperCase() + java_arraydb[i].slice(1);
				javaother=javaother+javacap+",";
			}
		}
		document.getElementById("java").innerHTML=javaother;
		oscheck(gotext);
	}
	function oscheck(gotext){
		var i;
		for(i=0;i<=os_arraydb.length;i++){
			if(gotext.includes(os_arraydb[i])){
				var oscap;
				oscap=os_arraydb[i].charAt(0).toUpperCase() + os_arraydb[i].slice(1);
				osmode=osmode+oscap+",";
			}
		}
		document.getElementById("os").innerHTML=osmode;
		toolcheck(gotext);
	}
	function toolcheck(gotext){
		var i;
		for(i=0;i<=adobe_arraydb.length;i++){
			if(gotext.includes(adobe_arraydb[i])){
				var adobecap;
				adobecap=adobe_arraydb[i].charAt(0).toUpperCase() + adobe_arraydb[i].slice(1);
				toolprogram=toolprogram+adobecap+",";
			}
		}
		for(i=0;i<=ms_arraydb.length;i++){
			if(gotext.includes(ms_arraydb[i])){
				var mscap;
				mscap=ms_arraydb[i].charAt(0).toUpperCase() + ms_arraydb[i].slice(1);
				toolprogram=toolprogram+mscap+",";
			}
		}
		for(i=0;i<=tools_arraydb.length;i++){
			if(gotext.includes(tools_arraydb[i])){
				var toolscap;
				toolscap=tools_arraydb[i].charAt(0).toUpperCase() + tools_arraydb[i].slice(1);
				toolprogram=toolprogram+toolscap+",";
			}
		}
		document.getElementById("tool").innerHTML=toolprogram;
		Other(gotext);
		
	}
	function Other(gotext){
		var i;
		for(i=0;i<=others_arraydb.length;i++){
			if(gotext.includes(others_arraydb[i])){
				var othercap;
				othercap=others_arraydb[i].charAt(0).toUpperCase() + others_arraydb[i].slice(1);
				othertxt=othertxt+othercap+"," ;
			}
		}
		document.getElementById("other").innerHTML=othertxt;
	}

</script>
<script>
	PDFJS.disableWorker = true
	PDFJS.disableRange = true
</script>

<p id="Textgo"></p>
<br><br><br>
<p id="skill"></p>
<p id="os"></p>
<p id="language"></p>
<p id="database"></p>
<p id="java"></p>
<p id="tool"></p>
<p id="other"></p>

<form name="form1" method="post" action="checktext.php">
	<div id="allinput">
		<input type="text" name="os_add" id="operation_add" placeholder="Operation System add" />
		<br><br>
		<input type="text" name="lang" id="lang_add" placeholder="Programming Language add" />
		<br><br>
		<input type="text" name="db_add" id="database_add" placeholder="Database add" />
		<br><br>
		<input type="text" name="javatech" id="java_add" placeholder="Java Technology add" />
		<br><br>
		<input type="text" name="tools" id="tools_add" placeholder="Tools add" />
		<br><br>
		<input type="text" name="others" id="other_add" placeholder="Other add" />
		<br><br>
		<input type="submit" id="gocheck" value="Add Info" />
		<br><br>
	</div>
</form>

<?php
    //Create Database php tag
    $hostname="localhost";
    $userhost="root";
    $password="";
    $database="myDB";
    //session_start();
    //create connection
	$conn = new mysqli($hostname, $userhost, $password);
    //check connection
    if ($conn->connect_error) {
    exit("Connection failed: " . $conn->connect_error);}
    //else{echo "Connected successfully"; echo "<br>";}
    
    //create database name
    $sql="CREATE DATABASE IF NOT EXISTS $database ";
    if(mysqli_query($conn,$sql)){
		if ($conn->connect_error) {
			exit("Connection failed: " . $conn->connect_error);}
			//else{echo "Connected successfully"; echo "<br>";}
    }
    //else{ echo "Error creating database: " . mysqli_error($conn); echo "<br>";}

	$conn =new mysqli($hostname,$userhost,$password,$database);
	//check connection
    if ($conn->connect_error) {
		exit("Connection failed: " . $conn->connect_error);}
		//else{echo "Connected successfully"; echo "<br>";}



    //------create all tables------ 
    $sql_table ="CREATE TABLE IF NOT EXISTS operation(
        id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
        ostools VARCHAR(30) NOT NULL UNIQUE)";
    if ($conn->query($sql_table) === TRUE) {
        //echo "New record1 created successfully"; echo "<br>";
    } 
    //else {echo "Error: " . $sql_table . "<br>" . $conn->error; echo "<br>";}

    $sql_table2="CREATE TABLE IF NOT EXISTS programming(
        id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
        language VARCHAR(30) NOT NULL UNIQUE)";
    if($conn->query($sql_table2) === TRUE){
        //echo "New record2 created successfully"; echo "<br>";
    }
    //else {echo "Error: " . $sql_table2 . "<br>" . $conn->error; echo "<br>"; }
    
    $sql_table3="CREATE TABLE IF NOT EXISTS databasetools(
        id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
        dbtools VARCHAR(30) NOT NULL UNIQUE)";
    if($conn->query($sql_table3) === TRUE){
        //echo "New record3 created successfully"; echo "<br>";
    }
    //else {echo "Error: " . $sql_table3 . "<br>" . $conn->error; echo "<br>";}

    $sql_table4="CREATE TABLE IF NOT EXISTS javatechs(
        id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
        javatech VARCHAR(30) NOT NULL UNIQUE)";
    if($conn->query($sql_table4) === TRUE){
        //echo "New record4 created successfully"; echo "<br>";
    }
    //else {echo "Error: " . $sql_table4 . "<br>" . $conn->error; echo "<br>";}

    $sql_table5="CREATE TABLE IF NOT EXISTS tools(
        id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
        tools VARCHAR(30) NOT NULL UNIQUE)";
    if($conn->query($sql_table5) === TRUE){
        //echo "New record5 created successfully"; echo "<br>";
    }
    //else {echo "Error: " . $sql_table5 . "<br>" . $conn->error; echo "<br>";}

    $sql_table6="CREATE TABLE IF NOT EXISTS others(
        id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
        other VARCHAR(30) NOT NULL UNIQUE)";
    if($conn->query($sql_table6) === TRUE){
        //echo "New record6 created successfully"; echo "<br>"; 
    }
    //else {echo "Error: " . $sql_table6 . "<br>" . $conn->error; echo "<br>";}
    
    $sql_table7="CREATE TABLE IF NOT EXISTS adobe(
        id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
        adobetools VARCHAR(30) NOT NULL UNIQUE)";
    if($conn->query($sql_table7) === TRUE){
        //echo "New record6 created successfully"; echo "<br>"; 
    }
    
    $sql_table8="CREATE TABLE IF NOT EXISTS microsoft(
        id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
        mstools VARCHAR(30) NOT NULL UNIQUE)";
    if($conn->query($sql_table8) === TRUE){
        //echo "New record6 created successfully"; echo "<br>"; 
    }


	//-----ãÊè¢éÍÁÙÅµÑé§µé¹Å§ã¹ database¡èÍ¹ ------//
    $sql_table="INSERT INTO operation (ostools) 
    VALUES ('android'),('ios'),('window'),('linux'),('ubuntu'),('macos')
    ,('debian'),('suse'),('mint'),('centos'),('unix'),('fedora')
    ,('red hat'),('red-hat'),('open source'),('hp-ux'),('aix'),('solaris')
    ,('sunos'),('osf/1'),('ibm')";

    if ($conn->query($sql_table) === TRUE) {
        //echo "New record created successfully";
    }
    //else {echo "Error: " . $sql_table . "<br>" . $conn->error;}
    $sql_table2="INSERT INTO programming (language) 
    VALUES ('java'),('c#'),('c++'),('sql'),('react.js'),('react-native')
    ,('react native'),('angular.js'),('backbone.js'),('javascript'),('css')
    ,('html'),('vue.js'),('ionic'),('pytohn'),('visual-basic'),('vb.net')
    ,('xml'),('objective-c'),('swift'),('assembly'),('cobol'),('pascal')
    ,('asp.net'),('jquery'),('ruby'),('perl'),('delphi'),('ajax'),('json')
    ,('kotlin'),('action-script'),('action script'),('jcl'),('powerbuilder')
    ,('etl'),('php'),('rpa'),('abap'),('t-sql'),('restful'),('soap'),('rpc')
    ,('golang'),('boostrap'),('rpg'),('ruby on rail'),('sass'),('bash script')
    ,('sas'),('jsass'),('scss'),('libsass'),('node.js'),('django'),('xcode')
    ,('lua'),('vba'),('powershell'),('groovy'),('pl/sql'),('phonegap')
    ,('cordova'),('lalavel'),('drupal'),('symfony'),('yii'),('codeigniter')
    ,('typescript'),('linux cammand'),('shell script'),('shell-script')
	,('power script'),('power-script')";

    if ($conn->query($sql_table2) === TRUE) {
        //echo "New record created successfully";
    }

    $sql_table3="INSERT INTO databasetools (dbtools) 
    VALUES ('sqlite'),('mongodb'),('oracle'),('mysql'),('informix'),('redis')
    ,('db2'),('mariadb'),('sql-server'),('sql server'),('nosql'),('apache cassandra')
    ,('apache-cassandra'),('sybase')
    ,('firebase'),('microsoft access'),('microsoft-access'),('ms access')
    ,('ms-access'),('rdbms')";

    if ($conn->query($sql_table3) === TRUE) {
        //echo "New record created successfully";
    }

    $sql_table4="INSERT INTO javatechs (javatech) 
    VALUES ('spring'),('jsf'),('vaadin'),('gwt'),('grails'),('jpsx')
    ,('jruleengine'),('jess'),('jaxp'),('jcabi'),('jdom'),('jello'),('jetty')
    ,('junit'),('selenium'),('jfreechart'),('jhipster'),('openxava'),('flexive')
    ,('jenkins'),('orientdb'),('quasar'),('ratpack'),('quartz'),('netty')
    ,('testng'),('thymeleaf'),('vertx'),('vraptor'),('wildfly'),('wordcram')
    ,('xuggler'),('zkoss'),('prova'),('openrules'),('jsp'),('servlet')
    ,('jmeter'),('j2ee'),('j2se'),('jsa'),('strut'),('hibernate'),('log4j')
    ,('axis'),('jdbc'),('poi'),('jboss'),('jreport'),('jvm'),('ejb'),('glassfish')
    ,('websphere'),('esp')";

    if ($conn->query($sql_table4) === TRUE) {
        //echo "New record created successfully";
    }

    $sql_table5="INSERT INTO tools (tools) 
    VALUES ('paint'),('unity'),('unreal engine'),('sony-vegus'),('git')
    ,('android studio'),('android-studio'),('netbeans'),('net-beans'),('cvs')
    ,('svn'),('sublime text'),('bracket')
    ,('inteilij'),('jasperreport'),('appcelerator'),('titanium'),('bugzilla')
    ,('spiratest'),('mantis'),('loadrunner'),('watir'),('ranorex'),('telerik')
    ,('katalon'),('hp-uft'),('hp alm'),('qtp'),('testcomplete'),('appium')
    ,('chef'),('squid'),('docker'),('cacti'),('maven'),('saltstack'),('ansible')
    ,('jira'),('ci/cd'),('agile'),('tableau'),('rabbitmq'),('qilkview')
    ,('power bi'),('cognos'),('cucumber'),('robotium'),('testrail'),('obiee')
    ,('pentaho'),('omnireports'),('puppet'),('pega'),('hpqc'),('linq')";

    if ($conn->query($sql_table5) === TRUE) {
        //echo "New record created successfully";
    }

    $sql_table6="INSERT INTO others (other)
    VALUES ('cloud'),('machine-learning'),('vmware'),('bw'),('basis')
    ,('sap')";

    if ($conn->query($sql_table6) === TRUE) {
        //echo "New record created successfully";
    }

    $sql_table7="INSERT INTO adobe (adobetools) 
    VALUES ('adobe photoshop'),('adobe illustrator'),('adobe flash')
    ,('adobe acrobat'),('adobe premiere'),('adobe after effect')
    ,('adobe indesign'),('adobe lightroom'),('adobe animate'),('adobe spark')
    ,('adobe dreamweaver'),('adobe audition'),('adobe fireworks')
    ,('adobe bridge'),('adobe captivate'),('adobe xd'),('adobe incopy')
    ,('adobe muse'),('adobe framemaker'),('adobe flashbuilder')
    ,('adobe speedgrade'),('adobe freehand'),('adobe pagemaker')
    ,('adobe onlocation'),('adobe robohelp')";

    if ($conn->query($sql_table7) === TRUE) {
        //echo "New record created successfully";
    }

    $sql_table8="INSERT INTO microsoft (mstools) 
    VALUES ('ms office'),('microsoft office'),('ms word'),('microsoft word')
    ,('ms excel'),('microsoft excel'),('ms powerpoint'),('microsoft powerpoint')
    ,('ms visio'),('microsoft visio'),('ms project'),('microsoft project')
    ,('ms sharepoint'),('microsoft sharepoint'),('ms azure'),('microsoft azure')
    ,('ms publisher'),('microsoft publisher'),('ms teams'),('microsoft teams')
    ,('ms planner'),('microsoft planner'),('ms infopath'),('microsoft infopath')
    ,('ms visual studio'),('microsoft visual studio'),('ms source-safe')
    ,('microsoft source-safe')";

    if ($conn->query($sql_table8) === TRUE) {
        //echo "New record created successfully";
	}
	
	//-----¢éÒ§ÅèÒ§¹Õé¨Ðà»ç¹¡ÒÃà¡çº data ¨Ò¡ mysqlä»à»ç¹array¢Í§µÑÇàà»Ã php-----//
	$select_os="SELECT id,ostools FROM operation ORDER BY id ASC";
	$os_result=$conn->query($select_os);
	$os_arr=array();
    if($os_result->num_rows>0){
        while($row=$os_result->fetch_assoc()){
	//-----comment 2ºÃÃ•Ñ´¹Õé äÇéà•Ê´Ù array•ÕèÃÑºÁÒ¨Ò¡sql ààÅéÇà¡çºà¢éÒ js -----//
			//echo $os_arr[]=$row["ostools"];
			//echo "<br>";
			$os_arr[]=$row["ostools"];
		}
    }
    else{
        //echo "0 results";
	}
	
	$select_lang="SELECT id,language FROM programming ORDER BY id ASC";
	$lang_result=$conn->query($select_lang);
	$lang_arr=array();
	if($lang_result->num_rows>0){
		while($row=$lang_result->fetch_assoc()){
	//-----comment 2ºÃÃ•Ñ´¹Õé äÇéà•Ê´Ù array•ÕèÃÑºÁÒ¨Ò¡sql ààÅéÇà¡çºà¢éÒ js -----//			
			//echo $lang_arr[]=$row["language"];
			//echo "<br>";
			$lang_arr[]=$row["language"];
		}
	}
	else{
        //echo "0 results";
	}

	$select_db="SELECT id,dbtools FROM databasetools ORDER BY id ASC";
	$db_result=$conn->query($select_db);
	$db_arr=array();
	if($db_result->num_rows>0){
		while($row=$db_result->fetch_assoc()){
	//-----comment 2ºÃÃ•Ñ´¹Õé äÇéà•Ê´Ù array•ÕèÃÑºÁÒ¨Ò¡sql ààÅéÇà¡çºà¢éÒ js -----//			
			//echo $db_arr[]=$row["dbtools"];
			//echo "<br>";
			$db_arr[]=$row["dbtools"];
		}
	}
	else{
        //echo "0 results";
	}

	$select_java="SELECT id,javatech FROM javatechs ORDER BY id ASC";
	$java_result=$conn->query($select_java);
	$java_arr=array();
	if($java_result->num_rows>0){
		while($row=$java_result->fetch_assoc()){
	//-----comment 2ºÃÃ•Ñ´¹Õé äÇéà•Ê´Ù array•ÕèÃÑºÁÒ¨Ò¡sql ààÅéÇà¡çºà¢éÒ js -----//			
			//echo $java_arr[]=$row["javatech"];
			//echo "<br>";
			$java_arr[]=$row["javatech"];
		}
	}
	else{
        //echo "0 results";
	}

	$select_tools="SELECT id,tools FROM tools ORDER BY id ASC";
	$tools_result=$conn->query($select_tools);
	$tools_arr=array();
	if($tools_result->num_rows>0){
		while($row=$tools_result->fetch_assoc()){
	//-----comment 2ºÃÃ•Ñ´¹Õé äÇéà•Ê´Ù array•ÕèÃÑºÁÒ¨Ò¡sql ààÅéÇà¡çºà¢éÒ js -----//			
			//echo $tools_arr[]=$row["tools"];
			//echo "<br>";
			$tools_arr[]=$row["tools"];
		}
	}
	else{
        //echo "0 results";
	}
	
	$select_adobe="SELECT id,adobetools FROM adobe ORDER BY id ASC";
	$adobe_result=$conn->query($select_adobe);
	$adobe_arr=array();
	if($adobe_result->num_rows>0){
		while($row=$adobe_result->fetch_assoc()){
	//-----comment 2ºÃÃ•Ñ´¹Õé äÇéà•Ê´Ù array•ÕèÃÑºÁÒ¨Ò¡sql ààÅéÇà¡çºà¢éÒ js -----//			
			//echo $adobe_arr[]=$row["adobetools"];
			//echo "<br>";
			$adobe_arr[]=$row["adobetools"];
		}
	}
	else{
        //echo "0 results";
	}

	$select_ms="SELECT id,mstools FROM microsoft ORDER BY id ASC";
	$ms_result=$conn->query($select_ms);
	$ms_arr=array();
	if($ms_result->num_rows>0){
		while($row=$ms_result->fetch_assoc()){
	//-----comment 2ºÃÃ•Ñ´¹Õé äÇéà•Ê´Ù array•ÕèÃÑºÁÒ¨Ò¡sql ààÅéÇà¡çºà¢éÒ js -----//			
			//echo $ms_arr[]=$row["mstools"];
			//echo "<br>";
			$ms_arr[]=$row["mstools"];
		}
	}
	else{
        //echo "0 results";
	}

	$select_others="SELECT id,other FROM others ORDER BY id ASC";
	$others_result=$conn->query($select_others);
	$others_arr=array();
	if($others_result->num_rows>0){
		while($row=$others_result->fetch_assoc()){
	//-----comment 2ºÃÃ•Ñ´¹Õé äÇéà•Ê´Ù array•ÕèÃÑºÁÒ¨Ò¡sql ààÅéÇà¡çºà¢éÒ js -----//			
			//echo $others_arr[]=$row["other"];
			//echo "<br>";
			$others_arr[]=$row["other"];
		}
	}
	else{
        //echo "0 results";
	}
    mysqli_close($conn);
?>
<script>
//-----ÍÑ¹¹Õé¨Ðà»ç¹¡ÒÃ¹Ó array ¨Ò¡php ÁÒ»ÃÑºãªéà»ç¹µÑÇàà»Ã array ¢Í§ js------//
	var os_array=[<?php echo '"'.implode('","',$os_arr).'"' ?>];
		var os_arraydb=os_array;

	var lang_array=[<?php echo '"'.implode('","',$lang_arr).'"' ?>];
		var lang_arraydb=lang_array;

	var db_array=[<?php echo '"'.implode('","',$db_arr).'"' ?>];
		var db_arraydb=db_array;

	var java_array=[<?php echo '"'.implode('","',$java_arr).'"' ?>];
		var java_arraydb=java_array;

	var tools_array=[<?php echo '"'.implode('","',$tools_arr).'"' ?>];
		var tools_arraydb=tools_array;

	var adobe_array=[<?php echo '"'.implode('","',$adobe_arr).'"' ?>];
		var adobe_arraydb=adobe_array;

	var ms_array=[<?php echo '"'.implode('","',$ms_arr).'"' ?>];
		var ms_arraydb=ms_array;

	var others_array=[<?php echo '"'.implode('","',$others_arr).'"' ?>];
		var others_arraydb=others_array;

	//alert(os_arraydb[5]);----- Test array •Õèà¡çºÁÒà©Âæ
</script>    

</body>
</html>
