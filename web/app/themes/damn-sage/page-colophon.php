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

  <div class="row colophon marginTop2em">

    <?php the_content(); ?>

    <div class="col-xs-12 col-ms-6 col-sm-6">
      <div class="col-xs-12 col-md-6 column-1">

        <?php /* query to show all users */ ?>
          <?php
          // Get all users order by amount of posts
          $allUsers = get_users('orderby=display_name');
          $users = array();

          foreach($allUsers as $currentUser) {
            if(in_array( 'author', $currentUser->roles )) {
              $users[] = $currentUser;
            }
          }
        ?>

        <h3 class="text-uppercase">
          Contributors
        </h3>

        <!-- Contributors list -->
        <div class="contributor-names">
          <?php foreach($users as $user) { ?>
            <span>
              <a href="<?php echo get_author_posts_url( $user->ID ); ?>" title="Read Articles" class="black-link">
                <?php echo $user->display_name; ?>
              </a>
            </span>
          <?php } ?>

          <a href="/colophon/contributors/" title="All Contributors" class="btn btn-primary marginTop marginBottom15">All Contributors</a>
        </div>
        <!-- End Contributors list -->

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



<article <?php post_class(''); ?>>
  <?php /* display normal content, if it exists */ ?>
  <?php while (have_posts()) : the_post(); ?>
    <?php the_content(); ?>
  <?php endwhile; ?>

  <?php /* query to show all users */ ?>
  <?php
  // Get all users order by amount of posts
  $allUsers = get_users('orderby=display_name&order=DESC&show_full');
  $users = array();
  // Remove subscribers from the list as they won't write any articles
  foreach($allUsers as $currentUser) {
    if(!in_array( 'subscriber', $currentUser->roles )) {
      $users[] = $currentUser;
    }
  }
  ?>

  <footer class="contributors-list">
    <?php foreach($users as $user) { ?>
    <?php $firstName = get_user_meta($user->ID, 'first_name', true); ?>
    <?php $lastName = get_user_meta($user->ID, 'last_name', true); ?>

      <a href="<?php echo get_author_posts_url( $user->ID ); ?>" title="Read Articles" class="black-link">
        <?php /* display name as what's selected in Display name as setting
        <?php echo $user->display_name; ?>
        */ ?>
        <?php echo $firstName; ?> <?php echo $lastName; ?>
      </a>
    <?php } ?>
  </footer>
</article>