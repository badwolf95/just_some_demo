/*
SQLyog Ultimate v11.27 (32 bit)
MySQL - 5.6.17 : Database - workspace
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `ws_admin` */

DROP TABLE IF EXISTS `ws_admin`;

CREATE TABLE `ws_admin` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(32) NOT NULL,
  `email` varchar(40) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '1' COMMENT '1为可用0为禁用',
  `create_time` int(10) NOT NULL,
  `update_time` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

/*Data for the table `ws_admin` */

insert  into `ws_admin`(`id`,`username`,`password`,`email`,`status`,`create_time`,`update_time`) values (11,'admina','aaaaaa','admin@153.com',0,1471093719,1471093719),(17,'admina6','aaaaaa','admin@153.com',1,1471093749,1471093749),(19,'admina78','aaaaaa','admin@153.com',1,1471093755,1471093755),(21,'admina766674546','aaaaaa','admin@153.com',1,1471093762,1474464560),(22,'adminb','732453d48dfafba28e028ff60633cfb7','admin@153.com',1,1471093891,1472732311),(23,'admin','732453d48dfafba28e028ff60633cfb7','',1,1472633402,1472732294);

/*Table structure for table `ws_assignment` */

DROP TABLE IF EXISTS `ws_assignment`;

CREATE TABLE `ws_assignment` (
  `id` mediumint(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL COMMENT '用户ID',
  `content` text NOT NULL COMMENT '内容',
  `status` int(1) NOT NULL DEFAULT '1' COMMENT '1可见2隐藏',
  `receive_user_id` text NOT NULL COMMENT '接收者ID，逗号隔开',
  `read_user_id` text COMMENT '已阅读者ID',
  `receive_user_num` int(6) DEFAULT NULL COMMENT '接收人数',
  `read_user_num` int(6) DEFAULT '0' COMMENT '已读人数',
  `create_time` int(10) DEFAULT NULL COMMENT '创建时间',
  `update_time` int(10) DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

/*Data for the table `ws_assignment` */

insert  into `ws_assignment`(`id`,`user_id`,`content`,`status`,`receive_user_id`,`read_user_id`,`receive_user_num`,`read_user_num`,`create_time`,`update_time`) values (5,1000,'一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十',1,',12,13,14,16,',NULL,NULL,NULL,1471416417,NULL),(6,1000,'一二三四',2,',12,13,14,16,',NULL,NULL,NULL,1471416456,1471491121),(7,1000,'一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十',2,',12,13,14,16,',NULL,NULL,NULL,1471416496,1471440072),(9,1000,'faf dsfa dfads \r\nsfg ff a\r\nfd \r\naf\r\nds d\r\nfds\r\nfad s\r\nsdf\r\ndsf d\r\naf\r\nfdfd \r\ndsfd\r\nfa \r\nfd\r\nfds\r\nf d\r\nfaf\r\ndfs faf\r\nsd\r\nf ',1,',15,14,',NULL,NULL,NULL,1471418504,1471436333),(13,1000,'342而我去热武器任务 而二期人切勿让而且为v不错吧许昌吧  ',1,',12,13,14,16,',NULL,4,0,1471424193,1471438385),(14,20493,'第三方爱第三方第三方算法发的说法水电费发多少水电费打的费发多少飞',1,',12,13,14,16,',',12,13,14,',4,0,1471424222,1471438385),(15,1000,'34324231443241432434341432343242314432414324343414323432423144324143243434143234324231443241432434341432',1,',12,14,16,',NULL,3,0,1471491100,NULL);

/*Table structure for table `ws_friends` */

DROP TABLE IF EXISTS `ws_friends`;

CREATE TABLE `ws_friends` (
  `id` mediumint(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL COMMENT '用户ID',
  `friends_id` text COMMENT '好友们的ID，逗号隔开',
  `create_time` int(10) DEFAULT NULL,
  `update_time` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `ws_friends` */

insert  into `ws_friends`(`id`,`user_id`,`friends_id`,`create_time`,`update_time`) values (3,12,',13,14,',1471319078,1471319123),(4,13,',12,',1471319078,NULL),(5,14,',12,',1471319123,NULL);

/*Table structure for table `ws_information` */

DROP TABLE IF EXISTS `ws_information`;

CREATE TABLE `ws_information` (
  `id` mediumint(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL COMMENT '用户ID',
  `content` text NOT NULL COMMENT '内容',
  `status` int(1) NOT NULL DEFAULT '1' COMMENT '1可见2隐藏',
  `receive_user_id` text NOT NULL COMMENT '接收者ID，逗号隔开',
  `read_user_id` text COMMENT '已阅读者ID',
  `receive_user_num` int(6) DEFAULT NULL COMMENT '接收人数',
  `read_user_num` int(6) DEFAULT '0' COMMENT '已读人数',
  `create_time` int(10) DEFAULT NULL COMMENT '创建时间',
  `update_time` int(10) DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

/*Data for the table `ws_information` */

insert  into `ws_information`(`id`,`user_id`,`content`,`status`,`receive_user_id`,`read_user_id`,`receive_user_num`,`read_user_num`,`create_time`,`update_time`) values (5,1000,'一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十',1,',12,13,14,16,',NULL,NULL,NULL,1471416417,NULL),(7,1000,'一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十',2,',12,13,14,16,',NULL,NULL,NULL,1471416496,1471440072),(14,20493,'第三方爱第三方第三方算法发的说法水电费发多少水电费打的费发多少飞',1,',12,13,14,16,',',12,13,14,',4,0,1471424222,1471438385),(15,1000,'213213132321321313232132131323213213132321321313232132131323213213132321321313232132131323',2,',12,14,16,',NULL,3,0,1471490740,1471490761),(16,1000,'32423423432423424322342342343242',1,',',NULL,0,0,1474533019,NULL);

/*Table structure for table `ws_new_friend` */

DROP TABLE IF EXISTS `ws_new_friend`;

CREATE TABLE `ws_new_friend` (
  `id` mediumint(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL COMMENT '申请人ID',
  `add_user_id` int(10) NOT NULL COMMENT '要添加的好友ID',
  `status` int(1) NOT NULL DEFAULT '1' COMMENT '1未读2已读3同意4拒绝',
  `create_time` int(10) DEFAULT NULL COMMENT '创建时间',
  `update_time` int(10) DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Data for the table `ws_new_friend` */

insert  into `ws_new_friend`(`id`,`user_id`,`add_user_id`,`status`,`create_time`,`update_time`) values (3,12,13,2,1471311950,1471311950),(5,12,13,4,1471312261,1471312261),(7,13,13,1,1471312362,1471312362);

/*Table structure for table `ws_papers` */

DROP TABLE IF EXISTS `ws_papers`;

CREATE TABLE `ws_papers` (
  `id` mediumint(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL COMMENT '用户ID',
  `title` varchar(100) NOT NULL COMMENT '标题',
  `thumb` varchar(200) DEFAULT NULL COMMENT '封面缩略图',
  `content` text COMMENT '手记内容',
  `status` int(1) DEFAULT '2' COMMENT '1私有2公开',
  `listorder` int(4) NOT NULL DEFAULT '10' COMMENT '0置顶，10默认',
  `put_up` int(10) NOT NULL DEFAULT '0' COMMENT '点赞数',
  `create_time` int(10) DEFAULT NULL COMMENT '发布时间',
  `update_time` int(10) DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `ws_papers` */

insert  into `ws_papers`(`id`,`user_id`,`title`,`thumb`,`content`,`status`,`listorder`,`put_up`,`create_time`,`update_time`) values (2,1000,'纯HTML+CSS+JavaScript编写的计算器应用',NULL,'一道笔试题 之前偶然看到一个公司的笔试题，题目如下： 用HTML5、CSS3、JavaScript，做一个网页，实现如下图形式计算器 具体要求： 有且只有一个文件：index.html。不允许再有其他文件，不允许再有单独的CSS、JS、PNG、JPG文件。 运行环境为 Google Chrome。 必须支持标准的四则运算。例如：1+2*3=7。 请在收到邮件的48小时内独立完成本测试，并回复本邮件。 一道笔试题引发的一个练手项目 花了一点时间写好的第一版，符合了笔试题的要求。后来左看右看觉得还可以改进做的更好，于是给它不断的改进，加新功能等，这样下来没完没了，利用业余时间一点一点的写，从刚开始的网页版，到后来做响应式的移动版，再到现在的移动App，短短续续大概写了3个月吧。 项目地址 最终版的计算器，项目地址和预览图片在GitHub： https://github.com/dunizb/sCalc 功能说明 最终版的功能如下： 界面布局采用CSS3 的 Flex box布局 内置两套主题可切换 计算历史记录显示 左滑右滑可以切换单手模式(App) 当输入手机号码后长按等于号可以拨打手机号码(App) 版本更新检查(App) 界面布局 由于这个项目只是练手,所以采用了HTML5个CSS3技术，也不打算兼容IE等低版本浏览器，所以直接使用CSS3提供的Flexbox布局方式。并且使用rem单位来进行自动计算尺寸。 计算计算历史记录显示功能，使用HTML5提供的本地存储功能之Local Storage，为了方便使用Local Storage，对它进行了简单的封装（见js/common.js文件）使之key值按一定规律生产，方便管理。 key由appName+id组成，id是自动增长不重复的，可以按id和appName删除一条记录，输入*则全部删除。 打包APP 移动Web版计算器写完后，又想把他做成APP在手机上运行，由于本人没用过混合APP诸如ionic之类的框架，所以参考了一下，选择了Hbuild来进行开发和APP的打包，非常方便。（HBuild）. 单手模式 左滑右滑可以切换单手模式，这就需要移动端的touch事件了，使用如下代码判断是左滑还是又滑： /** 单手模式 */ function singleModel(){ var calc = document.getElementById(\"calc\"); var startX = 0,moveX = 0,distanceX = 0; var distance = 100; var width = calc.offsetWidth; //滑动事件 calc.addEventListener(\"touchstart\",function(e){ startX = e.touches[0].clientX; }); calc.addEventListener(\"touchmove\",function(e){ moveX = e.touches[0].clientX; distanceX = moveX - startX; isMove = true; }); window.addEventListener(\"touchend\",function(e){ if(Math.abs(distanceX) > width/3 && isMove){ if( distanceX > 0 ){ positionFun(\"right\"); //右滑 }else{ positionFun(\"left\"); //作滑 } } startY = moveY = 0; isMove = false; }); } 如果是坐滑，就position:absolut;left:0,bottom:0，再把最外层DIV缩小到80%，这样就实现了左滑计算器缩小移动到左下角。右滑道理一样。 电话拨打功能 当输入手机号码后长按等于号可以拨打手机号码。这个功能没什么神奇，在移动Web上会对那些看起来像是电话号码的数字处理为电话链接，比如： 7位数字，形如：1234567 带括号及加号的数字，形如：(+86)123456789 双连接线的数字，形如：00-00-00111 11位数字，形如：13800138000 可能还有其他类型的数字也会被识别。我们可以通过如下的meta来开启电话号码的自动识别： 开启电话功能 123456 开启短信功能： 123456 但是，在Android系统上，只能调用系统的拨号界面，在iOS上则能调过这一步直接把电话拨打出去。 版本更新检查 在关于页面，有一个版本更新检查按钮，就能检查是否有新版本，这个功能的原理是发送一个JSOPN请求去检查服务器上的JSON文件，比对版本号，如果服务器上的版本比APP的版本高则会提示有新版本可以下载。\\ 客户端JavaScript代码： function updateApp(){ //检查新版本 var updateApp = document.getElementById(\"updateApp\"); updateApp.onclick = function(){ var _this = this; $.ajax({ type:\'get\', url:\'http://duni.sinaapp.com/demo/app.php?jsoncallback=?\', dataType:\'jsonp\', beforeSend : function(){ _this.innerHTML = \" 正在检查新版本...\"; }, success:function(data){ var newVer = data[0].version; if(newVer > appConfig.version){ var log = data[0].log; var downloadUrl = data[0].downloadUrl; if(confirm(\"检查到新版本【\"+newVer+\"】，是否立即下载？\\n 更新日志：\\n \" + log)){ var a = document.getElementById(\"telPhone\"); a.href = downloadUrl; a.target = \"_blank\"; a.click(); } }else{ alert(\"你很潮哦，当前已经是最新版本！\"); } _this.innerHTML = \" 检查新版本\"; }, error:function(msg){ _this.innerHTML = \" 检查新版本\"; alert(\"检查失败：\"+msg.message); } }); } } 服务端JSON： [ { \"version\":\"3.1.0\", \"downloadUrl\":\"http://dunizb.b0.upaiyun.com/demo/app/myCalc-3.1.0.apk\", \"hashCode\":\"20160812224616\", \"log\":\"1.新增切换主题功能 \\n 2.新增单手切换模式功能 \\n 3.调整UI \" } ] 下个版本计划 当前3.1.0版本还存在一些问题： 由于JS本身存在计算浮点数精度丢失问题，所以这个问题在项目中同意存在，需要自己去处理这个问题 由于使用了第三方的天气接口，用了jquery.Ajax方法，所以违背了使用纯原生写的初衷。 所以下个版本的开发计划为： 解决浮点数计算精度问题 把获取天气信息的jquery.Ajax方法替换为原生JavaScript代码，自己封装JSONP请求函数 使用面向对象方式重构APP 欢迎大家到github上来看看，如果喜欢可以star、watch一下，或提issue。\r\n作者： Dunizb \r\n链接：http://t.imooc.com/article/13009\r\n来源：慕课网',2,10,0,1474096578,1474096578),(3,1000,'121321216546465465465123',NULL,'单极分裂的会计法律上\r\n收电费缴费流口水的积分流口水的疯狂的\r\n似懂非懂精神分裂快点解锁李开复\r\n房间看电视富家大室\r\n可接受的快发到上\r\n      地方数据库就放开手的\r\n  快递费及代理商法ds\r\n',2,10,0,1474103860,1474103860),(4,1000,'Spring框架之AOP知识点总结',NULL,'   AOP简介: AOP(Aspect Oriented Programming)它是一种设计模式，用于实现一个系统中的某一个方面的应用。 OP(Aspect-Oriented Programming, 面向切面编程): 是一种新的方法论, 是对传统 OOP(Object-Oriented Programming, 面向对象编程) 的补充. AOP 的主要编程对象是切面(aspect), 而切面模块化横切关注点. 在应用 AOP 编程时, 仍然需要定义公共功能,\r\n    但可以明确的定义这个功能在哪里, 以什么方式应用, 并且不必修改受影响的类. 这样一来横切关注点就被模块化到特殊的对象(切面)里. AOP 的好处: 每个事物逻辑位于一个位置, 代码不分散, 便于维护和升级 业务模块更简洁, 只包含核心业务代码. AOP相关术语： 切面(Aspect): 横切关注点(跨越应用程序多个模块的功能)被模块化的特殊对象 通知(Advice): 切面必须要完成的工作 目标(Target): 被通知的对象 代理(Proxy): 向目标对象应用通知之后创建的对象 连接点（\r\n    Joinpoint）：程序执行的某个特定位置：如类某个方法调用前、调用后、方法抛出异常后等。连接点由两个信息确定：方法表示的程序执行点；相对点表示的方位。例如 ArithmethicCalculator#add() 方法执行前的连接点，执行点为 ArithmethicCalculator#add()； 方位为该方法执行前的位置 切点（pointcut）：每个类都拥有多个连接点：例如 ArithmethicCalculator 的所有方法实际上都是连接点，即连接点是程序类中客观存在的事务。AOP 通过切点定位到特定的连接点。类比：连接点相当于数据库中的记录，\r\n\r\n\r\n切点\r\n相当于查询条件。切点和连接点不是一对一的关系，一个切点匹配多个连接点，切点通过 org.springframew\r\nork.aop.Pointcut 接\r\n\r\n口进行描述，它使用类和方法作为连接点的查询条件。 AspectJ简介： AspectJ：Java 社区里最完整最流行的 AOP 框架。 在 Spring2.0 以上版本中, 可以使用基于 AspectJ 注解或基于 XML 配置的 AOP。 要在 Spring 应用中使用 AspectJ 注解, 必须在 classpath 下\r\n\r\n包含 AspectJ 类库: aopalliance.jar、aspectj.weaver.jar 和 spring-aspects.jar(注意前两个jar并不包括在spring的安装包中，需要单独下载) 将 aop Schema 添加到 根元\r\n\r\n素中。 要在 Spring IOC 容器中启用 AspectJ 注解支持, 只要在 Bean 配置文件中定义一个空的 XML 元素 当 Spring IOC 容器侦测到 Bean 配置文件中的 元素时, 会自动为与 AspectJ 切面匹配的 Bean 创建代理 要在 Spring 中声明 AspectJ 切面, 只需要在 IOC 容器中将切面声明为\r\n Bean 实例. 当在 Spring IOC 容器中初始化 AspectJ 切面之后, Spring IOC 容器就会为那些与 AspectJ 切面相\r\n匹配的 Bean 创建代理。\r\n 在 AspectJ 注解中, 切面只是一个带有 @Aspect 注解的 Java 类。 通知是标注有某种注解的简单的 Java 方法。 AspectJ 支持 5 种类型的通知注解: @Before: 前置通知, 在方法执行之前执行 @After: 后置通知, 在方法执行之后执行 @AfterRunning: 返回通知, 在方法返回结果之后执行 @AfterThrowing: 异常通知, 在方法抛出异常之后 @Around: 环绕通知, 围绕着方法执行 前置通知： 前置通知:在方法执行之前执行的通知 前置通知使用 @Before 注解, 并将切入点表达式的值作为注解值。 @Aspect //切面类 @Component public class LoggingAspect { @Before( \"execution(public void com.dao.impl.StudentsDAOImpl.\r\n\r\n*(com.bean.Students))\") public void before(JoinPoint point) { System.out.println(\"before:\"+point.getSignature().getName()+\"(\"+point.getArgs()+\")\"); } } applicationContext.xml中配置 最典型的切入点表达式时根据方法的签名来匹配各种方法: execution com.atguigu.spring.ArithmeticCalculator.(..): 匹配 ArithmeticCalculator 中声明的所有方法,第一个 代表任意修饰符及任意返回值. 第二个 代表任意方法. .. 匹配任意数量的参数. 若目标类与接口与该\r\n切面在同一个包中, 可以省略包名。 execution public ArithmeticCalculator.(..): 匹配 ArithmeticCalculator 接口的所有公有\r\n方法。 execution public double ArithmeticCalculator.(..): 匹配 ArithmeticCalculator 中返回 double 类型数值的方法。 execution public double ArithmeticCalculator.(double, ..): 匹配第一个参数为 double 类型的方法, .. 匹配任意数量任意类型的参数。 execution public double ArithmeticCalculator.*(double, double): 匹配参数类型为 double, double 类型的方法。 合并切入点 在 AspectJ 中, 切入点表达式可以通过操作符 &&, , ! 结合起来。 可以在通知方法中声明一个类型为 JoinPoint 的参数. 然后就能访问链接细节. 如方法名称和参数值。 后置通知： 后置通知是在连接点完成之后执行的, 即连接点返回结果或者抛出异常的时候都会\r\n行后置通知。 一个切面可以包括一个或者多个通知。后置通知不能访问目标方法执行的结果。 返回通知： 在返回通知中, 只要将 returning 属性添加到 @AfterReturning 注解中, 就可以\r\n的签名中添加一个同名参数。在运行时, Spring AOP 会通过这个参数传递返回值。 原始\r\n的切点表达式需要出现在 pointcut 属性中。 @AfterReturning(value=\"execution(public com.dao.impl.St\r\nudentsDAOImpl.(com.bean.Students))\" ,returning=\"result\") public void afterReturning(JoinPoint \r\netName()+\"(\"+point.getA\r\n\r\nrgs()+\")\"+\",result:\"+result); } 异常通知： 只在连接点抛出异常时才执行异常通知。 将 throwing 属性添加到 \r\n\r\n也可以访问连接点抛出的异常. Throwable 是所有错误和异常类的超类。所以在异常通知方法可以捕获到任何错误和异常。 如果只对某种特殊的异常类型感兴趣, 可以将参数声明为其他异常的参数类型. 然后通知就只在抛出这个类型及其子类的异常时才被执行。 @A\r\n\r\n\r\n\r\n\r\nfterThrowing(value=\"execution( public com.dao.impl.StudentsDAOImpl.(\r\ncom.bean.Students))\" ,throwing=\"ex\") public void afterThrowing(JoinPoint point,Exception ex) { System.out.\r\nprintln(\"aft\r\nerThrowing:\"+ point.getSignature().getName()+ \"(\"+point.getArgs()+\")\"+\",exception:\"+ex); } 环绕通知： 环绕通知是所有通知类型中功能最为强大的, 能够全面地控制连接点. 甚至可\r\n\r\n以控制是否执行连接点。 对于环绕通知来说, 连接点的参数类型必须是 ProceedingJoinPoint。 它是 JoinPoint 的子接口, 允许控制何时执行, 是否执行连接点。 在环绕通知中需要明确调用 ProceedingJoinPoint 的 proceed() 方法来执行被代理的方法。 如果忘记这样做就会导致通知被执行了, 但目标方法没有被执行。 注意: 环绕通知的方法需要返回目标方法执行之\r\n\r\n后的结果, 即调用 joinPoint.proceed(); 的返回值, 否则会出现空指针异常。\r\n作者： 霜花似雪 \r\n\r\n\r\n\r\n链接：http://t.imooc.com/article/details/id/12846\r\n来源：慕课网',2,10,0,1474104217,1474104217);

/*Table structure for table `ws_review_org` */

DROP TABLE IF EXISTS `ws_review_org`;

CREATE TABLE `ws_review_org` (
  `id` mediumint(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL COMMENT '申请者ID',
  `status` int(1) NOT NULL DEFAULT '1' COMMENT '1待审核2通过3拒绝',
  `create_time` int(10) DEFAULT NULL COMMENT '首次申请时间',
  `update_time` int(10) DEFAULT NULL COMMENT '最近申请时间',
  `operate_time` int(10) DEFAULT NULL COMMENT '最近操作时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `ws_review_org` */

insert  into `ws_review_org`(`id`,`user_id`,`status`,`create_time`,`update_time`,`operate_time`) values (1,16,3,1471182304,NULL,1473670338);

/*Table structure for table `ws_user` */

DROP TABLE IF EXISTS `ws_user`;

CREATE TABLE `ws_user` (
  `id` mediumint(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(40) NOT NULL COMMENT '注册邮箱',
  `password` varchar(32) NOT NULL,
  `nickname` varchar(60) DEFAULT NULL COMMENT '用户昵称',
  `type` int(1) NOT NULL DEFAULT '1' COMMENT '1用户2单位',
  `status` int(1) NOT NULL DEFAULT '0' COMMENT '1为可用0为禁用',
  `create_time` int(10) DEFAULT NULL,
  `update_time` int(10) DEFAULT NULL,
  `token` varchar(32) DEFAULT NULL COMMENT '验证邮箱token',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=utf8;

/*Data for the table `ws_user` */

insert  into `ws_user`(`id`,`email`,`password`,`nickname`,`type`,`status`,`create_time`,`update_time`,`token`) values (80,'2867680273@qq.com','732453d48dfafba28e028ff60633cfb7','badwolf恶狼',1,0,1474121644,1474121644,'b4f6cbf7b5a07eb53ac8a41d0b442663'),(81,'123456@qq.com','732453d48dfafba28e028ff60633cfb7',NULL,1,0,1474182044,1474182044,NULL),(82,'321654@qq.com','98809dafd26cfd97ac6fd8c7c1e6e84c',NULL,2,0,1474182208,1474182208,NULL);

/*Table structure for table `ws_user_info` */

DROP TABLE IF EXISTS `ws_user_info`;

CREATE TABLE `ws_user_info` (
  `id` mediumint(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL COMMENT '用户ID',
  `phone` varchar(11) DEFAULT NULL COMMENT '联系电话',
  `school` varchar(60) DEFAULT NULL COMMENT '学校',
  `academy` varchar(60) DEFAULT NULL,
  `grade` varchar(60) DEFAULT NULL,
  `organization` varchar(60) DEFAULT NULL,
  `power` int(10) DEFAULT NULL COMMENT '负责人',
  `create_time` int(10) DEFAULT NULL,
  `update_time` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

/*Data for the table `ws_user_info` */

insert  into `ws_user_info`(`id`,`user_id`,`phone`,`school`,`academy`,`grade`,`organization`,`power`,`create_time`,`update_time`) values (12,80,'18361262555','CUMT','计算机科学与技术学院','大三','学僧在线-后端组-组员',NULL,NULL,NULL),(13,81,'18361262123','CUMT','CS','3','123456',NULL,1474182044,1474182044),(14,82,'18361222222','cumt','cs','4','学生在线',NULL,1474182208,1474182208);

/*Table structure for table `ws_website` */

DROP TABLE IF EXISTS `ws_website`;

CREATE TABLE `ws_website` (
  `id` mediumint(10) unsigned NOT NULL AUTO_INCREMENT,
  `website_name` varchar(60) DEFAULT NULL COMMENT '网站名',
  `copyright` varchar(200) DEFAULT NULL COMMENT '版权信息',
  `status` int(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `reason` text COMMENT '关闭原因',
  `create_time` int(10) DEFAULT NULL,
  `update_time` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `ws_website` */

insert  into `ws_website`(`id`,`website_name`,`copyright`,`status`,`reason`,`create_time`,`update_time`) values (1,'2133424324','34',1,'34324',1471097170,1471156791);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
