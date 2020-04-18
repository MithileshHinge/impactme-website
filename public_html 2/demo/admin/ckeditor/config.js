/**
 * @license Copyright (c) 2003-2015, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	config.allowedContent = true;
config.extraAllowedContent = 'span;ul;li;table;td;i;style;*[id];*(*);*{*}';
CKEDITOR.dtd.$removeEmpty.i = 0; 
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
};
