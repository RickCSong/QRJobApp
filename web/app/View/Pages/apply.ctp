<?php $this->assign('title', "QRapp.ly - Apply"); ?>

<?php  $this->start('css'); ?>
  <!-- Supply additional CSS here -->
<?php $this->end('css'); ?>

<div>
	Job ID: <?php echo $job ?> 
</div>
<div> 
	User ID: <?php echo $user ?>
</div>
<div>
	Timestamp: <?php echo $timestamp ?>
</div>


<?php $this->start('script'); ?>

<?php $this->end('script'); ?>
