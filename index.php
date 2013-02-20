<?php
	require_once('php/autoloader.php');
	require_once 'google-api-php-client/src/Google_Client.php';
	require_once 'google-api-php-client/src/contrib/Google_CustomsearchService.php';

	$feed = new SimplePie();
	$feed->set_feed_url("http://www.reddit.com/r/nottheonion/top/.rss?sort=top&t=day");
	$feed->init();
	$feed->handle_content_type();

	$items = array();
	foreach ($feed->get_items() as $item) {
		$items[] = $item;
	}

	session_start();

	function get_image($item) {
		return "http://horsebreedsinfo.com/images/brown_horse.jpg";
		$client = new Google_Client();
		$client->setApplicationName('Not The Onion');
		// Visit https://code.google.com/apis/console?api=plus to generate your
		// client id, client secret, and to register your redirect uri.
		$client->setDeveloperKey('AIzaSyB8aIN6bkHdoAt-2JGb5HRavVKR2NNw-fg');

		$search = new Google_CustomsearchService($client);
		$results = $search->cse->listCse($item->get_title(), array(
			'cx' => '003354642559472057163:xtnlqsrtqw8', // The custom search engine ID to scope this search query.
			'searchType' => 'image'
		));

		foreach($results["items"] as $result) {
			$title = $result["title"];
			return $result["link"];
		}
	}

	function get_tweet() {
		$url = 'http://api.twitter.com/1/statuses/user_timeline.json?screen_name=justinbieber&count=1';
		$tweets = json_decode(file_get_contents($url),TRUE);
		return $tweets[0]["text"];
	}

?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Sadly, this is not The Onion</title>
<meta name="HandheldFriendly" content="True">
<meta name="MobileOptimized" content="480">
<script async="" type="text/javascript" id="dfp_script" src="http://www.googletagservices.com/tag/js/gpt.js"></script>
<script src="http://edge.quantserve.com/quant.js" async="" type="text/javascript"></script>
<script type="text/javascript" async="" src="http://www.google-analytics.com/ga.js"></script>
<script type="text/javascript">
		var metadata = {"master_vpv_path": "http://www.theonion.com/onion/home/", "vpv_path": "http://www.theonion.com/vpv/home/", "targeting": {"dfp_pagetype": "home", "dfp_adchannel": "home", "dfp_site": "theonion", "dfp_articletype": "home"}};
	</script>
