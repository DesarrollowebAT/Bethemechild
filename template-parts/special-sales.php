<!-- Conditonal check specials sales -->
<?php
// vars
$SpecialSales = get_field('LabelSellCourse');
// check
if( $SpecialSales ): ?>
<div>
	<?php foreach( $SpecialSales as $SpecialSales ): ?>
		<div class="LabelSpecial"><?php echo $SpecialSales; ?></div>
	<?php endforeach; ?>
</div>
<?php endif; ?>
<!-- End conditonal check specials sales -->
