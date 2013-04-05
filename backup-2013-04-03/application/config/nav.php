<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * The Link & text to appear in the adnim site
 */
$config['admin_nav'] = array(	'Home'			=> base_url().'admin',
								'Advertizements'=> base_url().'admin/ads',
								'Featured Models'=>base_url().'admin/featured',
								'Models'		=> base_url().'admin/subjects',
								//'Gossips'		=> base_url().'admin/gossips',
								'Events'		=> base_url().'admin/events',
								'News'		=> base_url().'admin/news',
								//'Projects'		=> '#',//base_url().'admin/projects',
								//'Services'		=> '#',//base_url().'admin/services',
								'Contact'		=> '#',//base_url().'admin/contact',
							);


/**
 * The Link & text to appear in the public site
 */

$config['nav'] = array(
						'Featured Models'	=> site_url('featured'),
						'Agency'			=> site_url('subjects'),
						'News & Gossips'	=> site_url('news'),
						'Events'			=> site_url('events'),
						'Music'				=> '#',
						'Videos'			=> '#',
						);




/* End of file nav.php */
/* Location: ./application/config/nav.php */
