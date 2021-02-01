<?php
if(!function_exists('tmc_countdown')){
    function tmc_countdown($atts, $content){
        $date = $day_text = $hour_text = $min_text = $sec_text = '';
        extract(shortcode_atts( array(
            'date' 		=> '2020/05/15',
            'day_text' 	=> __('Days','tmc'),
            'hour_text' => __('Hour','tmc'),
            'min_text' 	=> __('Min','tmc'),
            'sec_text' 	=> __('Sec','tmc'),
        ), $atts ));

        $data_text 	= [
      		'day' 	=> $day_text,
      		'hour' 	=> $hour_text,
      		'min' 	=> $min_text,
      		'sec' 	=> $sec_text,
      	];
      	$data_text = json_encode($data_text);
      	wp_enqueue_script('jquery-coundown');
      	ob_start();
      	?>
        <div class="tmc-countdown-shortcode">
			<div id="tmc-clock" class="tmc-clock-shortcode"> data-date="<?php esc_attr_e($date);?>" data-text="<?php echo esc_attr($data_text);?>"></div>
        </div>
	    <?php 
		$content = ob_get_contents();
	    ob_end_clean();
	    return $content;
	}
    add_shortcode('tmc_countdown', 'tmc_countdown');
}