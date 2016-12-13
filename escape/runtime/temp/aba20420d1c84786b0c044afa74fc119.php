<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:74:"F:\Coding\wamp\www\escape\public/../application/index\view\index\home.html";i:1481617890;s:70:"F:\Coding\wamp\www\escape\public/../application/index\view\layout.html";i:1481589406;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Fight2Escape-Blog</title>
	<link href="/static/handsome/img/f2e.ico" rel="shortcut icon" />
	<link rel="stylesheet" href="/static/handsome/css/home.css">
	<link rel="stylesheet" href="/static/handsome/css/raphaelicons.css">
	<!-- <link rel="stylesheet" href="/static/handsome/css/mobile.css"> -->
</head>
<body>
	<div class="wrap">
		<section class="sidebar">
			<div class="sidebar__navbar">
				<a href="/index/index/home" class="navbar__a active"><span class="ficon">S</span></a>
				<a href="#" class="navbar__a"><span class="ficon">U</span></a>
				<a href="/index/index/about" class="navbar__a"><span class="ficon">L</span></a>
			</div>
			<div class="sidebar__setting">
				<!-- <a href="#" class="setting__a"><span class="ficon">3</span></a> -->
				<!-- <a href="#" class="setting__a"><span class="ficon">a</span></a> -->
				<a href="/index/index/index" class="setting__a"><span class="ficon">v</span></a>
			</div>
		</section>
		<section class="detail">
	
			<section class="showpic showpic__home">
				<div class="showpic__summary">
					<h2>技术</h2>
					<h3>技术人生，没有道理</h3>
					<p>技术在手，天下我有,就是这么猖狂</p>
					<button><b class="ficon">Ã</b>up</button>

				</div>
			</section>

			
			<section class="main">
				<header>
				<span><n class="ficon">Æ</n>Coding</span>
				<!-- <input type="text" class="main__search" placeholder="search"> -->
				</header>
				<!-- <section class="main__tags">
					<a href="#" class="main__tags__a active">热门</a>
				
					<a href="#" class="main__tags__a">热门</a><a href="#" class="main__tags__a">热门</a>
					<a href="#" class="main__tags__a">热门</a>
					<a href="#" class="main__tags__a">热门</a>
					<a href="#" class="main__tags__a">热门</a><a href="#" class="main__tags__a">热门</a><a href="#" class="main__tags__a">热门</a>
					<a href="#" class="main__tags__a">热门</a>
					<a href="#" class="main__tags__a">热门</a>
					<a href="#" class="main__tags__a">热门</a>
					<a href="#" class="main__tags__a">热门</a>
					<a href="#" class="main__tags__a">热门</a>
					<a href="#" class="main__tags__a">热门</a>
				</section> -->
				<section class="main__list">
				<?php if(is_array($article) || $article instanceof \think\Collection): $i = 0; $__LIST__ = $article;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$atc): $mod = ($i % 2 );++$i;?>
					<div class="main__list__one">
						<div class="list__one__left">
							
							<h3><a href="/index/index/article/get/<?php echo $atc['id']; ?>"><b class="ficon">\</b><?php echo $atc['title']; ?></a></h3>
							<p><b class="ficon">4</b><?php echo getTimeSimple($atc['update_time']); ?></p>
							<p>
							<!-- <a href="#">热门</a>
							<a href="#">热门</a>
							<a href="#">热门</a> -->
							</p>
						</div>
						<div class="list__one__right">
							<a href="#"><img src="<?php echo $atc['thumb']; ?>" alt=""></a>
						</div>
					</div>
				<?php endforeach; endif; else: echo "" ;endif; ?>
					<!-- <button class="main__list__more">More <b class="ficon">:</b></button> -->
				</section>
				<footer>
					<b>&copy;</b>badwolf.cn  powerby fight2escape
				</footer>
			</section>

		</section>
	</div>
</body>
</html>