<?php
	//Format the tags according to the needs of formulateTagcloud()
	$formatted_tags = array();
	foreach($tags as $tag) {
		$formatted_tags[$tag['title']] = $tag['weight'];
	}
	$formatted_tags = $this->Tagcloud->formulateTagCloud($formatted_tags);
?>
<section class="block <?php echo $block['Block']['class']; ?>">
	<header>
		<h3><?php echo $block['Block']['title']; ?></h3>
	</header>
	<div id="vocabulary-2" class="vocabulary">
		<ul>
			<?php
				foreach ($tags as $tag) {
					echo '<li>';
					echo $this->Html->link($tag['title'], array(
						'controller' => 'nodes',
					    'action' => 'term',
					    'type' => 'blog',
					    'slug' => $tag['slug'],
					), array('style' => 'font-size:' . $formatted_tags[$tag['title']]['size'] . '%'));
					echo '<span class="small">(' . $tag['weight'] . ')</small></li>';
				}
			?>
		</ul>
	</div>
</section>