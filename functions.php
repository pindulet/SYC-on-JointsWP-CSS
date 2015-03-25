<?php
ob_start();
/*
This is where you can drop your custom functions or
just edit things like thumbnail sizes, header images,
sidebars, comments, ect.
*/

/*********************
INCLUDE NEEDED FILES
*********************/

/*
library/joints.php
	- head cleanup (remove rsd, uri links, junk css, ect)
	- enqueueing scripts & styles
	- theme support functions
	- custom menu output & fallbacks
	- related post function
	- page-navi function
	- removing <p> from around images
	- customizing the post excerpt
	- custom google+ integration
	- adding custom fields to user profiles
*/
require_once('library/joints.php'); // if you remove this, Joints will break
/*
library/custom-post-type.php
	- an example custom post type
	- example custom taxonomy (like categories)
	- example custom taxonomy (like tags)
*/
require_once('library/custom-post-type.php'); // you can disable this if you like
require_once('library/custom-post-type-accordion.php'); // you can disable this if you like
/*
library/admin.php
	- removing some default WordPress dashboard widgets
	- an example custom dashboard widget
	- adding custom login css
	- changing text in footer of admin
*/
// require_once('library/admin.php'); // this comes turned off by default
/*
library/translation/translation.php
	- adding support for other languages
*/
// require_once('library/translation/translation.php'); // this comes turned off by default

/*********************
THUMNAIL SIZE OPTIONS
*********************/

// Thumbnail sizes
add_image_size( 'joints-thumb-600', 600, 150, true );
add_image_size( 'joints-thumb-300', 300, 100, true );
/*
to add more sizes, simply copy a line from above
and change the dimensions & name. As long as you
upload a "featured image" as large as the biggest
set width or height, all the other sizes will be
auto-cropped.

To call a different size, simply change the text
inside the thumbnail function.

For example, to call the 300 x 300 sized image,
we would use the function:
<?php the_post_thumbnail( 'joints-thumb-300' ); ?>
for the 600 x 100 image:
<?php the_post_thumbnail( 'joints-thumb-600' ); ?>

You can change the names and dimensions to whatever
you like.
*/


/*********************
MENUS & NAVIGATION
*********************/
// registering wp3+ menus
register_nav_menus(
	array(
		'main-nav' => __( 'The Main Menu' ),   // main nav in header
		'footer-links' => __( 'Footer Links' ) // secondary nav in footer
	)
);

// the main menu
function joints_main_nav() {
	// display the wp3 menu if available
    wp_nav_menu(array(
    	'container' => false,                           // remove nav container
    	'container_class' => '',           // class of container (should you choose to use it)
    	'menu' => __( 'The Main Menu', 'jointstheme' ),  // nav name
    	'menu_class' => '',         // adding custom nav class
    	'theme_location' => 'main-nav',                 // where it's located in the theme
    	'before' => '',                                 // before the menu
        'after' => '',                                  // after the menu
        'link_before' => '',                            // before each link
        'link_after' => '',                             // after each link
    	'fallback_cb' => 'joints_main_nav_fallback'      // fallback function
	));
} /* end joints main nav */

// the footer menu (should you choose to use one)
function joints_footer_links() {
	// display the wp3 menu if available
    wp_nav_menu(array(
    	'container' => '',                              // remove nav container
    	'container_class' => 'footer-links clearfix',   // class of container (should you choose to use it)
    	'menu' => __( 'Footer Links', 'jointstheme' ),   // nav name
    	'menu_class' => 'sub-nav',      // adding custom nav class
    	'theme_location' => 'footer-links',             // where it's located in the theme
    	'before' => '',                                 // before the menu
        'after' => '',                                  // after the menu
        'link_before' => '',                            // before each link
        'link_after' => '',                             // after each link
        'depth' => 0,                                   // limit the depth of the nav
    	'fallback_cb' => 'joints_footer_links_fallback'  // fallback function
	));
} /* end joints footer link */

// this is the fallback for header menu
function joints_main_nav_fallback() {
	wp_page_menu( array(
		'show_home' => true,
    	'menu_class' => 'top-bar top-bar-section',      // adding custom nav class
		'include'     => '',
		'exclude'     => '',
		'echo'        => true,
        'link_before' => '',                            // before each link
        'link_after' => ''                             // after each link
	) );
}

// this is the fallback for footer menu
function joints_footer_links_fallback() {
	/* you can put a default here if you like */
}

/*********************
SIDEBARS
*********************/

