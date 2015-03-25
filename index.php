<?php get_header(); 

/*
Scripts
-----------------------------
*/
element_hover();

?>


			
			<div id="content">
			
				<div id="inner-content" class="row clearfix">
			
				    <div id="main" class="small-12 columns clearfix" role="main">
				    <?php
					    //Hent sidenummer
							$page_num = "";
							if(isset($_GET['pagenum'])) {
								$page_num = $_GET['pagenum'];
							}
								if ($page_num == ""){
									$offset = 0;
									$page_num = 1;
								}
								else {
									$offset = $page_num * 20;
									$page_num = $page_num + 1;
								}
								
						// Hent poster
						$posts = get_posts(
								array(	
									'numberposts' => 1000,
									'posts_per_page'=> 20,
									'offset' => $offset,
									
									'orderby' => 'date',
									'order' => 'DESC', 
									'order' => 'DESC',
								)
						);
						
						//Tæl antallet af poster
						$post_count = count($posts);
							
							if ( have_posts() ) : 
							
								$counter = 1; ?>

						<div id="results-container">
						<?php
							//$i=1;
							db_connect();
							foreach( $posts as $post ) :	setup_postdata($post);
							
										$post_id = $post->ID;
										$con = db_connect();

										$result = mysqli_query($con, "SELECT ID FROM wp_posts WHERE status = 'unavailable' AND ID = $post_id LIMIT 1");
										$num_rows = mysqli_num_rows($result);
										
										$available = "yes";
										$available_date = "none";


										if($num_rows == 1){
											$available = "no";

											

											$result_date = mysqli_query($con, "SELECT Available_date FROM wp_posts WHERE ID =  $post_id AND status = 'unavailable'");
											$row_date = mysqli_fetch_array($result_date);
											$available_date = $row_date[0];

											$originalDate = $available_date;
											$available_date_format = date("d-m-Y", strtotime($originalDate));
											$available_date = $available_date_format;
										}
										

										sort_image('sort', $post_id, $available, $available_date);
							endforeach; ?>
										
										</div>

										
										<!--
										Paginering
										-----------------------------------------------------------------
										-->
											
											<?php
												paginering($post_count, $page_num);
											

										//End paginering
										
										?>

							<!--		
					        <?php if (function_exists('joints_page_navi')) { ?>
					            <?php joints_page_navi(); ?>
					        	 	 <?php } else { ?>
					   	
					   	 		</div>
					      
							      <div class="row"> 
							      	<div clas="small-12"> 
							            <nav class="wp-prev-next">
							                <ul class="clearfix">
							        	        <li class="prev-link"><?php next_posts_link(__('&laquo; Older Entries', "jointstheme")) ?></li>
							        	        <li class="next-link"><?php previous_posts_link(__('Newer Entries &raquo;', "jointstheme")) ?></li>
							                </ul>
							           </nav>
							        <?php } ?>		
							   	</div>
							
							    <?php else : ?>
							    
		    						<?php get_template_part( 'partials/content', 'missing' ); ?>
							
							    
							    <?php endif; ?>
							-->
			
				    </div> <!-- end #main -->
    
				    
				    
				</div> <!-- end #inner-content -->
    
			</div> <!-- end #content -->

<?php get_footer(); ?>