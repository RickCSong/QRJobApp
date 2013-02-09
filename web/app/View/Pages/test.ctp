<?php $this->assign('title', "QRapp.ly - About"); ?>

<?php  $this->start('css'); ?>
  <!-- Supply additional CSS here -->
<?php $this->end('css'); ?>

<div id="qrcode"></div>

<?php $this->start('script'); ?>

<script type="text/javascript" src="/js/lib/jquery.qrcode.js"></script>
<script type="text/javascript" src="/js/lib/qrcode.js"></script>

<script type="text/javascript">
	jQuery('#qrcode').qrcode({
		text	: "http://jetienne.com"
	});	
</script>


<?php $this->end('script'); ?>
