<?php

$image = get_sub_field( 'image' );
$description = get_sub_field( 'description' );

?>

<div class="px-5 w-full pointer-events-none flex flex-col gap-y-[10px]">

	<div class="Xaspect-video overflow-hidden js-element-blurin">

		<?= mi_get_image( $image, 'xl', 'w-full h-full object-cover' ); ?>

	</div>

	<?php if ( $description ) : ?>

		<div class="text-black [&_strong:first-child]:mr-5 [&_strong:first-child]:font-normal js-element-blurin">
			<?= $description; ?>
		</div>

	<?php endif; ?>

</div>