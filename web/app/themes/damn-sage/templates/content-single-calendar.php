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

            <?php  /* if has featured video and featured thumbnail */ if ( has_post_video() && has_post_thumbnail() ) { ?>
              <ul class="slider bxslider">
                <li class="positionRelative">
                  <div class="featured-video">
                    <?php the_post_video(''); ?>
                  </div>
                </li>
                <li id="post-<?php the_ID(); ?>">
                  <?php the_post_thumbnail('large'); ?>
                </li>
              </ul>
            <?php /* else if just has post video */ } elseif ( has_post_video()) { ?>
              <div class="featured-video">
                <?php the_post_video(''); ?>
              </div>
            <?php /* else if just has featured thumbnail */ } elseif ( has_post_thumbnail()) { ?>
              <?php the_post_thumbnail('large'); ?>
            <?php } else { ?>
            <?php } ?>

          </div>
        </div>

        <div class="col-xs-12 marginTop">
          <div class="title-header">
            <?php if(get_field('start_date') || get_field('end_date')) { ?>
              <div class="event-date row bordered-gray">
            <?php } else { ?>
              <div class="event-date row">
            <?php } ?>
              <?php if(get_field('start_date')) { ?>
                <div class="col-xs-6 start-date">
                  <p><strong>Start Date:</strong> <?php the_field('start_date'); ?></p>
                </div>
              <?php } ?>
              <?php if(get_field('end_date')) { ?>
                <div class="col-xs-6 end-date">
                  <p><strong>End Date:</strong> <?php the_field('end_date'); ?></p>
                </div>
              <?php } ?>
              <div class="clearthis"></div>
            </div>

            <div class="clearthis"></div>

            <div class="pull-left event-buttons">
              <?php // Event website and ticket buttons ?>
              <?php if(get_field('event_website')) { ?>
                <a class="btn btn-lg btn-default marginRight marginTop text-uppercase" href="<?php the_field('event_website'); ?>" role="button" target="_blank" title="Event Website">Website</a>
              <?php } ?>
              <?php if(get_field('ticket_url')) { ?>
                <a class="btn btn-lg btn-default marginTop marginRight text-uppercase" href="<?php the_field('ticket_url'); ?>" role="button" target="_blank" title="Event Tickets">Tickets</a>
              <?php } ?>

              <?php // other URL buttons if added ?>
              <?php if(get_field('extra_buttons')): ?>
                <?php while(has_sub_field('extra_buttons')): ?>

                  <a class="btn btn-lg btn-default marginTop marginRight text-uppercase" href="<?php the_sub_field('button_link'); ?>" role="button" target="_blank" title="<?php the_sub_field('button_title'); ?>">
                    <?php the_sub_field('button_title'); ?>
                  </a>

                <?php endwhile; ?>
              <?php endif; ?>

            </div>

            <?php /* share icons */ ?>
            <div class="pull-right calendar-share">
              <!-- Go to www.addthis.com/dashboard to customize your tools -->
              <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-55ce3c8af0d16341" async="async"></script>

              <!-- Go to www.addthis.com/dashboard to customize your tools -->
              <div class="addthis_responsive_sharing"></div>
            </div>
            <div class="clearthis"></div>
          </div>

          <?php the_content(); ?>

          <?php /* Agenda Relation */ ?>
          <?php $post_objects = get_field('related _posts');
          if( $post_objects ): ?>
            <section class="widget related-post">
              <h3 class="widget-title noMargin boldText">
                Read More
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
          <?php /* end Agenda Relation */ endif; ?>

        </div>
      </div>
    </div>

    <?php /* REUSED snippet to display standard post footer */ ?>
    <?php get_template_part('templates/snippet', 'post-footer'); ?>
  </article>
<?php endwhile; ?>