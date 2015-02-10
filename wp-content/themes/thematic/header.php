<?php
/**
 * Header Template
 *
 * This template calls a series of functions that output the head tag of the document.
 * The body and div #main elements are opened at the end of this file.
 *
 * @package Thematic
 * @subpackage Templates
 */

	// Create doctype
	thematic_create_doctype();
	echo " ";
	language_attributes();
	echo ">\n";

	// Opens the head tag
	thematic_head_profile();

	// Create the meta content type
	thematic_create_contenttype();

	// Create the title tag
	thematic_doctitle();

	// Create the meta description
	thematic_show_description();

	// Create the tag <meta name="robots"
	thematic_show_robots();

	// Legacy feedlink handling
	if ( current_theme_supports( 'thematic_legacy_feedlinks' ) ) {
		// Creating the internal RSS links
		thematic_show_rss();

		// Create comments RSS links
		thematic_show_commentsrss();
	}

	// Create pingback adress
	thematic_show_pingback();

	/* The function wp_head() loads Thematic's stylesheet and scripts.
	 * Calling wp_head() is required to provide plugins and child themes
	 * the ability to insert markup within the <head> tag.
	 */
	wp_head();
?>
	<link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700' rel='stylesheet' type='text/css'>
	<link rel="apple-touch-icon" sizes="57x57" href="wp-content/themes/rhcbc/img/favicons/apple-touch-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="wp-content/themes/rhcbc/img/favicons/apple-touch-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="wp-content/themes/rhcbc/img/favicons/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="wp-content/themes/rhcbc/img/favicons/apple-touch-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="wp-content/themes/rhcbc/img/favicons/apple-touch-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="wp-content/themes/rhcbc/img/favicons/apple-touch-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="wp-content/themes/rhcbc/img/favicons/apple-touch-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="wp-content/themes/rhcbc/img/favicons/apple-touch-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="wp-content/themes/rhcbc/img/favicons/apple-touch-icon-180x180.png">
	<link rel="icon" type="image/png" href="wp-content/themes/rhcbc/img/favicons/wp-content/themes/rhcbc/img/faviconscon-32x32.png" sizes="32x32">
	<link rel="icon" type="image/png" href="wp-content/themes/rhcbc/img/favicons/wp-content/themes/rhcbc/img/faviconscon-194x194.png" sizes="194x194">
	<link rel="icon" type="image/png" href="wp-content/themes/rhcbc/img/favicons/wp-content/themes/rhcbc/img/faviconscon-96x96.png" sizes="96x96">
	<link rel="icon" type="image/png" href="wp-content/themes/rhcbc/img/favicons/android-chrome-192x192.png" sizes="192x192">
	<link rel="icon" type="image/png" href="wp-content/themes/rhcbc/img/favicons/wp-content/themes/rhcbc/img/faviconscon-16x16.png" sizes="16x16">
	<link rel="manifest" href="wp-content/themes/rhcbc/img/favicons/manifest.json">
	<meta name="msapplication-TileColor" content="#da532c">
	<meta name="msapplication-TileImage" content="wp-content/themes/rhcbc/img/favicons/mstile-144x144.png">
	<meta name="theme-color" content="#ffffff">
</head>

<?php
	// Create the body element and dynamic body classes
	thematic_body();

	// Action hook to place content before opening #wrapper
	thematic_before();
?>
	<?php
		// Filter provided for removing output of wrapping element follows the body tag
		if ( apply_filters( 'thematic_open_wrapper', true ) )
  		  echo ( '<div id="wrapper" class="hfeed">' );

		// Action hook for placing content above the theme header
		thematic_aboveheader();
	?>


		<?php
			// Filter provided for altering output of the header opening element
			echo ( apply_filters( 'thematic_open_header',  '<div id="header">' ) );
    	?>


        	<?php
				// Action hook creating the theme header
				thematic_header();
       		?>

    	<?php
    		// Filter provided for altering output of the header closing element
			echo ( apply_filters( 'thematic_close_header', '</div><!-- #header-->' ) );
		?>

    	<?php
			// Action hook for placing content below the theme header
			thematic_belowheader();
    	?>

	<div id="main">
