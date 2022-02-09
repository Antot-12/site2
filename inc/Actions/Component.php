<?php

/**
 * Streamit\Utility\Actions\Component class
 *
 * @package streamit
 */

namespace Streamit\Utility\Actions;

use Streamit\Utility\Component_Interface;
use Streamit\Utility\Templating_Component_Interface;

/**
 * Class for managing comments UI.
 *
 * Exposes template tags:
 * * `streamit()->the_comments( array $args = array() )`
 *
 * @link https://wordpress.org/plugins/amp/
 */
class Component implements Component_Interface, Templating_Component_Interface
{
	/**
	 * Gets the unique identifier for the theme component.
	 *
	 * @return string Component slug.
	 */
	public function get_slug(): string
	{
		return 'actions';
	}
	public function initialize()
	{
	}
	/**
	 * Gets template tags to expose as methods on the Template_Tags class instance, accessible through `streamit()`.
	 *
	 * @return array Associative array of $method_name => $callback_info pairs. Each $callback_info must either be
	 *               a callable or an array with key 'callable'. This approach is used to reserve the possibility of
	 *               adding support for further arguments in the future.
	 */
	public function template_tags(): array
	{
		return array(
			'streamit_get_blog_readmore_link' => array($this, 'streamit_get_blog_readmore_link'),
			'streamit_get_blog_readmore' => array($this, 'streamit_get_blog_readmore'),
			'streamit_video_playbtn' => array($this, 'streamit_video_playbtn'),
		);
	}

	//** Blog Read More Button Link **//
	public function streamit_get_blog_readmore_link($link, $label = "Read More")
	{
		echo '<a class="button-link" href="' . esc_url($link) . '">' . esc_html($label) . '<i class="fas fa-angle-right" aria-hidden="true"></i></a>';
	}

	//** Blog Read More Button **//
	public function streamit_get_blog_readmore($link, $label)
	{
		echo '<a class="streamit-button" href="' . esc_url($link) . '">' . esc_html($label) . '</a>';
	}
	public function streamit_video_playbtn($streamit_options,$trailer_link)
	{
		if(empty($trailer_link)){return null;}

		?>
		<a href="<?php echo esc_url($trailer_link); ?>" class="video-open playbtn block-images position-relative <?php echo  esc_html($streamit_options['streamit_display_trailer_link_btn'] == 'no'?'playbtn_thumbnail':''); ?> ">
			<?php
			if ($streamit_options['streamit_display_trailer_link_btn'] == 'no') {
				if (!empty($trailer_img)) {
					if (!empty($trailer_img['alt'])) {
						$trailer_alt = $trailer_img['alt'];
					} else {
						$trailer_alt = 'image';
					}
					echo '  <img src="' . esc_url($trailer_img['sizes']['medium']) . '" alt="' . esc_attr($trailer_alt) . '">';
				} else {
					if (has_post_thumbnail()) {
						the_post_thumbnail('medium-large');
					}
				}
			}
			?>
			<span class="content btn btn-transparant iq-button">
				<?php
				if (isset($streamit_options['streamit_trailer_link_icon'])) {
					$streamit_trailer_link_icon = $streamit_options['streamit_trailer_link_icon'];
				}
				?>
				<i class="<?php echo esc_attr($streamit_trailer_link_icon); ?> mr-2"></i>
				<?php
				if (isset($streamit_options['streamit_trailer_link_text'])) {
				?>
					<span><?php echo esc_html($streamit_options['streamit_trailer_link_text']) ?></span>
				<?php }  ?>
			</span>
		</a>
	<?php
	}
}
