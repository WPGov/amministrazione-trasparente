<?php
/*
	This file is part of searchTaxonomyGT by Gabriel Tavares // http://www.gtplugins.com

    searchTaxonomyGT is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    searchTaxonomyGT is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with searchTaxonomyGT.  If not, see <http://www.gnu.org/licenses/>.
*/
global $wpdb;

function at_searchTaxonomyGT_enqueue_admin_scripts() {
	wp_register_script('searchTaxonomyGT_at_js', plugins_url('searchTaxonomyGT.js', __FILE__));
	wp_enqueue_script('searchTaxonomyGT_at_js');
}
add_action( 'admin_enqueue_scripts', 'at_searchTaxonomyGT_enqueue_admin_scripts' );
?>