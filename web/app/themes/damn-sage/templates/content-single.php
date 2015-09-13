<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class(''); ?>>
    <header class="hidden-sm hidden-sm-block">
      <?php get_template_part('templates/entry-meta'); ?>
    </header>

    <div class="entry-content">

      <?php /* If is in DAMn Plus category, decide to show content IF user is logged in with an account, or else, CTA.. else, all other categories, display normal content */ ?>
      <?php if (in_category('damn-plus')) { ?>

        <?php if (current_user_can("access_s2member_level1")){ ?>
          <?php /* If visitor is logged in and can access blocked content, display all content */ ?>
          <?php the_content(); ?>

        <?php } else { ?>
          <?php /* else display excerpt or content above the more tag and the CTA to subscribe */ ?>
          <?php if(strpos(get_the_content(),'id="more-')) :
          global $more; $more = 0;
          the_content(''); ?>
          <?php endif; ?>

          <?php /* CTA */ ?>
          <div class="damn-plus-cta">
            <div class="col-xs-12 col-sm-4 damn-plus-image-cta">
              <a href="/join-damn-plus" title="Join DAMn Plus">
                <img src="<?= get_template_directory_uri(); ?>/dist/images/damn-join-box-boxed.png" alt="Join DAMn Plus" class="placeholder" />
              </a>
            </div>
            <div class="col-xs-12 col-sm-8 damn-plus-cta-copy">
              <h2>Dear DAMn reader,<br /><span style="font-size: 80%;">This is a <strong>DAMN+</strong> article.</span></h2>
              <p>
                With a subscription, you get unlimited access to:

                <ul>
                  <li><span style="font-size: 115%;">•</span> All articles of the current, and previous DAMn issues</li>
                  <li><span style="font-size: 115%;">•</span> Premium articles and content, hidden to regular users</li>
                  <li><span style="font-size: 115%;">•</span> The entire DAMn archive</li>
                  <li><span style="font-size: 115%;">•</span> Much more to come!</li>
                </ul>

                <h3><strong>Subscribe for just € 5 / month</strong>, and get two months on the house.</h3>
              </p>
              <a href="/join-damn-plus" class="btn btn-default btn-lg" role="button" title="Join DAMn Plus">JOIN DAMn PLUS</a>
            </div>
          </div>
        <?php } ?>

      <?php } else { ?>

        <?php /* or else, show all content normally, as this is not on a protected post */ ?>
        <?php the_content(); ?>

      <?php } ?>
    </div>

    <?php /* REUSED snippet to display standard post footer */ ?>
    <?php get_template_part('templates/snippet', 'post-footer'); ?>
  </article>
<?php endwhile; ?>

