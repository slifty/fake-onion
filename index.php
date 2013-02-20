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

				<section class="b">
				<div class="group-1 con">
					<div class="main article-list">
						<div data-ct_section_name="video">
							<div data-layout-group="hp-video">
								<div data-layout="hp-video-normal">
									<section class="section" data-contentlist="hp-video-items">
									<h4>
									Video </h4>
									<article class="article featured" data-article-id="31320">
									<div class="picture">
										<a data-prefetch="http://www.theonion.com/articles/flock-of-suicidal-geese-drinking-up-the-courage-to,31353/" href="http://www.theonion.com/articles/flock-of-suicidal-geese-drinking-up-the-courage-to,31353/"><img data-retina-src="http://o.onionstatic.com/images/19/19588/16x9/350.hq.jpg?5167" data-src="http://o.onionstatic.com/images/19/19588/16x9/350.jpg?5167" src="data:image/gif;base64,R0lGODlhEAAJAIAAAP///wAAACH5BAEAAAAALAAAAAAQAAkAAAIKhI+py+0Po5yUFQA7" class=" lazy-load" width="350" height="196" alt="" title=""></a>
									</div>
									<div class="desc">
										<h1><a class="title" data-prefetch="http://www.theonion.com/video/nations-24-middle-class-citizen-glad-to-hear-obama,31320/" href="http://www.theonion.com/video/nations-24-middle-class-citizen-glad-to-hear-obama,31320/">Flock Of Suicidal Geese Drinking Up The Courage To Down Jetliner<i class="icon icon-facetime-video"></i></a></h1>
									</div>
									</article>
									<ul class="related" data-contentlist="hp-video-items">
										<li data-ct_section_name=":2"><a class="title" data-prefetch="http://www.theonion.com/video/study-reveals-conditions-in-womens-prisons-deplora,31313/" href="http://www.theonion.com/video/study-reveals-conditions-in-womens-prisons-deplora,31313/">Study Reveals Conditions In Women's Prisons Deplorably Unsexy<i class="icon icon-facetime-video"></i></a></li>
										<li data-ct_section_name=":3"><a class="title" data-prefetch="http://www.theonion.com/articles/man-didnt-expect-sex-with-prostitute-would-be-so-e,31304/" href="http://www.theonion.com/articles/man-didnt-expect-sex-with-prostitute-would-be-so-e,31304/">Man Didn't Expect Sex With Prostitute Would Be So Emotionally Fulfilling</a></li>
										<li data-ct_section_name=":4"><a class="title" data-prefetch="http://www.theonion.com/articles/devoted-abuser-stops-by-girlfriends-office-to-deli,31297/" href="http://www.theonion.com/articles/devoted-abuser-stops-by-girlfriends-office-to-deli,31297/">Devoted Abuser Stops By Girlfriend's Office To Deliver Surprise Threat</a></li>
										<li data-ct_section_name=":5"><a class="title" data-prefetch="http://www.theonion.com/articles/the-state-of-the-union-is-strong-says-man-responsi,31275/" href="http://www.theonion.com/articles/the-state-of-the-union-is-strong-says-man-responsi,31275/">'The State Of The Union Is Strong,' Says Man Responsible For Shielding Nation From Truth</a></li>
									</ul>
									</section>
								</div>
							</div>
						</div>
						<div data-ct_section_name="in_the_news">
							<div data-layout-group="hp-in-the-news">
								<div data-layout="hp-in-the-news-normal">
									<section class="section" data-contentlist="hp-in-the-news-items">
									<h4>
									In The News </h4>
									<article class="article featured" data-article-id="31306">
									<div class="picture">
										<a data-prefetch="http://www.theonion.com/articles/los-angeles-on-high-alert-as-lapd-back-on-regular,31306/" href="http://www.theonion.com/articles/los-angeles-on-high-alert-as-lapd-back-on-regular,31306/"><img data-retina-src="http://o.onionstatic.com/images/19/19557/16x9/350.hq.jpg?8874" data-src="http://o.onionstatic.com/images/19/19557/16x9/350.jpg?8874" src="data:image/gif;base64,R0lGODlhEAAJAIAAAP///wAAACH5BAEAAAAALAAAAAAQAAkAAAIKhI+py+0Po5yUFQA7" class=" lazy-load" width="350" height="196" alt="" title=""></a>
									</div>
									<div class="desc">
										<h1><a class="title" data-prefetch="http://www.theonion.com/articles/los-angeles-on-high-alert-as-lapd-back-on-regular,31306/" href="http://www.theonion.com/articles/los-angeles-on-high-alert-as-lapd-back-on-regular,31306/">Los Angeles On High Alert As LAPD Back On Regular Duty</a></h1>
									</div>
									</article>
									<ul class="related" data-contentlist="hp-in-the-news-items">
										<li data-ct_section_name=":2"><a class="title" data-prefetch="http://www.theonion.com/articles/world-surrenders-to-north-korea,31265/" href="http://www.theonion.com/articles/world-surrenders-to-north-korea,31265/">World Surrenders To North Korea</a></li>
										<li data-ct_section_name=":3"><a class="title" data-prefetch="http://www.theonion.com/articles/shitcaked-urinesoaked-man-determined-to-enjoy-carn,31289/" href="http://www.theonion.com/articles/shitcaked-urinesoaked-man-determined-to-enjoy-carn,31289/">Shit-Caked, Urine-Soaked Man Determined To Enjoy Carnival Cruise</a></li>
										<li data-ct_section_name=":4"><a class="title" data-prefetch="http://www.theonion.com/articles/weary-americans-land-ship-on-bright-promising-shor,31283/" href="http://www.theonion.com/articles/weary-americans-land-ship-on-bright-promising-shor,31283/">Weary Americans Land Ship On Bright, Promising Shores Of China</a></li>
										<li data-ct_section_name=":5"><a class="title" data-prefetch="http://www.theonion.com/articles/rich-white-people-get-latino-guy-to-do-some-work-f,31285/" href="http://www.theonion.com/articles/rich-white-people-get-latino-guy-to-do-some-work-f,31285/">Rich White People Get Latino Guy To Do Some Work For Them</a></li>
									</ul>
									</section>
								</div>
							</div>
						</div>
						<div data-ct_section_name="osn">
							<div data-layout-group="hp-osn">
								<div data-layout="hp-osn-normal">
									<section class="section" data-contentlist="hp-osn-items">
									<h4>
									Onion Sports News </h4>
									<article class="article featured" data-article-id="31372">
									<div class="picture">
										<a data-prefetch="http://www.theonion.com/articles/blake-griffin-heartbroken-after-catching-chris-pau,31372/" href="http://www.theonion.com/articles/blake-griffin-heartbroken-after-catching-chris-pau,31372/"><img data-retina-src="http://o.onionstatic.com/images/19/19600/16x9/350.hq.jpg?8419" data-src="http://o.onionstatic.com/images/19/19600/16x9/350.jpg?8419" src="data:image/gif;base64,R0lGODlhEAAJAIAAAP///wAAACH5BAEAAAAALAAAAAAQAAkAAAIKhI+py+0Po5yUFQA7" class=" lazy-load" width="350" height="196" alt="" title=""></a>
									</div>
									<div class="desc">
										<h1><a class="title" data-prefetch="http://www.theonion.com/articles/blake-griffin-heartbroken-after-catching-chris-pau,31372/" href="http://www.theonion.com/articles/blake-griffin-heartbroken-after-catching-chris-pau,31372/">Blake Griffin Heartbroken After Catching Chris Paul Throwing Lobs To Lamar Odom</a></h1>
									</div>
									</article>
									<ul class="related" data-contentlist="hp-osn-items">
										<li data-ct_section_name=":2"><a class="title" data-prefetch="http://www.theonion.com/articles/michael-jordan-celebrates-50th-birthday-with-last,31332/" href="http://www.theonion.com/articles/michael-jordan-celebrates-50th-birthday-with-last,31332/">Michael Jordan Celebrates 50th Birthday With Last People He Hasn't Completely Alienated Yet</a></li>
										<li data-ct_section_name=":3"><a class="title" data-prefetch="http://www.theonion.com/articles/gerald-green-incorporates-christopher-marlowes-doc,31328/" href="http://www.theonion.com/articles/gerald-green-incorporates-christopher-marlowes-doc,31328/">Gerald Green Incorporates Christopher Marlowe's 'Doctor Faustus' Into Slam Dunk</a></li>
										<li data-ct_section_name=":4"><a class="title" data-prefetch="http://www.theonion.com/articles/michael-vick-not-sure-hes-got-another-412-season-i,31314/" href="http://www.theonion.com/articles/michael-vick-not-sure-hes-got-another-412-season-i,31314/">Michael Vick Not Sure He's Got Another 4-12 Season In Him</a></li>
										<li data-ct_section_name=":5"><a class="title" data-prefetch="http://www.theonion.com/articles/new-atlanta-braves-logo-features-gruesome-depictio,31284/" href="http://www.theonion.com/articles/new-atlanta-braves-logo-features-gruesome-depictio,31284/">New Atlanta Braves Logo Features Gruesome Depiction Of Trail Of Tears</a></li>
									</ul>
									</section>
								</div>
							</div>
						</div>
						<section class="section" data-contentlist="hp-secondary-story-list" data-ct_section_name="c_section:4">
						<h4><a href="http://www.theonion.com/channels/politics/">Politics</a></h4>
						<article class="article featured" data-article-id="31285">
						<div class="picture">
							<a data-prefetch="http://www.theonion.com/articles/rich-white-people-get-latino-guy-to-do-some-work-f,31285/" href="http://www.theonion.com/articles/rich-white-people-get-latino-guy-to-do-some-work-f,31285/"><img data-retina-src="http://o.onionstatic.com/images/19/19539/16x9/350.hq.jpg?2063" data-src="http://o.onionstatic.com/images/19/19539/16x9/350.jpg?2063" src="data:image/gif;base64,R0lGODlhEAAJAIAAAP///wAAACH5BAEAAAAALAAAAAAQAAkAAAIKhI+py+0Po5yUFQA7" class=" lazy-load" width="350" height="196" alt="" title=""></a>
						</div>
						<div class="desc">
							<h1><a class="title" data-prefetch="http://www.theonion.com/articles/rich-white-people-get-latino-guy-to-do-some-work-f,31285/" href="http://www.theonion.com/articles/rich-white-people-get-latino-guy-to-do-some-work-f,31285/">Rich White People Get Latino Guy To Do Some Work For Them</a></h1>
						</div>
						</article>
						<ul class="related" data-contentlist="hp-secondary-story-list">
							<li data-ct_section_name=":2"><a class="title" data-prefetch="http://www.theonion.com/video/the-state-of-the-union-is-strong-says-man-responsi,31276/" href="http://www.theonion.com/video/the-state-of-the-union-is-strong-says-man-responsi,31276/">'The State Of The Union Is Strong,' Says Man Responsible For Shielding Nation From Truth&nbsp;<i class="icon icon-facetime-video"></i></a></li>
							<li data-ct_section_name=":3"><a class="title" data-prefetch="http://www.theonion.com/articles/area-man-relieved-to-hear-state-of-union-still-str,31274/" href="http://www.theonion.com/articles/area-man-relieved-to-hear-state-of-union-still-str,31274/">Area Man Relieved To Hear State Of Union Still Strong</a></li>
							<li data-ct_section_name=":4"><a class="title" data-prefetch="http://www.theonion.com/articles/completely-selfabsorbed-obama-gets-up-and-just-tal,31272/" href="http://www.theonion.com/articles/completely-selfabsorbed-obama-gets-up-and-just-tal,31272/">Completely Self-Absorbed Obama Gets Up And Just Talks For An Hour Straight</a></li>
							<li data-ct_section_name=":5"><a class="title" data-prefetch="http://www.theonion.com/articles/panicked-biden-interrupts-state-of-the-union-to-as,31271/" href="http://www.theonion.com/articles/panicked-biden-interrupts-state-of-the-union-to-as,31271/">Panicked Biden Interrupts State Of The Union To Ask If Erections Can Ever Be Medical Emergency</a></li>
						</ul>
						</section><section class="section" data-contentlist="hp-secondary-story-list" data-ct_section_name="c_section:5">
						<h4><a href="http://www.theonion.com/channels/local/">Local</a></h4>
						<article class="article featured" data-article-id="31373">
						<div class="picture">
							<a data-prefetch="http://www.theonion.com/articles/woman-rushed-into-cosmetic-surgery-with-8-glaring,31373/" href="http://www.theonion.com/articles/woman-rushed-into-cosmetic-surgery-with-8-glaring,31373/"><img data-retina-src="http://o.onionstatic.com/images/19/19601/16x9/350.hq.jpg?6176" data-src="http://o.onionstatic.com/images/19/19601/16x9/350.jpg?6176" src="data:image/gif;base64,R0lGODlhEAAJAIAAAP///wAAACH5BAEAAAAALAAAAAAQAAkAAAIKhI+py+0Po5yUFQA7" class="has_caption lazy-load" width="350" height="196" alt="" title=""></a>
						</div>
						<div class="desc">
							<h1><a class="title" data-prefetch="http://www.theonion.com/articles/woman-rushed-into-cosmetic-surgery-with-8-glaring,31373/" href="http://www.theonion.com/articles/woman-rushed-into-cosmetic-surgery-with-8-glaring,31373/">Woman Rushed Into Cosmetic Surgery With 8 Glaring Flaws</a></h1>
						</div>
						</article>
						<ul class="related" data-contentlist="hp-secondary-story-list">
							<li data-ct_section_name=":2"><a class="title" data-prefetch="http://www.theonion.com/articles/art-imitates-life-imitates-art-remarks-man-trapped,31331/" href="http://www.theonion.com/articles/art-imitates-life-imitates-art-remarks-man-trapped,31331/">'Art Imitates Life Imitates Art,' Remarks Man Trapped In Art Museum</a></li>
							<li data-ct_section_name=":3"><a class="title" data-prefetch="http://www.theonion.com/articles/mother-considers-son-quite-the-little-casanova,31300/" href="http://www.theonion.com/articles/mother-considers-son-quite-the-little-casanova,31300/">Mother Considers Son 'Quite The Little Casanova'</a></li>
							<li data-ct_section_name=":4"><a class="title" data-prefetch="http://www.theonion.com/articles/area-mans-knee-making-weird-sound,31246/" href="http://www.theonion.com/articles/area-mans-knee-making-weird-sound,31246/">Area Man's Knee Making Weird Sound</a></li>
							<li data-ct_section_name=":5"><a class="title" data-prefetch="http://www.theonion.com/articles/horribly-depressed-zookeeper-has-always-had-specia,31202/" href="http://www.theonion.com/articles/horribly-depressed-zookeeper-has-always-had-specia,31202/">Horribly Depressed Zookeeper Has Always Had Special Connection With Animals</a></li>
						</ul>
						</section><section class="section" data-contentlist="hp-secondary-story-list" data-ct_section_name="c_section:6">
						<h4><a href="http://www.theonion.com/channels/entertainment/">Entertainment</a></h4>
						<article class="article featured" data-article-id="31368">
						<div class="picture">
							<a data-prefetch="http://www.theonion.com/articles/film-character-moves-into-beautiful-brooklyn-brown,31368/" href="http://www.theonion.com/articles/film-character-moves-into-beautiful-brooklyn-brown,31368/"><img data-retina-src="http://o.onionstatic.com/images/19/19598/16x9/350.hq.jpg?4934" data-src="http://o.onionstatic.com/images/19/19598/16x9/350.jpg?4934" src="data:image/gif;base64,R0lGODlhEAAJAIAAAP///wAAACH5BAEAAAAALAAAAAAQAAkAAAIKhI+py+0Po5yUFQA7" class=" lazy-load" width="350" height="196" alt="" title=""></a>
						</div>
						<div class="desc">
							<h1><a class="title" data-prefetch="http://www.theonion.com/articles/film-character-moves-into-beautiful-brooklyn-brown,31368/" href="http://www.theonion.com/articles/film-character-moves-into-beautiful-brooklyn-brown,31368/">Film Character Moves Into Beautiful Brooklyn Brownstone After Getting Dream Publishing Job</a></h1>
						</div>
						</article>
						<ul class="related" data-contentlist="hp-secondary-story-list">
							<li data-ct_section_name=":2"><a class="title" data-prefetch="http://www.theonion.com/articles/vin-diesel-will-finally-kiss-car-in-fast-furious-6,31344/" href="http://www.theonion.com/articles/vin-diesel-will-finally-kiss-car-in-fast-furious-6,31344/">Vin Diesel Will Finally Kiss Car In 'Fast &amp; Furious 6'</a></li>
							<li data-ct_section_name=":3"><a class="title" data-prefetch="http://www.theonion.com/articles/chris-browns-agent-suggests-suicide-could-be-great,31342/" href="http://www.theonion.com/articles/chris-browns-agent-suggests-suicide-could-be-great,31342/">Chris Brown's Agent Suggests Suicide Could Be Great Career Move</a></li>
							<li data-ct_section_name=":4"><a class="title" data-prefetch="http://www.theonion.com/articles/person-one-season-ahead-in-tv-show-doling-out-coun,31340/" href="http://www.theonion.com/articles/person-one-season-ahead-in-tv-show-doling-out-coun,31340/">Person One Season Ahead In TV Show Doling Out Counsel Like Wise Elder</a></li>
							<li data-ct_section_name=":5"><a class="title" data-prefetch="http://www.theonion.com/articles/update-taylor-swift-back-together-with-former-flam,31292/" href="http://www.theonion.com/articles/update-taylor-swift-back-together-with-former-flam,31292/">UPDATE: Taylor Swift Back Together With Ex-Boyfriend Christopher Dorner</a></li>
						</ul>
						</section><section class="section" data-contentlist="hp-secondary-story-list" data-ct_section_name="c_section:7">
						<h4><a href="http://www.theonion.com/channels/business/">Business</a></h4>
						<article class="article featured" data-article-id="31338">
						<div class="picture">
							<a data-prefetch="http://www.theonion.com/articles/officemates-unwittingly-spend-entire-workday-talki,31338/" href="http://www.theonion.com/articles/officemates-unwittingly-spend-entire-workday-talki,31338/"><img data-retina-src="http://o.onionstatic.com/images/19/19582/16x9/350.hq.jpg?2993" data-src="http://o.onionstatic.com/images/19/19582/16x9/350.jpg?2993" src="data:image/gif;base64,R0lGODlhEAAJAIAAAP///wAAACH5BAEAAAAALAAAAAAQAAkAAAIKhI+py+0Po5yUFQA7" class=" lazy-load" width="350" height="196" alt="" title=""></a>
						</div>
						<div class="desc">
							<h1><a class="title" data-prefetch="http://www.theonion.com/articles/officemates-unwittingly-spend-entire-workday-talki,31338/" href="http://www.theonion.com/articles/officemates-unwittingly-spend-entire-workday-talki,31338/">Officemates Unwittingly Spend Entire Workday Talking To Each Other On Grindr</a></h1>
						</div>
						</article>
						<ul class="related" data-contentlist="hp-secondary-story-list">
							<li data-ct_section_name=":2"><a class="title" data-prefetch="http://www.theonion.com/articles/american-airlines-us-airways-merge-to-form-worlds,31302/" href="http://www.theonion.com/articles/american-airlines-us-airways-merge-to-form-worlds,31302/">American Airlines, US Airways Merge To Form World's Largest Inconvenience</a></li>
							<li data-ct_section_name=":3"><a class="title" data-prefetch="http://www.theonion.com/articles/website-humiliating-itself,31286/" href="http://www.theonion.com/articles/website-humiliating-itself,31286/">Website Humiliating Itself</a></li>
							<li data-ct_section_name=":4"><a class="title" data-prefetch="http://www.theonion.com/articles/coworkers-brought-to-place-of-unthinkable-intimacy,31247/" href="http://www.theonion.com/articles/coworkers-brought-to-place-of-unthinkable-intimacy,31247/">Coworkers Brought To Place Of Unthinkable Intimacy By Team-Building Exercise</a></li>
							<li data-ct_section_name=":5"><a class="title" data-prefetch="http://www.theonion.com/articles/target-demographic-growing-up-right-before-wistful,31211/" href="http://www.theonion.com/articles/target-demographic-growing-up-right-before-wistful,31211/">Target Demographic Growing Up Right Before Wistful Advertiser's Eyes</a></li>
						</ul>
						</section>
					</div>
				</div>
				<aside class="sidebar" data-ct_section_name="sidebar_bottom">
				<div data-ct_section_name=":1">
					<div data-layout-group="b1">
						<div data-layout="horoscopes">
							<section data-contentlist="horoscopes">
							<h4 data-ct_section_name=":title"><a href="http://www.theonion.com/features/horoscope/">Horoscope</a></h4>
							<article class="article" data-article-id="31356"><a class="picture" data-prefetch="http://www.theonion.com/articles/your-horoscopes-week-of-february-19-2013,31356/" href="http://www.theonion.com/articles/your-horoscopes-week-of-february-19-2013,31356/"><img src="http://www.theonion.com/static/onion/img/horoscopes/horoscope_aries.png" alt="Aries" style="background: #fff"></a>
							<h1><a class="title" data-prefetch="http://www.theonion.com/articles/your-horoscopes-week-of-february-19-2013,31356/" href="http://www.theonion.com/articles/your-horoscopes-week-of-february-19-2013,31356/">Your Horoscopes – Week Of February 19, 2013</a></h1>
							<div class="text">
								<strong>Aries</strong> There are a million reasons you shouldn't give up hope of ever finding love. None of them, however, are any good. <strong>Taurus</strong> Forces ...
							</div>
							</article></section>
						</div>
					</div>
				</div>
				<div data-ct_section_name=":2">
					<div data-layout-group="b2">
						<div data-layout="null">
							<!-- data goes here -->
						</div>
					</div>
				</div>
				<div data-ct_section_name=":3">
					<div data-layout-group="b3">
						<div data-layout="orn">
							<section data-contentlist="onion-radio-news">
							<h4 data-ct_section_name=":title"><a href="http://www.theonion.com/features/radio-news/">Radio News</a></h4>
							<article class="article" data-article-id="28811">
							<div class="picture">
								<a data-prefetch="http://www.theonion.com/audio/despite-lack-of-natural-disaster-thousands-flee-de,28811/" href="http://www.theonion.com/audio/despite-lack-of-natural-disaster-thousands-flee-de,28811/" data-article-id="28811"><img src="http://www.theonion.com/static/onion/img/radionews/radionews_icon_2x.png" width="45" height="60" border="0" alt="Onion Radio News"></a>
							</div>
							<h1><a class="title" data-prefetch="http://www.theonion.com/audio/despite-lack-of-natural-disaster-thousands-flee-de,28811/" href="http://www.theonion.com/audio/despite-lack-of-natural-disaster-thousands-flee-de,28811/">Despite Lack Of Natural Disaster, Thousands Flee Des Moines, Iowa</a></h1>
							</article>
							<ul class="related" data-contentlist="onion-radio-news">
								<li data-ct_section_name=":2"><a class="title" data-prefetch="http://www.theonion.com/audio/highest-blender-setting-successfully-drowns-out-an,28688/" href="http://www.theonion.com/audio/highest-blender-setting-successfully-drowns-out-an,28688/">Highest Blender Setting Successfully Drowns Out Angry Jamba Juice Customer</a></li>
								<li data-ct_section_name=":3"><a class="title" data-prefetch="http://www.theonion.com/audio/pea-farmers-say-they-alone-keep-peas-from-overrunn,28656/" href="http://www.theonion.com/audio/pea-farmers-say-they-alone-keep-peas-from-overrunn,28656/">Pea Farmers Say They Alone Keep Peas From Overrunning Planet</a></li>
							</ul>
							</section>
						</div>
					</div>
				</div>
				<div data-ct_section_name=":4">
					<div data-layout-group="b4">
					</div>
				</div>
				<div data-ct_section_name=":5">
					<div data-layout-group="b5">
						<div data-layout="letters-editor">
							<section data-contentlist="letters-editor">
							<h4><a data-prefetch="http://www.theonion.com/articles/now-what,31357/" href="http://www.theonion.com/articles/now-what,31357/" data-article-id="31357">Letters to the Editor</a></h4>
							<article class="article" data-article-id="31357">
							<div class="text">
								<p class="salutation">
									Dear <i>The Onion</i>,
								</p>
								<p>
									I picked up on the coded messages in the last issue. I have procured a live chicken and am awaiting further instruction.
								</p>
								<p class="valediction">
									Frank Cavin, Williamsburg, VA
								</p>
							</div>
							</article></section>
						</div>
					</div>
				</div>
				<div data-ct_section_name=":6">
					<div data-layout-group="b6">
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
			<h1 data-ct_section_name=":logo"><a href="http://www.avclub.com/" target="_blank" class="avclub bgcontain">
			<!--[if lt IE 9]><img src="http://www.theonion.com/static/onion/img/avclub_1x.png" width="80px" height="14px" alt="The A.V. Club" /><![endif]-->
			</a></h1>
			<div class="picture" data-ct_section_name=":picture">
				<a href="http://feedproxy.google.com/~r/avclub/daily/~3/ELG0huedS6E/"><img src="http://media.avclub.com/images/424/424475/16x9/627.jpg?7143"></a>
			</div>
			<ul data-ct_section_name=":list">
				<li data-ct_section_name=":1">
				<h2><a href="http://feedproxy.google.com/~r/avclub/daily/~3/ELG0huedS6E/">Cougar Town, "Flirting With Time"</a></h2>
				</li>
				<li data-ct_section_name=":2">
				<h2><a href="http://feedproxy.google.com/~r/avclub/daily/~3/xXpCP5LS5i0/">TV: Inventory: "I forget who I am--who am I?": 23-plus alter egos of sitcom characters</a></h2>
				</li>
				<li data-ct_section_name=":3">
				<h2><a href="http://feedproxy.google.com/~r/avclub/daily/~3/9ZM_vzWiRco/">Savage Love: February 20, 2013</a></h2>
				</li>
			</ul>
			</section><section class="col-2" data-ct_section_name=":2">
			<h1 data-ct_section_name=":logo"><a href="http://store.theonion.com/" target="_blank" class="onionstore bgcontain">
			<!--[if lt IE 9]><img src="http://www.theonion.com/static/onion/img/onionstore_1x.png" width="141px" height="16px" alt="Videocracy" /><![endif]-->
			</a></h1>
			<div class="picture" data-ct_section_name=":picture">
				<a href="http://store.theonion.com/p-5045-cheat-to-win-bracelet.aspx">
				<div class="empty" style="background-image:url('http://store.theonion.com/images/Product/medium/5045.jpg');background-position:center center;background-size:100%;width: 100%;">
				</div>
				</a>
			</div>
			<ul data-ct_section_name=":list">
				<li data-ct_section_name=":1">
				<h2><a href="http://store.theonion.com/p-5045-cheat-to-win-bracelet.aspx">Cheat To Win Bracelet, Limited Supply!</a></h2>
				</li>
				<li data-ct_section_name=":2">
				<h2><a href="http://store.theonion.com/p-5061-mens-cheat-to-win-t-shirt.aspx">Men's Cheat To Win T-Shirt</a></h2>
				</li>
				<li data-ct_section_name=":3">
				<h2><a href="http://store.theonion.com/p-4738-search-for-self-called-off-framed-5x7-print.aspx">Search For Self Called Off - Framed Print</a></h2>
				</li>
			</ul>
			</section><section class="col-3" data-ct_section_name=":3">
			<h1 data-ct_section_name=":logo"><a href="http://www.youtube.com/TheOnion/" target="_blank" class="onionyoutube bgcontain">
			<!--[if lt IE 9]><img src="http://www.theonion.com/static/onion/img/onionyoutube_1x.png" width="168px" height="16px" alt="The Onion Youtube" /><![endif]-->
			</a></h1>
			<div class="picture" data-ct_section_name=":picture">
				<a href="http://www.youtube.com/watch?v=_w-3xOMbEVE&amp;feature=youtube_gdata">
				<div class="empty" style="background-image:url('http://i.ytimg.com/vi/_w-3xOMbEVE/0.jpg');background-position:center center;background-size:100%;width: 100%;">
				</div>
				</a>
			</div>
			<ul data-ct_section_name=":list">
				<li data-ct_section_name=":1">
				<h2><a href="http://www.youtube.com/watch?v=_w-3xOMbEVE&amp;feature=youtube_gdata">America's Best Kisser? - America's Best - Ep. 6</a></h2>
				</li>
				<li data-ct_section_name=":2">
				<h2><a href="http://www.youtube.com/watch?v=HOJKjK-JQpQ&amp;feature=youtube_gdata">Frustrated Inner-City Students Running Out Of Ideas To Motivate Teachers</a></h2>
				</li>
				<li data-ct_section_name=":3">
				<h2><a href="http://www.youtube.com/watch?v=Bqe6IajjU4E&amp;feature=youtube_gdata">NASA Continues Search For Planet Capable Of Supporting NASA</a></h2>
				</li>
			</ul>
			</section>
		</div>
		<section class="col-4" data-ct_section_name=":4">
		<div>
			<h4>Follow The Onion</h4>
			<ul class="social" data-ct_section_name=":social">
				<li data-ct_section_name=":twitter"><a href="http://www.twitter.com/theonion"><span class="icon-large icon-twitter"></span></a></li>
				<li data-ct_section_name=":facebook"><a href="http://www.facebook.com/theonion"><span class="icon-large icon-facebook"></span></a></li>
				<li data-ct_section_name=":google_plus"><a href="https://plus.google.com/+TheOnion"><span class="icon-large icon-google-plus"></span></a></li>
			</ul>
		</div>
		<div data-ct_section_name=":newsletter">
			<h4>Receive The Newsletter</h4>
			<form action="http://www.theonion.com/newsletters/subscribe/" method="post">
				<input type="text" name="address" placeholder="Your E-Mail Address" class="subscribe"><input type="checkbox" name="newsletters" value="1" id="newsletter-daily"><label for="newsletter-daily">Daily</label><input type="checkbox" name="newsletters" value="3" id="newsletter-weekly"><label for="newsletter-weekly">Weekly</label><input type="submit" value="Submit">
			</form>
		</div>
		</section><section class="col-5" data-ct_section_name=":5"><nav>
		<ul>
			<li data-ct_section_name=":onion_live"><a href="http://www.theonion.com/live/">Onion Live!</a></li>
			<li data-ct_section_name=":personals"><a href="http://personals.theonion.com/" target="_blank">Personals</a></li>
			<li data-ct_section_name=":faq"><a href="http://www.theonion.com/faq/">FAQ</a></li>
			<li data-ct_section_name=":contact"><a href="http://www.theonion.com/contact/">Contact Us</a></li>
			<li data-ct_section_name=":jobs"><a href="http://www.theonion.com/jobs/">Jobs</a></li>
			<li data-ct_section_name=":media_kit"><a href="http://mediakit.theonion.com/">Media Kit</a></li>
			<li data-ct_section_name=":privacy"><a href="http://www.theonion.com/privacy/">Privacy Policy</a></li>
			<li data-ct_section_name=":franchising"><a href="http://www.theonionnation.com/">Franchising</a></li>
			<li data-ct_section_name=":rss"><a href="http://www.theonion.com/connect/"><i class="icon-rss"></i> RSS &amp; Apps</a></li>
		</ul>
		</nav>
		<p>
			The Onion is not intended for readers under 18 years of age. ©Copyright 2012 Onion Inc. All rights reserved
		</p>
		</section>
	</div>
	</footer>