<link rel="stylesheet" href="http://www.theonion.com/static/CACHE/css/2903347c3113.css" type="text/css" media="all">
<link rel="stylesheet" href="http://www.theonion.com/static/CACHE/css/0f8c591ecd80.css" type="text/css">
<!--[if lt IE 9]><link rel="stylesheet" type="text/css" href="http://www.theonion.com/static/onion/css/redesign/ie.css" /><script type="text/javascript" src="http://www.theonion.com/static/onion/js/html5shiv.js"></script><script type="text/javascript" src="http://www.theonion.com/static/onion/js/html5shiv-printshiv.js"></script><script type="text/javascript" src="http://www.theonion.com/static/onion/js/respond.js"></script><![endif]-->
<link rel="canonical" href="http://www.theonion.com">
<link rel="alternate" type="application/rss+xml" title="The Onion: Daily News" href="http://feeds.theonion.com/theonion/daily">
<link rel="icon" type="image/png" href="favicon.ico">
</head>
<body id="" class="site_onion ga_section afns-ad-skin" name="default" data-ct_section_name="blank" style="overflow: visible;">
<section class="offpage" data-ct_section_name="offpage">
</section>
<div id="body-wrap">
	<div id="shadow" class="wrap">
	</div>
	<div class="wrap">
		<header class="site-header">
		<h1><a href="http://www.theonion.com/" title="Home - The Onion" class="bgcontain" style="background:url('onion-full.png');">
		<img src="onion-full.gif" alt="The On1on" title="The On1on" />
		</a></h1>
		<div id="meta-strip" class="inner-wrap">
			<div id="weather">
				<div class="image bgcontain" style="background-image: url('http://www.theonion.com/static/onion/img/icons/weather/sun_2x.png');">
					<div class="temp">
						42<sup>°</sup>
					</div>
					<!--[if lt IE 9]><img src="http://www.theonion.com/static/onion/img/icons/weather/sun_1x.png" alt="Partly cloudy" /><![endif]-->
				</div>
				<div class="forecast">
					It's not funny, cause it's true.
				</div>
			</div>
			<div id="networks" data-ct_section_name="social">
				<ul>
					<li class="av" data-ct_section_name="av"><a href="http://www.avclub.com/" target="_blank" class="bgcontain">
					<!--[if lt IE 9]><img src="http://www.theonion.com/static/onion/img/avclub-small_1x.png" alt="A.V. Club" title="A.V. Club" /><![endif]-->
					</a></li>
					<li class="social">
					<ul class="icons">
						<li><a href="#" class="facebook"><img src="http://www.theonion.com/static/onion/img/sharetools/facebook_2x.png" alt="Facebook"></a></li>
						<li class="trigger"><a href="#" class="twitter"><img src="http://www.theonion.com/static/onion/img/sharetools/twitter_2x.png" alt="Twitter"></a></li>
					</ul>
					<ul class="flyout">
						<li class="facebook">
						<iframe id="fb-like" data-src="http://www.theonion.com//www.facebook.com/plugins/likebox.php?href=http%3A%2F%2Fwww.facebook.com%2Ftheonion&amp;width=200&amp;height=70&amp;colorscheme=light&amp;show_faces=false&amp;border_color&amp;stream=false&amp;header=false&amp;appId=130164583741660" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:200px; height:70px;" allowtransparency="true">
						</iframe>
						</li>
						<li class="twitter"><a href="https://twitter.com/TheOnion" class="twitter-follow-button" data-show-count="false" data-size="large" data-show-screen-name="true">Follow @TheOnion</a>
						<div id="twitter-placeholder">
						</div>
						</li>
					</ul>
					</li>
				</ul>
			</div>
		</div>
		<a class="expansion-toggle"><img src="http://www.theonion.com/static/onion/img/mobile_navbtn.png" alt="Show/Hide Navigation"></a><nav class="main-nav" data-ct_section_name="nav">
		<div class="navigation">
			<ul class="links">
				<!-- <li class="video"><a href="http://www.theonion.com/articles/latest/video/">Video</a></li> -->
				<li class="video" style=""><a href="http://www.theonion.com/articles/latest/video/">Video</a></li>
				<li class="politics" style=""><a href="http://www.theonion.com/section/politics/">Politics</a></li>
				<li class="sports" style=""><a href="http://www.theonion.com/section/sports/">Sports</a></li>
				<li class="business" style=""><a href="http://www.theonion.com/section/business/">Business</a></li>
				<li class="science-technology" style=""><a href="http://www.theonion.com/section/science-technology/">Science/Tech</a></li>
				<li class="entertainment" style=""><a href="http://www.theonion.com/section/entertainment/">Entertainment</a></li>
				<li class="breaking" style=""><a href="http://www.theonion.com/breaking">Breaking</a></li>
				<li class="more" style="display: none;"><a href="#" onclick="return false">More <i class="icon-chevron-down"></i></a>
				<ul class="more-links" style="display: none;">
				</ul>
				</li>
			</ul>
		</div>
		<div class="search">
			<form action="http://www.theonion.com/search/">
				<button type="submit" value=""><i class="icon-large icon-search"></i></button><input type="text" name="q" value="Search" onclick="this.value=''; return false;" placeholder="Search">
			</form>
		</div>
		</nav></header>
		<div class="expansion">
			<div class="search">
				<button class="search-back">Back</button>
				<div class="search-field">
					<form id="mobilesearch" action="http://www.theonion.com/search/">
						<input type="text" class="" name="q" value="Search" onclick="this.value=''; return false;" placeholder="Search"><a href="#" onclick="$('#mobilesearch').submit()" class="icon-search icon-large"></a>
					</form>
				</div>
				<div class="results">
				</div>
			</div>
			<div class="nav con">
				<ul>
					<li class="video"><a href="http://www.theonion.com/articles/latest/video/">Video <i class="icon-chevron-right"></i></a></li>
					<li class="politics"><a href="http://www.theonion.com/section/politics/">Politics <i class="icon-chevron-right"></i></a></li>
					<li class="sports"><a href="http://www.theonion.com/section/sports/">Sports <i class="icon-chevron-right"></i></a></li>
					<li class="business"><a href="http://www.theonion.com/section/business/">Business <i class="icon-chevron-right"></i></a></li>
					<li class="sci-tech"><a href="http://www.theonion.com/section/science-technology/">Science/Tech <i class="icon-chevron-right"></i></a></li>
					<li class="entertainment"><a href="http://www.theonion.com/section/entertainment/">Entertainment <i class="icon-chevron-right"></i></a></li>
					<li class="breaking"><a href="http://www.theonion.com/breaking/">Breaking <i class="icon-chevron-right"></i></a></li>
				</ul>
			</div>
		</div>
		<div id="guts">
			<div class="homepage homebase">
				<section class="a">
				<div class="group-1 con">
					<div class="main">
						<div data-ct_section_name="main">
							<div data-layout-group="hp-main">
								<div data-layout="hp-main-story-only">
									<div class="feature con primary">
										<?php $item = array_shift($items); ?>
										<article data-contentlist="lead-story" class="article" data-article-id="31373">
										<div class="picture">
											<a href="<?php echo($item->get_permalink()); ?>"><img src="<?php echo(get_image($item));?>" class="lazy-loaded" width="350" height="196" alt="" title=""></a>
										</div>
										
										<h1><a class="title" href="<?php echo($item->get_permalink()); ?>"><?php echo($item->get_title()); ?></a></h1>
										</article>
									</div>
								</div>
							</div>
						</div>
						<div data-ct_section_name="secondary">
							<div data-layout-group="hp-secondary">
								<div data-layout="hp-secondary-four-stories">
									<div data-contentlist="hp-secondary-story-list">
										<div class="feature con secondary supporting" data-ct_section_name=":1">
											<?php $item = array_shift($items); ?>
											<article class="article" data-article-id="31373">
											<div class="picture">
												<a href="<?php echo($item->get_permalink()); ?>"><img src="<?php echo(get_image($item));?>" class="lazy-loaded" width="350" height="196" alt="" title=""></a>
											</div>
											<h1><a class="title" href="<?php echo($item->get_permalink()); ?>"><?php echo($item->get_title()); ?></a></h1>
											</article>
										</div>
										<div class="feature con tertiary supporting" data-ct_section_name=":2">
											<?php $item = array_shift($items); ?>
											<article class="article" data-article-id="31362">
											<div class="picture">
												<a href="<?php echo($item->get_permalink()); ?>"><img src="<?php echo(get_image($item));?>" class="lazy-loaded" width="350" height="196" alt="" title=""></a>
											</div>
											<h1><a class="title" href="<?php echo($item->get_permalink()); ?>"><?php echo($item->get_title()); ?></a></h1>
											<div class="text"></div>
											</article>
										</div>
										<div class="feature con quaternary supporting" data-ct_section_name=":3">
											<?php $item = array_shift($items); ?>
											<article class="article" data-article-id="31354">
											<div class="picture">
												<a href="<?php echo($item->get_permalink()); ?>"><img src="<?php echo(get_image($item));?>" class="lazy-loaded" width="350" height="196" alt="" title=""></a>
											</div>
											<h1><a class="title" href="<?php echo($item->get_permalink()); ?>"><?php echo($item->get_title()); ?></a></h1>
											<div class="text">
											</div>
											</article>
										</div>
										<div class="feature con quinary supporting" data-ct_section_name=":4">
											<?php $item = array_shift($items); ?>
											<article class="article" data-article-id="31355">
											<div class="picture">
												<a href="<?php echo($item->get_permalink()); ?>"><img src="<?php echo(get_image($item));?>" class="lazy-loaded" width="350" height="196" alt="" title=""></a>
											</div>
											<h1><a class="title" href="<?php echo($item->get_permalink()); ?>"><?php echo($item->get_title()); ?></a></h1>
											<div class="text">
											</div>
											</article>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<aside class="content-list">
					<div data-layout-group="hp-recent-news">
						<div data-layout="hp-recent-and-highlights">
							<section class="recent-news" data-ct_section_name="recent_news">
							<h4><span class="icon-time icon-large icon"></span> Recent News</h4>
							<div data-contentlist="recent-news-feature" class="featured">
								<?php $item = array_shift($items); ?>
								<div class="picture">
									<a href="<?php echo($item->get_permalink()); ?>"><img src="<?php echo(get_image($item));?>" class="lazy-loaded" width="350" height="196" alt="" title=""><i class="icon-play-circle"></i></a>
								</div>
								<h1><a class="title" href="<?php echo($item->get_permalink()); ?>"><?php echo($item->get_title()); ?></a></h1>
								<div class="meta">
								</div>
							</div>
							<div data-contentlist="recent-news-items" class="list" data-ct_section_name=":list">
								<?php $item = array_shift($items); ?>
								<a class="title" href="<?php echo($item->get_permalink()); ?>"><?php echo($item->get_title()); ?></a>
								<?php $item = array_shift($items); ?>
								<a class="title" href="<?php echo($item->get_permalink()); ?>"><?php echo($item->get_title()); ?></a>
								<?php $item = array_shift($items); ?>
								<a class="title" href="<?php echo($item->get_permalink()); ?>"><?php echo($item->get_title()); ?></a>
								<?php $item = array_shift($items); ?>
								<a class="title" href="<?php echo($item->get_permalink()); ?>"><?php echo($item->get_title()); ?></a>
							</div>
							</section><section class="news-highlight bordered" data-ct_section_name="highlights">
							<div class="inner">
								<h4><span class="icon-globe icon-large icon"></span> News Highlights</h4>
								<div data-contentlist="highlights-feature" class="featured" data-ct_section_name=":featured">
									<?php $item = array_shift($items); ?>
									<div class="picture">
										<a href="<?php echo($item->get_permalink()); ?>"><img src="<?php echo(get_image($item));?>" class="lazy-loaded" width="350" height="196" alt="" title=""></a>
									</div>
									<h1><a class="title" href="<?php echo($item->get_permalink()); ?>"><?php echo($item->get_title()); ?></a></h1>
								</div>
								<div data-contentlist="highlights-items" class="list">
									<?php $item = array_shift($items); ?>
									<a class="title" href="<?php echo($item->get_permalink()); ?>"><?php echo($item->get_title()); ?></a>
									<?php $item = array_shift($items); ?>
									<a class="title" href="<?php echo($item->get_permalink()); ?>"><?php echo($item->get_title()); ?></a>
								</div>
							</div>
							</section>
						</div>
					</div>
					</aside>
				</div>
				<aside class="sidebar" data-ct_section_name="sidebar_top">
				<div data-ct_section_name=":3">
					<div data-layout-group="a3">
						<div data-layout="american-voices">
							<?php $item = array_shift($items); ?>
							<section data-contentlist="american-voices">
							<h4 data-ct_section_name=":title"><a href="http://www.theonion.com/features/american-voices/">American Voices</a></h4>
							<article data-article-id="31364" data-ct_section_name=":1">
							<h1><a class="title" href="<?php echo($item->get_permalink()); ?>"><?php echo($item->get_title()); ?></a></h1>
							<div class="picture" data-ct_section_name=":image">
								<a href="https://twitter.com/justinbieber"><img class="lazy-loaded" src="http://s6.favim.com/orig/61/justin-bieber-justin-bieber-photography-justin-bieber-images-justin-bieber-photos-justin-bieber-pictures-Favim.com-613705.jpg"></a>
							</div>
							<div class="text">
								“<?php echo(get_tweet()); ?>”
							</div>
							</article>
							<ul class="related" data-contentlist="american-voices">
								<?php $item = array_shift($items); ?>
								<li><a class="title" href="<?php echo($item->get_permalink()); ?>"><?php echo($item->get_title()); ?></a></li>
								<?php $item = array_shift($items); ?>
								<li><a class="title" href="<?php echo($item->get_permalink()); ?>"><?php echo($item->get_title()); ?></a></li>
								<?php $item = array_shift($items); ?>
								<li><a class="title" href="<?php echo($item->get_permalink()); ?>"><?php echo($item->get_title()); ?></a></li>
							</ul>
							</section>
						</div>
					</div>
				</div>
				<div>
					<div data-layout-group="a3">
								<?php $item = array_shift($items); ?>
								<div class="picture">
									<a href="<?php echo($item->get_permalink()); ?>"><img src="<?php echo(get_image($item));?>" class="lazy-loaded" width="350" height="196" alt="" title=""><i class="icon-play-circle"></i></a>
								</div>
								<h1><a class="title" href="<?php echo($item->get_permalink()); ?>"><?php echo($item->get_title()); ?></a></h1>
								<div class="meta">
								</div>

					</div>
				</div>
				<div data-ct_section_name=":5">
					<div data-layout-group="a5">
						<div data-layout="null">
							<!-- data goes here -->
						</div>
					</div>
				</div>
				</aside></section>
			</div>
		</div>
	</div>
	<footer class="site-footer" data-ct_section_name="footer">
	<div class="wrap">
		<div>
			<section class="col-1" data-ct_section_name=":1">
			<ul data-ct_section_name=":list">
				<li data-ct_section_name=":1">
				<h2>This isn't actually the onion.</h2>
				</li>
				<li data-ct_section_name=":2">
				<h2>All these headlines are real.</h2>
				</li>
				<li data-ct_section_name=":3">
				<h2>Isn't that depressing?</h2>
				</li>
			</ul>
			</section>
			<section class="col-2" data-ct_section_name=":1">
			</section>
			<section class="col-3" data-ct_section_name=":1">
			</section>
		</div>
		<section class="col-4" data-ct_section_name=":4">
		</section>
		<section class="col-5" data-ct_section_name=":5"><nav>
		<p>
			The Onion has nothing to do with this site, we don't represent them.
		</p>
		</section>
	</div>
	</footer>
</div>
<style class="afns-ad-element">
					body.afns-ad-skin div#body-wrap{                        top: 125px !important;                    }
</style>
</body>
</html>
