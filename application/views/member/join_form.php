
	<script>
	(function($) {
		$(document).ready(function() {
			$("#mem_passwd").bind("keydown", function(e) {
				var val = $("#mem_passwd").val();

				if(e.keyCode == 32) {
					alert("비밀번호에 공백을 입력하실 수 없습니다.");
					$("#mem_passwd").val(val.substring(0, val.length-1));

					return;
				}
			});

			//비밀번호확인
			$("#mem_repasswd").keyup(function(e) {
				var mem_passwd = $("#mem_passwd").val().replace(/\s/gi, '');
				var mem_repasswd = $("#mem_repasswd").val().replace(/\s/gi, '');

				if(mem_passwd != mem_repasswd) {
					$("#passwd_compare").text('불일치').removeClass("compare").addClass("nocompare");
				}
				else {
					$("#passwd_compare").text("일치").removeClass("nocompare").addClass("compare");
				}
			});
			
			//회원가입 처리
			$(".reg_box").click(function() {
				var mem_id = $("#mem_id").val().replace(/\s/gi, '');
				var mem_name = $("#mem_name").val().replace(/\s/gi, '');
				var mem_passwd = $("#mem_passwd").val().replace(/\s/gi, '');
				var mem_repasswd = $("#mem_repasswd").val().replace(/\s/gi, '');

				if(mem_id.length == 0) {
					alert("아이디(이메일주소)를 입력해주세요.");

					$("#mem_id").val("");
					$("#mem_id").focus();
					return;
				}
				$("#mem_id").val(mem_id);

				if(mem_name.length == 0) {
					alert("이름을 입력해주세요.");

					$("#mem_name").val("");
					$("#mem_name").focus();
					return;
				}
				$("#mem_name").val(mem_name);

				if(mem_passwd.length == 0) {
					alert("비밀번호를 입력해주세요.");

					$("#mem_passwd").val("");
					$("#mem_passwd").focus();
					return;
				}
				$("#mem_passwd").val(mem_passwd);

				if(mem_passwd != mem_repasswd) {
					alert("비밀번호를 확인해 주세요.");
					return;
				}

				$("#mem_reg_frm").submit();
			});
		});
	}) (jQuery);
	</script>
	
	<div class="join_box">
		<p class="tit">회원가입</p>
		<p class="expr">● 이메일 주소를 아이디로 사용하실 수 있습니다.</p>
		<?php echo validation_errors();?>
		
		<?=form_open("/member/join_progress/r", array('id'=>'mem_reg_frm', 'name'=>'mem_reg_frm'));?>
		<div class="datas">
			<ul>
				<li class="f_tit">이메일 주소</li>
				<li class="f_sep">:</li>
				<li class="f_cont">
					<input type="text" name="mem_id" id="mem_id" style="width:100%;" value="<?php echo set_value('mem_id')?>" />				
				</li>
				<li class="f_tit">이름</li>
				<li class="f_sep">:</li>
				<li class="f_cont"><input type="text" name="mem_name" id="mem_name" style="width:100%;"  value="<?php echo set_value('mem_name')?>" /></li>
				<li class="f_tit">비밀번호</li>
				<li class="f_sep">:</li>
				<li class="f_cont"><input type="password" name="mem_passwd" id="mem_passwd" style="width:70%;" /></li>
				<li class="f_tit">비밀번호 확인</li>
				<li class="f_sep">:</li>
				<li class="f_cont"><input type="password" name="mem_repasswd" id="mem_repasswd" style="width:70%;" /><span id="passwd_compare"></span></li>
			</ul>
		</div>
		
		<div class="btn_area">
			<p class="reg_box">가입하기</p>
		</div>
		<?=form_close()?>
		
		<p class="expr2">● 작성하신 이메일 주소로 발송된 인증메일을 확인하시면 가입이 완료됩니다.</p>
	</div>
