<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>cyller Note</title>
	<!--  link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.5/cerulean/bootstrap.min.css" rel="stylesheet" -->
	<link href="/Include/bootstrap/css/bootstrap-cerulean.css" rel="stylesheet" >
	<link href="/include/css/default.css" rel="stylesheet" >
	<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
	<script src="/Include/bootstrap/js/bootstrap.js" ></script>

	<script>
	(function($) {
		$(document).ready(function() {
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

			$(".main_left").height($(window).height() - $(".header").height());
		});
	}) (jQuery);
	</script>
</head>
<body>

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#"><span>Cyller</span> Note</a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
        <li><a href="#">Link</a></li>
        <li class="dropdown">
          <a class="dropdown-toggle" role="button" aria-expanded="false" href="#" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li class="divider"></li>
            <li><a href="#">Separated link</a></li>
            <li class="divider"></li>
            <li><a href="#">One more separated link</a></li>
          </ul>
        </li>
      </ul>
      <form class="navbar-form navbar-left" role="search">
        <div class="form-group">
          <input class="form-control" type="text" placeholder="Search">
        </div>
        <button class="btn btn-default" type="submit">Submit</button>
      </form>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#">Link</a></li>
      </ul>
    </div>
  </div>
</nav>

<header>
	<div class="header">
<?php if($this->session->userdata('userid')) :?>
		<div>
			<p class="mem_logout">로그아웃</p>
			<p class="mem_joinmodi">정보수정</p>
			<span><?php echo iconv('euc-kr', 'utf-8', $this->session->userdata('user_name'));?>님 반갑습니다.</span>
		</div>
<?php else :?>	
		<div>
			<p class="mem_login">로그인</p>
			<p class="mem_join">회원가입</p>
		</div>
<?php endif;?>		
	
		<h1><span>Cyller</span> Note</h1>
		
	</div>
</header>

<div class="body_wrap">
	
	