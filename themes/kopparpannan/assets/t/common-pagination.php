<?php 
	$link_array = get_kopparpannan_pagination();

	if ($link_array) {
?>
	<div class="ui pagination menu">
<?php 
		$keys = array_keys($link_array);
		foreach ($keys as $k) {
			if ($k == $link_array[$k]) {
				if (preg_match('/\d+/', $k)) {
					$add_class = "active ";
				} else {
					$add_class = '';
				}
?>				
				<div class="<?php echo $add_class; ?> item">
					<?php echo $k; ?>
				</div>
<?php				
			}
			else {
?>
				<a class="item" href="<?php echo $link_array[$k]; ?>">
					<?php echo $k; ?>
				</a>
<?php			
			}
		}				
?>
	</div>
<?php 	
	}
?>