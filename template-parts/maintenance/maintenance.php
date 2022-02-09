<?php
get_template_part('template-parts/maintenance/header');

$streamit_options = get_option('streamit_options');
if ($streamit_options['maintenance_radio'] == 1) {

	if (isset($streamit_options['maintenance_bg_image']['url'])) {
		$m_bgurl = $streamit_options['maintenance_bg_image']['url'];
	}
?>
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="maintenance" <?php if (!empty($m_bgurl)) { ?> style="background: url(<?php echo esc_url($m_bgurl); ?> );" <?php } ?>>

					<h2 class="mb-3"><?php $maintenance_title = $streamit_options['maintenance_title'];
										echo esc_html($maintenance_title); ?></h2>
					<p><?php $mainten_desc = $streamit_options['mainten_desc'];
						echo esc_html($mainten_desc); ?></p>
				</div>
			</div>
		</div>
	</div>
<?php
}
if ($streamit_options['maintenance_radio'] == 2) {
?>
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<?php
				if (isset($streamit_options['coming_soon_bg_image']['url'])) {
					$coming_bgurl = $streamit_options['coming_soon_bg_image']['url'];
				}
				?>
				<div class="iq-coming text-center" <?php if (!empty($coming_bgurl)) { ?> style="background: url(<?php echo esc_url($coming_bgurl); ?> );" <?php } ?>>
					<div class="iq-coming-inner">
						<div class="iq-maintenance-text">
							<h1 class="mb-3">
								<?php $coming_title = $streamit_options['coming_title'];
								echo esc_html($coming_title); ?>
							</h1>
							<p>
								<?php $coming_desc = $streamit_options['coming_desc'];
								echo esc_html($coming_desc); ?>
							</p>
						</div>
						<?php
						if (!empty($streamit_options['opt_date'])) {
							$date = $streamit_options['opt_date'];
							$date = date_create_from_format('m/d/Y', $date);
							$date = $date->format('F d,Y');
						?>
							<div class="expire_date" id="<?php echo esc_attr($date); ?>"></div>
							<ul class="example mb-0 pl-0 countdown">
								<li><span class="days"><?php echo esc_html__('00', 'streamit'); ?></span>
									<p class="days_text"><?php esc_html__('Days', 'streamit'); ?></p>
								</li>

								<li><span class="hours"><?php echo esc_html__('00', 'streamit'); ?></span>
									<p class="hours_text"><?php esc_html__('Hours', 'streamit'); ?></p>
								</li>

								<li><span class="minutes"><?php echo esc_html__('00', 'streamit'); ?></span>
									<p class="minutes_text"><?php esc_html__('Minutes', 'streamit'); ?></p>
								</li>

								<li><span class="seconds"><?php echo esc_html__('00', 'streamit'); ?></span>
									<p class="seconds_text"><?php esc_html__('Seconds', 'streamit'); ?></p>
								</li>
							</ul>
					</div>
				<?php
						}
				?>
				</div>
			</div>
		</div>
	</div>
<?php
}
get_template_part('template-parts/maintenance/footer');
