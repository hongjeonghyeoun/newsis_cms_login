<div class="container">
  <div class="row">
    <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 mt-5 pt-3 pb-3 bg-white from-wrapper">
      <div class="container">
        <h3>Login</h3>
        <hr>
        <?php if (session()->get('success')): ?>
          <div class="alert alert-success" role="alert">
            <?= session()->get('success') ?>
          </div>
        <?php endif; ?>
        <form id="loginForm" name="loginForm" class="" action="/" method="post">
          <div class="form-group">
           <label for="user_id">ID</label>
           <input type="text" class="form-control" name="user_id" id="user_id" value="<?php if(get_cookie('id_check_id')){ echo  get_cookie('id_check_id'); }?>">
          </div>
          <div class="form-group">
           <label for="password">Password</label>
           <input type="password" class="form-control" name="password" id="password" value="" autocomplete="on">
          </div>
		  <span class="id_check"><input type="checkbox" <?php if(get_cookie('id_check') == 'Y'){ echo "checked"; }?> id="id_check" name="id_check" value="Y">&nbsp;<label for="id_check">아이디 저장</label></span>
          <?php if (isset($validation)): ?>
            <div class="col-12">
              <div class="alert alert-danger" role="alert">
                <?= $validation->listErrors() ?>
				<?php 	
				if (isset($login_info_err)){
						foreach($login_info_err as $key => $value){
						echo $value.'</br>';
					}
				}
				if (isset($login_check_err)){
						foreach($login_check_err as $key => $value){
						echo $value.'</br>';
					}
				}
				?>
              </div>
            </div>
          <?php endif; ?>

          <div class="row">
            <div class="col-12 col-sm-4">
              <button type="button" class="btn btn-primary" onclick="check_submit(event); return false;">Login</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>