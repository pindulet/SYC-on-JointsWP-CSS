<!doctype html>

<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?>> <!--<![endif]-->

	<head>
		<meta charset="utf-8">

		<title><?php wp_title(''); ?></title>

		<!-- Google Chrome Frame for IE -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

		<!-- mobile meta -->
		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320">
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

		<!-- icons & favicons -->
		<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/library/images/apple-icon-touch.png">
		<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.png">
		<!--[if IE]>
			<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
		<![endif]-->
		<meta name="msapplication-TileColor" content="#f01d4f">
		<meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/library/images/win8-tile-icon.png">

  	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

		<?php wp_head(); ?>

		<!-- Drop Google Analytics here -->
		<!-- end analytics -->

		<!--
		*********************************************
		JQUERY SCRIPTS
		*********************************************
		-->
		<script type=text/javascript>

		// Infomenu i top
			jQuery(document).ready(function($) {
				$('#open').click(function(){
					$('#myinfo').slideToggle(100,'swing');
				});
			});

		//Masonry script og settings
			jQuery(document).ready(function($){
	    		$('#results-container').imagesLoaded( function(){
					$('#main').fadeIn(500);
					$('#dvLoading').fadeOut(200);
					$('#results-container').masonry({

				  		itemSelector: '.sort',
				  		columnWidth: 220,
				  		gutterWidth:14,
				  		isFitWidth:true,
				  		isAnimated: true,
						animationOptions: {
						duration: 400,
						easing: 'swing',
						queue: false
						}
					});
				});
			});

			//header search
			jQuery(document).ready(function($) {
				$('#search_open').click(function(){
					$('#sortselect').slideToggle(200,'swing');
				});
			});

			//Menu i footer
			jQuery(document).ready(function($) {
				$('#menu_burger').click(function(){
					$('#footer-menu_ul').slideToggle(200,'swing');
					$('#nav-toggle').toggleClass( "active" );

				});
			});	  		

/*
	    	jQuery(document).ready(function($){
				$('#results-container').infinitescroll(
					{
	        			navSelector  : '#page-navigation',    // selector for the paged navigation
	        			nextSelector : '.next a.more_posts',  // selector for the NEXT link (to page 2)
	        			itemSelector : '#results-container .sort',     // selector for all items you'll retrieve
	        			debug: true
	        		},

	        		// call Masonry as a callback
	        		function( newElements ) {
	        			// hide new items while they are loading
            		var $newElems = $( newElements ).css({ opacity: 0 });
						//create container variabel
						var $container = $('#results-container');
            		// ensure that images load before adding to masonry layout
            		$newElems.imagesLoaded(function(){
              	// show elems now they're ready
              	$newElems.animate({ opacity: 1 });
						//add the posts
						$container.masonry( 'appended', $newElems, true ); 
					}

	    		);
			});
*/
			


		</script>

		<!--
		END SCRIPTS
		*****************************************
		-->

	</head>

	<body <?php body_class(); ?>>

<!--
				Log ind funktion
