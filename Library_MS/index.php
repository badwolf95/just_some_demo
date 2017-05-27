<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'include.php';
@$username = $_GET['username']?$_GET['username']:$_SESSION['username'];
if($username==null){
    if($_SESSION['ADMINname']){
        $username = $_SESSION['ADMINname'];
    }else{
        header("location:login.php");
    }
   
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	
	<title>后台管理</title>
	<link rel="stylesheet" href="styles/index.css"/>
	<link rel="stylesheet" href="styles/bootstrap.min.css" />

</head>
<body>
	<header>
		<a href="#" id="index">Library_MS</a>
		<div class="right">
			<span id="user"><?php echo $username;?></span>
			<a href="doAction.php?act=logout" id="logout">logout</a>
		</div>
	</header>
	<div class="main">
		<div class="main_left">
			<ul>
				<li><a href="books.php">馆藏图书信息</a></li>
				<li><a href="history.php">图书借阅历史</a></li>
				<li><a href="student.php">学生信息管理</a></li>
				<li><a href="user.php">用户列表</a></li>
				<li><a href="admin.php">管理员列表</a></li>
				<li><a href="author.php">作者列表</a></li>
				<li><a href="press.php">出版社列表</a></li>
			</ul>
		</div>
		<div class="main_right">
			<div class="right_top">关于Library_MS</div>
			<div class="right_about">
				<div class="cont_left"><a href="">扁平化风格</a></div>
				<div class="cont_mid"><a href="">傻瓜式操作</a></div>
				<div class="cont_right"><a href="">用过都说好</a></div>
			</div>
		</div>
	</div>
	<footer>&copy;badwolf</footer>
	
	
	
	<div class="modal fade" tabindex="-1" role="dialog"  id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">致用户的一封信</h4>
      </div>
      <div class="modal-body">
        <p>欢迎你使用这个蹩脚的图书系统，由于我们的需求和本系统当初的构建目的不同，所以用起来会觉得比较烂，先别介意哈，最近要做的事太多了，不出太大意外的话，目测要一个月左右才能完成新版系统，敬请期待.....</p>
        <p>然后呢，这个系统是我最近几天改的，只是实现了最最基本的需求，还需要用户的较多配合：</p>
        <p>1、新用户请到左侧的“ 学生信息管理”添加自己的个人信息先；</p>
        <p>2、懒得对旧系统修修补补了，所以页面直接用了管理员的，所以有些功能普通用户是受限的，目前的话，用户只能添加，不能删改，所以还请各位添加时尽量确保信息的正确性哈，不然可就苦了管理员了</p>
        <p>3、要借书的话，先找到书的主人自行联系，毕竟同班方便，然后在本系统添加借阅信息，确保图书借阅信息为最新，方便你我他</p>
        <p>4、关于网站安全这方面我个渣渣还不懂，所以请各位大神手下留情，发现BUG什么的，可以跟我说下，还请不要搞破坏哈，毕竟小本经营，亏本吐血大甩卖个人劳动力。</p>
        <p>最后呢，界面比较丑请大家别嫌弃啦，当初是只是为了能实现后台功能，所以界面就尽可能地简单，所以你看我连颜色都懒得搭配，最后的最后，有意见和建议都可以直接跟我说，我个渣渣还是很乐意接受批评的</p>
      </div>
      
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script src="js/jquery-1.10.0.js"></script>
<script src="js/bootstrap.min.js"></script> 
<script type="text/javascript">
$(document).ready(function(){
	$('#myModal').modal('toggle')
});
</script>
</body>
</html>