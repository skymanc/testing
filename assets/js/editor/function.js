function binddra()//物件綁定拖拉
{
	$(".dra").draggable({
		cursor: "move",
		cursorAt: {left: 32, top: 32},
		helper: "clone",
		start: function(event, ui) {	
		},
		stop: function(event, ui) { 
		}
	});
}

function getAjaximg( src , x , y , type , id )
{
	fabric.Image.fromURL( src, function(obj) {
		var width = obj.getWidth();
		var height = obj.getHeight();
		var nick = src;
		if( width > height )
		{
			//太寬就縮到320px，這邊可以設定希望進圖時的大小
			var s = imgSize/width;
			var oImg = obj.set({ left: x, top: y, nick:nick ,tip:1 , itemtype:type , itemid:id }).scale(s);//tip預設為1，算是套件的BUG所以一定要設，主要是讓他被拉進去時會記錄路徑,nick為照片路徑
			canvas.add(oImg).renderAll();
			canvas.setActiveObject(oImg);
		}
		else
		{
			//太長就縮到320px
			var s = imgSize/height;
			var oImg = obj.set({ left: x, top: y, nick:nick ,tip:1 , itemtype:type , itemid:id}).scale(s);//tip預設為1，算是套件的BUG所以一定要設，主要是讓他被拉進去時會記錄路徑，主要是讓他被拉進去時會記錄路徑,nick為照片路徑
			canvas.add(oImg).renderAll();
			canvas.setActiveObject(oImg);
		}
	});
}

function newStageClick()
{
	var objectCount = canvas.getObjects().length;
	var hisSize = $("#history div").size();
	if( objectCount > 0 || hisSize > 0 )
	{
		if( window.confirm("畫布即將被清空!沒問題嗎?") )
		{
			sessionStorage.clear();
			$("#history").empty();
			canvas.clear();
		}
	}
	else
	{
		canvas.clear();
	}
}

function delItemClick()
{
	obj = canvas.getActiveObject();
	canvas.remove(obj);
}

function copyItemClick()
{
	obj = canvas.getActiveObject();
	if( obj != null )
	{
		var oImg ;
		var x = obj.getLeft();  
		var y = obj.getTop();
		var object = fabric.util.object.clone(obj);
		object.set("left",x+10);
		object.set("top",y+10);
		canvas.add(object);
		canvas.renderAll();	
	}
}

