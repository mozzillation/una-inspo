<?php
/**
 * The template for displaying all single inspirations
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

		<section class="SingleInspiration">

				<div class="Preview">
					<div class="Bar">

					</div>
					<div class="Thumb">
						<?php the_post_thumbnail("large"); ?>
					</div>
				</div>

				<div class="Data">
					<div class="Title">
						<?php the_title(); ?>
					</div>
					<div class="Url">
						<a href="<?php the_field("url"); ?>?ref=inspo.wannad.it" target="_blank">
							<?php the_field("url"); ?> ↗
						</a>
					</div>
					<div class="Time">
						<?php echo esc_html(
          human_time_diff(get_the_time("U"), current_time("timestamp"))
      ) . " ago"; ?>
					</div>
				</div>


				<?php the_content(); ?>

		</section>

	<?php
     endwhile; ?>
	<?php
 endif; ?>

<?php get_footer();
?>
