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

            <?php /* damn plus badge */ ?>
            <?php get_template_part('templates/damn-plus-badge'); ?>

            <?php if ( has_post_thumbnail()) { ?>
              <?php the_post_thumbnail('large'); ?>
            <?php } else { ?>
              <img src="<?= get_template_directory_uri(); ?>/dist/images/default-tall.png" alt="<?php the_title_attribute(); ?> - <?= get_bloginfo("name"); ?>" class="placeholder" />
            <?php } ?>
          </div>
        </div>

        <div class="col-xs-12">
          <div class="title-header">
            <?php if(get_field('start_date')) { ?>
              <div class="event-date row">
                <div class="col-xs-6">
                  <p><strong>Start Date:</strong> <?php the_field('start_date'); ?></p>
                </div>
                <?php if(get_field('end_date')) { ?>
                  <div class="col-xs-6">
                    <p><strong>End Date:</strong> <?php the_field('end_date'); ?></p>
                  </div>
                <?php } ?>
              </div>
            <?php } ?>

            <?php if(get_field('event_website')) { ?>
              <a class="btn btn-lg btn-default marginRight marginTop text-uppercase" href="<?php the_field('event_website'); ?>" role="button" target="_blank" title="Event Website">Website</a>
            <?php } ?>
            <?php if(get_field('ticket_url')) { ?>
              <a class="btn btn-lg btn-default marginTop text-uppercase" href="<?php the_field('ticket_url'); ?>" role="button" target="_blank" title="Event Tickets">Tickets</a>
            <?php } ?>
          </div>

          <?php the_content(); ?>
        </div>
      </div>
    </div>

    <?php /* REUSED snippet to display standard post footer */ ?>
    <?php get_template_part('templates/snippet', 'post-footer'); ?>
  </article>
<?php endwhile; ?>