**************************************************************
-->
			<?php
				$redirect_url = $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];

				login_popup("Dejligt at se dig igen", "Log venligst ind nedenfor", ".login_link", $redirect_url);
			?>


	<div class="off-canvas-wrap">
		<div class="inner-wrap">
			<div id="container">

				<header class="header" role="banner">

					<div id="inner-header" class="row">
						<div class="small-12 columns">
								<div id="usertext">

										<?php
										if (!is_user_logged_in()) {
											$url=get_site_url();

											echo "Hej gæst. <a class=\"login_link\" href=\"#\" onclick=\"return false;\">Log ind</a> eller <a href=\"$url/wp-login.php?action=register\">registrer dig som bruger</a>";
										}
										
										


										$url=get_site_url();
										?>
								</div> <!--- end usertext -->
						</div>
					</div>
					<div class="row">
						<div class="small-10 small-centered columns" id="header-logo">
							<a href="<?php bloginfo('url');?>">
								<img src="<?php bloginfo('template_directory'); ?>/images/logo_200x200_retina.png" width="100px" height="100px">
							</a></a>
						</div>
					</div>
					<div class="row">
						<div class="small-8 columns">
							<?php
								if(is_user_logged_in()){

											global $current_user;

											$userID=$current_user->ID;

											$con = db_connect();
											$result_user=mysqli_query($con, "SELECT * FROM wp_users WHERE ID = $userID");

											$row_user=mysqli_fetch_array($result_user);

											$user_klip=$row_user['klip'];
											$username=$current_user->display_name;
											$user_firstname = $current_user->user_firstname;

											$url = get_site_url();
											$logout=wp_logout_url($url);

											//$greeting=array("søde","rare","gode","kære","smukke");
											//$rand=array_rand($greeting);

											?>

											<div id="myinfo">
												<ul id="myinfo_ul">
													<!--
													<li>
														
														
														
													</li>	
													-->
													<li>
														<a href="<?php echo $url; ?>/upload">
															<img src="<?php bloginfo('template_directory'); ?>/images/header/upload.png"> <div class="show-for-medium-up">Del tøj</div>
														</a>
													</li>
													<li>
														<a href="<?php echo $url; ?>/loans?userid=<?php echo $userID; ?>&filter=loans">
															<img src="<?php bloginfo( 'template_directory' ) ?>/images/postsgrafik/user.png" /> <div class="show-for-medium-up">profil</div>
														</a>
													</li>
													<li id="search_open">
															<img src="<?php bloginfo('template_directory'); ?>/images/header/search.png"> <div class="show-for-medium-up">Søg</div>
													</li>
												</ul>

											</div>
								<?php
								}
							?>			

						</div>
						<div class="small-4 columns">
							<!--
								Hej <?php //echo $greeting[$rand]; ?> <b><?php echo $user_firstname; ?></b>, Du  har <b>
							-->
						<?php
							if(is_user_logged_in()){
								?>
									<div id="myinfo_klip">
										<ul id="myinfo_ul">
											<li>
												<img src="<?php bloginfo('template_directory'); ?>/images/mysite/klip.png">  <?php echo $user_klip; ?></b> <div class="show-for-medium-up">klip</div>
											</li>
										</ul>
										<!--
											<a href="<?php echo $logout; ?>">Log ud</a>
										-->
									</div>
								<?php
							}
						?>
						</div>
					<div class="row collapse">
						
							<!--
							<div id="search">
								<form method="get" id="searchform" action="<?php bloginfo('url'); ?>/">
									<div>
										<div id="search_btn">
											<input type="submit" id="searchsubmit" value="S&oslash;g" tabindex="2" class="btn" />
										</div>
										<div id="size">
											<input type="text" class="input" name="s" tabindex="1" id="s" value="Skriv dit s&oslash;geord..." onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;"/>
										</div>

									</div>
								</form>
							</div>
							-->

					<?php
						$size = "";
						$kat = "";
						$brand = "";
						if(isset($_GET['size'])) {
							$size = $_GET['size'];
						}
						if(isset($_GET['kat'])) {
							$kat = $_GET['kat'];
						}
						if(isset($_GET['brand'])) {
							$brand = $_GET['brand'];
						}

						if (($size == "") || ($size == "all")){
							$size="Størrelse";
						}
						if (($kat == "") || ($kat == "all")){
							$kat="Alle";
						}
						else{
							$kat=str_replace("&","&amp;",$kat);
						}
						if (($brand == "") || ($brand == "all")){
							$brand="Brand";
						}
						else{
							$brand=str_replace("&","&amp;",$brand);
						}



					?>

					<form  action="<?php echo $url ?>/sort/" id="sortselect" method="GET">

							

							<div class="medium-1 columns">
								<label for="size" class="right inline">Størrelse</label>
							</div>
							<div class="medium-2 columns">
								<select tabindex="3" name="size" id="size" class="select" placeholder"Størrelse">
										<option value="all">Alle</option>
								<?php
								$sizes1=array('Extra small', 'Small', 'Medium', 'Large', 'Extra large');

								foreach ($sizes1 as $size1){
									if ($size == $size1){
										?>
										<option value="<?php echo $size1; ?>" selected="selected"><?php echo $size1; ?></option>
										<?php

									}
									else{
										?>
										<option value="<?php echo $size1; ?>"><?php echo $size1; ?></option>
										<?php

									}

								}
								?>

								</select>
							</div>
							<div class="medium-1 columns">
								<label for="kat" class="right inline">Kategori</label>
							</div>
							<div class="medium-2 columns">
								<select name="kat" id="kat" class="select" tabindex="2">

									<?php
									if ($kat == "Alle"){
									?>
									<option value="all" selected="selected"><?php echo $kat; ?></option>

									<?php
									}
									else {
									?>
									<option value="all">Alle</option>
									<?php
									}

									$args=array(
										'orderby' => 'name',
										'order' => 'ASC',
										'taxonomy' => 'kat',

									 );


									$categories=get_categories($args);


									foreach($categories as $category){

											if ($kat == ($category->name)){
												?>
												<option value="<?php echo ($category->name); ?>" selected="selected"><?php echo ($category->name); ?></option>
												<?php

											}
											else{
												?>
												<option value="<?php echo ($category->name); ?>"><?php echo ($category->name); ?></option>
												<?php

											}
									}


									?>



								</select>

							</div>
							<div class="medium-1 columns">
								
								<label for="brand" class="right inline">Brand</label>
								
							</div>
							<div class="medium-2 columns">
								<select name="brand" class="select" id="brand" tabindex="1">
									<?php
									if ($brand == "Alle"){
									?>
									<option value="all" selected="selected"><?php echo $brand; ?></option>

									<?php
									}
									else{
									?>
									<option value="all">Alle</option>
									<?php
									}

									$args=array(
										'orderby' => 'name',
										'order' => 'ASC',
										'taxonomy' => 'brand',

									 );


									$brands1=get_categories($args);

										foreach($brands1 as $brand1){

											if ($brand == ($brand1->name)){

												?>
												<option value="<?php echo ($brand1->name); ?>" selected="selected"><?php echo ($brand1->name); ?></option>
												<?php
											}

											else{
												?>
												<option value="<?php echo ($brand1->name); ?>"><?php echo ($brand1->name); ?></option>
												<?php
											}
										}


									?>
								</select>
							</div>
							<div class="medium-3 columns" id="submit-sortmenu">
								<input class="button postfix" id="searchsubmit" type="submit" tabindex="4" value="  SØG  " />
							</div>

					</form>
						</div> <!-- end insorts -->
						</div>	<!-- end sorst -->

						</div>
					</div>
				</div>
						</div>
					</div>


						 <?php // get_template_part( 'partials/nav', 'offcanvas' ); ?>

						 <?php  // get_template_part( 'partials/nav', 'topbar' ); ?>

						 <?php //get_template_part( 'partials/nav', 'offcanvas-sidebar' ); ?>

						<!-- You only need to use one of the above navigations.
							 Offcanvas-sidebar adds a sidebar to a "right" offcanavas menus. -->

					</div> <!-- end #inner-header -->

				</header> <!-- end header -->
