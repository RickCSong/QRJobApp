<?php $this->assign('title', "HomeHub - Profile"); ?>

<?php  $this->start('css'); ?>
<?php $this->end('css'); ?>

<div class="row-fluid">
  <div class="span12">
  	<table border="0">
  		<tr>
  			<td> Username: </td>
  			<td> <?php echo $user['username'] ?> </td>
  		<tr>
  		<tr>
  			<td> Name: </td>
  			<td> <?php echo $user['name'] ?> </td>
  		<tr>
  		<tr>
  			<td> Address: </td>
  			<td> <?php echo $user['address'] ?> </td>
  		<tr>
  		<tr>
  			<td> E-mail: </td>
  			<td> <?php echo $user['email'] ?> </td>
  		<tr>
  	</table>

    <form action="/users/UpdatePassword" method="POST" name="User" style="margin-top:25px;">
      <input type="text" id="oldPassword" name="oldPassword" placeholder="old password">
      <input type="text" id="newPassword" name="newPassword" placeholder="new password">
      <input type="text" id="newPasswordConfirm" placeholder="confirm new password">
      <button type="submit" class="btn" style="margin-bottom:9px;"> Update Password </button>
    </form>

  </div><!--/span-->
</div><!--/row-->


<?php $this->start('script'); ?>
<!-- Supply additional javascript here -->
<script type="text/javascript">
HomeHub.profile = (function() {
  return {
    setup: function() {

    }
  }
})();

HomeHub.profile.setup();
</script>
<?php $this->end('script'); ?>