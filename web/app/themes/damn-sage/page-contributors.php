<?php
/*
Template Name: Contributors
*/
?>

<article <?php post_class(''); ?>>
  <?php /* display normal content, if it exists */ ?>
  <?php while (have_posts()) : the_post(); ?>
    <?php the_content(); ?>
  <?php endwhile; ?>

  <?php /* query to show all users */ ?>
  <?php
  // Get all users order by amount of posts
  $allUsers = get_users('orderby=display_name');
  $users = array();

  // return authors and admins with posts
  foreach($allUsers as $currentUser) {
    if(in_array( 'author', $currentUser->roles ) || in_array( 'administrator', $currentUser->roles )) {
    if(count_user_posts($currentUser->ID)){
      $users[] = $currentUser;
    }
    }
  }
  ?>

  <footer class="contributors-list">
    <?php foreach($users as $user) { ?>

      <div class="author-wrapper">
        <div class="author-info">
          <?php
          $author_badge = get_field('author_image', 'user_'. $user->ID ); if($author_badge != '') { ?>
            <div class="authorAvatar pull-left">
              <a href="<?php echo get_author_posts_url( $user->ID ); ?>" title="Read Articles">
                <img src="<?php echo $author_badge['url']; ?>" alt="<?php echo $author_badge['alt']; ?>" />
              </a>
            </div>
          <?php } ?>

          <?php /* if no badge, remove left margin with inline style, as the default avatar is hidden */
          $author_badge = get_field('author_image', 'user_'. $user->ID ); if($author_badge != '') { ?>
            <div class="author-meta">
          <?php } else { ?>
            <div class="author-meta" style="margin-left: 0;">
          <?php } ?>
            <h3>
              <a href="<?php echo get_author_posts_url( $user->ID ); ?>" title="Read Articles" class="black-link">
                <?php echo $user->display_name; ?>
              </a>
            </h3>
            <p class="authorDescrption"><?php echo get_user_meta($user->ID, 'description', true); ?></p>
            <p class="authorLinks"><a href="<?php echo get_author_posts_url( $user->ID ); ?>" title="Read Articles" class="btn btn-default text-uppercase">Read Articles</a></p>

            <ul class="social-profiles list-inline">
              <?php
                $website = $user->user_url;
                if($user->user_url != '') {
                  printf('<li><a href="%s" target="_blank" title="">%s</a> <span>&nbsp; /</span></li>', $user->user_url, 'Website');
                }

                $facebook = get_user_meta($user->ID, 'author_facebook', true);
                if($facebook != '') {
                  printf('<li><a href="%s" target="_blank" title="">%s</a> <span>&nbsp; /</span></li>', $facebook, 'Facebook');
                }

                $twitter = get_user_meta($user->ID, 'author_twitter', true);
                if($twitter != '') {
                  printf('<li><a href="%s" target="_blank" title="">%s</a> <span>&nbsp; /</span></li>', $twitter, 'Twitter');
                }

                $linkedin = get_user_meta($user->ID, 'author_linkedin', true);
                if($linkedin != '') {
                  printf('<li><a href="%s" target="_blank" title="">%s</a> <span>&nbsp; /</span></li>', $linkedin, 'LinkedIn');
                }

                $pinterest = get_user_meta($user->ID, 'author_pinterest', true);
                if($pinterest != '') {
                  printf('<li><a href="%s" target="_blank" title="">%s</a> <span>&nbsp; /</span></li>', $pinterest, 'Pinterest');
                }

                $instagram = get_user_meta($user->ID, 'author_instagram', true);
                if($instagram != '') {
                  printf('<li><a href="%s" target="_blank" title="">%s</a> <span>&nbsp; /</span></li>', $iinterest, 'Instagram');
                }
              ?>
            </ul>
          </div>
          <div class="clearthis"></div>
          <?php /* author meta end */ ?>

        </div>
      </div>
    <?php } ?>
  </footer>
</article>
<div class="clearthis"></div>


