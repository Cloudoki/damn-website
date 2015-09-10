<?php /* damn plus badge */ ?>
<?php
if(is_protected_by_s2member()) { ?>
  <div class="damn-plus-badge">
    <img src="<?= get_template_directory_uri(); ?>/dist/images/damnplus-sm.png" alt="DAMn+" />
  </div>
<?php } ?>