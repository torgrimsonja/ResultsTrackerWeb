<?php
/**********************************************************
 *	/inc/template.php
 *	------------------------
 *  begin           : March 1, 2013
 *  created by:		: Jason Torgrimson
 *  copyright		: (c) Twin Falls High School
 **********************************************************/
 

$template = new page_template();

$template->location = ROOT_PATH;
$template->data_validation = $data_validation;
$template->auth = $auth;


class page_template {
	
	var $data_validation;
	var $location;
	var $auth;
	
	function page_header($title, $htmlHead = ''){
		$html['title'] = $this->data_validation->escape_html($title);
	?>
        <!DOCTYPE html>
        <html>
        <head>
        <meta charset="utf-8" />
            <title><?php echo $html['title']; ?></title>
            <link href="<?php echo $this->location; ?>inc/css/main.css" rel="stylesheet">
            <link href="<?php echo $this->location; ?>inc/css/jquery.mobile-1.3.1.min.css" rel="stylesheet">
            <script src="<?php echo $this->location; ?>inc/js/jquery-1.9.0.min.js"></script>
            <script src="<?php echo $this->location; ?>inc/js/jquery.mobile-1.3.1.min.js"></script>
			<script type="text/javascript">
			document.addEventListener('deviceready', onDeviceReady, false);
			
			function onDeviceReady(){
				$(document).bind("mobileinit", function(){
				  $.extend(  $.mobile , {
					ajaxFormsEnabled : false,
					ajaxEnabled : false,
				  });
				});
			}
			</script>
        <?php echo $htmlHead; ?>
        </head>
        <body>
            <div id="page" data-role="page" data-theme="a">
                <div id="header" data-role="header" data-position="fixed">
                        <h2 style="color:#FFF;">Welcome to ResultsTracker</h1>
                        <a href="<?php echo $this->location;?>admin/" data-role="button">Login</a>
                </div>
                    <div data-role="navbar" data-grid="b">
                        <ul>															   <!-- class="ui-btn-active" -->
                            <li><a href="<?php echo $this->location; ?>index.php">Home</a></li>
                            <li><a href="<?php echo $this->location; ?>reports.php">Reports</a></li>
                            <li><a href="<?php echo $this->location; ?>progress.php">Progress</a></li>
                        </ul>
                    </div><!-- /navbar -->
				<div style="margin: 2em;" class="content">
	<?php
	}
	
	function page_footer(){
	?>
    			</div> <!-- end #content -->
                <div data-role="footer" data-position="fixed" style="text-align:center;">
                	&copy; 2013 atsolinc.com
                </div>     
        	</div>  <!-- end #container -->
        </body>
        </html>

    <?php
	}

	function errorPage($message){
		$this->page_header('An Error Occurred');
		echo $this->data_validation->escape_html($message);
		$this->page_footer();
	}
	
	function admin_page_header($title, $htmlHead = ''){
		
		$html['title'] = $this->data_validation->escape_html($title);
		?>
        <!DOCTYPE html>
        <html>
        <head>
        <meta charset="utf-8" />
            <title><?php echo $html['title']; ?></title>
            <link href="<?php echo $this->location; ?>inc/css/main.css" rel="stylesheet">
            <link href="<?php echo $this->location; ?>inc/css/jquery.mobile-1.3.1.min.css" rel="stylesheet">
            <script src="<?php echo $this->location; ?>inc/js/jquery-1.9.0.min.js"></script>
            <script src="<?php echo $this->location; ?>inc/js/jquery.mobile-1.3.1.min.js"></script>
			<script type="text/javascript">
			document.addEventListener('deviceready', onDeviceReady, false);
			
			function onDeviceReady(){
				$(document).bind("mobileinit", function(){
				  $.extend(  $.mobile , {
					ajaxFormsEnabled : false,
					ajaxEnabled : false,
				  });
				});
			}
			</script>
        <?php echo $htmlHead; ?>
        </head>
        <body>
            <div id="page" data-role="page" data-theme="a">
                <div id="header" data-role="header" data-position="fixed">
                        <h2 style="color:#FFF;">ResultsTracker - Administration</h1>
                        <?php
                        	if($this->auth->check_authenticated()){
								echo '<a href="?logout" data-role="button">Logout</a>';
							}
						?>
                </div>
					<?php
                        if($this->auth->check_authenticated()){
							?>
                                <div data-role="navbar" data-grid="d">
                                    <ul>															   <!-- class="ui-btn-active" -->
                                        <li><a href="<?php echo $this->location; ?>admin/schedule/index.php">Home</a></li>
                                        <li><a href="<?php echo $this->location; ?>admin/courses.php">Courses</a></li>
                                        <li><a href="<?php echo $this->location; ?>admin/students.php">Students</a></li>
                                        <li><a href="<?php echo $this->location; ?>admin/tasks.php">Tasks</a></li>
                                        <li><a href="<?php echo $this->location; ?>admin/reports.php">Reports</a></li>
                                    </ul>
                                </div><!-- /navbar -->
                            <?php
						}
					?>
				<div style="margin: 2em;">
            
    <?php
	}
	
	function admin_page_footer(){
	?>
                    </div>
                    <div data-role="footer" data-position="fixed" class="ui-bar" style="text-align: center;">
	                	&copy; 2013 atsolinc.com
                    </div>                    
                </div>
            </div>
        </body>
        </html>

    <?php
	}

}