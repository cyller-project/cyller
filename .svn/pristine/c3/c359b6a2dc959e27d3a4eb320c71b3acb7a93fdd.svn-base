<script>
(function($) {
	$(document).ready(function() {
		
		//로그인 처리
		$(".reg_box").click(function() {
			var mem_id = $("#mem_id").val().replace(/\s/gi, '');
			var mem_passwd = $("#mem_passwd").val().replace(/\s/gi, '');
			
			if(mem_id.length == 0) {
				alert("아이디(이메일주소)를 입력해주세요.");

				$("#mem_id").val("");
				$("#mem_id").focus();
				return;
			}
			$("#mem_id").val(mem_id);

			if(mem_passwd.length == 0) {
				alert("비밀번호를 입력해주세요.");

				$("#mem_passwd").val("");
				$("#mem_passwd").focus();
				return;
			}
			$("#mem_passwd").val(mem_passwd);

			$("#login_frm").submit();
		});
	});
}) (jQuery);
</script>

<div class="join_box">
	<p class="tit">로그인</p>
	<p class="expr"></p>
	<?php echo validation_errors();?>
	
	<?php if($msg != '') :?>
	<div class="msg_box">
		<?php echo $msg;?>
	</div>
	<?php endif;?>
	
	<?=form_open("/member/login_process", array('id'=>'login_frm', 'name'=>'login_frm'));?>
	<div class="datas">
		<ul>
			<li class="f_tit">아이디</li>
			<li class="f_sep">:</li>
			<li class="f_cont">
				<input type="text" name="mem_id" id="mem_id" style="width:100%;" value="<?php echo set_value('mem_id')?>" />				
			</li>
			<li class="f_tit">비밀번호</li>
			<li class="f_sep">:</li>
			<li class="f_cont"><input type="password" name="mem_passwd" id="mem_passwd" style="width:100%;" /></li>
		</ul>
	</div>
	
	<div class="btn_area">
		<p class="reg_box">로그인하기</p>
	</div>
	<?=form_close()?>
	
	<p class="expr2">● 아이디는 이메일주소 형식입니다.</p>
</div>