<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @package una
 * @since una 1.0.1
 * @license GPL 2.0
 *
 */
get_header(); ?>

  <section class="Homepage">

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
          foreach ( $terms as $term ): ?>
              <a class="Tag" href="<?php echo esc_url( get_term_link( $term ) ) ?>">
                  <?php echo $term->name; ?>
              </a>

              <?php
              endforeach;
              endif;
      ?>

    </div>

  </div>


    <div class="Grid">

      <?php
      /**
       * Setup query to show the website post type with all posts.
       */

      $args = [
          "post_type" => "design-tools",
          "post_status" => "publish",
          "posts_per_page" => -1,
          "order" => "DESC",
      ];

      $loop = new WP_Query($args);

      while ($loop->have_posts()):
          $loop->the_post(); ?>
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
      <?php
      endwhile;
      wp_reset_postdata();
      ?>

    </div>
  </section>

<?php get_footer();
?>
