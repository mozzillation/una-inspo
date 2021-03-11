<?php
/**
 * The template for displaying all single posts and pages
 *
 * @package una
 * @since una 1.0.3
 * @license GPL 2.0
 *
 */
get_header();
global $wp;
?>



	<?php if (have_posts()): ?>

		<section class="Taxonomy">



	    <div class="Filter">

	      <div class="Intro">
	        Filter by
	      </div>

	      <div class="List">

	      <?



	      $terms = get_terms(
	          array(
	              'taxonomy'   => 'design_tools_filter',
	              'hide_empty' => true,
	          )
	      );

	      if ( ! empty( $terms ) && is_array( $terms ) ):
	          foreach ( $terms as $term ):
							$term_link = get_term_link( $term);
							$current_url = home_url(add_query_arg(array(), $wp->request));
							?>
	              <a class="Tag
								<?php
									if($current_url === $term_link)
									echo 'is-active'
								?>" href="<?php echo esc_url( get_term_link( $term ) ) ?>">
	                  <?php echo $term->name; ?>
	              </a>

	              <?php
	              endforeach;
	              endif;
	      ?>

	    </div>

	  </div>


	    <div class="Grid">




  <?php while (have_posts()):
         the_post(); ?>

				 <article class="toolCard">
					 <div class="Top">
						 <div class="Thumb">
							 <?php the_post_thumbnail("medium"); ?>
						 </div>
						 <div class="Data">
							 <div class="Title">
								 <?php the_title();?>
							 </div>
							 <div class="Filters">
								 <?php
								 $terms = get_the_terms( get_the_ID(), 'design_tools_filter' );

								 if ( $terms && ! is_wp_error( $terms ) ) :
										 foreach ( $terms as $term ):?>
											 <li>#<?php echo $term->name;?></li>
								 <?php endforeach; endif; ?>
							 </div>
						 </div>
					 </div>

					 <div class="Bottom">
						 <div class="OS">
							 <?php
								 $values = get_field('software');
								 foreach ($values as $value):
									switch ($value) {
										 case 'macos':
											 $icon = 'ph-apple-logo';
											 break;
										 case 'windows':
											 $icon = 'ph-grid-four';
											 break;
										 default:
											 $icon = 'ph-cloud';
											 break;
									 };?>
									 <i class="<?php echo $icon;?>"></i>
							 <?php endforeach;?>

						 </div>

						 <?php if( have_rows('links') ): ?>
							 <div class="Links">
							 <?php while( have_rows('links') ): the_row(); ?>
									 <li>
										 <a href="<?php the_sub_field('url'); ?>" target="_blank"><?php the_sub_field('text'); ?></a>
									 </li>
							 <?php endwhile; ?>
							 </div>
					 <?php endif; ?>





					 </div>

				 </article>


	<?php endwhile;?>

</section>
 <?php endif; ?>

<?php get_footer();
?>
