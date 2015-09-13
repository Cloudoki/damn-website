<?php
/*
Template Name: Colophon
*/
?>

<?php while (have_posts()) : the_post(); ?>

  <?php if ( has_post_thumbnail()) { ?>
    <div class="page-featured-image color-box">
      <?php the_post_thumbnail('large'); ?>
    </div>
  <?php } ?>

  <div class="row colophon">

    <?php the_content(); ?>

    <div class="col-xs-12 col-ms-6 col-sm-6">
      <div class="col-xs-12 col-md-6 column-1">

        <?php
        // Get all users order by amount of posts
        $allUsers = get_users('orderby=post_count&order=DESC&showposts=15');
        $users = array();

        // Remove subscribers from the list as they won't write any articles
        foreach($allUsers as $currentUser) {
          if(!in_array( 'subscriber', $currentUser->roles )) {
            $users[] = $currentUser;
          }
        }
        ?>

        <h3 class="text-uppercase">
          Contributors
        </h3>

        <div class="contributor-names">
          <?php foreach($users as $user) { ?>
            <span>
              <a href="<?php echo get_author_posts_url( $user->ID ); ?>" title="Read Articles">
                <?php echo $user->display_name; ?>
              </a>
            </span>
          <?php } ?>
          <a href="/colophon/contributors/" title="All Contributors" class="btn btn-primary marginTop marginBottom15">All Contributors</a>
        </div>



        <?php if(get_field('column_1')) { ?>
          <?php the_field('column_1'); ?>
        <?php } ?>
      </div>
      <div class="col-xs-12 col-md-6 column-2">
        <?php if(get_field('column_2')) { ?>
          <?php the_field('column_2'); ?>
        <?php } ?>
      </div>
    </div>

    <div class="col-xs-12 col-ms-6 col-sm-6">
      <?php if(get_field('bookstore_title')) { ?>
        <div class="col-xs-12">
          <h3><?php the_field('bookstore_title'); ?></h3>
        </div>
      <?php } ?>
      <div class="nothing">
        <div class="col-xs-12 col-md-6 column-3">
          <?php if(get_field('column_3')) { ?>
            <?php the_field('column_3'); ?>
          <?php } ?>
        </div>
        <div class="col-xs-12 col-md-6 column-4">
          <?php if(get_field('column_4')) { ?>
            <?php the_field('column_4'); ?>
          <?php } ?>
        </div>
      </div>
    </div>

  </div>

<?php endwhile; ?>
