<div class="project-time-list-header">
	<div class="time-list-header-col first" data-sort="first">
		<span>
			<?php if (!empty($data['filter_type'])):
			echo esc_html( $data['filter_type'] );
			endif ?>	
		</span>
	</div>
	<div class="time-list-header-col second" data-sort="title">
		<span>
			<?php 
				esc_html_e('Title', 'prague-plugins');
			?>
		</span>
	</div>
	<div class="time-list-header-col third" data-sort="third">
		<span>
			<?php if (!empty($data['filter_type_2'])):
			echo esc_html( $data['filter_type_2'] );
			endif ?>
		</span>
	</div>
	<div class="time-list-header-col fourth" data-sort="fourth">
		<span>
			<?php if (!empty($data['filter_type_3'])):
			echo esc_html( $data['filter_type_3'] );
			endif ?>
		</span>
	</div>
</div>