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

          <?php /* display product info above content only on mobile (so you dont have to scroll below comments to see product info) - otherwise visible on sidebar for larger than mobile */ ?>
          <?php if(get_field('creators')) { ?>
            <section class="widget product-info-wrapper visible-xs-block">
              <h3 class="widget-title noMargin">
                Product Info
              </h3>

              <?php get_template_part('templates/snippet', 'product-info'); ?>

            </section>
          <?php } ?>
          <?php /* end display of product info for mobile */ ?>

          <?php the_content(); ?>

          <?php /* Product Relation */ ?>
          <?php $post_objects = get_field('related _posts');
          if( $post_objects ): ?>
            <section class="widget related-post">
              <h3 class="widget-title noMargin boldText">
                Product Related Posts
              </h3>
              <ul class="relation-list product-relation-list">
              <?php foreach( $post_objects as $post): ?>
                <?php setup_postdata($post); ?>
                <li>
                  <?php if ( has_post_thumbnail()) { ?>
                    <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>" class="list-thumb"><?php the_post_thumbnail('thumbnail'); ?></a>
                  <?php } else { ?>
                   <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>" class="list-thumb">
                    <img src="<?= get_template_directory_uri(); ?>/dist/images/default-thumb.gif" alt="<?php the_title_attribute(); ?> - <?= get_bloginfo("name"); ?>"/>
                   </a>
                  <?php } ?>
                  <div class="list-meta">
                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="displayBlock"><?php the_title(); ?></a>
                    <?php /* display category links as a comma separated list, and not the block format */
                    get_template_part('templates/snippet', 'category-link-sep'); ?>
                  </div>
                  <div class="clearthis"></div>
                </li>
              <?php endforeach; ?>
              </ul>
            </section>
            <?php wp_reset_postdata(); ?>
          <?php /* end Product Relation */ endif; ?>

        </div>
      </div>
    </div>

    <?php /* REUSED snippet to display standard post footer */ ?>
    <?php get_template_part('templates/snippet', 'post-footer'); ?>
  </article>
<?php endwhile; ?>