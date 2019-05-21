<!doctype html>
<html <?php language_attributes(); ?> >
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' &mdash; '; } ?><?php bloginfo('description'); ?></title>

		<link href="//www.google-analytics.com" rel="dns-prefetch">
    	<link href="<?php echo get_template_directory_uri(); ?>/img/icons/icon.ico" rel="shortcut icon">
        <link href="<?php echo get_template_directory_uri(); ?>/img/icons/touch.png" rel="apple-touch-icon-precomposed">

		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width,initial-scale=1.0">
		<meta name="google-site-verification" content="5uTf9A5BJio4i93VgW4J_-9pjriwREKP9-RwVx-b5rQ" />

		<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/style.css">
		
		<div id="fb-root"></div>
		<script>
			(function(d, s, id) {
			  var js, fjs = d.getElementsByTagName(s)[0];
			  if (d.getElementById(id)) return;
			  js = d.createElement(s); js.id = id;
			  js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&appId=249975551830481&version=v2.0";
			  fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));

			var themeUrl = "<?php echo bloginfo('template_url');?>";
			var siteUrl = "<?php echo site_url(); ?>";

		</script>

		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
		<header id="header" class="header clear">
			<img class="logo" src="<?php echo get_template_directory_uri(); ?>/img/logo.png">
			<nav class="navigation"><?php grantex_nav(); ?></nav>
			<div class="toggle-wrap">
				<div class="toggle-bar"></div>
			</div>
		</header>