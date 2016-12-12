<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:80:"F:\Coding\wamp\www\escape\public/../application/enjoyusf\view\article\index.html";i:1481447597;s:73:"F:\Coding\wamp\www\escape\public/../application/enjoyusf\view\layout.html";i:1481359137;s:79:"F:\Coding\wamp\www\escape\public/../application/enjoyusf\view\index\header.html";i:1481466127;s:79:"F:\Coding\wamp\www\escape\public/../application/enjoyusf\view\index\footer.html";i:1481466120;}*/ ?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Fight2Escape</title>

<link href="/static/enjoyusf/css/bootstrap.min.css" rel="stylesheet">
<link href="/static/enjoyusf/css/datepicker3.css" rel="stylesheet">
<link href="/static/enjoyusf/css/styles.css" rel="stylesheet">
<link href="/static/enjoyusf/css/bootstrap-table.css" rel="stylesheet">

<!--[if lt IE 9]>
<script src="/static/enjoyusf/js/html5shiv.js"></script>
<script src="/static/enjoyusf/js/respond.min.js"></script>
<![endif]-->

<link rel="stylesheet" href="/static/enjoyusf/js/layer/skin/layer.css">
<script src="/static/enjoyusf/js/jquery-1.11.1.min.js"></script>


</head>

<body>
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#"><span>Fight</span>Escape</a>
				<ul class="user-menu">
					<li class="dropdown pull-right">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> User <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="#"><span class="glyphicon glyphicon-user"></span> Profile</a></li>
							<li><a href="#"><span class="glyphicon glyphicon-cog"></span> Settings</a></li>
							<li><a href="/enjoyusf/loginout/logout"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</div><!-- /.container-fluid -->
	</nav>
		
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<!-- <form role="search">
			<div class="form-group">
				<input type="text" class="form-control" placeholder="Search">
			</div>
		</form> -->
		<ul class="nav menu">
			<li><a href="/index/index" target="_blank"><span class="glyphicon glyphicon-dashboard"></span> Blog</a></li>
			<li class="active"><a href="/enjoyusf/index/index"><span class="glyphicon glyphicon-dashboard"></span> Dashboard</a></li>
			<li><a href="/enjoyusf/user/index"><span class="glyphicon glyphicon-th"></span> User</a></li>
			<li><a href="/enjoyusf/article/index"><span class="glyphicon glyphicon-stats"></span> Article</a></li>
			<!-- <li><a href="tables.html"><span class="glyphicon glyphicon-list-alt"></span> Tag</a></li>
			<li><a href="forms.html"><span class="glyphicon glyphicon-pencil"></span> Forms</a></li>
			<li><a href="panels.html"><span class="glyphicon glyphicon-info-sign"></span> Alerts &amp; Panels</a></li>
			<li class="parent ">
				<a href="#">
					<span class="glyphicon glyphicon-list"></span> Dropdown <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><em class="glyphicon glyphicon-s glyphicon-plus"></em></span> 
				</a>
				<ul class="children collapse" id="sub-item-1">
					<li>
						<a class="" href="#">
							<span class="glyphicon glyphicon-share-alt"></span> Sub Item 1
						</a>
					</li>
					<li>
						<a class="" href="#">
							<span class="glyphicon glyphicon-share-alt"></span> Sub Item 2
						</a>
					</li>
					<li>
						<a class="" href="#">
							<span class="glyphicon glyphicon-share-alt"></span> Sub Item 3
						</a>
					</li>
				</ul>
			</li> 
			li role="presentation" class="divider"></li>
			<li><a href="login.html"><span class="glyphicon glyphicon-user"></span> Login Page</a></li> -->
		</ul>
		<!-- <div class="attribution">More Templates <a href="http://www.cssmoban.com/" target="_blank" title="模板之家">模板之家</a> - Collect from <a href="http://www.cssmoban.com/" title="网页模板" target="_blank">网页模板</a></div> -->
	</div><!--/.sidebar-->


	

<script>
var CONFIG  = {
	'jump_url'	:'/enjoyusf/article/add',
}
</script>


