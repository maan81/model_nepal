<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * The Link & text to appear in the adnim site
 */
$config['admin_nav'] = array(	'Home'			=> site_url('admin'),
								'Advertizements'=> site_url('admin/ads'),
								'Featured Models'=>site_url('admin/featured'),
								'Models'		=> site_url('admin/subjects'),
								'Events'		=> site_url('admin/events'),
								'News'			=> site_url('admin/news'),
								//'Contests'		=> base_url('admin/contests'),
								'Featured Link'	=> site_url('admin/flinks'),
								//'Gossips'		=> base_url().'admin/gossips',
								//'Projects'		=> '#',//base_url().'admin/projects',
								//'Services'		=> '#',//base_url().'admin/services',
							);


/**
 * The Link & text to appear in the public site
 */

$config['nav'] = array(
						'Featured Models'	=> site_url('featured'),
						'Agency'			=> site_url('subjects'),
						'News &amp; Gossips'=> site_url('news'),
						'Events'			=> site_url('events'),
						//'Contests'			=> site_url('contests'),
						'Music'				=> '#',
						);




/* End of file nav.php */
/* Location: ./application/config/nav.php */
