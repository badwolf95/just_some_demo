
{*
	{$test}
	{$arr.title}
	{$arr['name']}

	{$arr2.1.title}
	{$arr2['1']['name']}

*}
<!-- 首字母大写 -->
{$test|capitalize}
<!-- 字符串连接 -->
{$test|cat:"hhhhhhhhhhhhh"}
<!-- 格式化 -->
{$time|date_format}
<!-- 为空时设置为默认值 ，可同时设置多个调节-->
{$love|default:"is you"|upper}
<!-- url转码 -->
{$url|escape:"url"|lower}
<!-- 换行转换 -->
{$nl2br|nl2br}
<!-- 判断语句 -->
{if $score gt 90}
优秀
{elseif $score gt 80}
良好
{else}
不合格
{/if}
<!-- 循环语句 section-->
{section name=arr loop=$arr3}
<br/>section<br/>
	{$arr3[arr].title}
	{$arr3[arr].name}
	{$arr3[arr].sex}
<br/>
{/section}
<!-- 循环语句 foreach -->
{foreach $arr3 as $arr}
<br/>foreach<br/>
	{$arr.title}
	{$arr.name}
	<br/>
{/foreach}

{foreach $arr4 as $arr}
<br/>foreachelse<br/>
	{$arr.title}
	{$arr.name}
	{$arr.sex}
{foreachelse}
想看啥？没有！
{/foreach}


<br/>
	{$imooc}
<br/>
<!-- 类对象 -->
{$fruit->grow(array('苹果','上天了'))}

<!-- smarty使用PHP内置函数 -->
<!-- 内置函数的调用必须遵循smarty的格式，也就是{'这是第一个参数'|函数:'第二个参数':'第N个'.....} -->

<!-- str_replace('d','h',$str); -->
<br/>
{'d'|str_replace:'h':$abc}
<!-- date('Y-m-d H:i:s') -->
<br/>
{'Y-m-d H:i:s'|date:$date}

<!-- 函数的注册 -->
<br/>
<!-- 函数的话，p1和p2是参数里的键值对的关系索引 -->
<!-- 函数会自动将关系索引的值打包成数组发给函数调用 -->
{f_test p1='苹果' p2='菠萝'}




