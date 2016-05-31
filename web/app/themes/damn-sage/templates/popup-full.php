<?php 

$issue = get_field ('current_issue', 'option');
$issue_image   = get_field('magazine_taxonomy_image', 'magazine_' . $issue->term_id );
$issue_color = get_field ('issue_color', 'magazine_' . $issue->term_id );

?>

<div id="popup-content" class="popup-content">
	
	<a class="close-popup" href="">X</a>

	<h2>DON'T MISS A <span>DAM<span class="that-char">N</span>º</span> THING</h2>
	
	<div class="popup-content-middle">

		<div class="popup-content-left">

			<h3>Join <span>DAM<span class="that-char">N</span>º</span> <span style="color:<?php echo $issue_color; ?>;">+</span> now!</h3>

			<h4>
				With a subscription, you get unlimmited access to:
			</h4>

			<ul>
				<li>All articles of the current, and previous DAMn issues</li>
				<li>Premium articles and content, hidden to regular users</li>
				<li>The entire DAMn archive</li>
				<li>Much more to come!</li>
			</ul>

			<p>
				<a class="btn btn-lg btn-default marginTop text-uppercase" title="Join damn plus " href="/join-damn-plus" >SUBSCRIBE</a>
			</p>
		

		</div>

		<div class="popup-content-right">
			
			<h3>Subscription of <span>DAM<span class="that-char">N</span>º</span> <span style="color:<?php echo $issue_color; ?>;">Magazine</span></h3>

			<div class="popup-content-right-inner">
				
				<h4>
					6 issues for €70 (Europe)<br>
					172$ (rest of the world)
				</h4>

				<p>
					<a class="btn btn-lg btn-default marginTop text-uppercase" title="Subscribe Now" href="/back-issues/subscribe" >SUBSCRIBE</a>
				</p>

				<p class="divider">OR order a back issue:</p>

				<p>
					<a class="btn btn-lg btn-default text-uppercase" title="Order Back Issue" href="/back-issues/" >ORDER BACK ISSUE
					</a>
				</p>
			</div>


			<a class="popup-content-right-img" href="/back-issues/subscribe">
				<?php echo wp_get_attachment_image( $issue_image, 'medium' ); ?>
			</a>

		</div>

	</div>

	<div class="popup-subscribe-container">
		<h3>Subscribe to our mailing list</h3>
		<h4>While we finish DAMn+, subscribe to our maiing list to get the latest and hottest fresh from the oven</h4>

		<div class="popup-subscribe-fields">
				<?php echo do_shortcode( '[mc4wp_form id="15581"]' ); ?>
		</div>

	</div>
	

</div>