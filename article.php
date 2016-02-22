<?php
	require_once('php/config.php');
	checkPage();
?>
<?php
	
	require_once('php/account_system.php');
	
	function writefile($text,$loc) {
		$fp = fopen($loc,"wb");
		fwrite($fp,$text);
		fclose($fp);
	}

	if (isset($_POST['butComment'])){
		$comment  = isset($_POST['commentText']) ? $_POST['commentText'] : '';
		
		$postDir = "posts";
		
		$dirS = 'posts/'.$_GET['id'];				
							
		if (file_exists($dirS.'/date')) {
		} else {
			$postDir = "projects";
		}
		
		$folderPath = $postDir.'/'.$_GET['id'].'/comments/';
				
				if (!file_exists($folderPath)) {
					mkdir ($folderPath);
				}
				
				$date_dir_folder = date('Y_m_d_H_i_s');
				
				mkdir ($folderPath.$date_dir_folder);
				
				$mydate=getdate(date("U"));
	
				$date_expanded = "$mydate[weekday] $mydate[month] $mydate[mday]th $mydate[year]";
				
				writefile($comment,$folderPath.$date_dir_folder.'/comment');
				writefile($_SESSION['userName'],$folderPath.$date_dir_folder.'/author');
				writefile($date_expanded,$folderPath.$date_dir_folder.'/date');
				
				$folderPath = 'profiles/'.$_SESSION['userName'].'/comments/';
				
				if (!file_exists($folderPath)) {
					mkdir ($folderPath);
				}

				mkdir ($folderPath.$date_dir_folder);
				
				writefile($comment,$folderPath.$date_dir_folder.'/comment');
				writefile($_SESSION['userName'],$folderPath.$date_dir_folder.'/author');
				writefile($date_expanded,$folderPath.$date_dir_folder.'/date');
				writefile($_GET['id'],$folderPath.$date_dir_folder.'/id');
				
				$folderPath = 'feed/';
				
				mkdir ($folderPath.$date_dir_folder);
				
				writefile($comment,$folderPath.$date_dir_folder.'/comment');
				writefile($_SESSION['userName'],$folderPath.$date_dir_folder.'/author');
				writefile($date_expanded,$folderPath.$date_dir_folder.'/date');
				writefile($_GET['id'],$folderPath.$date_dir_folder.'/id');
				
				header('Location: '."reload");
		
	}
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
    <title><?php require_once('php/config.php'); echo constant("Website_Name"); ?> - Viewing article</title>
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
                  <?php	require_once('php/account_system.php');
				  
							$pName = 'posts/'.$_GET['id'];
							$dire = 'posts/'.$_GET['id'];
							
							$replaceStr = "posts";
							
							if (file_exists($pName.'/date')) {
							} else {
								$pName = 'projects/'.$_GET['id'];
								$dire = 'projects/'.$_GET['id'];
							
								$replaceStr = "projects";
								
							}
							
							if (file_exists($pName.'/date')) {
								$pName=str_replace($replaceStr.'/', '',$pName);
							
							$date = file_get_contents($dire.'/date');
							$author = file_get_contents($dire.'/author');
							$post = file_get_contents($dire.'/post');
							$title = file_get_contents($dire.'/title');
							$date_expanded = file_get_contents($dire.'/date_expanded');
							$full_name = file_get_contents($dire.'/full_name');
							
							echo '<article class="single-from-blog">';
							
								echo '<div class="blog-title">';
								
									echo '<h2><a href="article?id='.$pName.'">'.$title.'</a></h2>';
									echo '<p>Posted by <a href="profile?id='.$author.'">'.$full_name.'</a> on <span class="blog-date">'.$date_expanded.'</span>';
								
								echo '</div>';
						
							
								echo $post;
									
								if ($_SESSION['userName'] != '') {
									if (file_get_contents('profiles/'.$_SESSION['userName'].'/admin') == "true") {
										echo '	<a href="edit?id='.$pName.'"><button class="button button-default" data-text="Edit article"><span>Edit article</span></button></a>';
										echo '<a href="delete?id='.$pName.'"><button class="button button-default" data-text="Delete article"><span>Delete article</span></button></a>';
									} else {
										if ($author == $_SESSION['userName']) {
											echo '<a href="edit?id='.$pName.'"><button class="button button-default" data-text="Edit article"><span>Edit article</span></button></a>';
											echo '<a href="delete?id='.$pName.'"><button class="button button-default" data-text="Delete article"><span>Delete article</span></button></a>';
										}
									}
								}
							
							echo '</article>';
							} else {
								echo '<article class="single-from-blog">';
								echo '<p>Article not found.</p>';
								echo '</article>';
							}
							
							
				  ?>
                  <?php
				  require_once('php/account_system.php');
				  
					if (file_exists('posts/'.$_GET['id'].'/date')) {
						if ($_SESSION['userName'] != '') {
						?>
						<br>
						<div class="blog-comment">
                    <h2>Post a comment</h2>
                    <form class="comment-form" method="POST">
                            
                      <div class="form-group">
                        <textarea name="commentText" required class="form-control"></textarea>
                      </div>
                      <button name="butComment" class="button button-default" data-text="Comment" type="submit"><span>Comment</span></button>
                    </form>
                  </div>
				  
					<?php } ?>
				  
				  <div class="blog-comment">
                    <h2>All comments:</h2>
					
					
					
						<?php 
					
						require_once('php/account_system.php');
					
						$postDir = "posts";
		
						$dirS = 'posts/'.$_GET['id'];				
							
						if (file_exists($dirS.'/date')) {
						} else {
							$postDir = "projects";
						}
						
						$folderPath = $postDir.'/'.$_GET['id'].'/comments';
						$directories = glob($folderPath . '/*' , GLOB_ONLYDIR);
						$reversed = array_reverse($directories);
						$counter = 0;
						
						foreach($reversed as $dire) {
						
							if ($counter < 15) {
								
								$commentName = $dire;
								$commentName=str_replace($folderPath.'/', '',$commentName);
								
								$author_comment = file_get_contents($folderPath.'/'.$commentName.'/author');
								$date_comment = file_get_contents($folderPath.'/'.$commentName.'/date');
								$comment_comment = file_get_contents($folderPath.'/'.$commentName.'/comment');
								
								if ($_SESSION['userName'] != '') {
									if (file_get_contents('profiles/'.$_SESSION['userName'].'/admin') == "true") {
										echo '<p><a href="account?id="'.$author_comment.'">'.$author_comment.'</a>: '.$comment_comment.' (<a href="delete?type=comment&id='.$_GET['id'].'&cid='.$commentName.'">Delete comment</a>)</p>';
									} else {
										if ($_SESSION['userName'] == $author_comment) {
											echo '<p><a href="account?id="'.$author_comment.'">'.$author_comment.'</a>: '.$comment_comment.' (<a href="delete?type=comment&id='.$_GET['id'].'&cid='.$commentName.'">Delete comment</a>)</p>';
										} else {
											echo '<p><a href="account?id="'.$author_comment.'">'.$author_comment.'</a>: '.$comment_comment.'</p>';
										}
									}
								} else {
									echo '<p><a href="account?id="'.$author_comment.'">'.$author_comment.'</a>: '.$comment_comment.'</p>';
								}
								
							}
							$counter +=1;
						}
						
						if ($counter == 0) {
							echo '<p>No recent comments</p>';
						}
					?>
					
					</div>
					
					
					
					<?php }
					
				  
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