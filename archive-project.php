<?php get_header()?>

<main class="container">
	<div class="row projects">
		<?php
		$projects = get_posts(array('post_type' => 'project', 'orderby' => 'menu_order', 'order' => 'ASC', 'numberposts' => -1));
		foreach ($projects as $project) {
			$types = wp_get_post_terms($project->ID, 'type');
			foreach ($types as &$type) $type = $type->slug;
			?>
			<a class="col-xs-12 col-sm-6 col-md-4 <?php echo implode(' ', $types)?>" href="/<?php echo $project->post_name?>">
				<div style="background-image: url(<?php echo wp_get_attachment_image_src(get_post_thumbnail_id($project->ID), 'one-third')[0]?>);"></div>
				<span><?php echo $project->post_title?></span>
			</a>
		<?php }?>
	</div>	
</main>

<?php get_footer()?>