// Sidebars & Widgetizes Areas
function joints_register_sidebars() {
	register_sidebar(array(
		'id' => 'sidebar1',
		'name' => __('Sidebar 1', 'jointstheme'),
		'description' => __('The first (primary) sidebar.', 'jointstheme'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));

	register_sidebar(array(
		'id' => 'offcanvas',
		'name' => __('Offcanvas', 'jointstheme'),
		'description' => __('The offcanvas sidebar.', 'jointstheme'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));

	/*
	to add more sidebars or widgetized areas, just copy
	and edit the above sidebar code. In order to call
	your new sidebar just use the following code:

	Just change the name to whatever your new
	sidebar's id is, for example:

	register_sidebar(array(
		'id' => 'sidebar2',
		'name' => __('Sidebar 2', 'jointstheme'),
		'description' => __('The second (secondary) sidebar.', 'jointstheme'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));

	To call the sidebar in your template, you can just copy
	the sidebar.php file and rename it to your sidebar's name.
	So using the above example, it would be:
	sidebar-sidebar2.php

	*/
} // don't remove this bracket!

/*********************
COMMENT LAYOUT
*********************/

// Comment Layout
function joints_comments($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class('panel'); ?>>
		<article id="comment-<?php comment_ID(); ?>" class="clearfix large-12 columns">
			<header class="comment-author">
				<?php
				/*
					this is the new responsive optimized comment image. It used the new HTML5 data-attribute to display comment gravatars on larger screens only. What this means is that on larger posts, mobile sites don't have a ton of requests for comment images. This makes load time incredibly fast! If you'd like to change it back, just replace it with the regular wordpress gravatar call:
					echo get_avatar($comment,$size='32',$default='<path_to_url>' );
				*/
				?>
				<!-- custom gravatar call -->
				<?php
					// create variable
					$bgauthemail = get_comment_author_email();
				?>
				<?php printf(__('<cite class="fn">%s</cite>', 'jointstheme'), get_comment_author_link()) ?> on
				<time datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_time(__(' F jS, Y - g:ia', 'jointstheme')); ?> </a></time>
				<?php edit_comment_link(__('(Edit)', 'jointstheme'),'  ','') ?>
			</header>
			<?php if ($comment->comment_approved == '0') : ?>
				<div class="alert alert-info">
					<p><?php _e('Your comment is awaiting moderation.', 'jointstheme') ?></p>
				</div>
			<?php endif; ?>
			<section class="comment_content clearfix">
				<?php comment_text() ?>
			</section>
			<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
		</article>
	<!-- </li> is added by WordPress automatically -->
<?php
} // don't remove this bracket!

/*****************************
CUSTOM FUNCTIONS
****************************/
//Sørger for ÆØÅ i koden
function replacer($str){
	$str = str_replace("æ","a",$str);
	$str = str_replace("ø","o",$str);
	$str = str_replace("å","a",$str);
	$str = str_replace("é","e",$str);
	$str = str_replace("ü","u",$str);
	return $str;
	}

//Find poster til forside og oversigter
//Sorteringsfunktion af billeder på sort siden
		function sort_image_mysite($sort, $post_id, $available, $available_date, $currently_holding){


				?><div class="<?php echo $sort?>">
						<?php //echo $post_id ?>
							<div id="pic">
								<?php
								/*
								if($available == "no" && $currently_holding == true){
									?>
									<a href="<?php the_permalink(); ?>">
										<div class="activeicon">
											<img src="<?php bloginfo('template_directory'); ?>/images/mysite/active.png">
											<div class="activeicon_hover mousehover">
												<p>Udlånt! Tilgængelig: <?php echo $available_date; ?></p>
											</div>
										</div>
									</a>
									<?php
								}

								if($currently_holding == true){
									?>


									<a href="<?php the_permalink(); ?>">
										<div class="homeicon">
											<img src="<?php bloginfo('template_directory'); ?>/images/mysite/home.png">

											<div class="homeicon_hover mousehover">
												<p>Ligger hos dig</p>
											</div>
										</div>
									</a>

									<?php
								}

								*/
								?>
								<!--<div id="sort-image">-->
								<?php
								get_the_image( array('size' => 'sort-thumbnail', 'image_class' => 'featured','width' => 202) );?>


						<a href="<?php the_permalink(); ?>">

							<?php
									$star_share = get_post_meta( $post_id, 'starShare', true );
									if ( $star_share == "starShare" ) {
										?>
											<div class="star_mark">
													<img src="<?php echo bloginfo( 'template_directory' ); ?>/images/donations/white_star.png">

											</div>

											<?php
											$donatedby = "";

												$terms = get_the_terms($post_id, 'donatedby');
												if(!empty($terms)){
													foreach ( $terms as $term ){
														$donatedby = $term->name;
													}
												}

												$donatedby = str_replace(' ', '-', $donatedby);
												$donatedby = strtolower($donatedby);
											?>

											<div class="logo_mark">
												<img src="<?php echo bloginfo( 'template_directory' ); ?>/images/donations/logos/<?php echo $donatedby; ?>.png">
											</div>
										<?php
									}
								?>

								<div class="sort-title">
									<?php echo the_title(); ?>
								</div>
								<div class="sort-size">
									<?php
										$terms = get_the_terms($post->ID, 'size');
											if(!empty($terms)){
												foreach ( $terms as $term ){
												echo "str. " . $term->name;
											}

										}

								?></div>
							</div>
						</a>
				</div><?php

		}

		function sort_image($sort, $post_id, $available, $available_date){


				?><div class="<?php echo $sort?>">

						<a href="<?php the_permalink(); ?>">

							<div id="pic">

								<?php

								if($available == "no"){
									?>
									
										<div class="unavailable_mark">
											<!--
											<img src="<?php bloginfo('template_directory'); ?>/images/unavailable.png">
											-->
											<p>UDLÅNT</p>
											<div class="activeicon_hover mousehover">
												<p>Ledig <?php echo $available_date; ?></p>
											</div>
										</div>

									<?php
								}


								?>
								<!--<div id="sort-image">-->
								<?php
								//get_the_image( array('size' => 'sort-thumbnail', 'image_class' => 'featured','width' => 202) );
								$img_thumbnail = get_the_post_thumbnail($post_id, 'sort-thumbnail');
								echo $img_thumbnail;
								?>


						
								<?php
									$star_share = get_post_meta( $post_id, 'starShare', true );
									if ( $star_share == "starShare" ) {
										?>
											<div class="star_mark">
													<img src="<?php echo bloginfo( 'template_directory' ); ?>/images/donations/white_star.png">

											</div>

											<?php
											$donatedby = "";

												$terms = get_the_terms($post_id, 'donatedby');
												if(!empty($terms)){
													foreach ( $terms as $term ){
														$donatedby = $term->name;
													}
												}

												$donatedby = str_replace(' ', '-', $donatedby);
												$donatedby = strtolower($donatedby);
											?>

											<div class="logo_mark">
												<img src="<?php echo bloginfo( 'template_directory' ); ?>/images/donations/logos/<?php echo $donatedby; ?>.png">
											</div>
										<?php
									}
								?>




								<div class="sort-title">
									<?php echo the_title(); ?>
								</div>
								<div class="sort-size">
									<?php
										global $post;
										$terms = get_the_terms($post->ID, 'size');
											if(!empty($terms)){
												foreach ( $terms as $term ){
												echo "str. " . $term->name;
											}

										}

								?></div>
							</div>

						</a>
				</div><?php

		}
?>
<?php

function element_hover(){
	?>
	<script type="text/javascript">
		jQuery(document).ready(function($) {
			$('.sort').mouseenter(
				function(){
				$(this).find('.activeicon_hover').fadeIn();
				$(this).find('.logo_mark').animate({width: 'toggle'}, 200);
			});
			$('.sort').mouseleave(
				function(){
				$(this).find('.activeicon_hover').fadeOut('fast');
				$(this).find('.logo_mark').animate({width: 'toggle'}, 200);
			});
		});
	</script>

	<?php
}

/*
Paginering
--------------------------------
*/
function paginering($post_count, $page_num){
	if ($post_count < 20){
		
		?>
			<div class="row">
				<div class="small-12 columns"  id="page-navigation">
					<div class="next">
						Du har nået enden af klædeskabet. Godt gået!
					</div>
				</div>
			</div>
		<?php
	}
	
	else{
		?>
			<div class="row">
				<div class="small-12 columns" id="page-navigation">
					<div class="next">
						<a class="more_posts" href="<?php bloginfo('url'); ?>?pagenum=<?php echo $page_num ?>">Mere tøj >></a>
					</div>
				</div>
			</div>
		<?php
	}
}

/*****************************
INCLUDE FILES
*****************************/

include_once ("static/dbfunction.php");

function my_add_frontend_scripts() {
	wp_enqueue_script('jquery-masonry');
}
add_action('wp_enqueue_scripts', 'my_add_frontend_scripts');




/*
Login redirect
-----------------------------------------------------*/
function admin_default_page() {
  $url = get_site_url();
  return $url;
}

//add_filter('login_redirect', 'admin_default_page');

/*
function register_message

add_filter('registration_redirect', );
*/

/*
Send brugeren tilbage ved failed password
**************************************************************/
add_action( 'wp_login_failed', 'custom_login_failed' );
function custom_login_failed( $username )
{
    $referrer = wp_get_referer();

    if ( $referrer && ! strstr($referrer, 'wp-login') && ! strstr($referrer,'wp-admin') )
    {
        wp_redirect( add_query_arg('login', 'failed', $referrer) );
        exit;
    }
}
/*
Dialog
************************************************/
function syc_dialog($heading, $subheading, $message_text){

	?>
	<script type="text/javascript">

		//scripts til loginfunktionen
		jQuery(document).ready(function($) {
				//$('.popdialog').slideToggle(100,'swing');
				//$('.overlay').show();
			});
		});

	</script>
		<div class="static-overlay">
		</div> <!-- End overlay -->

		<div class="dialog">

					<h1><?php echo $heading; ?></h1>
					<h2><?php echo $subheading; ?></h2>

					<p>
						<?php echo $message_text ?>
					</p>


		</div> <!-- End centerdiv -->

	<?php
}
/*
login pop up funktion
*************************************************/

