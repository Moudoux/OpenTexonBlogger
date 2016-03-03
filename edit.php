<?php
	require_once('php/config.php');
	checkPage();
?>
<?php

	require_once('php/account_system.php');
	require_once('php/config.php');
	
	$error = '';
	
	function writefile($text,$loc) {
		$fp = fopen($loc,"wb");
		fwrite($fp,$text);
		fclose($fp);
	}
	
	function _isXSS($contentT) {
		$result = false;
		
		if (strpos($contentT,'<script>') !== false) {
			$result = true;
		}
		
		if (strpos($contentT,'</script>') !== false) {
			$result = true;
		}
		
		if (strpos($contentT,'<html>') !== false) {
			$result = true;
		}
		
		if (strpos($contentT,'</html>') !== false) {
			$result = true;
		}
		
		if (strpos($contentT,'<?php') !== false) {
			$result = true;
		}
		
		if (strpos($contentT,'?>') !== false) {
			$result = true;
		}
		
		return $result;
	}
	
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
	
	if (isset($_POST['butSubmit'])){
		$title  = isset($_POST['title']) ? $_POST['title'] : '';
		$prev_article  = isset($_POST['prev_article']) ? $_POST['prev_article'] : '';
		$article = isset($_POST['article']) ? $_POST['article'] : '';
		
		$isSafe = true;
		
		if (_isXSS($title)) {
			$isSafe = false;
		}
		if (_isXSS($prev_article)) {
			$isSafe = false;
		}
		if (_isXSS($article)) {
			$isSafe = false;
		}
		
		if ($isSafe == true) {
			
				$newPost = $article;
				$newTitle = $title;
				
				unlink('posts/'.$_GET['id'].'/title');
				unlink('posts/'.$_GET['id'].'/post');
				
				unlink('profiles/'.$_GET['user'].'/'.$_GET['id'].'/title');
				unlink('profiles/'.$_GET['user'].'/'.$_GET['id'].'/post');
				
				if (file_exists('profiles/'.$_GET['user'].'/'.$_GET['id'].'/post_preview')) {
					unlink('profiles/'.$_GET['user'].'/'.$_GET['id'].'/post_preview');
				}
				
				if (file_exists('posts/'.$_GET['id'].'/post_preview')) {
					unlink('posts/'.$_GET['id'].'/post_preview');
				}
				
				writefile($newPost, 'posts/'.$_GET['id'].'/post');
				writefile($newTitle, 'posts/'.$_GET['id'].'/title');
				writefile($prev_article, 'posts/'.$_GET['id'].'/post_preview');
				
				writefile($prev_article, 'profiles/'.$_GET['user'].'/'.$_GET['id'].'/post_preview');
				writefile($newPost, 'profiles/'.$_GET['user'].'/'.$_GET['id'].'/post');
				writefile($newTitle, 'profiles/'.$_GET['user'].'/'.$_GET['id'].'/title');
			
		header('Location: '.constant("Website_Url"));	
		} else {
			$error = 'Your article conatins illegal characters.';
		}
		
	}
	
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php require_once('php/config.php'); echo constant("Website_Name"); ?> - Edit</title>
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

	<script src="js/ckeditor/ckeditor.js"></script>
	
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
	
	<?php require_once('php/config.php'); AdblockCheck(); ?>
	
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

  <?php
  
	if ($error != '') {
		
		echo '<script>alert("'.$error.'");</script>';
		
	}
  
  ?>
  
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
                  
				  <?php
				  
					require_once('php/account_system.php');
					require_once('php/config.php');
					
					
					
					$PostDir = '';
					$PostExists = false;
					
					if (file_exists('posts/'.$_GET['id'].'/date')) {
						$PostDir = 'posts';
						$PostExists = true;
					}
					
					if (file_exists('projects/'.$_GET['id'].'/date')) {
						$PostDir = 'projects';
						$PostExists = true;
					}
					
					if ($PostExists == false) { ?>
						
					<div class="blog-comment">
					<br>
                    <h2>The specified article does not exist.</h2>
					<p>If you belive this is a error please contact the server admin <a href="<?php require_once('php/config.php'); echo 'mailto:'.constant("Website_Server_Admin"); ?>"><?php require_once('php/config.php'); echo constant("Website_Server_Admin"); ?></a>.</p>
					</div>
						
					<?php } else {
						
						require_once('php/account_system.php');
						require_once('php/config.php');
						
						$PostDir = '';
						
						if (file_exists('posts/'.$_GET['id'].'/date')) {
							$PostDir = 'posts';
							$PostExists = true;
						}
					
						if (file_exists('projects/'.$_GET['id'].'/date')) {
							$PostDir = 'projects';
							$PostExists = true;
						}
						
						$PostAuthor = file_get_contents($PostDir.'/'.$_GET['id'].'/author');
						
						if ($_SESSION['userName'] == $PostAuthor) { ?>
							
							<div class="blog-comment">
				  <br>
                    <h2>Edit your article on <?php require_once('php/config.php'); echo constant("Website_Name"); ?></h2>
                    <form class="comment-form" method="POST">
                      <div class="form-group">                
                        <input type="text"  name="title" required placeholder="Title" value="<?php
						require_once('php/account_system.php');
						require_once('php/config.php');
						
						$PostDir = '';
						
						if (file_exists('posts/'.$_GET['id'].'/date')) {
							$PostDir = 'posts';
							$PostExists = true;
						}
					
						if (file_exists('projects/'.$_GET['id'].'/date')) {
							$PostDir = 'projects';
							$PostExists = true;
						}
					
							$PostAuthor = file_get_contents($PostDir.'/'.$_GET['id'].'/author');
						
						echo file_get_contents($PostDir.'/'.$_GET['id'].'/title');
						
						?>" class="form-control">
                      </div>
                       <div class="form-group">
                        <textarea name="prev_article" id="article_prev" required placeholder="Preview of article (Will be shown as a preview of this article, keep under 400 characters)" class="form-control"><?php
						require_once('php/account_system.php');
						require_once('php/config.php');
						
						$PostDir = '';
						
						if (file_exists('posts/'.$_GET['id'].'/date')) {
							$PostDir = 'posts';
							$PostExists = true;
						}
					
						if (file_exists('projects/'.$_GET['id'].'/date')) {
							$PostDir = 'projects';
							$PostExists = true;
						}
					
							$PostAuthor = file_get_contents($PostDir.'/'.$_GET['id'].'/author');
						
						
						
						if (file_exists($PostDir.'/'.$_GET['id'].'/post_preview')) {
							echo file_get_contents($PostDir.'/'.$_GET['id'].'/post_preview');
						}
						
						
						
						?></textarea>
                      </div>
						<div class="form-group">
                        <textarea name="article" id="article" required placeholder="Article"  class="form-control"><?php
						require_once('php/account_system.php');
						require_once('php/config.php');
						
						$PostDir = '';
						
						if (file_exists('posts/'.$_GET['id'].'/date')) {
							$PostDir = 'posts';
							$PostExists = true;
						}
					
						if (file_exists('projects/'.$_GET['id'].'/date')) {
							$PostDir = 'projects';
							$PostExists = true;
						}
					
							$PostAuthor = file_get_contents($PostDir.'/'.$_GET['id'].'/author');
						
						echo file_get_contents($PostDir.'/'.$_GET['id'].'/post');?></textarea>
                      </div>					  
					  <script>
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace( 'article' );
				CKEDITOR.replace( 'article_prev' );
            </script>
                      <button class="button button-default" data-text="Save article" name="butSubmit" type="submit"><span>Save article</span></button>
                    </form>
                  </div>
							
							
						<?php } else {
							if (file_get_contents('profiles/'.$_SESSION['userName'].'/admin') == "true") { ?>
								
									<div class="blog-comment">
				  <br>
                    <h2>Edit a article on <?php require_once('php/config.php'); echo constant("Website_Name"); ?></h2>
                    <form class="comment-form" method="POST">
                      <div class="form-group">                
                        <input type="text" name="title" required placeholder="Title" value="<?php
						require_once('php/account_system.php');
						require_once('php/config.php');
						
						$PostDir = '';
						
						if (file_exists('posts/'.$_GET['id'].'/date')) {
							$PostDir = 'posts';
							$PostExists = true;
						}
					
						if (file_exists('projects/'.$_GET['id'].'/date')) {
							$PostDir = 'projects';
							$PostExists = true;
						}
					
							$PostAuthor = file_get_contents($PostDir.'/'.$_GET['id'].'/author');
						
						echo file_get_contents($PostDir.'/'.$_GET['id'].'/title');
						
						?>" class="form-control">
                      </div>
                       <div class="form-group">
                        <textarea name="prev_article" id="article_prev" required placeholder="Preview of article (Will be shown as a preview of this article, keep under 400 characters)"  class="form-control"><?php
						require_once('php/account_system.php');
						require_once('php/config.php');
						
						$PostDir = '';
						
						if (file_exists('posts/'.$_GET['id'].'/date')) {
							$PostDir = 'posts';
							$PostExists = true;
						}
					
						if (file_exists('projects/'.$_GET['id'].'/date')) {
							$PostDir = 'projects';
							$PostExists = true;
						}
					
							$PostAuthor = file_get_contents($PostDir.'/'.$_GET['id'].'/author');
						
						
						
						if (file_exists($PostDir.'/'.$_GET['id'].'/post_preview')) {
							echo file_get_contents($PostDir.'/'.$_GET['id'].'/post_preview');
						}
						
						
						
						?></textarea>
                      </div>
						<div class="form-group">
                        <textarea name="article" id="article" required placeholder="Article" class="form-control"><?php
						require_once('php/account_system.php');
						require_once('php/config.php');
						
						$PostDir = '';
						
						if (file_exists('posts/'.$_GET['id'].'/date')) {
							$PostDir = 'posts';
							$PostExists = true;
						}
					
						if (file_exists('projects/'.$_GET['id'].'/date')) {
							$PostDir = 'projects';
							$PostExists = true;
						}
					
							$PostAuthor = file_get_contents($PostDir.'/'.$_GET['id'].'/author');
						
						echo file_get_contents($PostDir.'/'.$_GET['id'].'/post');?></textarea>
                      </div>					  
					  <script>
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace( 'article' );
				CKEDITOR.replace( 'article_prev' );
            </script>
                      <button class="button button-default" data-text="Save article" name="butSubmit" type="submit"><span>Save article</span></button>
                    </form>
                  </div>
								
							<?php } else { ?>
								
								<div class="blog-comment">
								<br>
								<h2>Access denied.</h2>
								<p>If you belive this is a error please contact the server admin <a href="<?php require_once('php/config.php'); echo 'mailto:'.constant("Website_Server_Admin"); ?>"><?php require_once('php/config.php'); echo constant("Website_Server_Admin"); ?></a>.</p>
								</div>
								
							<?php }
						}
						
					}
				  
				  ?>
				 
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