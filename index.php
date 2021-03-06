<?php
	require_once('vendor/autoload.php');
	require_once 'google-api-php-client/src/Google_Client.php';
	require_once 'google-api-php-client/src/contrib/Google_CustomsearchService.php';
	$feed = new SimplePie();
	$feed->set_feed_url("https://www.reddit.com/r/nottheonion/top/.rss?limit=25&sort=top&t=week");
	$feed->set_cache_duration(60);
	$feed->init();
	$feed->handle_content_type();

	// Load the image cache
	global $image_cache;
	global $image_cache_location;
	global $GOOGLE_API_OVERUSE;
	$GOOGLE_API_OVERUSE = false;
	$image_cache_location = "cache/images.json";
	if(!file_exists($image_cache_location)) {
		$f = fopen($image_cache_location,'w');
		fwrite($f, "{}");
		fclose($f);
	}
	$image_cache = json_decode(file_get_contents($image_cache_location), true);

	$tweet_cache_location = "cache/tweets.json";
	if(!file_exists($tweet_cache_location)) {
		$f = fopen($tweet_cache_location,'w');
		fwrite($f, "{}");
		fclose($f);
	}
	$tweet_cache = json_decode(file_get_contents($tweet_cache_location), true);

	$items = array();
	foreach ($feed->get_items() as $item) {
		$items[] = $item;
	}

	session_start();
	
	function get_url($item) {
		if(!$item)
			return "";

		// NOTE: I had to do a DISGUSTING hack to SimplePie to get this to work.  Like, really terrible.  Somewhere around line 9000 of the library
		$description = $item->get_description();
		preg_match_all('/(")(https?\:\/\/[^"]*)/', $description, $parts);
		foreach($parts[2] as $url) {
			if(strpos($url, "reddit.com") === false
			&& strpos($url, "redditmedia.com") === false)
				return $url;
		}
		return "";
	}

	function get_title($item) {
		if(!$item)
			return "";
		$title = $item->get_title();
		$title = preg_replace('/”/', '"', $title);
		$title = preg_replace('/‘/', "'", $title);
		$title = preg_replace('/’/', "'", $title);
		$title = preg_replace('/"/', "'", $title);
		$title = preg_replace('/(\W|^)[\'](.*)[\'](\W|$)/', '$1$2$3',$title);
		return $title;
	}

	function get_image($item) {
		if(!$item)
			return "";
		global $image_cache;
		global $image_cache_location;
		global $GOOGLE_API_OVERUSE;

		if(array_key_exists($item->get_title(), $image_cache))
			return $image_cache[$item->get_title()];

		$title = $item->get_title();
		$image_url = "http://horsebreedsinfo.com/images/brown_horse.jpg";
		
		$client = new Google_Client();
		$client->setApplicationName('Not The Onion');
		$client->setDeveloperKey('AIzaSyAlZ6Rt-PAmZY-1RFFki6XU1MMChGAt9mY');
		//$client->setDeveloperKey('AIzaSyB8aIN6bkHdoAt-2JGb5HRavVKR2NNw-fg');
		try {
			if(!$GOOGLE_API_OVERUSE) {
				$search = new Google_CustomsearchService($client);
				$results = $search->cse->listCse($title, array(
					//'cx' => '003354642559472057163:xtnlqsrtqw8', // The custom search engine ID to scope this search query.
					'cx' => '000165549053786166966:ql3eaq3lk9w',
					'searchType' => 'image'
				));

				$image_url = $results["items"][0]["link"];

				$img = 'cache/'.preg_replace("/[^A-Za-z0-9]/", "",array_shift(explode('?', basename($image_url))));
				file_put_contents($img, file_get_contents($image_url));

				$image_url = $img;
				$image_cache[$title] = $image_url;
				$f = fopen($image_cache_location,'w');
				fwrite($f, json_encode($image_cache));
				fclose($f);
			}
		} catch(Exception $e) {
			print_r($e->getMessage());
			exit();
			$GOOGLE_API_OVERUSE = true;
		}

		return $image_url;
	}

	function get_tweet() {
		global $tweet_cache;
		global $tweet_cache_location;
		$time = time();
		if(array_key_exists("time", $tweet_cache) && $tweet_cache["time"] > $time - 900) // 15 minute cache
			return $tweet_cache["tweet"];

		$url = 'http://api.twitter.com/1/statuses/user_timeline.json?screen_name=justinbieber&count=1';

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$output = curl_exec($ch);
		$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE); //get the code of request
		curl_close($ch);
		
		$tweet_cache["time"] = $time;
		$tweet_cache["tweet"] = "gonna rest up. Manchester tonight. #BELIEVEtour";

		if($httpCode == 200) {
			$tweets = json_decode(file_get_contents($url),TRUE);

			$tweet_cache["time"] = $time;
			$tweet_cache["tweet"] = $tweets[0]["text"];
		}

		$f = fopen($tweet_cache_location,'w');
		fwrite($f, json_encode($tweet_cache));
		fclose($f);

		return $tweet_cache["tweet"];
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
		var metadata = {"master_vpv_path": "http://www.theon1on.com", "vpv_path": "http://www.theon1on.com", "targeting": {"dfp_pagetype": "home", "dfp_adchannel": "home", "dfp_site": "theonion", "dfp_articletype": "home"}};