function login_popup($login_heading, $login_subheading, $link_div, $redirect_url){

	if(isset($_GET['login'])) {
		$login = $_GET['login'];
	}
	?>
	<script type="text/javascript">

		//scripts til loginfunktionen
		jQuery(document).ready(function($) {

			$('<?php echo $link_div; ?>').click(function(){
				$('.popdialog').fadeIn(100);
				$('.overlay').fadeIn(100);
				console.log("element was clicked");
			});
		});

		<?php
			

			if (isset($login) && $login == "failed"){
				?>
					jQuery(document).ready(function($) {
						$('.popdialog').show();
						$('.overlay').show();
					});
				<?php
			}

	?>

	</script>
		<div class="overlay">
		</div> <!-- End overlay -->

		<div class="popdialog">
				<div class="inside">
					<h1><?php echo $login_heading; ?></h1>
					<h2><?php echo $login_subheading; ?></h2>

					<p>
						<div id="loginform">
							<?php



								if(isset($login) && $login == "failed"){
									?>
										<div class="highlight">
											Forkert password eller brugernavn/email!
										</div>
									<?php
								}

								$args = array(
	        						//'redirect' => $redirect_url,
	        						'form_id' => 'loginform-custom',
	        						'label_username' => __( 'Brugernavn eller email' ),
	        						'label_password' => __( 'Password' ),
	        						'label_remember' => __( 'Remember Me custom text' ),
	        						'label_log_in' => __( 'Log ind' ),
	        						'remember' => false
	    						);
	    						wp_login_form( $args );

							?>
							<p class="sublinks">
								<a href="<?php bloginfo('url'); ?>/wp-login.php?action=register">Registrer</a> / <a href="<?php bloginfo('url'); ?>/wp-login.php?action=lostpassword">Mistet din adgangskode?</a>
							</p>
						</div>
					</p>
				</div>

		</div> <!-- End centerdiv -->

	<?php
}


