// 拖拽插件
Base.extend('drag',drag)
function drag(){
	var nodes = arguments;
	for(var i = 0;i < this.elements.length;i++){
		addEvent(this.elements[i],'mousedown',function(e){
			var _this = this; // 此处 this 等价于 this.elements[i]
			var diffX = e.clientX - this.offsetLeft;	// 存储鼠标点击处距左边框的距离
			var diffY = e.clientY - this.offsetTop;		// 存储鼠标点击处距上边框的距离
			var flag = false;
			for(var i = 0;i < nodes.length;i++){
				if(e.target == nodes[i]) {
					flag = true;
					break;
				}
			}
		
			
			if(flag){
				addEvent(document,'mousemove',move);
				addEvent(document,'mouseup',up);
			}else{
				removeEvent(document,'mousemove',move);
				removeEvent(document,'mouseup',up);
			}
			function move(e){
				var left = e.clientX - diffX;
				var top = e.clientY - diffY;
				left < 0 ? left = 0 : left = left;
				left > (innerWidth - _this.offsetWidth) ? left = (innerWidth - _this.offsetWidth) : left = left;
				top < 0 ? top = 0 : top = top;
				top > (innerHeight - _this.offsetWidth) ? top = (innerHeight - _this.offsetHeight) : top = top;
				_this.style.left = left + 'px';
				_this.style.top = top + 'px';
			}
			function up(){
				removeEvent(this,'mousemove',move);
				removeEvent(this,'mouseup',up);
			}
		});
	}
	
	return this;
}