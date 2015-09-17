<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class(''); ?>>
    <div class="entry-content">
      <div class="row">

        <div class="col-xs-12">
          <h1 class="entry-title"><?php the_title(); ?></h1>
          <?php if(get_field('sub-title')) { ?>
            <h2 class="subtitle">
              <?php the_field('sub-title'); ?>
            </h2>
          <?php } ?>
          <div class="post-image bordered-image">

            <div class="feature-slider">

              <ul class="slider bxslider">
                <?php /* get normal post thumbnail */ ?>
                <?php if ( has_post_thumbnail()) { ?>
                  <li id="post-<?php the_ID(); ?>">
                    <?php the_post_thumbnail('large'); ?>
                  </li>
                <?php } ?>

                <?php /* get multiple images, if exist */ ?>
                <?php if(get_field('multiple_product_images')): ?>
                  <?php while(has_sub_field('multiple_product_images')): ?>

                    <?php
                      $attachment_id = get_sub_field('product_images');
                      $size = "large";
                      $image = wp_get_attachment_image_src( $attachment_id, $size );
                    ?>
                    <li><img src="<?php echo $image[0]; ?>" alt="<?php echo get_the_title(get_sub_field('product_images')) ?>"></li>

                  <?php endwhile; ?>
                <?php endif; ?>
              </ul>

            </div>

          </div>
        </div>

        <div class="col-xs-12 marginTop">
          <?php the_content(); ?>
        </div>
      </div>
    </div>

    <?php /* REUSED snippet to display standard post footer */ ?>
    <?php get_template_part('templates/snippet', 'post-footer'); ?>
  </article>
<?php endwhile; ?>