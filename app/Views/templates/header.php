<?php
	$os_chk = false;
	preg_match('/MSIE (.*?);/', $_SERVER['HTTP_USER_AGENT'], $matches);

	if(count($matches)<2){
		preg_match('/Trident\/\d{1,2}.\d{1,2}; rv:([0-9]*)/', $_SERVER['HTTP_USER_AGENT'], $matches);
	}

	if (count($matches)>1){ $version = $matches[1];//$matches변수값이 있으면 IE브라우저
		if($version<=8){
			//8버전 이하
			$os_chk = true;
		}else{
			//8버전이상
			$os_chk = false;
		}
	}else{
		//다른 브라우저
		$os_chk = false;
	}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=Edge"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/css/style.css">
<?php if($os_chk == true){?>
		<script src="/assets/js/jquery-1.9.1.min.js"></script>
<?php }else{?>
		<script src="/assets/js/jquery-3.6.0.min.js"></script>
<?php
	}
?>
	<script src="/assets/js/cms_common.js"></script>
	<script src="/assets/js/login.js?rnd=202207180904"></script>
    <title>CMS NEWSIS</title>

  </head>
  <body id="cmsbody">
    <?php
      $uri = service('uri');
     ?>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container">
      <a class="navbar-brand" href="/">Ci4 Login</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <?php if (session()->get('user_id')): ?>
        <ul class="navbar-nav mr-auto">
          <li class="nav-item <?= ($uri->getSegment(1) == 'dashboard' ? 'active' : null) ?>">
            <a class="nav-link"  href="/dashboard">Dashboard</a>
          </li>
        </ul>
        <ul class="navbar-nav my-2 my-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="/logout">Logout</a>
          </li>
        </ul>
      <?php else: ?>
        <ul class="navbar-nav mr-auto">
          <li class="nav-item <?= ($uri->getSegment(1) == '' ? 'active' : null) ?>">
            <a class="nav-link" href="/">Login</a>
          </li>
        </ul>
        <?php endif; ?>
      </div>
      </div>
    </nav> 