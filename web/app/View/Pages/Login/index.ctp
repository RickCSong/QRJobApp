<?php $this->assign('title', "HomeHub - Login"); ?>

<?php  $this->start('css'); ?>
  <link href="/css/homehub-login.css" rel="stylesheet">  
<?php $this->end('css'); ?>

<div class="row-fluid">
<div class="span12">

  <form class="login-form" action="/login" method="POST" name="User">
    
    <div class="logo">
      HomeHub
    </div>
    <div class="input-controls">
      <input type="text" id="username" name="data[User][username]" placeholder="Username">
      <input type="password" id="password" name="data[User][password]" placeholder="Password">
    </div>
    <div class="alert alert-error hide err"></div>

    <button type="submit" class="btn btn-success btn-large">Log In</button>
    <button type="button" class="btn btn-success btn-large" onClick="parent.location='/register'"> Register </a>
  </form>


</div>
</div>


<?php $this->start('script'); ?>
<script type="text/javascript">

HomeHub.login = (function() {
  // Redirect to this destination
  var destination = '/';

  var auth = {
    "validate": function() {
      var check = ["username","password"];
      for (var c in check) {
        var item = check[c];
        if ($('#' + item).val().length < 1) {
          $('#' + item).focus();
          auth.error('Please enter a ' + item);
          return false;
        }
      }
      return true;
    },
    "error": function(message) {
      if (message != null) {
        $('.err').html(message);
      } else {
        return;
      }
      
      $('.err').slideDown('fast');
      setTimeout(function() {
        $('.err').fadeOut('slow');
      }, 2000);
    }
  };

  return {
    "setup": function() {

      $(".login-form").submit(function() {
        if (!auth.validate()) {
          return false;
        }
      })

      <?php if (isset($error)) { ?>
        auth.error(<?php echo "\"" . $error . "\""?>);
      <?php } ?>

      $('#username').focus();

    }
  }
})();

HomeHub.login.setup();
</script>
<?php $this->end('script'); ?>

