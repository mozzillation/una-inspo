<?php
/**
 * The template for displaying all single posts and pages
 *
 * @package una
 * @since una 1.0.3
 * @license GPL 2.0
 *
 */
get_header(); ?>

	<?php if (have_posts()):
     while (have_posts()):
         the_post(); ?>

		<section class="Page About">
			<div class="Title">
				<h1>
					<?php the_title(); ?>
				</h1>
			</div>
			<div class="WithSidebar">
				<main class="Content">
					<?php the_content(); ?>
				</main>

				<aside class="Sidebar">
					
				</aside>
			</div>



		</section>

	<?php
     endwhile;
 else:
      ?>

		<p>Nope</p>

	<?php
 endif; ?>

<?php get_footer();
?>
