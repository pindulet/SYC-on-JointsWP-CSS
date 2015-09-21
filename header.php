		<?php
			header_settings();
			header_scripts();
		?>
		

	</head>

	<body <?php body_class(); ?>>

<!--
				Log ind funktion
**************************************************************
-->
			<?php
				$host = $_SERVER["HTTP_HOST"];
				$uri = $_SERVER["REQUEST_URI"];
				//$url = get_site_url();
				
				$redirect_url = $host . $uri;
				/*if ($uri == "/SYC-dev/velkommen/"){
					$redirect_url = $url;
					echo $redirect_url;
				};*/


				login_popup("Dejligt at se dig igen", "Log venligst ind nedenfor", ".login_link", $redirect_url);
			?>


	<div class="off-canvas-wrap">
		<div class="inner-wrap">
			<div id="container">

				<header class="header" role="banner">
					<?php
						if (!is_user_logged_in()) {
							
							?>
								<div id="inner-header" class="row">
									<div class="small-12 medium-6 medium-offset-3 columns">
											<div id="usertext">
											<?php
												$url=get_site_url();
												echo "<h3>Har vi set hinanden før?</h3><br> <a class=\"button small login_link\" href=\"#\" onclick=\"return false;\">Log ind</a> eller <a class=\"button small\" href=\"$url/wp-login.php?action=register\">opret en gratis profil</a>";
										
										
										


										
											?>
										</div> <!--- end usertext -->
									</div>
								</div>
							<?php
								}
							?>
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
