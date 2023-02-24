<p class="m-0">
		<?php 
			$rating = ModelHelper::getRating($product->rating ?? []);
		?>
		@for ($i = 1; $i <= 5; $i++)
			@if ($i <= $rating)
				<i class="bi bi-star-fill text-warning"></i>
			@else
				<i class="bi bi-star text-warning"></i>
			@endif
		@endfor
	<span class="text-warning">({{ count($product->rating ?? []) }})</span>
</p>