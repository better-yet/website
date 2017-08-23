<?php
get_header();

if (have_posts()) {
	while (have_posts()) {
		the_post();
		
		$types = wp_get_post_terms($post->ID, 'type');
		foreach ($types as &$type) {
			$type = '<span>' . $type->name . '</span>';
		}
		$types = implode(', ', $types);
?>

<main class="container">
	<div class="row project">
		<div class="col-md-8 attachments">
			<?php 
			$attachments = new Attachments('attachments');
			while ($attachments->get()) {
				
				if ($embed = $attachments->field('embed')) {
					echo '<div class="embed">' . $embed . '</div>';
				} else {?>
				<div style="background-image: url(<?php echo $attachments->src('two-thirds')?>);"></div>
				<?php }
			}?>
		</div>
		<div class="col-md-4 description">
			<div data-spy="affix" data-clampedwidth=".description">
				<h1><?php the_title()?></h1>
				<p class="types"><?php echo $types?></p>
				<?php the_content()?>
			</div>
		</div>
	</div>
</main>

<?php 
	}
}
get_footer();
?>