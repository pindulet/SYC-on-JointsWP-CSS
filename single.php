
<?php 
$template_name = 'post';

get_header(); 

?>
<!-- close dialog -->
<script type="text/javascript">
	jQuery(document).ready(function($) {
		
		$('#close').click(function(){
			$('.dialog').fadeOut('200');
		});
	});
</script>	
<!-- end close dialog script -->

<?php loan_button(); ?>

			<div id="content">

				<div id="inner-content" class="row clearfix">
					
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
						<div id="pics" class="large-6 medium-6 columns first clearfix" role="main">
							<div class="row">
								<div id="main_pic_frame">
									<a href="<?php $image_url=wp_get_attachment_url( get_post_thumbnail_id($post->ID, 'thumbnail') ); echo $image_url; ?>" rel="lightbox">
										<?php the_post_thumbnail('full'); ?>
									</a>
								</div>
							</div>
							<div id="sub-pics" class="row">
								
								<?php 

								
								$featured2 = kd_mfi_get_the_featured_image( 'featured-image-2', 'post' );
								
								if (class_exists('kdMultipleFeaturedImages') && $featured2 !="") {
									?><div class="subpic small-4 large-4 medium-4 columns">
										<a href="<?php echo kd_mfi_get_featured_image_url( 'featured-image-2', 'post', 'full' ); ?>" rel="lightbox">
										
										<?php
											kd_mfi_the_featured_image( 'featured-image-2', 'post', 'joints-thumb-300');
										
										?>
										</a>
										
									</div>
								<?php } 
								

								$featured3 = kd_mfi_get_the_featured_image( 'featured-image-3', 'post' );

								if (class_exists( 'kdMultipleFeaturedImages') && $featured3 != "") {
									?><div class="subpic small-4 large-4 medium-4 columns">
										<a href="<?php echo kd_mfi_get_featured_image_url( 'featured-image-3', 'post', 'full' ); ?>" rel="lightbox">
										
										<?php
											$image = kd_mfi_the_featured_image( 'featured-image-3', 'post', 'joints-thumb-300');
											if (isset($image)){
												echo $image;
											}
										?>
										</a>
									</div>
								<?php } ?>
								
								<?php 
								
								$featured4 = kd_mfi_get_the_featured_image( 'featured-image-4', 'post' );
								if (class_exists( 'kdMultipleFeaturedImages') && $featured4 != "") {
									?><div class="subpic small-4 large-4 medium-4 columns">
										<a href="<?php echo kd_mfi_get_featured_image_url( 'featured-image-4', 'post', 'full' ); ?>" rel="lightbox">
										
										<?php
											kd_mfi_the_featured_image( 'featured-image-4', 'post', 'joints-thumb-300');
										
										?>
										</a>
									</div>
								<?php } 
								
								?>
								
							</div>
							
						</div>
						<div id="content_aside" class="large-6 medium-6 columns">
							<div class="row aside">
									
									<h1>
										<?php the_title(); ?>
									</h1>
										<?php
										
										//get post id
										$post_id=get_the_ID();

											$star_share = get_post_meta( $post_id, 'starShare', true );
											
										
										if ( $star_share == "starShare" ) {
											
											$terms = get_the_terms($post_id, 'donatedby');
											if(!empty($terms)){
												foreach ( $terms as $term ){
													$donatedby = $term->name;
													$donatedby_web = $term->description;
												}
											}
													
											$donatedby = str_replace(' ', '-', $donatedby);
											$donatedby = strtolower($donatedby);


											?>
											<div id="uploader_name">
												Doneret af
											</div>
											<div id="donate_logo">
												<a href="<?php echo $donatedby_web; ?>">
													<img src="<?php bloginfo( 'template_directory' ) ?>/images/donations/logos/<?php echo $donatedby; ?>_page.png">
												</a>
											</div>


											<?php
										}

										else{
											$uploader_first_name = get_the_author_meta('first_name');
											$uploader_last_name = get_the_author_meta('last_name');
											$uploader_id = get_the_author_meta('ID');

											?>
										
											<div id="uploader_name">
												<a href="<?php bloginfo('url'); ?>/shares/?userid=<?php echo $uploader_id; ?>">
													<img src="<?php bloginfo( 'template_directory' ) ?>/images/postsgrafik/user.png" /> <?php echo $uploader_first_name . " " . $uploader_last_name; ?>
												</a>  	
											</div>

											<?php
										}
										
										the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'hatch' ) ); ?>
										
										<p>Størrelse: <?php $terms = get_the_terms($post->ID, 'size');
											if(!empty($terms)){
												foreach ( $terms as $term ){
													echo $term->name;
												}
											}  ?></p>
										<p>Mærke: <?php $terms = get_the_terms($post->ID, 'brand');
											if(!empty($terms)){
												foreach ( $terms as $term ){
													echo $term->name;
												}
											}  ?></p>
										<p>Stand: <?php echo get_post_meta($post->ID, 'stand', true); ?></p>
										<p>Materiale: <?php echo get_post_meta($post->ID, 'material', true); echo get_post_meta($post->ID, 'Material', true);?></p>
										<p>Vaskeanvisning: <?php echo get_post_meta($post->ID, 'wash', true); ?></p>
										
										
										
									<?php wp_link_pages( array( 'before' => '<p class="page-links">' . __( 'Pages:', 'hatch' ), 'after' => '</p>' ) ); ?>

									<?php 
								


									
									
										
										
										
										$available_date=get_available_date($post_id);
										/*echo $available_date;*/
										
										
										//get status
										$status=check_status($post_id);
										
										//get user
										$user_id=$current_user->ID;
										
										//get URL
										$url=get_site_url();
										
										//get owner
										$owner_id = get_the_author_meta('ID');				
										
										//Get loaner ID
												$con=db_connect();

												$query="SELECT * FROM wp_loan_log WHERE item_id = $post_id AND status = 'active' LIMIT 1";
												$result = mysqli_query($con, $query);
												$row=mysqli_fetch_array($result);
																			
												$loaner_id=$row['loaner_id'];
											
										
										if ($status=="available"){
											?>
											<form id="loanform" name="new_loan" action="?loan=true" method="POST">
												<input type="hidden" name="userID" value="<?php echo $user_id; ?>" />
												<input type="hidden" name="postID" value="<?php echo the_ID(); ?>" />
										
												<input class="btn" id="loanbt"  type="submit" value="LÅN" />
												
												<input type="hidden" name="action" value="new_loan" />
											</form>
											<?php 	
											
												
										}
										
											
										
										
										else{
																					
											
											if ($loaner_id == $user_id){
												?>
													<div id="notice">
														Du har lånt dette. Dit lån udløber <?php echo $available_date; ?>, hvor tøjet aktiveres igen så andre brugere kan låne det.
													</div>
												<?php
												}
											
											
											else{
											?>
											<!--
											<form id="waitinglist" action="<?php echo $url ?>/venteliste/" method="POST">
												<input type="hidden" name="userID" value="<?php echo $user_id; ?>" />
												<input type="hidden" name="postID" value="<?php echo the_ID(); ?>" />
									
												<input class="btn" id="searchsubmit" type="submit" value="  Skriv dig på venteliste  " />
											
									
											</form>
											-->

											<?php
											$originalDate = $available_date;
											$available_date_format = date("d-m-Y", strtotime($originalDate));
											?>

											<div class="highlight">ØV! Den er udlånt - Tilgængelig igen d. <?php echo $available_date_format; ?></div>
											
											<?php
											}
												
										
											
										
										
											if ( current_user_can( 'administrator' ) ) {
											?>
												<br>
												<form id="loanform" name="admin_activate" action="" method="POST">
													<input type="hidden" name="action" value="available" />
													<input type="hidden" name="postID" value="<?php echo the_ID(); ?>" />
													<input class="btn" id="searchsubmit"  type="submit" value="Make available" />  
												</form>
											
											<?php			
											}
											
										}
										
										if ($owner_id === $user_id){
											?>
												<div id="notice">
													Det er dig der har delt dette. Husk at du altid kan låne dit eget tøj uden at det koster klip.
												
												
													<p><a href="<?php echo bloginfo('url'); ?>/rediger-delt-toj?id=<?php echo get_the_ID(); ?>">Redigér</a></p>
												</div>
											<?php
										}
																
										?>
									
							</div>
						</div>
				
					    <?php endwhile; else : ?>
					
					   		<?php get_template_part( 'partials/content', 'missing' ); ?>

					    <?php endif; ?>
			
					</div> <!-- end #main -->
    
					

				</div> <!-- end #inner-content -->

				<?php comments_template(); ?>	
    
			</div> <!-- end #content -->

<?php get_footer(); ?>