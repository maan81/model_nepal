<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * The Link & text to appear in the adnim site
 */
$config['admin_nav'] = array(	'Home'			=> site_url('admin'),
								'Advertizements'=> site_url('admin/ads'),
								'Featured Models'=>site_url('admin/featured'),
								'Models'		=> site_url('admin/models'),
								'Events'		=> site_url('admin/events'),
								'News'			=> site_url('admin/news'),
								'Contests'		=> base_url('admin/contests'),
								'Featured Link'	=> site_url('admin/flinks'),
								//'File Management'=>site_url('admin/file_management'),
								//'Gossips'		=> base_url().'admin/gossips',
								//'Projects'		=> '#',//base_url().'admin/projects',
								//'Services'		=> '#',//base_url().'admin/services',
							);



/**
 * The Link & text to appear in the public site
 */

$config['nav'] = array(
						'Models'			=> site_url('featured'),
						'Agency'			=> site_url('models'),
						'Professionals'		=> '#',
						'News &amp; Gossips'=> site_url('news'),
						'Events'			=> site_url('events'),
						'Contests'			=> site_url('contests'),
						);




/* End of file nav.php */
/* Location: ./application/config/nav.php */
