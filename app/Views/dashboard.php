<?php

// var_dump(get_cookie('id_check'));
// var_dump(get_cookie());
?>
<div class="container">
  <div class="row">
    <div class="col-12">
      <h1>Hello, <?= session()->get('user_id') ?></h1>
    </div>
    
    
    <form id="dashForm" name="dashForm" class="" action="/test" method="post"> 
    
        <input type="submit" value="test">
        
    </form>
    
    
    
  </div>
</div> 