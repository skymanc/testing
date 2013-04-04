<div id="content">
	<div id="leftpart">
		<div id="tools">
			<input type="button" id="newStage" value="新場景"/>
			<input type="button" id="delItem" value="刪除"/>
			<input type="button" id="copyItem" value="複製"/>
			<input type="button" id="set0degree" value="歸0度"/>
			<input type="button" id="lrTurn" value="上下顛倒"/>
			<input type="button" id="udTurn" value="左右顛倒"/>
			<input type="button" id="upStair" value="上一層"/>
			<input type="button" id="downStair" value="下一層"/>
			<input type="button" id="fixPic" value="固定"/>
			<input type="button" id="realSize" value="原始尺寸"/>
			<input type="button" id="" value="透明度(無)"/>
			<input type="button" id="" value="隱藏物件(無)"/>
			<input type="button" id="" value="歷史上一步(無)"/>
			<input type="button" id="" value="歷史下一步(無)"/>
			<input type="button" id="nextimg" value="暫存且新增下一張" />
			<input type="button" id="publish" value="發表作品" />
		</div>
		<div id="ccanvas" data-process="1">
			<canvas id="canvas" width="800" height="600" style="border:5px solid #E3DDE8;"></canvas>
		</div>
		<div id="history">
		</div>
	</div>
	<div id="rightpart">
		<span class="item"><img src="assets/images/123.jpg" data-type='element' data-cover="123.jpg" width='64' height='64' class="dra"></span>
		<span class="item"><img src="assets/images/123.jpg" data-type='element' data-cover="123.jpg" width='64' height='64' class="dra"></span>
		<span class="item"><img src="assets/images/123.jpg" data-type='element' data-cover="123.jpg" width='64' height='64' class="dra"></span>
		<span class="item"><img src="assets/images/123.jpg" data-type='element' data-cover="123.jpg" width='64' height='64' class="dra"></span>
		<span class="item"><img src="assets/images/123.jpg" data-type='element' data-cover="123.jpg" width='64' height='64' class="dra"></span>
		<span class="item"><img src="assets/images/123.jpg" data-type='element' data-cover="123.jpg" width='64' height='64' class="dra"></span>
		<span class="item"><img src="assets/images/123.jpg" data-type='element' data-cover="123.jpg" width='64' height='64' class="dra"></span>
		<span class="item"><img src="assets/images/123.jpg" data-type='element' data-cover="123.jpg" width='64' height='64' class="dra"></span>
		<span class="item"><img src="assets/images/123.jpg" data-type='element' data-cover="123.jpg" width='64' height='64' class="dra"></span>
		<span class="item"><img src="assets/images/123.jpg" data-type='element' data-cover="123.jpg" width='64' height='64' class="dra"></span>
		<span class="item"><img src="assets/images/123.jpg" data-type='element' data-cover="123.jpg" width='64' height='64' class="dra"></span>
		<span class="item"><img src="assets/images/123.jpg" data-type='element' data-cover="123.jpg" width='64' height='64' class="dra"></span>
		<span class="item"><img src="assets/images/123.jpg" data-type='element' data-cover="123.jpg" width='64' height='64' class="dra"></span>

	</div>
</div>
<div style='display:none'>
	<div id='inline_content' style='padding:10px; background:#fff;'>
    <div class="pcontent">
      <div class="pheader">
        Publish
      </div>
      <div class="player">
        <input class="title" style="color:#898989;" type="text" name="title" id="title" value="故事標題"  onfocus="if (this.value=='故事標題') this.value='';" onblur="if (this.value=='') this.value='故事標題';"/>
      </div>
      <div class="player">
        <textarea name="description" cols="50" rows="5" id="description" class="description" onfocus="if (this.value=='故事描述~') this.value='';" onblur="if (this.value=='') this.value='故事描述~';">故事描述~</textarea>
      </div>
      <div class="ptagdesc">自訂風格標籤</div>
      <div id="modifyTagDiv" ><input style="color:#898989;" type="text" name="modifyTag" class="modifyTag" id="modifyTag" value="請用逗號分隔"  onfocus="if (this.value=='請用逗號分隔') this.value='';" onblur="if (this.value=='') this.value='請用逗號分隔';"/></div>
      <div id="pfbcheck">
          <input type="checkbox" id="pfb" name="pfb" value="1" checked="true" />
          發表到Facebook</div>
      <div id="pubDiv" align="center">
          <input type="button" name="spublic" class="pbtn" id="spublic" value="發佈" />
          <input type="button" name="scancel" class="pbtn" id="scancel" value="取消" />
      </div>
      <div align="center">
        <img id="upload_publish" style="display:none;" src="assets/images/ajax-loader.gif"/>
      </div>
    </div>

	</div>
</div>
<script>
	var canvas = new fabric.Canvas('canvas');	
	var obj = new fabric.Object();
	//canvas.backgroundColor= '#ccc';
	var f = fabric.Image.filters;
	canvas.renderAll();
	var filters = ['grayscale', 'invert', 'remove-white', 'sepia', 'sepia2', 'brightness','noise', 'gradient-transparency', 'pixelate', 'blur', 'sharpen'];
	
	function applyFilter(index, filter) {
	  var obj = canvas.getActiveObject();
	  obj.filters[index] = filter;
	  obj.applyFilters(canvas.renderAll.bind(canvas));
	}

</script>