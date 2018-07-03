<?php 
	$others = get_other_attachments(get_the_ID());

	if ($others != null) { ?>
		<div class="ui horizontal divider">Bilagor</div>
		<div class="ui list">
<?php		
		while ($others->get()) { ?>
			<a class="item" href="<?php echo $others->url(); ?>">
				<div class="ui label">
					<i class="large <?php the_attachment_icon($others->subtype()); ?> icon"></i>
						<?php echo $others->field('bildtext'); ?>
				</div>
			</a>
<?php 
		} ?>
		</div>
<?php 
	} 
	if (is_single()) {
		$images = get_image_attachments(get_the_ID());
		if ($images != null) { ?>		
			<div class="ui horizontal divider">Bildgalleri</div>
			<div class="ui horizontal stacked list">
<?php		
			while ($images->get()) { ?>
			<div class="item">
				<a href="<?php echo $images->url(); ?>" 
						 data-lightbox="gallery_<?php the_ID(); ?>"
						 data-title="<?php $images->field('bildtext'); ?>">
					<?php echo $images->image('thumbnail'); ?>
				</a>
			</div>
<?php 
			} ?> 
			</div>
<?php		
		} 
	} ?>
