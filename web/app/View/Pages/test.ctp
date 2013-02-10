<?php $this->assign('title', "QRapp.ly - Application"); ?>

<?php  $this->start('css'); ?>
  <!-- Supply additional CSS here -->
<?php $this->end('css'); ?>

<div id="qrcode"></div>

<?php $this->start('script'); ?>

<script type="text/javascript" src="/js/lib/jquery.qrcode.min.js"></script>

<script type="text/javascript">
	$('#qrcode').qrcode({
		width: 120,
		height: 120,
		text	: "Ivan wants Rick's dick!"
	});	
</script>


<?php $this->end('script'); ?>
