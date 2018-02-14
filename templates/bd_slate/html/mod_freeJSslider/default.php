<script type="text/javascript">
	window.addEvent('domready',function(){
		<?php if ($showarrows) { ?>
		var walkers<?php echo $uniqid ?> = document.getElements('#fJSs-handlers<?php echo $uniqid ?> span');
		<?php } ?>
		var fssp1_id<?php echo $uniqid ?> = new freeJSslider($('fJSs-<?php echo $uniqid ?>'), {
			size: {width: <?php echo $width; ?>, height: <?php echo $height; ?>},
			fxOptions: {duration:  <?php echo $speed; ?>, transition: Fx.Transitions.<?php echo $transition; ?>},
			<?php if ($showarrows) { ?>
			onWalk: function(i, j){
				$$(walkers<?php echo $uniqid ?>[i]).addClass('active');
				$$(walkers<?php echo $uniqid ?>[j]).removeClass('active');
			},
			onInitialized: function () {
				walkers<?php echo $uniqid ?>[0].addClass('active');
			},	
			<?php } ?>	
			transition: <?php echo "'" .$effects. "'"; ?>			
		});
		<?php if ($showarrows) { ?>
		fssp1_id<?php echo $uniqid ?>.addItemWalkers(walkers<?php echo $uniqid ?>);
		fssp1_id<?php echo $uniqid ?>.addPlayerControls('previous', [$('fJSs-prev<?php echo $uniqid;?>')]);
		fssp1_id<?php echo $uniqid ?>.addPlayerControls('next', [$('fJSs-next<?php echo $uniqid;?>')]);
		<?php } ?>
		
		<?php if ($autoplay) { ?>
		fssp1_id<?php echo $uniqid ?>.play(<?php echo $params->get('interval', 5000); ?>);
		<?php } ?>	
	});
</script>
<div id="freeJSslider_id<?php echo $uniqid ?>" class="fJSs">
	<div id="fJSs-<?php echo $uniqid ?>" style="overflow:hidden;position:relative;height:<?php echo $height ?>px;width:<?php echo $width ?>px">
		<?php foreach ($list as $item): ?>
			<div class="fJSs-content">
				<div class="fJSs-inner">
					<?php if ($showimage) { ?>	
						<?php if($imagelinked) { ?>
							<a href="<?php echo $item->link ?>"><img src="<?php echo $item->image ?>" alt="" class="fJSs-image" /></a>
						<?php } else { ?>
							<img src="<?php echo $item->image ?>" alt="" class="fJSs-image" />
						<?php } ?>			
					<?php } ?>
					<div class="fJSs-desc">
						<?php if($showtitle) { ?>
							<?php if($titlelinked) { ?>
								<h2 class="fJSs-title"><a href="<?php echo $item->link; ?>"><?php echo $item->title; ?></a></h2>
							<?php } else { ?>
								<h2 class="fJSs-title"><?php echo $item->title; ?></h2>
							<?php } ?>	
						<?php } ?>		
						
						<?php if($showarticle) { ?>
							<p class="fJSs-intro"><?php echo $item->introtext; ?></p>
						<?php } ?>
						
						<?php if($showmore) { ?>
							<br /><a class="readon" href="<?php echo $item->link; ?>"><?php echo $moretext ?></a>
						<?php } ?>
					</div>	
				</div>
			</div>
		<?php endforeach; ?>
	</div>
	<?php if ($showarrows) { ?>
		<div id="fJSs-handlers<?php echo $uniqid ?>" class="fJSs-controllers">
			<div id="fJSs-prev<?php echo $uniqid;?>" class="fJSs-prev"></div>
			<?php
				foreach ($list as $key=>$item) {
					echo '<span>' . $key . '</span>';	
				}	
			?>	
			<div id="fJSs-next<?php echo $uniqid;?>" class="fJSs-next"></div>
		</div>
	<?php } ?>	
</div>