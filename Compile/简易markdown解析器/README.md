## 简易Markdown解析器
这是2017年3月19日CCF的第三题，比赛时刻挑战自我极限，两个字，开森  

主要有以下几个功能：
- 六级标题
- 段落
- 无序列表
- 斜体
- 超链接
> 其中无序列表只有一级，其他可以任意嵌套

> 可以在控制台测试，参考测试如  
# _li_
# [text](link)
* this is ul
* the second one
* _test_[text](link)test
test p
test p again
# _this_test[_text_](link)_test_test_test_[_text](link

> 还不是太严谨，但基本符合题目要求了。感兴趣的可以参考注释