</div>
<script type="text/javascript">window.STATIC_URL = '/static/';</script>
<script type="text/javascript">
			document.write(unescape("%3Cscript src='" + (document.location.protocol == "https:" ? "https://sb" : "http://b") + ".scorecardresearch.com/beacon.js' %3E%3C/script%3E"));
		</script>
<script src="http://b.scorecardresearch.com/beacon.js"></script>
<script type="text/javascript">
			var _gaq = _gaq || [];
			_gaq.push(['_setAccount', 'UA-223393-1'],
					  ['master._setAccount', 'UA-30070605-9'],
					  ['bigboy._setAccount', 'UA-30070605-1']);
			(function() {
			var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
			})();
			var ignoredOrganicKeywords = ['the onion', 'onion', 'theonion', 'onion news', 'the onion news', 'theonion.com', 'http://www.theonion.com', 'www.theonion.com', 'onion.com', 'the onion.com', 'the onio', 'http://theonion.com/'];
		</script>
<!-- quantcast -->
<script type="text/javascript">
		var _qevents = _qevents || [];
		(function() {
		var elem = document.createElement('script');
		elem.src = (document.location.protocol == "https:" ? "https://secure" : "http://edge") + ".quantserve.com/quant.js";
		elem.async = true;
		elem.type = "text/javascript";
		var scpt = document.getElementsByTagName('script')[0];
		scpt.parentNode.insertBefore(elem, scpt);
		})();
		</script>
<script type="text/javascript" src="http://s.ppjol.net/pp.js">{
		  'zone':"X7Gu3YIpecAvEgj6-27cd0",
		  'mode':"meter",
		  'customPreCheck': "preCheckOnion100821",
		  'border': "qtYGSqnP-QssVfyr5XPE6D",
		  'debug':0
		}</script>
<script type="text/javascript">
		function preCheckOnion100821($){
			loc = window.location + '';
			if (loc.match(/\/(articles|video)\/.+/i)) {
				return 1;
			}
			return 0;
		}
		</script>
<div id="BF_WIDGET_1">
	&nbsp;
	<script type="text/javascript" src="http://ct.buzzfeed.com/wd/UserWidget?u=theonion.com&amp;to=1&amp;or=vb&amp;wid=1&amp;cb=1361385909185"></script>
</div>
</iframe>
<style class="afns-ad-element">
					body.afns-ad-skin div#body-wrap{                        top: 125px !important;                    }
</style>
</body>
</html>
