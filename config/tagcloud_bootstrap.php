<?php

/**
 * Component
 */
	Croogo::hookComponent('*', 'Tagcloud.Tagcloud');
/**
 * Helper
 */
    Croogo::hookHelper('*', 'Tagcloud.Tagcloud');
/**
 * Admin menu (navigation)
 *
 * This plugin's admin_menu element will be rendered in admin panel under Extensions menu.
 */
    Croogo::hookAdminMenu('Tagcloud');

?>