<?php
/**
* Template: Index.php
*
* @package EvoLve
* @subpackage Template
*/

get_header();
$xyz = "";
$evolve_layout = evolve_get_option('evl_layout','2cl');
$evolve_post_layout = evolve_get_option('evl_post_layout','two');
$evolve_nav_links = evolve_get_option('evl_nav_links','after');
$evolve_header_meta = evolve_get_option('evl_header_meta','single_archive');
$evolve_category_page_title = evolve_get_option('evl_category_page_title','1');
$evolve_excerpt_thumbnail = evolve_get_option('evl_excerpt_thumbnail','0');
$evolve_share_this = evolve_get_option('evl_share_this','single');
$evolve_post_links = evolve_get_option('evl_post_links','after');
$evolve_similar_posts = evolve_get_option('evl_similar_posts','disable');
$evolve_featured_images = evolve_get_option('evl_featured_images','1');
$evolve_thumbnail_default_images=evolve_get_option('evl_thumbnail_default_images','0');
$evolve_posts_excerpt_title_length=intval(evolve_get_option('evl_posts_excerpt_title_length','40'));
$evolve_blog_featured_image = evolve_get_option('evl_blog_featured_image','0');

if (($evolve_layout == "1c")) { ?>

<?php } else { ?>
	
	<?php $options = get_option('evolve');
	
	if((is_page() || is_single()) && get_post_meta($post->ID, 'evolve_full_width', true) == 'yes'):
	
	else:
	
		if ($evolve_layout == "3cm" || $evolve_layout == "3cl" || $evolve_layout == "3cr") { ?>
		
		<?php get_sidebar('2'); ?>
		
		<?php } ?>
	
	<?php endif; ?>

<?php } ?>

<!--BEGIN #primary .hfeed-->
<div id="primary" class="<?php evolve_layout_class($type = 1); ?>">

<?php
$evolve_breadcrumbs = evolve_get_option('evl_breadcrumbs','1');
if ($evolve_breadcrumbs == "1"):
if (is_home() || is_front_page()):
else:evolve_breadcrumb();
endif;
endif;

