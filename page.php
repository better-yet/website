<?php
get_header();
the_post();

$attachments = new Attachments('attachments');
?>
<main class="container">
	
	<div class="row">
		<div class="col-md-8 col-md-offset-2 content">
			<?php the_content()?>

			<?php if ($attachments->exist()) {?>
			<div class="row attachments">
				<?php
				while ($attachments->get()) {
					if ($link = $attachments->field('link')) {
						echo '<div class="col-sm-6"><a href="' . $link . '"><img src="' . $attachments->src('one-third') . '" alt="' . $attachments->field('title') . '" class="img-responsive"></a></div>';
					} else {
						echo '<div class="col-sm-6"><img src="' . $attachments->src('one-third') . '" alt="' . $attachments->field('title') . '" class="img-responsive"></div>';
					}
				}
				?>
			</div>
			<?php }?>

		</div>
	</div>
		
</main>

<?php get_footer()?>