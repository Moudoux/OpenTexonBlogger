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
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Install the OpenTexon Blogger Platform</title>
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
				  
				function _CheckInstallation() {
					if (file_exists($_SERVER['DOCUMENT_ROOT'].'/data/installed.token') == true) {
						return true;
					} else {
						return false;
					}
				}
				  
				  if (_CheckInstallation() == true) {?>
				  
				  <div class="blog-title">
							<h2>The OpenTexon Blogger Platform is alredy installed.</h2>
						</div>
						
						<p>The OpenTexon Blogger Platform is alredy installed.</p>
						
				  
				  <?php
				  } else {
					if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') { ?>
						
						<div class="blog-title">
							<h2>OS not supported</h2>
						</div>
						
						<p>The OpenTexon Blogger Platform will not work on windows servers.<br>Please use Linux or Mac.</p>
						
					<?php } else { ?>
						
						<div class="blog-title">
							<h2>Install the OpenTexon Blogger Platform</h2>
						</div>
						
						<p>Before you continue with the installation please configure php/config.php to your liking.</p>
						
						<p>Testing write permissions...
						
						<?php
						
						$allowed = true;
						$foldersDontExists = false;
							
						require_once('php/config.php');
						
						if (file_exists(constant("Logger_Dir")) == false) {
							$foldersDontExists = true;
						}

						if (file_exists(constant("Website_Data_dir")) == false) {
							$foldersDontExists = true;
						}
						
						
						if ($foldersDontExists == false) {
							
							
							if (is_writable('profiles') == false) {
								$allowed = false;
							}
							
							if (is_writable('posts') == false) {
								$allowed = false;
							}
							
							if (is_writable('data') == false) {
								$allowed = false;
							}
							
							if (is_writable('subscribers') == false) {
								$allowed = false;
							}
							
							if (is_writable('projects') == false) {
								$allowed = false;
							}
							
							if (is_writable('feed') == false) {
								$allowed = false;
							}

							
							if ($allowed == false) { ?>

								<br><br>Error: Cannot write to folders, please execute themes commands in a terminal:<br><br>
								sudo chown -R www-data <?php echo $_SERVER['DOCUMENT_ROOT']; ?>/profiles<br>
								sudo chown -R www-data <?php echo $_SERVER['DOCUMENT_ROOT']; ?>/posts<br>
								sudo chown -R www-data <?php echo $_SERVER['DOCUMENT_ROOT']; ?>/data<br>
								sudo chown -R www-data <?php echo $_SERVER['DOCUMENT_ROOT']; ?>/subscribers<br>
								sudo chown -R www-data <?php echo $_SERVER['DOCUMENT_ROOT']; ?>/projects<br>
								sudo chown -R www-data <?php echo $_SERVER['DOCUMENT_ROOT']; ?>/feed<br>
								sudo chown -R www-data <?php echo $_SERVER['DOCUMENT_ROOT']; ?>/projects<br>
								sudo chown -R www-data <?php require_once('php/config.php'); echo constant("Logger_Dir"); ?><br>
								sudo chown -R www-data <?php require_once('php/config.php'); echo constant("Website_Data_dir"); ?><br><br>
								Then refresh this page.</p>

							<?php } else { ?>
							
								Can write to all folders.<br><br>Checking for all directories... Found all required directories.</p>
							
								<p>Congratulations you can now setup the administrator account.</p>
								
								
								
									<a href="register?ref=install&url=<?php require_once('php/config.php'); echo constant("Website_Url"); ?>"><button class="button button-default" data-text="Create admin account"><span>Create admin account</span></button></a>
							
								
							
							<?php } 
						} else { ?>
							
							Error... Not all folders were found.<br><br>Please create the following folders:<br><br>
							<?php require_once('php/config.php'); echo constant("Logger_Dir"); ?><br>
							<?php require_once('php/config.php'); echo constant("Website_Data_dir"); ?><br><br>
							Then refresh this page.</p>
							
						<?php }
					}
				  }?>
				  
				
				  </article>
                 
                  <!-- End single blog post -->                  
                </div>
              </div>
              <div class="col-lg-4 col-md-5 col-sm-12">
                <aside class="blog-right">
                
                  <div class="single-widget">
                    <h2><?php require_once('php/lang.php'); $LangDir = getLang(); require_once('lang/'.$LangDir.'/language.php'); echo constant("Lang_General_Search"); ?></h2>
                    <form class="blog-search" method="POST">
                      <input name="searchText" required type="text">
                      <button class="button button-default" data-text="<?php require_once('php/lang.php'); $LangDir = getLang(); require_once('lang/'.$LangDir.'/language.php'); echo constant("Lang_General_But_Search"); ?>" name="butSearch" type="submit"><span><?php require_once('php/lang.php'); $LangDir = getLang(); require_once('lang/'.$LangDir.'/language.php'); echo constant("Lang_General_But_Search"); ?></span></button>
                    </form>
                  </div>
                 
                  <div class="single-widget">
                    <h2><?php require_once('php/lang.php'); $LangDir = getLang(); require_once('lang/'.$LangDir.'/language.php'); echo constant("Lang_General_FollowUs"); ?></h2>
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
                    <h2><?php require_once('php/lang.php'); $LangDir = getLang(); require_once('lang/'.$LangDir.'/language.php'); echo constant("Lang_General_Subscribe"); ?></h2>
                    <form class="blog-search" method="POST">
                      <input name="emailSubscribe" required type="text">
                      <button class="button button-default" name="butSubscribe" data-text="<?php require_once('php/lang.php'); $LangDir = getLang(); require_once('lang/'.$LangDir.'/language.php'); echo constant("Lang_General_But_Subscribe"); ?>" type="submit"><span><?php require_once('php/lang.php'); $LangDir = getLang(); require_once('lang/'.$LangDir.'/language.php'); echo constant("Lang_General_But_Subscribe"); ?></span></button>
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