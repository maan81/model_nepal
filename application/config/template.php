<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
|--------------------------------------------------------------------------
| Active template
|--------------------------------------------------------------------------
|
| The $template['active_template'] setting lets you choose which template 
| group to make active.  By default there is only one group (the 
| "default" group).
|
*/
$template['active_template'] = 'site';

/*
|--------------------------------------------------------------------------
| Explaination of template group variables
|--------------------------------------------------------------------------
|
| ['template'] The filename of your master template file in the Views folder.
|   Typically this file will contain a full XHTML skeleton that outputs your
|   full template or region per region. Include the file extension if other
|   than ".php"
| ['regions'] Places within the template where your content may land. 
|   You may also include default markup, wrappers and attributes here 
|   (though not recommended). Region keys must be translatable into variables 
|   (no spaces or dashes, etc)
| ['parser'] The parser class/library to use for the parse_view() method
|   NOTE: See http://codeigniter.com/forums/viewthread/60050/P0/ for a good
|   Smarty Parser that works perfectly with Template
| ['parse_template'] FALSE (default) to treat master template as a View. TRUE
|   to user parser (see above) on the master template
|
| Region information can be extended by setting the following variables:
| ['content'] Must be an array! Use to set default region content
| ['name'] A string to identify the region beyond what it is defined by its key.
| ['wrapper'] An HTML element to wrap the region contents in. (We 
|   recommend doing this in your template file.)
| ['attributes'] Multidimensional array defining HTML attributes of the 
|   wrapper. (We recommend doing this in your template file.)
|
| Example:
| $template['default']['regions'] = array(
|    'header' => array(
|       'content' => array('<h1>Welcome</h1>','<p>Hello World</p>'),
|       'name' => 'Page Header',
|       'wrapper' => '<div>',
|       'attributes' => array('id' => 'header', 'class' => 'clearfix')
|    )
| );
|
*/

/*
|--------------------------------------------------------------------------
| Admin Template Configuration (adjust this or create your own)
|--------------------------------------------------------------------------
*/

$template['admin']['template']	= 'admin/admin.php';
$template['admin']['regions']	= array(
										'menu',
										'userlogged',
										'list',
										'new_item'
									);
$template['admin']['parser'] 	= 'parser';
$template['admin']['parser_method'] = 'parse';
$template['admin']['parse_template'] = FALSE;



/*
|--------------------------------------------------------------------------
| Admin's Login Template Configuration (adjust this or create your own)
|--------------------------------------------------------------------------
*/

$template['admin-login']['template'] = 'admin/admin-login.php';
$template['admin-login']['regions'] = array(
											   'username',
											   'password',
											   'footer',
											);
$template['admin-login']['parser'] = 'parser';
$template['admin-login']['parser_method'] = 'parse';
$template['admin-login']['parse_template'] = FALSE;


/*
|--------------------------------------------------------------------------
| Reseting username/password's form
|--------------------------------------------------------------------------
*/

$template['reset_user']['template'] = 'admin/reset_user.php';
$template['reset_user']['regions'] = array(
											   'email',
											   'footer',
											);
$template['reset_user']['parser'] = 'parser';
$template['reset_user']['parser_method'] = 'parse';
$template['reset_user']['parse_template'] = FALSE;

/*
|--------------------------------------------------------------------------
| Default Template Configuration (adjust this or create your own)
|--------------------------------------------------------------------------
*/

$template['site']['template'] = 'site';
$template['site']['regions'] = array(
   'header',
   'content',
   'footer',
);
$template['site']['parser'] = 'parser';
$template['site']['parser_method'] = 'parse';
$template['site']['parse_template'] = FALSE;

/* End of file template.php */
/* Location: ./system/application/config/template.php */