</script>
<link rel="stylesheet" href="css/1.css" type="text/css" media="all">
<link rel="stylesheet" href="css/2.css" type="text/css">
<!--[if lt IE 9]><link rel="stylesheet" type="text/css" href="css/ie.css" /><![endif]-->
<link rel="canonical" href="http://www.theon1on.com">
<link rel="icon" type="image/png" href="favicon.ico">
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36889397-4']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</head>
<body id="" class="site_onion ga_section afns-ad-skin" name="default" data-ct_section_name="blank" style="overflow: visible;">
<section class="offpage" data-ct_section_name="offpage">
</section>
<div id="body-wrap">
	<div id="shadow" class="wrap">
	</div>
	<div class="wrap">
		<header class="site-header">
		<h1><a href="http://www.theon1on.com/" title="Home - The Onion" class="bgcontain" style="background:url('ononeon.png');">
		</a></h1>
		<div id="meta-strip" class="inner-wrap">
			<div id="weather">
				<div class="image bgcontain" style="background-image: url('/static/onion/img/icons/weather/sun_2x.png');">
					<div class="temp">
						42<sup>°</sup>
					</div>
				</div>
				<div class="forecast">
					It's not funny, cause it's true.
				</div>
			</div>
			<div id="networks" data-ct_section_name="social">
				<ul>
					<li class="social">
						<br />
						<a href="http://www.reddit.com/r/nottheonion/submit">Add a story to this page</a>
					</li>
				</ul>
			</div>
		</div>
		<a class="expansion-toggle"><img src="/static/onion/img/mobile_navbtn.png" alt="Show/Hide Navigation"></a><nav class="main-nav" data-ct_section_name="nav">
		<div class="navigation">
			<ul class="links">
				<li class="video" style=""><a href="http://zeega.com/channel/audiogif#f/43586">Video</a></li>
				<li class="politics" style=""><a href="http://www.verminsupreme.com/">Politics</a></li>
				<li class="sports" style=""><a href="http://na.leagueoflegends.com/">Sports</a></li>
				<li class="business" style=""><a href="http://www.youtube.com/watch?v=AqZcYPEszN8">Business</a></li>
				<li class="science-technology" style=""><a href="http://www.icr.org/">Science/Tech</a></li>
				<li class="entertainment" style=""><a href="http://answers.yahoo.com/">Entertainment</a></li>
				<li class="breaking" style=""><a href="http://foxnews.com/">Breaking</a></li>
				<li class="more" style="display: none;"><a href="#" onclick="return false">More <i class="icon-chevron-down"></i></a>
				<ul class="more-links" style="display: none;">
				</ul>
				</li>
			</ul>
		</div>
		<div class="search">
		</div>
		</nav></header>
		<div class="expansion">
			<div class="search">
				<button class="search-back">Back</button>
				<div class="search-field">
				</div>
				<div class="results">
				</div>
			</div>
			<div class="nav con">
				<ul>
					<li class="video"><a href="http://nyan.cat/">Video <i class="icon-chevron-right"></i></a></li>
					<li class="politics"><a href="http://www.mittromney.com/">Politics <i class="icon-chevron-right"></i></a></li>
					<li class="sports"><a href="http://na.leagueoflegends.com/">Sports <i class="icon-chevron-right"></i></a></li>
					<li class="business"><a href="http://www.youtube.com/watch?v=AqZcYPEszN8">Business <i class="icon-chevron-right"></i></a></li>
					<li class="sci-tech"><a href="http://www.icr.org/">Science/Tech <i class="icon-chevron-right"></i></a></li>
					<li class="entertainment"><a href="http://answers.yahoo.com/">Entertainment <i class="icon-chevron-right"></i></a></li>
					<li class="breaking"><a href="http://foxnews.com/">Breaking <i class="icon-chevron-right"></i></a></li>
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
											<a href="<?php echo(get_url($item)); ?>"><img src="<?php echo(get_image($item));?>" class="lazy-loaded" width="350" height="196" alt="" title=""></a>
										</div>
										
										<h1><a class="title" href="<?php echo(get_url($item)); ?>"><?php echo(get_title($item)); ?></a></h1>
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
												<a href="<?php echo(get_url($item)); ?>"><img src="<?php echo(get_image($item));?>" class="lazy-loaded" width="350" height="196" alt="" title=""></a>
											</div>
											<h1><a class="title" href="<?php echo(get_url($item)); ?>"><?php echo(get_title($item)); ?></a></h1>
											</article>
										</div>
										<div class="feature con tertiary supporting" data-ct_section_name=":2">
											<?php $item = array_shift($items); ?>
											<article class="article" data-article-id="31362">
											<div class="picture">
												<a href="<?php echo(get_url($item)); ?>"><img src="<?php echo(get_image($item));?>" class="lazy-loaded" width="350" height="196" alt="" title=""></a>
											</div>
											<h1><a class="title" href="<?php echo(get_url($item)); ?>"><?php echo(get_title($item)); ?></a></h1>
											<div class="text"></div>
											</article>
										</div>
										<div class="feature con quaternary supporting" data-ct_section_name=":3">
											<?php $item = array_shift($items); ?>
											<article class="article" data-article-id="31354">
											<div class="picture">
												<a href="<?php echo(get_url($item)); ?>"><img src="<?php echo(get_image($item));?>" class="lazy-loaded" width="350" height="196" alt="" title=""></a>
											</div>
											<h1><a class="title" href="<?php echo(get_url($item)); ?>"><?php echo(get_title($item)); ?></a></h1>
											<div class="text">
											</div>
											</article>
										</div>
										<div class="feature con quinary supporting" data-ct_section_name=":4">
											<?php $item = array_shift($items); ?>
											<article class="article" data-article-id="31355">
											<div class="picture">
												<a href="<?php echo(get_url($item)); ?>"><img src="<?php echo(get_image($item));?>" class="lazy-loaded" width="350" height="196" alt="" title=""></a>
											</div>
											<h1><a class="title" href="<?php echo(get_url($item)); ?>"><?php echo(get_title($item)); ?></a></h1>
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
									<a href="<?php echo(get_url($item)); ?>"><img src="<?php echo(get_image($item));?>" class="lazy-loaded" width="350" height="196" alt="" title=""><i class="icon-play-circle"></i></a>
								</div>
								<h1><a class="title" href="<?php echo(get_url($item)); ?>"><?php echo(get_title($item)); ?></a></h1>
								<div class="meta">
								</div>
							</div>
							<div data-contentlist="recent-news-items" class="list" data-ct_section_name=":list">
								<?php $item = array_shift($items); ?>
								<a class="title" href="<?php echo(get_url($item)); ?>"><?php echo(get_title($item)); ?></a>
								<?php $item = array_shift($items); ?>
								<a class="title" href="<?php echo(get_url($item)); ?>"><?php echo(get_title($item)); ?></a>
								<?php $item = array_shift($items); ?>
								<a class="title" href="<?php echo(get_url($item)); ?>"><?php echo(get_title($item)); ?></a>
								<?php $item = array_shift($items); ?>
								<a class="title" href="<?php echo(get_url($item)); ?>"><?php echo(get_title($item)); ?></a>
							</div>
							</section><section class="news-highlight bordered" data-ct_section_name="highlights">
							<div class="inner">
								<h4><span class="icon-globe icon-large icon"></span> News Highlights</h4>
								<div data-contentlist="highlights-feature" class="featured" data-ct_section_name=":featured">
									<?php $item = array_shift($items); ?>
									<div class="picture">
										<a href="<?php echo(get_url($item)); ?>"><img src="<?php echo(get_image($item));?>" class="lazy-loaded" width="350" height="196" alt="" title=""></a>
									</div>
									<h1><a class="title" href="<?php echo(get_url($item)); ?>"><?php echo(get_title($item)); ?></a></h1>
								</div>
								<div data-contentlist="highlights-items" class="list">
									<?php $item = array_shift($items); ?>
									<a class="title" href="<?php echo(get_url($item)); ?>"><?php echo(get_title($item)); ?></a>
									<?php $item = array_shift($items); ?>
									<a class="title" href="<?php echo(get_url($item)); ?>"><?php echo(get_title($item)); ?></a>
								</div>
							</div>
							</section>
						</div>
					</div>
					</aside>
				</div>
				<aside class="sidebar">
				<div>
					<div>
						<div>
							<?php $item = array_shift($items); ?>
							<section>
							<h4><a href="https://twitter.com/justinbieber">American Voices</a></h4>
							<article>
							<h1><a class="title" href="<?php echo(get_url($item)); ?>"><?php echo(get_title($item)); ?></a></h1>
							<div class="picture" data-ct_section_name=":image">
								<a href="https://twitter.com/justinbieber"><img class="lazy-loaded" src="/static/biebs.jpg"></a>
							</div>
							<div class="text">
								“<?php echo(get_tweet()); ?>”
							</div>
							</article>
							<ul class="related">
								<?php $item = array_shift($items); ?>
								<li><a class="title" href="<?php echo(get_url($item)); ?>"><?php echo(get_title($item)); ?></a></li>
								<?php $item = array_shift($items); ?>
								<li><a class="title" href="<?php echo(get_url($item)); ?>"><?php echo(get_title($item)); ?></a></li>
								<?php $item = array_shift($items); ?>
								<li><a class="title" href="<?php echo(get_url($item)); ?>"><?php echo(get_title($item)); ?></a></li>
							</ul>
							</section>
						</div>
					</div>
				</div>
				<div>
					<div>
						<h4>A "Word" from Our "Sponsors"</h4>
						<div class="picture">
							<a href="http://www.newsjack.in"><img src="/static/newsjack/newsjack.jpg"></a>
						</div>
					</div>
				</div>
				<div>
					<h4>Old News</h4>
					<div>
						<?php $item = array_shift($items); ?>
						<div class="picture">
							<a href="<?php echo(get_url($item)); ?>"><img src="<?php echo(get_image($item));?>" class="lazy-loaded" width="350" height="196" alt="" title=""><i class="icon-play-circle"></i></a>
						</div>
						<h1><a class="title" href="<?php echo(get_url($item)); ?>"><?php echo(get_title($item)); ?></a></h1>
						<div class="meta">
						</div>
					</div>
				</div>
				</aside></section>
			</div>
		</div>
	</div>
	<footer class="site-footer">
	<div class="wrap">
		<div>
			<section class="col-1">
			<ul>
				<li>
				<h2>It's not The Onion.</h2>
				</li>
				<li>
				<h2>These are all completely real.</h2>
				</li>
				<li>
				<h2>Depressing, ain't it.</h2>
				</li>
			</ul>
			</section>
			<section class="col-2">
			<ul data-ct_section_name=":list">
				<li data-ct_section_name=":1">
					<h2>Content on this page is being lovingly curated by the "Not the Onion" subreddit.  <a href="http://www.reddit.com/r/nottheonion">Check out their community.</a></h2>
				</li>
			</ul>
			</section>
			<section class="col-3">
			</section>
		</div>
		<section class="col-4">
			<p>This site is quick hack by <a href="http://www.slifty.com">Dan Schultz</a> and <a href="http://mattstempeck.com">Matt Stempeck</a>.</p>
		</section>
		<section class="col-5">
		<p>
			The Onion has nothing to do with this site, we don't represent them.  In fact, we love them.  If you don't love us back, please get in touch: <a href="http://www.twitter.com/slifty">@slifty</a> and <a href="http://www.twitter.com/mstem">@mstem</a>.
		</p>
		</section>
	</div>
	</footer>
</div>
<style class="afns-ad-element">
					body.afns-ad-skin div#body-wrap{                        top: 25px !important;                    }
</style>
</body>
</html>
