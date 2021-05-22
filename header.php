<?php
session_start();
if(!defined('Myheader')){
	header('location: 404');
	exit();
}
?>
<?php
$return_url_var=(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://codewithbishal.com/js/min.js"></script>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://cdnjs.cloudflare.com">
	<link rel="stylesheet" href="https://codewithbishal.com/css/mini/cookie.min.css">
	<link rel="stylesheet" href="https://codewithbishal.com/css/button-outline.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://codewithbishal.com/css/mini/header.min.css">
  </head>
  <body>
  <div class="navigation-wrap bg-light start-header start-style">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<nav class="navbar navbar-expand-md navbar-light">
					
                    <span class="navbar-brand">CWB</span>	
						
						<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
							<span class="navbar-toggler-icon"></span>
						</button>
						
						<div class="collapse navbar-collapse" id="navbarSupportedContent">
							<ul class="navbar-nav ml-auto py-4 py-md-0">
								 <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
									<a class="nav-link" href="https://codewithbishal.com/">HOME</a>
								</li>
								<li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
									<a class="nav-link" href="https://codewithbishal.com/about-us">ABOUT US</a>
								</li>
								<li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
									<a class="nav-link" href="https://codewithbishal.com/contact-us">CONTACT</a>
								</li>
								<li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
									<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">EXAMPLES</a>
									<div class="dropdown-menu">
										<a class="dropdown-item" href="https://codewithbishal.com/posts">ALL</a>
										<a class="dropdown-item" href="https://codewithbishal.com/search?search=html+and+css">HTML + CSS</a>
										<a class="dropdown-item" href="https://codewithbishal.com/search?search=html%2C+css+and+js">HTML + CSS + JS</a>
									</div>
								</li>
								<li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
									<a class="nav-link" id="login1" href="https://codewithbishal.com/signup-user?return_url=<?php echo urlencode($return_url_var) ?>">SIGN UP</a>
                                </li>
                                <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
									<a class="nav-link" id="login2" href="https://codewithbishal.com/login-user?return_url=<?php echo urlencode($return_url_var) ?>">LOG IN</a>
								</li>
							</ul>
						</div>
						
					</nav>
				</div>
			</div>
		</div>
	</div>
	<script>
	$('body').on('mouseenter mouseleave','.nav-item',function(e){
			if ($(window).width() > 750) {
				var _d=$(e.target).closest('.nav-item');_d.addClass('show');
				setTimeout(function(){
				_d[_d.is(':hover')?'addClass':'removeClass']('show');
				},1);
			}
	});
	</script>
  </body>
</html>