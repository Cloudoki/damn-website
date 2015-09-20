<?php
/* if Productivity */
if (is_singular('product')) { ?>
  <?php if(get_field('creators')) { ?>
    <section class="widget product-info-wrapper">
      <h3 class="widget-title">
        Product Info
      </h3>
      <div class="product-info">
        <?php
          $companylogo = wp_get_attachment_image_src(get_field('company_image'), 'full');
          if( $companylogo ) { ?>
            <div class="company-logo">
              <img src="<?php echo $companylogo[0]; ?>" alt="<?php echo get_the_title(get_field('magazine_feature_feature_image')) ?>" />
            </div>
        <?php } ?>

        <div class="product-creators">
          <h4><strong>CREATOR</strong></h4>
          <p class="noMargin"><?php the_field('creators', false, false); ?></p>
        </div>

        <div class="product-links text-uppercase">
          <?php if(get_field('company_website')) { ?>
            <a class="btn btn-lg btn-default marginRight" href="<?php the_field('company_website'); ?>" role="button" target="_blank" title="Creator Website">Website</a>
          <?php } ?>

          <?php /* hide buy button until October 16th
          <?php if(get_field('buy_link')) { ?>
            <a class="btn btn-lg btn-default" href="<?php the_field('buy_link'); ?>" role="button" target="_blank" title="Buy">Buy</a>
          <?php } ?>
          */ ?>
        </div>
      </div>
    </section>
  <?php } ?>
  <?php /* end if get field = creators */ ?>
<?php } ?>

<?php /* DAMN + specific form */ ?>
<?php if (is_page('join-damn-plus') || is_page('damn-plus') || is_page('profile')) { ?>
  <div class="damn-plus-login-form">
    <?php if ( is_active_sidebar( 'sidebar-damn-plus-widget' ) ) : dynamic_sidebar( 'sidebar-damn-plus-widget' ); endif; ?>
  </div>
<?php } ?>

<?php /* Top Advert 300 x 600 */ ?>
<div class="advert advert-sidebar-top">
  <?php if (function_exists('adrotate_group')) echo adrotate_group(3); ?>
</div>

<?php /* if Magazine detail page or Calendar detal page, else normal */ ?>
<?php if(is_tax( 'magazine' )) { ?>
  <?php if ( is_active_sidebar( 'magazine-detail-widget' ) ) : dynamic_sidebar( 'magazine-detail-widget' ); endif; ?>
<?php } elseif(is_singular( 'calendar' )) { ?>
  <?php if ( is_active_sidebar( 'calendar-detail-widget' ) ) : dynamic_sidebar( 'calendar-detail-widget' ); endif; ?>
<?php } else { ?>
  <?php if ( is_active_sidebar( 'sidebar-primary' ) ) : dynamic_sidebar( 'sidebar-primary' ); endif; ?>
<?php } ?>

<?php /* 300 x 250 */ ?>
<div class="advert advert-sidebar-bottom">
  <?php if (function_exists('adrotate_group')) echo adrotate_group(4); ?>
</div>