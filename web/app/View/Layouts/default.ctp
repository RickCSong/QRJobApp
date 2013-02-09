<!DOCTYPE html>
<html lang="en">
<!-- head -->
<html>
  <head>
    <meta charset="utf-8">
    <title><?php echo $this->fetch('title'); ?></title>
    <link rel="stylesheet" href="/css/bootstrap-responsive.css">
    <link rel="stylesheet" href="/css/bootstrap.css">
    <link rel="stylesheet" href="/css/custom.css">

    <?php 
      echo $this->fetch('css');
    ?>  
  </head>

<!-- body -->
<body>
  <?php echo $this->fetch('content'); ?>

	<script type="text/javascript" src="/js/lib/jquery.js"></script>
  <script type="text/javascript" src="/js/lib/es5-shim.js"></script>
  <script type="text/javascript" src="/js/lib/es5-sham.js"></script>
  <script type="text/javascript" data-main="/js/requireMain.js" src="/js/lib/require.js"></script>
  <?php if ($this->fetch('script')): ?>
    <?php echo $this->fetch('script'); ?>
  <?php endif; ?>
	<!-- Additional local javascript -->
	
</body> <!-- body end -->
</html>
