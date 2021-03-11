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
              'taxonomy'   => 'website_filter',
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
          "post_type" => "website",
          "post_status" => "publish",
          "posts_per_page" => -1,
          "order" => "DESC",
      ];

      $loop = new WP_Query($args);

      while ($loop->have_posts()):
          $loop->the_post(); ?>
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
      <?php
      endwhile;
      wp_reset_postdata();
      ?>

    </div>
  </section>

<?php get_footer();
?>
