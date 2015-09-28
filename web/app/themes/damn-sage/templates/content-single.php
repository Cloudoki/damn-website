<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class(''); ?>>
    <div class="entry-content">

      <?php /* if this is a quote post format, add the quote at the top of the page */ ?>
        <?php if ( has_post_format( 'quote' )) { ?>

          <header class="quote-single">
            <blockquote>
                <?php the_excerpt(); ?>
            </blockquote>
          </header>

        <?php } ?>
      <?php /* end if quote */ ?>

      <?php /* If is in DAMN + category, decide to show content IF user is logged in with an account, or else, CTA.. else, all other categories, display normal content */ ?>
      <?php if (in_category('damn-plus')) { ?>

        <?php /* if in damn plus and can access locked content */ ?>
        <?php if (current_user_can("access_s2member_level1")){ ?>
          <?php /* If visitor is logged in and can access blocked content, display all content */ ?>
          <?php the_content(); ?>

          <?php /* Multiple external URL links, if added */ ?>
          <?php get_template_part('templates/snippet', 'external-links'); ?>

          <?php /* REUSED snippet to display standard post footer */ ?>
          <?php get_template_part('templates/snippet', 'post-footer'); ?>

        <?php } else /* else show CTA and lock everything else out */ { ?>
          <?php /* display items above the more tag, or a limited content (if more not selected, so "excerpt" doesn't duplicate on quote post formats) */ ?>
          <?php if(strpos(get_the_content(),'id="more-')) : global $more; $more = 0; the_content(''); ?>
          <?php else : ?>
            <p>
            <?php $content = get_the_content();
            $content = strip_tags($content);
            echo substr($content, 0, 400);
            echo '...';
            ?>
            </p>
          <?php endif; ?>

          <?php /* CTA */ ?>
          <div class="damn-plus-cta">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 damn-plus-image-cta">
              <a href="/join-damn-plus" title="Join DAMN +">
                <img src="<?= get_template_directory_uri(); ?>/dist/images/damn-join-box-boxed.png" alt="Join DAMN +" class="placeholder visible-lg-block" />
                <img src="<?= get_template_directory_uri(); ?>/dist/images/damn-join-box-wide.png" alt="Join DAMN +" class="placeholder visible-xs-block visible-sm-block visible-md-block mobile-image" />
              </a>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 damn-plus-cta-copy">
              <?php /* Join DAMN Plus */ ?>
              <h2>Dear DAMN reader,<br /><span style="font-size: 80%;">This is a <strong>DAMN +</strong> article.</span></h2>
              <p>
                With a subscription, you get unlimited access to:

                <ul>
                  <li><span style="font-size: 115%;">•</span> All articles of the current, and previous DAMN issues</li>
                  <li><span style="font-size: 115%;">•</span> Premium articles and content, hidden to regular users</li>
                  <li><span style="font-size: 115%;">•</span> The entire DAMN archive</li>
                  <li><span style="font-size: 115%;">•</span> Much more to come!</li>
                </ul>

                <h3><strong>Subscribe for just € 5 / month</strong>, and get two months on the house.</h3>
              </p>
              <a href="/join-damn-plus" class="btn btn-default btn-lg join-btn" role="button" title="Join DAMN +">JOIN DAMN +</a>

              <?php /* subscribe to the magazine */ ?>
              <div class="row marginTop marginBottom">
                <div class="col-xs-12">
                  <h2 class="marginTop">Subscribe to our print magazine</h2>
                </div>
                <div class="col-xs-7 col-sm-7 col-md-5 col-lg-4 latest-cover">
                  <?php get_template_part('templates/snippet-latest-cover'); ?>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-7 col-lg-8">
                  <p>Don’t miss a single copy of DAMN° Magazine! Build your own library and feel DAMN° by taking a yearly subscription today.</p>
                  <h3>6 issues for €70 (Europe)</h3>
                  <h3>$172 (rest of the world)</h3>
                </div>
                <div class="col-xs-12">

                  <a class="btn btn-lg btn-default text-uppercase" href="https://www.bruil.info/damn" target="_blank" title="Subscribe Now">SUBSCRIBE</a>

                  &nbsp; or &nbsp;

                  <a class="btn btn-lg btn-default text-uppercase" href="http://www.bruil.info/magazine-damn/back-issues" target="_blank" title="Order Back Issue">ORDER BACK ISSUE</a>
                </div>
                <div class="clearthis"></div>
              </div>

            </div>
          </div>
        <?php } ?>
        <?php /* end if damn + and can or can't access locked content */ ?>

      <?php } else { ?>

        <?php /* or else if not in DAMN+, show all content normally, as this is not on a protected post */ ?>
        <?php the_content(); ?>

        <?php /* Multiple external URL links, if added */ ?>
        <?php get_template_part('templates/snippet', 'external-links'); ?>

        <?php /* REUSED snippet to display standard post footer */ ?>
        <?php get_template_part('templates/snippet', 'post-footer'); ?>

      <?php } ?>

    </div>


  </article>
<?php endwhile; ?>

