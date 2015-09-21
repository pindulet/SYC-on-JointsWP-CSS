					<footer class="footer" role="contentinfo">
					
						<div id="inner-footer" class="row clearfix">
						
							<div class="small-12 small-centered columns" id="footer">
										<div id="menu_burger">
												<div id="nav-toggle"><span></span></div>
											<!--
											<img src="<?php bloginfo('template_directory'); ?>/images/menu_burger.png" >
											-->

										</div>
											
											<script type=text/javascript>
												jQuery(document).ready(function($) {
													$("#menu_burger").click(function(){
														$("#footer_menu_text").toggle();
													});
												});
											</script>
											
											<div id="footer_menu_text">MENU</div>
		    							<ul id="footer-menu_ul">
		    								<?php $url=get_site_url(); ?>
											<li><a href="<?php echo $url; ?>/velkommen-til-syc">Velkommen</a></li>
											<li><a href="<?php echo $url; ?>/sadan-bruger-du-share-your-closet">Sådan bruger du SYC</a></li>
											<li><a href="<?php echo $url; ?>/abc">SYC's ABC</a></li>
											<li><a href="<?php echo $url; ?>/faq">FAQ</a></li>
											<li><a href="<?php echo $url; ?>/vilkar-og-betingelser">Vilkår</a></li>
											<li><a href="<?php echo $url; ?>/tips-anvisniger-og-guides">Tips og guides</a></li>
											<li><a href="<?php echo $url; ?>/kontakt">Kontakt</a></li>
											<li class="last-child">
											<a href="https://www.facebook.com/ShareYourClosetDK"><img src="<?php bloginfo('template_directory'); ?>/images/facebook_white.png" onmouseover="this.src='<?php bloginfo('template_directory'); ?>/images/facebook_pink.png'" onmouseout="this.src='<?php bloginfo('template_directory'); ?>/images/facebook_white.png'"></a>
											</li>
										</ul>
		    					
		    				</div>
			               
			                	
						</div> <!-- end #inner-footer -->			
					</footer> <!-- end .footer -->
				</div> <!-- end #container -->
			</div> <!-- end .inner-wrap -->
		</div> <!-- end .off-canvas-wrap -->
						
				<!-- all js scripts are loaded in library/joints.php -->
				<?php wp_footer(); ?>
	</body>

</html> <!-- end page -->