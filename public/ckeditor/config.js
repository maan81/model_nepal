/*
Copyright (c) 2003-2012, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.editorConfig = function( config )
{
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';

	// Default Sizes are in pixels
	config.resize_minWidth = 550;
	config.resize_minHeight = 500;

	config.resize_maxWidth = 700;
	config.resize_maxHeight = 600;

	//for ajax save
	//config.removePlugins = "save";
	//config.extraPlugin   = 'ajaxplugin';

};