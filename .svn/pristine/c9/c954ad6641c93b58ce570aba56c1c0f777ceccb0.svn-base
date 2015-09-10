<script type="text/javascript" src="/include/js/jquery-pack.js"></script>
<script type="text/javascript" src="/include/js/jquery.imgareaselect.min.js"></script>
	
<script>
(function($) {
	$(document).ready(function() {
	
		//회원명 수정
		$("#reg_btn_n").click(function() {
			var mem_name = $("#mem_name").val().replace(/\s/gi, '');

			if(mem_name.length == 0) {
				alert("이름을 입력해주세요.");

				$("#mem_name").val("");
				$("#mem_name").focus();
				return;
			}
			$("#mem_name").val(mem_name);

			$("#mem_modi_frm").submit();
		});

		//회원사진 업로드
		$("#reg_btn_p").click(function() {
			var mem_photo = $("#mem_photo").val();
			
			if(mem_photo.length == 0) {
				alert("사진을 선택해주세요.");

				return;
			}

			$("#mem_modi_frm2").submit();
		});
	});
}) (jQuery);

function getHeight($image) {
	$size = getimagesize($image);
	$height = $size[1];
	return $height;
}
//You do not need to alter these functions
function getWidth($image) {
	$size = getimagesize($image);
	$width = $size[0];
	return $width;
}

var thumb_width = 200;
var thumb_height = 240;
var large_img_name = '<?php echo $large_img_name;?>';
var large_img_width = 0;
var large_img_height = 0;

function preview(img, selection) { 
	if(large_img_name != '') {
		var scaleX = thumb_width / selection.width; 
		var scaleY = thumb_height / selection.height; 
	
		$('.thumb_box img').css({ 
			width: Math.round(scaleX * large_img_width) + 'px', 
			height: Math.round(scaleY * large_img_height) + 'px',
			marginLeft: '-' + Math.round(scaleX * selection.x1) + 'px', 
			marginTop: '-' + Math.round(scaleY * selection.y1) + 'px' 
		});
		$('#x1').val(selection.x1);
		$('#y1').val(selection.y1);
		$('#x2').val(selection.x2);
		$('#y2').val(selection.y2);
		$('#w').val(selection.width);
		$('#h').val(selection.height);

		//alert($('.thumb_box img').height());
	}
} 

$(document).ready(function () { 
	
	$('#save_thumb').click(function() {
		var x1 = $('#x1').val();
		var y1 = $('#y1').val();
		var x2 = $('#x2').val();
		var y2 = $('#y2').val();
		var w = $('#w').val();
		var h = $('#h').val();
		if(x1=="" || y1=="" || x2=="" || y2=="" || w=="" || h==""){
			alert("You must make a selection first");
			return false;
		}else{
			$("#mem_modi_frm3").submit();
			
			return true;
		}
	});
}); 

$(window).load(function () { 
	large_img_width = $('#thumbnail').width();
	large_img_height = $('#thumbnail').height();

	$(".photo_box").height(large_img_height+400);
	
	$('#thumbnail').imgAreaSelect({ aspectRatio: '1:140/120', onSelectChange: preview }); 
});

</script>

<div class="join_box">
	<p class="tit">회원정보수정</p>
	<p class="expr"></p>
	<?php echo validation_errors();?>
	<?php echo $result;?>
	
	<?=form_open("/member/join_modi_progress/n", array('id'=>'mem_modi_frm', 'name'=>'mem_modi_frm'));?>
	<div class="datas">
		<ul style="height:80px;">
			<li class="f_tit">이메일 주소</li>
			<li class="f_sep">:</li>
			<li class="f_cont">
				<?php echo $this->session->userdata('userid');?>				
			</li>
			<li class="f_tit">이름</li>
			<li class="f_sep">:</li>
			<li class="f_cont">
				<ul>
					<li><input type="text" name="mem_name" id="mem_name" style="width:50%;"  value="<?php echo iconv('euc-kr', 'utf-8', $this->session->userdata('user_name'));?>" /></li>
					<li><p class="reg_box" style="width:40px;" id="reg_btn_n">수정</p></li>
				</ul>
			</li>
		</ul>
	</div>
	<?=form_close()?>
	
	
	<div class="photo_box">	
		<ul>
			<li class="f_tit" style='width:40px;'>사진</li>
			<li class="f_sep">:</li>
			<li class="f_cont" style='width:310px;'>
				<?=form_open_multipart("/member/join_modi_progress/p", array('id'=>'mem_modi_frm2', 'name'=>'mem_modi_frm2'));?>
				<ul>
					<li><input type="file" name="mem_photo" id="mem_photo" style="width:260px;" /></li>
					<li><p class="reg_box" style="width:40px;" id="reg_btn_p">업로드</p></li>
				</ul>
				<?=form_close()?>
			</li>
		</ul>
		<ul style="padding:10px; width:400px; height:300px; box-sizing:border-box;">
			<li style="width:120px;">
				<p>현재 사진</p>
				<img src="/uploads/memphoto/<?php echo $this->session->userdata('user_photo');?>" style="width:90px;" />
			</li>
			<li style="width:260px;">
				<p>수정할 사진</p>
				<?php if($large_img_name) :?>
				<div class="thumb_box">
					<img src="/uploads/memphoto/<?php echo $large_img_name;?>" style="position: relative; width:200px;" alt="Thumbnail Preview" />
				</div>
		

				<?=form_open("/member/join_modi_progress/t", array('id'=>'mem_modi_frm3', 'name'=>'mem_modi_frm3'));?>
				<input type="hidden" name="x1" value="" id="x1" />
				<input type="hidden" name="y1" value="" id="y1" />
				<input type="hidden" name="x2" value="" id="x2" />
				<input type="hidden" name="y2" value="" id="y2" />
				<input type="hidden" name="w" value="" id="w" />
				<input type="hidden" name="h" value="" id="h" />
				<input type="hidden" name="img_name" value="<?php echo $large_img_name;?>" />
				<?=form_close()?>
				<div style="clear:both; padding-top:10px;">
					<p class="reg_box" style="width:150px;" id="save_thumb">Save Thumbnail</p>
				</div>
				<?php endif;?>
			</li>
		</ul>
		
		<?php if($large_img_name) :?>
		<p style="clear:both; padding:10px 0 0 10px;;">원본사진 : 영역을 선택하세요.</p>
		<div style="width:380px;">
			<img src="/uploads/memphoto/<?php echo $large_img_name;?>" style="float: left; width:380px;" id="thumbnail" alt="Create Thumbnail" />
		</div>
		<?php endif;?>
	</div>
	
	<p class="expr2"></p>
</div>