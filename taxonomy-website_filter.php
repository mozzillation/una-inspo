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
	              'taxonomy'   => 'website_filter',
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


			 <article class="inspoCard">
				 <a href="<?php the_field(
						 "url"
				 ); ?>?ref=inspo.wannad.it" target="_blank">
					 <div class="Preview">
						 <div class="Bar">
							 <div class="Dot Red"></div>
							 <div class="Dot Yellow"></div>
							 <div class="Dot Green"></div>
						 </div>
						 <div class="Thumb">
							 <?php the_post_thumbnail("medium"); ?>
							 <div class="Overlay">
								 Visit↗
							 </div>
						 </div>
					 </div>
				 </a>

				 <a href="<?php the_permalink(); ?>">

					 <div class="Data">
						 <div class="Title">
							 <?php the_title(); ?>
						 </div>
						 <div class="Time">
							 <?php echo esc_html(
									 human_time_diff(
											 get_the_time("U"),
											 current_time("timestamp")
									 )
							 ) . " ago"; ?>
						 </div>
					 </div>

				 </a>

			 </article>


	<?php endwhile;?>

</section>
 <?php endif; ?>

<?php get_footer();
?>
