// JavaScript Document
function addEvent(obj,type,fun){
	obj.addEventListener(type,fun,false);
};
function removeEvent(obj,type,fun){
	obj.removeEventListener(type,fun,false);
};
var b = function(args){
	return new Base(args);	// 返回一个 Base 对象
}
var Base = function(args){
	
	this.elements = [];	// dom结点数组
	if(typeof args == 'object'){
		if(args != undefined){
			this.elements[0] = args;
		}
	}else if(typeof args == 'string'){
		// $(#id .class tag) 类型处理
		if(args.indexOf(' ') != -1){
			var childElements = [];				// 防止覆盖的临时数组
			var node = [];						// 存储父节点的数组
			var elements = args.split(' ');		// 分割字符串后的数组
			for(var i = 0; i < elements.length; ++i){
				if(node.length == 0) node.push(document);	// getTags getClass 方法父节点（第二个参数）不能为空
				switch (elements[i].charAt(0)){
					case '#':	
						childElements = [];
						childElements.push(this.getId(elements[i].substring(1)));
						node = childElements;
						break;
					case '.':
						childElements = [];
						for(var j = 0; j < node.length; ++j){
							var arr = this.getClass(elements[i].substring(1),node[j]);	//以数组存储父节点为node[j]的所有类名为elements[i]节点
							for(var k = 0; k < arr.length; ++k){
								childElements.push(arr[k]);
							}
						}
						node = childElements;
						break;
					default :
						childElements = [];
						for(var j = 0; j < node.length; ++j){
							var arr = this.getTags(elements[i],node[j]);	//以数组存储父节点为node[j]的所有标签为elements[i]节点
							for(var k = 0; k < arr.length; ++k){
								childElements.push(arr[k]);
							}
						}
						node = childElements;
				}
			}
			this.elements = childElements;
			
		}else{	// find 处理
			switch (args.charAt(0)){
				case '#':	
						this.elements.push(this.getId(args.substring(1)));
						break;
				case '.':
						this.elements = this.getClass(args.substring(1));
						break;
				default :
						this.elements = this.getTags(args);
			}
		}
		
	}else if(typeof args == 'function'){
		addEvent(document,'DOMContentLoaded',args);
	}
};

Base.prototype.getId = function(id){
	return document.getElementById(id);
};

// 获取（传来结点下）同类名数组
Base.prototype.getClass = function(className,parentNode){
	var node = null;
	var tempElements = [];
	if(arguments.length == 1){
		node = document;
	}else if(parentNode != undefined){
		node = parentNode;
	}
	var all = node.getElementsByTagName('*');
	for(var i = 0;i < all.length;i++){
		if(all[i].className == className) tempElements.push(all[i]);
	}
	return tempElements;
};

// 获取 elements数组中某一个元素结点 返回Base对象
Base.prototype.gb = function(num){	
	var target = this.elements[num];
	this.elements = [];
	this.elements[0] = target;
	return this;
};

// 返回元素节点对象
Base.prototype.ge = function(num){	// 获取 elements数组中某一个元素结点
	return this.elements[num];
}

// 返回首节点
Base.prototype.first = function(){
	return this.elements[0];
};

// 返回末结点
Base.prototype.last = function(){
	return this.elements[this.elements.length - 1];
};

Base.prototype.getName = function(name){
	var arr = document.getElementsByName(name);
	for(var i = 0;i < arr.length;i++){
		this.elements.push(arr[i]);
	}
	return this;
};

// 返回 parentNode 下名为tag的数组
Base.prototype.getTags = function(tag,parentNode){
	var node = null;
	var tempElements = [];
	if(arguments.length == 1){
		node = document;
	}else if(parentNode != undefined){
		node = parentNode;
	}
	var arr = node.getElementsByTagName(tag);
	for(var i = 0;i < arr.length;i++){
		tempElements.push(arr[i]);
	}
	return tempElements;
};

//  find 查找子节点
Base.prototype.find = function(str){
	var tempElements = [];
	for(var i = 0;i < this.elements.length;i++){
		switch (str.charAt(0)){
			case '#':	
					tempElements.push(this.getId(str.substring(1)));
					break;
			case '.':
					var arr = this.getClass(str.substring(1),this.elements[i]);	//某个节点下的 同类名元素数组
					for(var j = 0;j < arr.length;j++){
						tempElements.push(arr[j]);
					}
					break;
			default :
					var arr = this.getTags(str,this.elements[i]);//某个节点下的 同标签名元素数组
					for (var j = 0;j < arr.length;j++){
						tempElements.push(arr[j]);
					}
		}
	}
	this.elements = tempElements;
	return this;
};

//	添加class
Base.prototype.addClass = function(className){
	for(var i = 0;i < this.elements.length;i++){
		this.elements[i].className += ' ' + className;
	}
	return this;
};

//	移除class
Base.prototype.removeClass = function(className){
	for(var i = 0;i < this.elements.length;i++){
		this.elements[i].className = this.elements[i].className.replace(new RegExp('(\\s|^)' + className + '(\\s|$)'),' ')
	}
	return this;
};

