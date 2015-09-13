<style>
	.news-item-wrapper.advert.advert-premium .news-item .post-image 	{
		background-color: black !important;
		position: relative;
		padding: 12px;
	}
	
	.news-item-wrapper.advert.advert-premium .news-item .post-image img	{
		width: auto;
		height: auto;
	}
</style>

<div class="news-item-wrapper col-xs-12 col-sm-4 advert advert-premium">
  <div class="news-item">
    <div class="post-image">
      <?php if (function_exists('adrotate_group')) echo adrotate_group(1); ?>
      <!-- <img src="<?= get_template_directory_uri(); ?>/dist/images/blank-image.gif" class="placeholder"> -->
    </div>
  </div>
</div>