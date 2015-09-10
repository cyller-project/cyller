
	<div class="join_box">
		<p class="tit">회원가입</p>
		
		<div class="msg_box">
		<?php if($result == 3) :?>
			<p class="msg">회원<?php echo $mode;?>이 성공했습니다.</p>
		<?php elseif($result == 4) :?>
			<p class="msg">회원<?php echo $mode;?>에 실패했습니다. (<?php echo $mem_id;?>)</p>
		<?php elseif($result == 1) :?>	
			<p class="msg">회원 <?=$mode?>이 완료되었습니다.</p>
			<p class="msg2">가입하신 이메일(<?=$mem_id?>)로 인증메일이 발송되었습니다.<br />메일을 확인하시면 로그인 하실 수 있습니다.</p>
		<?php else :?>
			<p>회원 <?=$mode?> 중 오류가 발생햇습니다.</p>	
		<?php endif;?>
		</div>
	</div>