//	设置CSS
Base.prototype.css = function(attr,value){
	for(var i = 0;i < this.elements.length;i++){
		if(arguments.length == 1){
			return window.getComputedStyle(this.elements[i],null)[attr];
		}
		this.elements[i].style[attr] = value;
	}
	return this;
};

//	设置 innerHTML
Base.prototype.html = function(str){
	for(var i = 0;i < this.elements.length;i++){
		if(arguments.length == 0){
			return this.elements[i].innerHTML; // 一般用 ID 获取
		}
		this.elements[i].innerHTML = str;
	}
	return this;
};

//	触发点击事件
Base.prototype.click = function(fun){
	for(var i = 0;i < this.elements.length;i++){
		addEvent(this.elements[i],'click',fun);
	}
	return this;
};

// hover事件
Base.prototype.hover = function(over,out){
	for(var i = 0;i < this.elements.length;i++){
		addEvent(this.elements[i],'mouseover',over);
		addEvent(this.elements[i],'mouseout',out);
	}
	return this;
};

//	设置物体居中
Base.prototype.center = function(){
	for(var i = 0;i < this.elements.length;i++){
		var computedStyle = getComputedStyle(this.elements[i],null);
		var left = (document.documentElement.clientWidth - parseFloat(computedStyle.width))/2;
		var top = (document.documentElement.clientHeight - parseFloat(computedStyle.height))/2;
		this.elements[i].style.left = left + 'px';
		this.elements[i].style.top = top + 'px';
	}
	return this;
};

//	浏览器窗口事件
Base.prototype.resize = function(fun){
	addEvent(window,'resize',fun);
	return this;
};

// 锁屏
Base.prototype.lock = function(){
	for(var i = 0;i < this.elements.length;i++){
		this.elements[i].style.width = document.documentElement.clientWidth + 'px';
		this.elements[i].style.height = document.documentElement.clientHeight + 'px';
		this.elements[i].style.display = 'block';
		document.documentElement.overflow = 'hidden';
	}
	return this;
};

// 解屏
Base.prototype.unlock = function(){
	for(var i = 0;i < this.elements.length;i++){
		this.elements[i].style.display = 'none';
		document.documentElement.overflow = 'auto';
	}
	return this;
};

// animate
Base.prototype.animate = function(obj){
	var attr = (obj.attr == 'x') ? 'left' : (obj.attr == 'y') ? 'top' : 			// 可选，默认为left基准
				(obj.attr == 'w') ? 'width' : (obj.attr == 'h') ? 'height' :
				(obj.attr == 'o') ? 'opacity' : 'left';
	var start = (obj.start != undefined) ? obj.start : parseFloat(this.css(attr));	// 可选，开始值默认为computed值
	var step = (obj.step != undefined) ? obj.step : 10;								// 可选，默认步长为10
	var time = (obj.time != undefined) ? obj.time : 50;								// 可选，默认频率50ms一次
	var target = obj.target; 											
	var alter = obj.alter;
	var speed = (obj.speed != undefined) ? obj.speed : 6;							// 可选，默认缓冲速 度为6
	var type = (obj.type == 0) ? 'constant' : (obj.type == 1) ? 'buffer' : 'buffer' // 可选，默认缓冲运动方式
	this.css(attr,(attr == 'opacity') ? start : start + 'px');
	if(obj.alter != undefined && obj.target == undefined){
		target = start + alter;
	}else if(obj.alter == undefined && obj.target == undefined){
		return new Error('至少要传一个alter增量或target目标量！');
	}
	if (start > target) step = -step;
	for(var i = 0;i < this.elements.length;i++){
		
		var element = this.elements[i];
		clearInterval(element.timer);	// 全局变量是window的属性
		element.timer = setInterval(function(){
			var current = parseFloat(window.getComputedStyle(element,null)[attr]);	// 将当前属性值转成 number 赋给 current
			if(type == 'buffer') 	// 因为（target - current）是float所以递减过程中不能到达0
					step = (attr == 'opacity') ? Math.ceil((target - current)*100/speed) : (step > 0) ? Math.ceil((target - current)/speed) : Math.floor((target - current)/speed);
					
			if(attr == 'opacity'){	// 色彩透明度动画
				if(step >= 0 && current*100 + step >= target*100) {
					setOpacity();
				}else if(step <= 0 && current*100 + step <= target*100){
					setOpacity();
				}else{
					element.style[attr] = parseInt(current*100 + step)/100;
				}
				
			}else{	// 运动动画
				
				if(step >= 0 && current + step >= target) {
					setTarget();
				}else if(step <= 0 && current + step <= target){
					setTarget();
				}else{
					element.style[attr] = current + step + 'px';
				}
			}
			
		},time);
		function setTarget(){
			element.style[attr] = target + 'px';
			clearInterval(element.timer);
			if(obj.fun != undefined) obj.fun();
		}
		function setOpacity(){
			element.style[attr] = target;
			clearInterval(element.timer);
			if(obj.fun != undefined) obj.fun();
		}
	}
	return this;
};


// 插件引入接口
Base.extend = function(plugin,fun){
	Base.prototype[plugin] = fun;
};
