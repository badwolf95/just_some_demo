<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:77:"F:\Coding\wamp\www\escape\public/../application/index\view\index\article.html";i:1481608495;s:70:"F:\Coding\wamp\www\escape\public/../application/index\view\layout.html";i:1481589406;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Fight2Escape-Article</title>
	<link href="/static/handsome/img/f2e.ico" rel="shortcut icon" />
	<link rel="stylesheet" href="/static/handsome/css/home.css">
	<link rel="stylesheet" href="/static/handsome/css/article.css">
	<link rel="stylesheet" href="/static/handsome/css/raphaelicons.css">
</head>
<body>
	<div class="wrap">
		<section class="sidebar">
			<div class="sidebar__navbar">
				<a href="/index/index/home" class="navbar__a"><span class="ficon">S</span></a>
				<a href="#" class="navbar__a  active"><span class="ficon">U</span></a>
				<a href="/index/index/about" class="navbar__a"><span class="ficon">L</span></a>
			</div>
			<div class="sidebar__setting">
				<!-- <a href="#" class="setting__a"><span class="ficon">3</span></a> -->
				<!-- <a href="#" class="setting__a"><span class="ficon">a</span></a> -->
				<a href="/index/index/index" class="setting__a"><span class="ficon">v</span></a>
			</div>
		</section>
		<section class="detail">
	
			<section class="showpic showpic__article">
				<div class="showpic__summary">
					<h2>技术</h2>
					<h3>技术人生，没有道理</h3>
					<p>技术在手，天下我有,就是这么猖狂</p>
					<button><b class="ficon">Ã</b>up</button>

				</div>
			</section>

			
			<section class="main">
				<h1><b class="ficon">È</b>	<?php echo $res['title']; ?></h1>
				<span><b class="ficon">4</b>	<?php echo getTime($res['update_time']); ?></span>
				<article>
					<?php echo $res['content']; ?>
				</article>
				<button class="main__list__more main__list__others" id="my_back_btn">Others <b class="ficon">Ì</b></button>
				<footer>
					<b>&copy;</b>badwolf.cn  powerby fight2escape
				</footer>
			</section>

		</section>
	</div>


	<script src="/static/handsome/js/common.js"></script>
</body>
</html>	