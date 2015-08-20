<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class(''); ?>>
    <header>
      <?php get_template_part('templates/entry-meta'); ?>
    </header>
    <div class="entry-content">
      <?php the_content(); ?>
    </div>

    <footer>
      <?php /* Author Info */ ?>
      <div class="author-wrapper">
        <?php get_template_part('templates/author-info'); ?>
      </div>

      <?php /* Tag Wrapper */ ?>
      <div class="tags-wrapper">
        <?php the_tags( 'Tags: ', ', ', '<br />' ); ?>
      </div>
      <?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>

      <?php /* Story Navigation */ ?>
      <div class="story-navigation">
        <?php $nextPost = get_next_post(); if($nextPost) { ?>
          <div class="nav-next col-xs-6">
            <?php $nextthumbnail = get_the_post_thumbnail($nextPost->ID, 'thumbnail'); ?>
            <?php next_post_link('%link',"$nextthumbnail &larr; %title"); ?>
          </div>
        <?php } ?>
        <?php $prevPost = get_previous_post(); if($prevPost) { ?>
          <div class="nav-previous col-xs-6 text-right pull-right">
            <?php $prevthumbnail = get_the_post_thumbnail($prevPost->ID, 'thumbnail' );?>
            <?php previous_post_link('%link',"$prevthumbnail %title &rarr;"); ?>
          </div>
        <?php } ?>
      </div>
    </footer>
  </article>
<?php endwhile; ?>

<?php /* Faebook Comments */ ?>
<?php comments_template('/templates/facebook-comments.php'); ?>

