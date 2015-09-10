<!DOCTYPE html>
<html>
<head>
	<title>cyller Note</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="stylesheet" href="/include/css/member.css" type="text/css">
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
	<script>
	(function($) {
		$(document).ready(function() {
			$(".main_link").click(function() {
				document.location.href = "/";
			});
			
			$(".mem_join").click(function() {
				document.location.href = "/member/join_form";
			});

			$(".mem_login").click(function() {
				document.location.href = "/member/login";
			});

			$(".mem_joinmodi").click(function() {
				document.location.href = "/member/join_modify";
			});

			$(".mem_logout").click(function() {
				document.location.href = "/member/logout";
			});
		});
	}) (jQuery);
	</script>
</head>
<body>

<div style="width:500px;">
	<header>
		<div class="header">
<?php if($this->session->userdata('userid')) :?>
			<div>
				<p class="mem_logout">로그아웃</p>
				<p class="mem_joinmodi">정보수정</p>
			</div>
<?php else :?>			
			<div>
				<p class="mem_login">로그인</p>
				<p class="mem_join">회원가입</p>
			</div>
<?php endif;?>		
			<h1><span class="main_link">Cyller</span> Note</h1>
			
		</div>
	</header>