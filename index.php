<?php
/*****************************************************************
 *	DOCUMENT_TEMPLATE.php
 *	------------------------
 *  Created			: January 25, 2013
 *  Created by:		: Jason Torgrimson
 *  Copyright		: (c) 2013 Twin Falls High School.
 *	Description		: Application landing page for the public.
****************************************************************/
   
/************************************************
 *	PAGE VARIABLES AND CONSTANTS
************************************************/

	//Defines the path from this file to the root of the site
		//Define to path to the root of our site in the quotes.
		define('ROOT_PATH', '');
		
	//Defines page title in the title bar and in the header.
		//Place the title of your project in the quotes.
		define('TITLE', 'Library Checkin Software, v1.0');

/************************************************
 *	SERCURITY AND INCLUDES
************************************************/

	//Includes all classes and variables common to all pages in the site.
		require_once(ROOT_PATH . 'common.php');

	//Validate authorized user access to this page
		$auth->validate_user_access('PUBLIC');

/************************************************
 *	DATA HANDLING
 *	description: Section used for filtering
 				 incoming data and escaping
				 outgoing data passed to this
				 page.
 ************************************************/
 
	 if(	array_key_exists('checkin', $_GET) &&
	 		array_key_exists('inputBarcode', $_POST) &&
			is_numeric($_POST['inputBarcode'])){
							
		 requestCheckin($_POST['inputBarcode']);
		
	 }
 
/************************************************
 *	PAGE SPECIFIC FUNCTIONS
 *	description: Section used for creating functions
 				 used ONLY on this page.  All other
				 functions must be included in the
				 appropriate file in the INC folder.
 ************************************************/

	function requestCheckin($barcode){

		global $data_validation, $db;

		// capture barcode
		$sql['barcode'] = $data_validation->escape_sql($barcode);

		// Check to see if student exists in the database
		$db->query('SELECT * FROM student WHERE id = ' . $sql['barcode'], 'checkForStudent');
		if($db->num_rows('checkForStudent')){
			
			//Check to see if this is a checkout request
			$sql['currDate'] = date('Y-m-d');
			$sql['currTime'] = date('h:i:s');
			
			$db->query('SELECT id FROM `log` WHERE studentId = \''.$sql['barcode'].'\' AND date = \''.$sql['currDate'].'\' AND timeOut IS NULL', 'checkoutValidation');
			if($db->num_rows('checkoutValidation')){

				//Process checkout request
				while($row = $db->fetch_array('checkoutValidation')){
					$sql['logId'] = $data_validation->escape_sql($row['id']);
					$db->query('UPDATE `log` SET timeOut = \''.$sql['currTime'].'\' WHERE id = \''.$sql['logId'].'\'', 'updateCheckout');
					
					//Send email to current instructor
					
					
					// redirect user to checkout page
					header('Location:checkedout.php');
				}
				
				
			}else{
				header('Location:options.php?id=' . $sql['barcode']);
			}
		}
		
	}
 
/************************************************
 *	HEADER
 *	description: Section calls the header
 				 container for this page.
************************************************/
	
	//Establishes the structure for the header container
	
		$htmlHead = '';
		$template->page_header(TITLE, $htmlHead);
		

/************************************************
 *	PAGE OUTPUT
 *	description: Section used for all page output
************************************************/

?>
	<!-- THE ONLY THINGS YOU NEED TO CHANGE ABOVE ARE THE ROOT_PATH AND TITLE, and navigation method!!! -->

	<!-- ENTER THE CONTENT FOR YOUR PAGE HERE!!! -->
	
	<!-- Begin HTML5 content -->

	<script type="text/javascript">
		<!--
		//Center the content on the page
				
			// set focus on the input element
			setInterval(function(){if(!$("*:focus").is("input, inputBarcode")){
				//document.getElementById('inputBarcode').focus()
				$("#inputBarcode").focus();
			}},100);
			
			//Set the input element value to an empty string
			$('#inputBarcode').val('');
				
		-->
	</script>
        <h2 class="title" style="text-align:center;"><a>Welcome to the Library Sign In</a></h2>
            <h2 style="color:#FFF;">Scan your Student ID card below</h2>
            <div data-role="popup" id="popupInfo" data-transition="pop">
              <p>To Sign Into the Library Checkin System, scan your Student ID Card's Barcode, and follow the instructions given.</p>
            </div>

                <div id="checkin" >
                    <form name="barcode" id="barcode" method="post" action="?checkin">
                    <input type="text" id="inputBarcode" onfocus="this.value=''" name="inputBarcode" placeholder="Student ID Number" style="font-size:18pt;"/><br />

                    </form>
                </div>
            <a style="width: 25%; margin-right: auto; margin-left: auto;" href="#popupInfo" data-role="button" data-rel="popup" data-theme="b">Help</a>

	<!-- End HTML5 content -->
	
	<!-- LEAVE EVERYTHING BELOW THIS LINE ALONE!!! -->

<?php

/************************************************
 *	FOOTER
 *	description: Section calls the advertisement
 				 structure for this page.
************************************************/

	//Establishes the structure for the banner container
		$template->page_footer();


/************************************************
 *	END OF DOCUMENT
************************************************/

?>