/*
Besked ved glemt password
-------------------------------------------------------*/
function forgotpass_message() {
 $action = $_REQUEST['action'];
 if( $action == 'lostpassword' ) {
 $message = '<p class="show">Indtast din email eller brugernavn. Du vil herefter modtage en mail med instruktioner til at at få et nyt password</p>';
 return $message;
 }
}
add_filter('login_message', 'forgotpass_message');

function checkemail_message() {
 $checkemail = $_REQUEST['checkemail'];
 if( $checkemail == 'confirm' ) {
 $message = '<p class="message">Check din email :)</p>';
 return $message;
 }
}
add_filter('login_message', 'checkemail_message');

function registered_message() {
 $checkemail = $_REQUEST['checkemail'];
 if( $checkemail == 'registered' ) {
 $message = '<p class="message">Tillykke! Du er nu oprettet og kan logge ind i det fælles klædeskab. En mail med dine brugeroplysninger er sendt til dig.</p>';
 return $message;
 }
}
add_filter('login_message', 'registered_message');

function loggedout_message() {
 $loggedout = $_REQUEST['loggedout'];
 if( $loggedout == 'true' ) {
 $message = '<p class="message">Du er nu logget ud. Håber snart vi ses igen.</p>';
 return $message;
 }
}
add_filter('login_message', 'loggedout_message');

/*
Login url linker til SYC i stedet for WP
*/
add_filter('login_headerurl', 'my_login_url_local');
function my_login_url_local() {
	return get_bloginfo('url');
}

?>