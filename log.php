<?php
	require_once('php/config.php');
	checkPage();
?>
<?php

	if (isset($_POST['butSearch'])){
		$comment  = isset($_POST['searchText']) ? $_POST['searchText'] : '';
		$comment=str_replace(" ", '+',$comment);
		header('Location: '.'search?q='.$comment);
	}
	
	if (isset($_POST['butSubscribe'])){
		$emailSubscribe  = isset($_POST['emailSubscribe']) ? $_POST['emailSubscribe'] : '';
		$emailSubscribe=str_replace(" ", '+',$emailSubscribe);
		header('Location: '.'subscribe?q='.$emailSubscribe);
	}
	
?>
<?php

	$customDate = '';
	if (isset($_POST['butSubmit'])){
		// Get user input
		$cdate  = isset($_POST['cdate']) ? $_POST['cdate'] : '';
		$customDate = $cdate;
	}
	if (isset($_POST['butToday'])){
		$customDate = date('d-M-y').".txt";
	}
	
?>
<?php

	require_once('php/account_system.php');
	require_once('php/config.php');
	
	if ($_SESSION['userName'] == '') {
		header('Location: '.constant("Website_Url").'/login?url='.constant("Website_Url").'/log');	
	}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php require_once('php/config.php'); echo constant("Website_Name"); ?> - Logs</title>
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/icon" href="assets/images/favicon.ico"/>
    <!-- Font Awesome -->
    <link href="assets/css/font-awesome.css" rel="stylesheet">
    <!-- Bootstrap -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!-- Slick slider -->
    <link rel="stylesheet" type="text/css" href="assets/css/slick.css"/> 
    <!-- Fancybox slider -->
    <link rel="stylesheet" href="assets/css/jquery.fancybox.css" type="text/css" media="screen" /> 
    <!-- Animate css -->
    <link rel="stylesheet" type="text/css" href="assets/css/animate.css"/>  
     <!-- Theme color -->
    <link id="switcher" href="assets/css/theme-color/default.css" rel="stylesheet">

    <!-- Main Style -->
    <link href="style.css" rel="stylesheet">

    <!-- Fonts -->
    <!-- Open Sans for body font -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <!-- Raleway for Title -->
    <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
    <!-- Pacifico for 404 page   -->
    <link href='https://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  <!-- BEGAIN PRELOADER -->
  <div id="preloader">
    <div class="loader">&nbsp;</div>
  </div>
  <!-- END PRELOADER -->

  <!-- SCROLL TOP BUTTON -->
    <a class="scrollToTop" href="#"><i class="fa fa-chevron-up"></i></a>
  <!-- END SCROLL TOP BUTTON -->

  <!-- Start menu section -->
  <section id="menu-area">
    <nav class="navbar navbar-default main-navbar" role="navigation">  
      <div class="container">
        <div class="navbar-header">
          <!-- FOR MOBILE VIEW COLLAPSED BUTTON -->
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <!-- LOGO --> 
               <h3><?php require_once('php/config.php'); echo constant("Website_Name"); ?></h3>                   
        </div>
        <?php require_once('php/menu.php'); ?><!--/.nav-collapse -->
       <div class="search-area">
          <form action="">
            <input id="search" name="search" type="text" placeholder="What're you looking for ?">
            <input id="search_submit" value="Rechercher" type="submit">
          </form>
        </div>         
      </div>          
    </nav> 
  </section>
  <!-- End menu section -->
  <!-- Start blog banner section -->

  <!-- End blog banner section -->

  <!-- Start blog section -->
  <section id="blog">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="blog-area">
            <div class="row">
              <div class="col-lg-8 col-md-7 col-sm-12">
                <div class="blog-left blog-details">
                  <!-- Start single blog post -->
                  
				  <article class="single-from-blog">
				  
				  <?php
			
			function formatSizeUnits($bytes)
    {
        if ($bytes >= 1073741824)
        {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        }
        elseif ($bytes >= 1048576)
        {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        }
        elseif ($bytes >= 1024)
        {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        }
        elseif ($bytes > 1)
        {
            $bytes = $bytes . ' bytes';
        }
        elseif ($bytes == 1)
        {
            $bytes = $bytes . ' byte';
        }
        else
        {
            $bytes = '0 bytes';
        }

        return $bytes;
}
	
			require_once('php/account_system.php');
			require_once('php/config.php');

			
			$load = sys_getloadavg();
			$ramUssage = formatSizeUnits(memory_get_usage());
			
			if ($customDate == '') {
				$customDate = date('d-M-y').".txt";
			}
			
			$filename = date('d-M-y') . ".txt";
			$LogFileLocation = constant("Logger_Dir") . $filename;
			
			if ($customDate != '') {
				$filename = $customDate;
				$LogFileLocation = constant("Logger_Dir") . $customDate;
			}

			$totalVisits = file_get_contents(constant("Website_Data_dir").'counter.txt');
			
			$counter = 0;
			
			
			$author = $_SESSION['userName'];
			
		
					
				if (file_get_contents('profiles/'.$_SESSION['userName'].'/admin') == "true") {
					echo '<div class="blog-title">';
					echo '<h3>Format: [Date] [Time] [IP] [CC] [Page] [CPU] [User agent]</h3><br>';
					
					
					
					echo '<fieldset>';
					echo '<form method="POST">';
					
					echo '<p>Change date: <select name="cdate">';

					
					
					$files = scandir(constant("Logger_Dir"));
					foreach($files as $file) {
						$pName = $file;
						$pName=str_replace(constant("Logger_Dir"), '',$pName);
						$displayname = $pName;																																																													
						$filename = $pName;
						$displayname=str_replace('.txt', '',$displayname);
						$displayname=str_replace('-', ' ',$displayname);

						
						if ($customDate != '') {
							if ($customDate == $filename) {
								echo '<option value="'.$filename.'" selected="selected">'.$displayname.'</option>';
							} else {
								echo '<option value="'.$filename.'">'.$displayname.'</option>';
							}
							
						} else {
							echo '<option value="'.$filename.'">'.$displayname.'</option>';
						}

					}
					
					echo '</select> <input name="butSubmit" class="formbutton" value="Change" type="submit" />';
					
					if (date('d-M-y').".txt" != $customDate) {
						if ($customDate != '') {
							echo ' <input name="butToday" class="formbutton" value="Today" type="submit" />';
						}
					}
					
					echo '</p>';
					
					echo '</form>';
					echo '</fieldset>';
					echo '</div>';
					$countrysVisited = '';
					
					$file = file($LogFileLocation);
					$file = array_reverse($file);
					foreach($file as $f){
						$counter += 1;
					}
					
					if (date('d-M-y').".txt" == $customDate) {
						$customDate = '';
					}
					
					if ($customDate != '') {
						if ($counter > 99) {
							$dDate = $customDate;
						$dDate=str_replace('.txt', '',$dDate);
						$dDate=str_replace('-', ' ',$dDate);
						echo '<p>Total visits '.$dDate.': <span style="color: #009F6A;">'.$counter.'</span><br>';
						echo 'Showing the last 100 visitors:';
					} else {
						$dDate = $customDate;
						$dDate=str_replace('.txt', '',$dDate);
						$dDate=str_replace('-', ' ',$dDate);
						if ($counter > 49) {
							echo '<p>Total visits '.$dDate.': <span style="color: #F3CF1B;">'.$counter.'</span>';
						} else {
							echo '<p>Total visits '.$dDate.': <span style="color: #B32500;">'.$counter.'</span>';
						}
					}
					
					} else {
						if ($counter > 99) {
						echo '<p>Total visits today: <span style="color: #009F6A;">'.$counter.'</span><br>';
						echo 'Showing the last 100 visitors:';
					} else {
						if ($counter > 49) {
							echo '<p>Total visits today: <span style="color: #F3CF1B;">'.$counter.'</span>';
						} else {
							echo '<p>Total visits today: <span style="color: #B32500;">'.$counter.'</span>';
						}
						
					}
					}
					
					echo '<br>Total visits all time: <span style="color: #009F6A;">'.$totalVisits.'</span> (Since 20th december 2015)<br>';
					
					date_default_timezone_set(date_default_timezone_get());
					
					echo 'Server time: '.$date = date('m/d/Y h:i:s a', time()).'<br>';
					
					echo 'Server ussage: <span style="color: #009F6A;">'.$load[0].'</span>%<br>Ram ussage: <span style="color: #009F6A;">'.$ramUssage.'</span></p>';
					
					$counter = 0;
					foreach($file as $f){
						if ($counter < 100) {
							echo '<p>'.$f.'%</p>';
						}
						$counter += 1;
					}
					if ($counter == 0) {
						echo '<p>The log is currently empty</p>';
					}
			
				} else { ?>
					
					<div class="blog-title">
					<h2>Access denied.</h2>
				  </div>
				  
				  <p>You are not permitted to view the logs.</p>
					
				<?php }
			
			
			?>
				  </article>
                 
                  <!-- End single blog post -->                  
                </div>
              </div>
              <div class="col-lg-4 col-md-5 col-sm-12">
                <aside class="blog-right">
                
                  <div class="single-widget">
                    <h2>Search</h2>
                    <form class="blog-search" method="POST">
                      <input name="searchText" required type="text">
                      <button class="button button-default" data-text="Search" name="butSearch" type="submit"><span>Search</span></button>
                    </form>
                  </div>
                 
                  <div class="single-widget">
                    <h2>Follow us on</h2>
                    <div class="follow-us">
                      <a class="facebook" href="<?php require_once('php/config.php'); echo constant("Social_Facebook"); ?>"><span class="fa fa-facebook"></span></a>
                      <a class="twitter" href="<?php require_once('php/config.php'); echo constant("Social_Twitter"); ?>"><span class="fa fa-twitter"></span></a>
                      <a class="google-plus" href="<?php require_once('php/config.php'); echo constant("Social_GPlus"); ?>"><span class="fa fa-google-plus"></span></a>
                      <a class="youtube" href="<?php require_once('php/config.php'); echo constant("Social_YouTube"); ?>"><span class="fa fa-youtube"></span></a>
                      <a class="linkedin" href="<?php require_once('php/config.php'); echo constant("Social_LinkedIn"); ?>"><span class="fa fa-linkedin"></span></a>
                      <a class="dribbble" href="<?php require_once('php/config.php'); echo constant("Social_Dribbble"); ?>"><span class="fa fa-dribbble"></span></a>
                    </div>
                  </div>
                 
                  <div class="single-widget">
                    <h2>Subscribe to newsletter</h2>
                    <form class="blog-search" method="POST">
                      <input name="emailSubscribe" required type="text">
                      <button class="button button-default" name="butSubscribe" data-text="Subscribe" type="submit"><span>Subscribe</span></button>
                    </form>
                  </div>
                 
                </aside>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End blog section -->

  <!-- Start Footer -->    
  <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="footer-top-area">             
                            
              <div class="footer-social">
				<a class="facebook" href="<?php require_once('php/config.php'); echo constant("Social_Facebook"); ?>"><span class="fa fa-facebook"></span></a>
                <a class="twitter" href="<?php require_once('php/config.php'); echo constant("Social_Twitter"); ?>"><span class="fa fa-twitter"></span></a>
                <a class="google-plus" href="<?php require_once('php/config.php'); echo constant("Social_GPlus"); ?>"><span class="fa fa-google-plus"></span></a>
                <a class="youtube" href="<?php require_once('php/config.php'); echo constant("Social_YouTube"); ?>"><span class="fa fa-youtube"></span></a>
                <a class="linkedin" href="<?php require_once('php/config.php'); echo constant("Social_LinkedIn"); ?>"><span class="fa fa-linkedin"></span></a>
                <a class="dribbble" href="<?php require_once('php/config.php'); echo constant("Social_Dribbble"); ?>"><span class="fa fa-dribbble"></span></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="footer-bottom">
      <p><?php require_once('php/config.php'); echo constant("Website_Copyright"); ?></p>
    </div>
  </footer>
  <!-- End Footer -->
  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <!-- Bootstrap -->
  <script src="assets/js/bootstrap.js"></script>
  <!-- Slick Slider -->
  <script type="text/javascript" src="assets/js/slick.js"></script>
  <!-- Counter -->
  <script type="text/javascript" src="assets/js/waypoints.js"></script>
  <script type="text/javascript" src="assets/js/jquery.counterup.js"></script>
  <!-- mixit slider -->
  <script type="text/javascript" src="assets/js/jquery.mixitup.js"></script>
  <!-- Add fancyBox -->        
  <script type="text/javascript" src="assets/js/jquery.fancybox.pack.js"></script>
  <!-- Wow animation -->
  <script type="text/javascript" src="assets/js/wow.js"></script> 

  <!-- Custom js -->
  <script type="text/javascript" src="assets/js/custom.js"></script>
  </body>
</html>