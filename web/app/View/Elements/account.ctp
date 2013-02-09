<div class="btn-group pull-right">
	<?php if (isset($user) && isset($user['username'])) { ?>
		<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
			<i class="icon-user"></i> <?php echo $user['username'] ?>
			<span class="caret"></span>
		</a>
		<ul class="dropdown-menu">
			<li><a href="/profile">Profile</a></li>
			<li class="divider"></li>
			<li><a href="/logout">Sign Out</a></li>
		</ul>
	<?php } else { ?>
		<a class="btn" data-toggle="dropdown" href="/login"> Login </a>
	<?php } ?>
</div>