<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
				<li class="active">Article</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Article</h1>
			</div>
		</div><!--/.row-->
				
		
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading"><button class="btn btn-primary" id="my_jump_btn">New Article</button></div>
					<div class="panel-body">
						<table data-toggle="table" data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
						    <thead>
						    <tr>
						        <!-- <th data-field="state" data-checkbox="true" >Article ID</th> -->
						        <th data-field="id" data-sortable="true" data-align="center">ID</th>
						        <th data-field="title"  data-sortable="true" data-align="center">Title</th>
						        <th data-field="thumb" data-sortable="true" data-align="center">Thumb</th>
						        <th data-field="create_time" data-sortable="true" data-align="center">Create Time</th>
						        <th data-field="update_time" data-sortable="true" data-align="center">Update Time</th>
						    </tr>
						    </thead>
						    <tr>
						    	<!-- <td><input type="checkbox"></td> -->
						    	<td>#1</td>
						    	<td><a href="#">文章标题</a></td>
						    	<td><img src="/uploads/blackhorse.jpg" alt="" style="width:50px;height:50px"></td>
						    	<td>2016-12-12 12:12:12</td>
						    	<td>2016-12-12 12:12:12</td>
						    </tr>
						    <tr>
						    	<!-- <td><input type="checkbox"></td> -->
						    	<td>#1</td>
						    	<td><a href="#">文章标题</a></td>
						    	<td><img src="/uploads/blackhorse.jpg" alt="" style="width:50px;height:50px"></td>
						    	<td>2016-12-12 12:12:12</td>
						    	<td>2016-12-12 12:12:12</td>
						    </tr>
						    <tr>
						    	<!-- <td><input type="checkbox"></td> -->
						    	<td>#1</td>
						    	<td><a href="#">文章标题</a></td>
						    	<td><img src="/uploads/blackhorse.jpg" alt="" style="width:50px;height:50px"></td>
						    	<td>2016-12-12 12:12:12</td>
						    	<td>2016-12-12 12:12:12</td>
						    </tr>
						    <tr>
						    	<!-- <td><input type="checkbox"></td> -->
						    	<td>#1</td>
						    	<td><a href="#">文章标题</a></td>
						    	<td><img src="/uploads/blackhorse.jpg" alt="" style="width:50px;height:50px"></td>
						    	<td>2016-12-12 12:12:12</td>
						    	<td>2016-12-12 12:12:12</td>
						    </tr>
						    <tr>
						    	<!-- <td><input type="checkbox"></td> -->
						    	<td>#1</td>
						    	<td><a href="#">文章标题</a></td>
						    	<td><img src="/uploads/blackhorse.jpg" alt="" style="width:50px;height:50px"></td>
						    	<td>2016-12-12 12:12:12</td>
						    	<td>2016-12-12 12:12:12</td>
						    </tr>
						    <tr>
						    	<!-- <td><input type="checkbox"></td> -->
						    	<td>#1</td>
						    	<td><a href="#">文章标题</a></td>
						    	<td><img src="/uploads/blackhorse.jpg" alt="" style="width:50px;height:50px"></td>
						    	<td>2016-12-12 12:12:12</td>
						    	<td>2016-12-12 12:12:12</td>
						    </tr>
						    <tr>
						    	<!-- <td><input type="checkbox"></td> -->
						    	<td>#1</td>
						    	<td><a href="#">文章标题</a></td>
						    	<td><img src="/uploads/blackhorse.jpg" alt="" style="width:50px;height:50px"></td>
						    	<td>2016-12-12 12:12:12</td>
						    	<td>2016-12-12 12:12:12</td>
						    </tr>
						    <tr>
						    	<!-- <td><input type="checkbox"></td> -->
						    	<td>#1</td>
						    	<td><a href="#">文章标题</a></td>
						    	<td><img src="/uploads/blackhorse.jpg" alt="" style="width:50px;height:50px"></td>
						    	<td>2016-12-12 12:12:12</td>
						    	<td>2016-12-12 12:12:12</td>
						    </tr>
						    
						</table>
					</div>
				</div>
			</div>
		</div><!--/.row-->	







		</div><!--/.row-->
	</div>	<!--/.main-->


	<script src="/static/enjoyusf/js/bootstrap.min.js"></script>
	<script src="/static/enjoyusf/js/chart.min.js"></script>
	<script src="/static/enjoyusf/js/chart-data.js"></script>
	<script src="/static/enjoyusf/js/easypiechart.js"></script>
	<script src="/static/enjoyusf/js/easypiechart-data.js"></script>
	<script src="/static/enjoyusf/js/bootstrap-datepicker.js"></script>
	<script src="/static/enjoyusf/js/bootstrap-table.js"></script>


	<script>
		$('#calendar').datepicker({
		});

		!function ($) {
		    $(document).on("click","ul.nav li.parent > a > span.icon", function(){          
		        $(this).find('em:first').toggleClass("glyphicon-minus");      
		    }); 
		    $(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
		}(window.jQuery);

		$(window).on('resize', function () {
		  if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
		})
		$(window).on('resize', function () {
		  if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
		})
	</script>
	<script type="text/javascript" src="/static/enjoyusf/js/common.js"></script>
	<script type="text/javascript" src="/static/enjoyusf/js/layer/layer.js"></script>
</body>

</html>