function set0degreeClick()
{
	obj = canvas.getActiveObject();
	obj.setAngle(0);
	obj.setActive(false);
	canvas.renderAll();
}
function lrTurnClick()
{
	obj = canvas.getActiveObject();
	if( obj != null )
	{
		if( obj.flipY )
		{
			obj.flipY = false;
		}
		else
		{
			obj.flipY = true;
		}
		canvas.renderAll();	
	}	
}
function udTurnClick()
{
	obj = canvas.getActiveObject();
	if( obj != null )
	{
		if( obj.flipX )
		{
			obj.flipX = false;
		}
		else
		{
			obj.flipX = true;
		}
		canvas.renderAll();	
	}
}
function upStairClick()
{
	obj = canvas.getActiveObject();
	canvas.bringForward(obj);
}
function downStairClick()
{
	obj = canvas.getActiveObject();
	canvas.sendBackwards(obj);
}
function fixPicClick()
{
	obj = canvas.getActiveObject(); 
	if( obj != null )
	{         
		if( obj.lockMovementX )
		{
			// if any better api?
			obj.lockMovementX = false;
			obj.lockMovementY = false;
			obj.lockScalingX = false;
			obj.lockScalingY = false;
			obj.lockUniScaling = false;
			obj.lockRotation = false;
		}
		else
		{
			obj.lockMovementX = true;
			obj.lockMovementY = true;
			obj.lockScalingX = true;
			obj.lockScalingY = true;
			obj.lockUniScaling = true;
			obj.lockRotation = true;
			obj.set("lockMovementX",true);
		}
	}
	canvas.renderAll();	
}
function publishClick()
{
	//alert("Publish按鈕");
	 $.colorbox({ 
		href: "#inline_content", 
		inline:true, 
		width:"600px", 
		height:"480px", 
		transition: "elastic" ,
		escKey: false,
		overlayClose: false
		},function(){
	});
}
/*
status = 1 不檢查畫布是否空白
*/
function nextimgClick( status )
{
	var objectCount = canvas.getObjects().length;
	if( objectCount > 0 )
	{
		canvas.deactivateAll();
		var imgDataUrl = canvas.toDataURL();
		var process = $("#ccanvas").data("process");
		var key = "page"+process;
		if( typeof(sessionStorage[key]) != "undefined" )
		{
			sessionStorage[key] = JSON.stringify(canvas.toDatalessJSON());
			if( typeof($("#history").find("div[data-process='"+process+"']").html()) == "undefined" )
			{
				var img = new Image();
				img.src = imgDataUrl;
				var hisImg = "<div class='hisImgDiv' id='hisImgDiv' data-process='"+process+"'><img id='hisImg' src='"+imgDataUrl+"' width='100' height='75'/><img src='assets/images/delete.png' id='delhis' /></div>";
				$("#history").append(hisImg);
			}
			else
			{
				$("#history").find("div[data-process='"+process+"']").find("img[id=hisImg]").attr("src",imgDataUrl);
			}
		}
		else
		{
			sessionStorage[key] = JSON.stringify(canvas.toDatalessJSON());
			var img = new Image();
			img.src = imgDataUrl;
			var hisImg = "<div class='hisImgDiv' id='hisImgDiv' data-process='"+process+"'><img id='hisImg' src='"+imgDataUrl+"' width='100' height='75'/><img src='assets/images/delete.png' id='delhis' /></div>";
			$("#history").append(hisImg);
		}
		canvas.clear();
		$("#ccanvas").data("process",new Date().getTime());
		}
	else
	{
		if( status != 1 )
		{
			alert("您目前的畫布是空白的~請先創作~");
		}
	}

	
}
function hisImgClick( source )
{
	var process = $(source).parent().data("process");
	$("#ccanvas").data("process",process);
	//console.log("ccanvas process:"+$("#ccanvas").data("process"));
	var key = "page"+process;
	var content = sessionStorage[key];
	canvas.loadFromDatalessJSON( content , function () {
		canvas.renderAll();
	});
}
function delhisClick( source )
{
	if( window.confirm("你即將移除此畫布!") )
	{
		var process = $(source).parent().data("process");
		$(source).parent().remove();
		var key = "page"+process;
		sessionStorage.removeItem(key);
		//console.log("process"+process);
		//console.log(" ccanvasprocess"+$("#ccanvas").data("process"));
		if( $("#ccanvas").data("process") == process )
		{
			canvas.clear();
		}
	}
}
function realSizeClick()
{
	obj = canvas.getActiveObject();
	var width = obj.getOriginalSize().width;
	var height = obj.getOriginalSize().height;
	var x = obj.getLeft();  
	var y = obj.getTop();
	if( width > height )
	{
		//太寬就縮到320px
		var s = imgSize/width;
		obj.scale(s).rotate(0).set({ left: x, top: y });
	}
	else
	{
		//太長就縮到320px
		var s = imgSize/height;
		obj.scale(s).rotate(0).set({ left: x, top: y });
	}
	canvas.renderAll();
}
function spublicClick( source )
{
	nextimgClick( 1 );
	var title = $("#title").val();
	var desc = $("#description").val();
	var pfb = false;//是否發布到facebook
  	if($('#pfb').is(':checked')) 
  	{
  		pfb = true;
  	}
  	$.ajax({
    		type:'POST',
    		url:'story/save_story',
    		async: false,
    		data:{ title:title,
    				desc:desc,
    				pfb:pfb
    		},
    		success: function(response) {
    			//回傳id,開始上傳、儲存圖片
    			//check最後一張圖是否有放到暫存區
    			
    			save_hisImg(response);
    			//alert("good");
    			//$.colorbox.close();
    		}
    	});
}

function save_hisImg( id )
{
	var hisSize = $("#history div").size();
	var count = 1;
	$("#history div").each(function(){
		$("#inline_content").empty().append("正在儲存第"+count+"張圖!");
		var process = $(this).data("process");
		var key = "page"+process;
		var content = sessionStorage[key];
		var img = $(this).find("img[id=hisImg]").attr("src");
		//console.log(img);
		$.ajax({
    		type:'POST',
    		url:'story/save_storypage',
    		async: false,
    		data:{ 
    			id:id,
    			story_json:content,
    			img:img,
    			order:count
    		},
    		success: function(response) {
    			//回傳id,開始上傳、儲存圖片
    			//check最後一張圖是否有放到暫存區

    			//alert(response);
    			//$.colorbox.close();
    		}
    	});
    	count++;
	});
	$.colorbox.close();
	//頁面導至個人頁面
	location.href="http://app.mokafunpp.com/editor";
}