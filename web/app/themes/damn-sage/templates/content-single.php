<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class(''); ?>>
    <header class="hidden-sm hidden-sm-block">
      <?php get_template_part('templates/entry-meta'); ?>
    </header>

    <div class="entry-content">

    <?php /* If is in DAMn Plus category, decide to show content IF user is logged in with an account, or else, CTA.. else, all other categories, display normal content */ ?>
      <?php if (in_category('damn-plus')) { ?>

        <?php if (current_user_can("access_s2member_level1")){ ?>
          <?php /* display all content */ ?>
          <?php the_content(); ?>

        <?php } else { ?>
          <?php /* display teaser and CTA */ ?>
          <?php the_excerpt(); ?>
          <div class="damn-plus-cta">
              <div class="col-xs-12 col-sm-4 damn-plus-image-cta">
                <a href="/join-damn-plus" title="Join DAMn Plus">
                  <img src="<?= get_template_directory_uri(); ?>/dist/images/damn-join-box-boxed.png" alt="Join DAMn Plus" class="placeholder" />
                </a>
              </div>
              <div class="col-xs-12 col-sm-8 damn-plus-cta-copy">
                <h3>Dear DAMN reader, this is a <span>DAMN+</span> article. Subscribe here to get unlimited access to all articles of the current DAMN issue, to the DAMNº archives and much more.</h3>
                <a href="/join-damn-plus" class="btn btn-default btn-lg" role="button" title="Join DAMn Plus">JOIN DAMn PLUS</a>
              </div>
            </div>
        <?php } ?>

      <?php } else { ?>

        <?php the_content(); ?>

      <?php } ?>
    </div>

    <?php /* REUSED snippet to display standard post footer */ ?>
    <?php get_template_part('templates/snippet', 'post-footer'); ?>
  </article>
<?php endwhile; ?>

