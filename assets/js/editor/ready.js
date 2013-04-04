var index = 0;
var nowindex = 0;
var mainCat = "";
var itemPage = 1;
var selectedTagId = "";
var itemPerPage = 42;
var imgSize = 200;


var elementPath = "http://app.mokafunpp.com/assets/images/"

$(function(){

	sessionStorage.clear();

	$("#canvas").droppable({
		accept: ".dra",
		drop: function( event, ui ) {
			var src = ui.draggable.attr("src");
			var cover = ui.draggable.data("cover");
			var type = ui.draggable.data("type");
			var id = ui.draggable.data("id");
			var position = $('#canvas').offset();
			var path = "";
			//var off = $('div#content').offset();
			var sx = event.pageX;//+ document.documentElement.scrollTop;
			var sy = event.pageY;//+ document.documentElement.scrollLeft;
			var x = position.left;  
			var y = position.top; 
			var rx = sx-x;
			var ry = sy-y;  
			path = elementPath;
			path = path+cover;
			getAjaximg(path,rx,ry, type, id);
		}
	});

	binddra();
}).on('click','#newStage',function(){
	newStageClick();
}).on('click',"#delItem",function(){
	delItemClick();
}).on('click',"#copyItem",function(){
	copyItemClick();
}).on('click',"#set0degree",function(){
	set0degreeClick();
}).on('click',"#lrTurn",function(){
	lrTurnClick();
}).on('click',"#udTurn",function(){
	udTurnClick();
}).on('click',"#upStair",function(){
	upStairClick();
}).on('click',"#downStair",function(){
	downStairClick();
}).on('click',"#fixPic",function(){
	fixPicClick();
}).on('click',"#publish",function(){
	publishClick();
}).on('click',"#nextimg",function(){
	nextimgClick();
}).on('click',"#realSize",function(){
	realSizeClick();
}).on('click',"#hisImg",function(){
	hisImgClick( $(this) );
}).on('click',"#delhis",function(){
	delhisClick( $(this) );
}).on('click',"#spublic",function(){
	spublicClick( $(this) );
}).on('click',"#scancel",function(){
	$.colorbox.close();
});