//<!-- attachment begin -->
 if (is_attachment()) { 
    load_template( locate_template('attachment.php') );

//	<!-- attachment end -->

//<!-- single article -->
 } elseif (is_singular( 'article' )) {   
            
     load_template( locate_template('article.php') );

 } elseif (is_singular( 'journal' ) || is_tag()) { 


//<!-- single tag -->
    if (is_tag()) { ?>
	    <h2 class="page-title archive-title">
            <?php _e( 'Articles tagged', 'evolve' ); ?> <span id="tag-title"><?php single_tag_title(); ?></span>
        </h2>
<?php

//<!-- single journal -->
    } elseif (is_singular( 'journal' )) { ?>     	        
        <h2 class="page-title archive-title">
            <span id="journal-title">Journal: <?php the_title(); ?></span>
        </h2> 
        <?php }

         load_template( locate_template('articles.php') );

 } elseif (is_single()) { 

//<!-- single post begin -->    
    load_template( locate_template('post.php') );

//	<!-- single post end -->


//<!-- home/date/category/tag/search/author begin -->

 } elseif (is_home() || is_date() || is_category() || is_tag() || is_search() || is_author() || is_singular( 'journal' ) || is_post_type_archive( array( 'article', 'journal' ) ) ) { ?>



<!-- 2 or 3 columns begin -->



<?php if (is_date()) { ?>

	<?php /* If this is a daily archive */ if ( is_day() ) { ?>
	<h2 class="page-title archive-title"><?php _e( 'Daily archives for', 'evolve' ); ?> <span class="daily-title updated"><?php the_time( 'F jS, Y' ); ?></span></h2>
	<?php /* If this is a monthly archive */ } elseif ( is_month() ) { ?>
	<h2 class="page-title archive-title"><?php _e( 'Monthly archives for', 'evolve' ); ?> <span class="monthly-title updated"><?php the_time( 'F, Y' ); ?></span></h2>
	<?php /* If this is a yearly archive */ } elseif ( is_year() ) { ?>
	<h2 class="page-title archive-title"><?php _e( 'Yearly archives for', 'evolve' ); ?> <span class="yearly-title updated"><?php the_time( 'Y' ); ?></span></h2>
	<?php } ?>
	
	<?php } elseif (is_category() && $evolve_category_page_title) { ?>
	<h2 class="page-title archive-title"><?php _e( 'Posts in category', 'evolve' ); ?> <span id="category-title"><?php single_cat_title(); ?></span></h2>
	
	
	<?php } elseif (is_search()) { ?>
	
	
	<h2 class="page-title search-title"><?php _e( 'Search results for', 'evolve' ); ?> <?php echo '<span class="search-term">'.the_search_query().'</span>'; ?></h2>
	
	<?php } elseif (is_author()) { ?>	
	<h2 class="page-title archive-title"><?php _e( 'Posts by', 'evolve' ); ?> <span class="author-title"><?php the_post(); echo $authordata->display_name; rewind_posts(); ?></span></h2>
	
	<?php } ?>
	
	<?php $options = get_option('evolve'); if ($evolve_post_layout == "two" || $evolve_post_layout == "three") { ?>
	
	
	<?php if (($evolve_nav_links == "before") || ($evolve_nav_links == "both")) { ?>
	
	<span class="nav-top">
		<?php get_template_part( 'navigation', 'index' ); ?>
	</span>

<?php } else {
     
      } 


//<!-- article archive -->
  if (is_post_type_archive( 'article' ) || is_search()) : 
        load_template( locate_template('articles.php') );

//<!-- journal archive -->
      elseif (is_post_type_archive( 'journal' )) : 
        load_template( locate_template('journals.php') );


   elseif ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<!--BEGIN .hentry-->
<div id="post-<?php the_ID(); ?>" class="<?php semantic_entries(); evolve_post_class($xyz);$xyz++ ?> margin-40">

	<?php $options = get_option('evolve'); 
 
 if (($evolve_header_meta == "") || ($evolve_header_meta == "single_archive"))
	{ ?>
	
		<h2 class="entry-title">
			<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>">
				<?php
				if ( get_the_title() ){ $title = the_title('', '', false);
					echo evolve_truncate($title, $evolve_posts_excerpt_title_length, '...'); 
				} 
				?>
			</a>
		</h2>
		
		<!--BEGIN .entry-meta .entry-header-->
		<div class="entry-meta entry-header">

			<a href="<?php the_permalink() ?>"><span class="published updated"><?php the_time(get_option('date_format')); ?></span></a>

			<span class="author vcard">
				<?php _e( 'Written by', 'evolve' ); ?> <strong><?php printf( '<a class="url fn" href="' . get_author_posts_url( $authordata->ID, $authordata->user_nicename ) . '" title="' . sprintf( 'View all posts by %s', $authordata->display_name ) . '">' . get_the_author() . '</a>' ) ?></strong>
			</span>
			
			<?php edit_post_link( __( 'edit', 'evolve' ), '<span class="edit-post">', '</span>' ); ?>
			
			<!--END .entry-meta .entry-header-->
		</div>
	
	<?php } else { ?>
	
		<h1 class="entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>">
	
		<?php
		if ( get_the_title() ){ $title = the_title('', '', false);
		echo evolve_truncate($title, 40, '...'); }
		?></a> </h1>
		
		<?php if ( current_user_can( 'edit_post', $post->ID ) ): ?>
			<?php edit_post_link( __( 'EDIT', 'evolve' ), '<span class="edit-post edit-attach">', '</span>' ); ?>
		<?php endif; ?>
	
	<?php } ?>
	
	<!--BEGIN .entry-content .article-->
	<div class="entry-content article">

	<?php if ($evolve_featured_images == "1") { ?>
	
		<?php
		if(has_post_thumbnail()) {
			echo '<span class="thumbnail-post"><a href="'; the_permalink(); echo '">';the_post_thumbnail('post-thumbnail'); echo '
			<div class="mask">
			<div class="icon"></div>
			</div>
			</a></span>';
		
		} else {
		
		$image = evolve_get_first_image();
		
		if ($image):
				echo '<span class="thumbnail-post"><a href="'; the_permalink(); echo'"><img src="'.$image.'" alt="';the_title();echo'" />
				<div class="mask">
				<div class="icon"></div>
				</div>
				</a></span>';
			
			else:
				if($evolve_thumbnail_default_images==0)
				{
				echo '<span class="thumbnail-post"><a href="'; the_permalink(); echo'"><img src="'.get_template_directory_uri().'/library/media/images/no-thumbnail.jpg" alt="';the_title();echo'" />
				<div class="mask">
				<div class="icon"></div>
				</div>
				</a></span>';
			}
		
		endif;
		} ?>
	
	<?php } ?>
	

	<?php the_excerpt(); ?>
	
		<div class="entry-meta entry-footer">
	
			<div class="read-more btn btn-right icon-arrow-right">
				<a href="<?php the_permalink(); ?>"><?php _e('READ MORE', 'evolve' ); ?></a>
			</div>
			
			<?php if ( comments_open() ) : ?>
				<span class="comment-count"><?php comments_popup_link( __( 'Leave a Comment', 'evolve' ), __( '1 Comment', 'evolve' ), __( '% Comments', 'evolve' ) ); ?></span>
			<?php else : // comments are closed
			endif; ?>
		</div>
		
		<!--END .entry-content .article-->
		<div class="clearfix"></div>
	</div>
	
	<!--END .hentry-->
</div>

<?php $i='';$i++; ?>

<?php endwhile; ?>
<?php get_template_part( 'navigation', 'index' ); ?>
<?php else : ?>


<?php if (is_search()) { ?>

	<!--BEGIN #post-0-->
	<div id="post-0" class="<?php semantic_entries(); ?>">
		<h1 class="entry-title"><?php _e( 'Your search for', 'evolve' ); ?> "<?php echo the_search_query(); ?>" <?php _e( 'did not match any entries', 'evolve' ); ?></h1>
		
		<!--BEGIN .entry-content-->
		<div class="entry-content">
			<br />
			<p><?php _e( 'Suggestions:', 'evolve' ); ?></p>
			<ul>
			<li><?php _e( 'Make sure all words are spelled correctly.', 'evolve' ); ?></li>
			<li><?php _e( 'Try different keywords.', 'evolve' ); ?></li>
			<li><?php _e( 'Try more general keywords.', 'evolve' ); ?></li>
			</ul>
			<!--END .entry-content-->
		</div>
	<!--END #post-0-->
	</div>
	
<?php } else { ?>
	
	<!--BEGIN #post-0-->
	<div id="post-0" class="<?php semantic_entries(); ?>">
		<h1 class="entry-title"><?php _e( 'Not Found', 'evolve' ); ?></h1>
	
		<!--BEGIN .entry-content-->
		<div class="entry-content">
			<p><?php _e( 'Sorry, but you are looking for something that isn\'t here.', 'evolve' ); ?></p>
		<!--END .entry-content-->
		</div>
	<!--END #post-0-->
	</div>

<?php } ?>

<?php endif; ?>


<!-- 2 or 3 columns end -->


<!-- 1 column begin -->


<?php } else { ?>

<?php if (($evolve_nav_links == "before") || ($evolve_nav_links == "both")) { ?>

	<span class="nav-top">
	<?php get_template_part( 'navigation', 'index' ); ?>
	</span>
	
	<?php } else {?>

<?php } ?>

<?php  
  
  
//<!-- article archive -->
if (is_post_type_archive( 'article' )) : 
        load_template( locate_template('articles.php') );


//<!-- journal archive -->
elseif (is_post_type_archive( 'journal' )) : 
        load_template( locate_template('journals.php') );


//<!-- Search Results -->
elseif (is_search()) : 
        load_template( locate_template('articles.php') );


//<!-- Posts -->
elseif ( have_posts() ) : while ( have_posts() ) : the_post(); ?>



	<!--BEGIN .hentry-->
	<div id="post-<?php the_ID(); ?>" class="<?php semantic_entries(); ?> <?php evolve_post_class_2(); ?>">
	
		<?php if (($evolve_header_meta == "") || ($evolve_header_meta == "single_archive"))
		{ ?>
		
		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php if ( get_the_title() ){ the_title();} ?></a></h1>
		
		<!--BEGIN .entry-meta .entry-header-->
		<div class="entry-meta entry-header">
			<a href="<?php the_permalink() ?>"><span class="published updated"><?php the_time(get_option('date_format')); ?></span></a>
			
			<?php if ( comments_open() ) : ?>
				<span class="comment-count"><a href="<?php comments_link(); ?>">
					<?php comments_popup_link( __( 'Leave a Comment', 'evolve' ), __( '1 Comment', 'evolve' ), __( '% Comments', 'evolve' ) ); ?></a>
				</span>
			<?php else : // comments are closed
			endif; ?>
			
			<span class="author vcard">
			
			<?php $evolve_author_avatar = evolve_get_option('evl_author_avatar','0');
			if ($evolve_author_avatar == "1") { echo get_avatar( get_the_author_meta('email'), '30' );		
			} ?>
	
			<?php _e( 'Written by', 'evolve' ); ?> <strong><?php printf( '<a class="url fn" href="' . get_author_posts_url( $authordata->ID, $authordata->user_nicename ) . '" title="' . sprintf( 'View all posts by %s', $authordata->display_name ) . '">' . get_the_author() . '</a>' ) ?></strong></span>
	
			<?php edit_post_link( __( 'edit', 'evolve' ), '<span class="edit-post">', '</span>' ); ?>
			<!--END .entry-meta .entry-header-->
		</div>
		
		<?php } else { ?>
		
			<h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php if ( get_the_title() ){ the_title();} ?></a></h1>
			
			<?php if ( current_user_can( 'edit_post', $post->ID ) ): ?>
				?php edit_post_link( __( 'EDIT', 'evolve' ), '<span class="edit-post edit-attach">', '</span>' ); ?>
			<?php endif; ?>
		
		<?php } ?>
		
		<!--BEGIN .entry-content .article-->
		<div class="entry-content article">
	
			<?php if ($evolve_featured_images == "1") { ?>
			
				<?php
				if(has_post_thumbnail()) {
				echo '<span class="thumbnail-post"><a href="'; the_permalink(); echo '">';the_post_thumbnail('post-thumbnail'); echo '
				<div class="mask">
				<div class="icon"></div>
				</div>
				</a></span>';
				
				} else {
				
				$image = evolve_get_first_image();
		
				if ($image):
				echo '<span class="thumbnail-post"><a href="'; the_permalink(); echo'"><img src="'.$image.'" alt="';the_title();echo'" />
				<div class="mask">
				<div class="icon"></div>
				</div>
				</a></span>';
				
				else:
				if($evolve_thumbnail_default_images==0)
				{
				echo '<span class="thumbnail-post"><a href="'; the_permalink(); echo'"><img src="'.get_template_directory_uri().'/library/media/images/no-thumbnail.jpg" alt="';the_title();echo'" />
				<div class="mask">
				<div class="icon"></div>
				</div>
				</a></span>';
				}
		
				endif;
				} ?>
			
			<?php } ?>
			
			<?php if (($evolve_excerpt_thumbnail == "1")) { ?>
			
			<?php the_excerpt();?>
	
			<div class="read-more btn btn-right icon-arrow-right">
			<a href="<?php the_permalink(); ?>"><?php _e('READ MORE', 'evolve' ); ?></a>
			</div>
			
			<?php } else { ?>
	
				<?php the_content( __('READ MORE &raquo;', 'evolve' ) ); ?>
			
				<?php wp_link_pages( array( 'before' => '<div id="page-links"><p>' . __( '<strong>Pages:</strong>', 'evolve' ), 'after' => '</p></div>' ) ); ?>
			
			<?php } ?>
			
			<!--END .entry-content .article-->
			<div class="clearfix"></div>
		</div>
		
		
		
		<!--BEGIN .entry-meta .entry-footer-->
		
		<div class="entry-meta entry-footer row">
		<div class="col-md-6">
		<?php if ( evolve_get_terms( 'cats' ) ) { ?>
		<div class="entry-categories"> <?php echo evolve_get_terms( 'cats' ); ?></div>
		<?php } ?>
		<?php if ( evolve_get_terms( 'tags' ) ) { ?>
		
		<div class="entry-tags"> <?php echo evolve_get_terms( 'tags' ); ?></div>
		<?php } ?>
		<!--END .entry-meta .entry-footer-->
		</div>
		
		<div class="col-md-6">
		<?php if (($evolve_share_this == "single_archive") || ($evolve_share_this == "all")) {
		evolve_sharethis(); } else { ?> <div class="margin-40"></div> <?php }?>
		</div>
		</div>
	
	<!--END .hentry-->
	</div>

<?php comments_template(); ?>

<?php endwhile; ?>

<?php if (($evolve_nav_links == "") || ($evolve_nav_links == "after") || ($evolve_nav_links == "both")) { ?>

	<?php get_template_part( 'navigation', 'index' ); ?>
	
	<?php } else {?>

<?php } ?>

<?php else : ?>

<?php if (is_search()) { ?>

	<!--BEGIN #post-0-->
	<div id="post-0" class="<?php semantic_entries(); ?>">
	
		<h1 class="entry-title"><?php _e( 'Your search for', 'evolve' ); ?> "<?php echo the_search_query(); ?>" <?php _e( 'did not match any entries', 'evolve' ); ?></h1>
	
		<!--BEGIN .entry-content-->
		<div class="entry-content">
		<br />
		<p><?php _e( 'Suggestions:', 'evolve' ); ?></p>
		<ul>
		<li><?php _e( 'Make sure all words are spelled correctly.', 'evolve' ); ?></li>
		<li><?php _e( 'Try different keywords.', 'evolve' ); ?></li>
		<li><?php _e( 'Try more general keywords.', 'evolve' ); ?></li>
		</ul>
		<!--END .entry-content-->
		</div>
	<!--END #post-0-->
	</div>
	
	<?php } else { ?>
	
	<!--BEGIN #post-0-->
	<div id="post-0" class="<?php semantic_entries(); ?>">
		<h1 class="entry-title"><?php _e( 'Not Found', 'evolve' ); ?></h1>
		
		<!--BEGIN .entry-content-->
		<div class="entry-content">
			<p><?php _e( 'Sorry, but you are looking for something that isn\'t here.', 'evolve' ); ?></p>
		<!--END .entry-content-->
		</div>
	<!--END #post-0-->
	</div>

<?php } ?>

<?php endif; ?>

<?php } ?>

<!-- 1 column end -->

<!-- home/date/category/tag/search/author end -->

<?php } elseif (is_page()) { ?>


<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

	<!--BEGIN .hentry-->
	<div id="post-<?php the_ID(); ?>" class="<?php semantic_entries(); ?>">
		<h1 class="entry-title"><?php if ( get_the_title() ){ the_title(); } ?></h1>
		
		<?php if(has_post_thumbnail()) {
			echo '<span class="thumbnail-post">';the_post_thumbnail('post-thumbnail'); echo '</span>';		
		}?>
		
		<?php if ( current_user_can( 'edit_post', $post->ID ) ): ?>	
			<?php edit_post_link( __( 'EDIT', 'evolve' ), '<span class="edit-page">', '</span>' ); ?>
		<?php endif; ?>
	
		<!--BEGIN .entry-content .article-->
		<div class="entry-content article">
		<?php the_content( __('READ MORE &raquo;', 'evolve' ) ); ?>
		<!--END .entry-content .article-->
		<div class="clearfix"></div>
		</div>
	
		<!-- Auto Discovery Trackbacks
		<?php trackback_rdf(); ?>
		-->
		<!--END .hentry-->
	</div>
	
	<?php if( $evolve_share_this == 'all' ) evolve_sharethis(); ?>
	
	<?php if ( 'page' !== get_option('show_on_front') ) comments_template( '', true ); ?>

<?php endwhile; endif; ?>


<?php } elseif (is_404()) { ?>

	<!--BEGIN #post-0-->
	<div id="post-0" class="<?php semantic_entries(); ?>">
	<h1 class="entry-title"><?php _e( 'Not Found', 'evolve' ); ?></h1>
	
	<!--BEGIN .entry-content-->
	<div class="entry-content">
	<p><?php _e( 'Sorry, but you are looking for something that isn\'t here.', 'evolve' ); ?></p>
	
	
	<!--END .entry-content-->
	</div>
	<!--END #post-0-->
	</div>

<?php } ?>


<!--END #primary .hfeed-->
</div>


<?php
if (($evolve_layout == "1c"))
{ ?>

<?php } else { ?>

<?php if((is_page() || is_single()) && get_post_meta($post->ID, 'evolve_full_width', true) == 'yes'):

else: ?>

<?php get_sidebar(); ?>

<?php endif; ?>

<?php } ?>

<?php get_footer(); ?>