<!DOCTYPE html>
<html lang="en">
<!-- head -->
<html>
  <head>
    <meta charset="utf-8">
    <title><?php echo $this->fetch('title'); ?></title>
    <link rel="stylesheet" href="/css/bootstrap.css">
    <link rel="stylesheet" href="/css/bootstrap-responsive.css">
    <link rel="stylesheet" href="/css/app/qrapply.css">

    <?php 
      echo $this->fetch('css');
    ?>  
  </head>

<!-- body -->
<body>
  <div class="wrapper">

    <!-- top header bar -->
    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <button type="button"class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button> 
          <?php echo $this->element('brand'); ?>
          <?php echo $this->element('account'); ?>
          <?php echo $this->element('nav'); ?>
        </div>
      </div>
    </div>

    <div class="content-block container-fluid">
      <?php echo $this->fetch('content'); ?>
    </div>
  </div>

	<script type="text/javascript" src="/js/lib/jquery.js"></script>
  <script type="text/javascript" src="/js/lib/bootstrap.js"></script>
  <script type="text/javascript" src="/js/lib/es5-shim.js"></script>
  <script type="text/javascript" src="/js/lib/es5-sham.js"></script>
  <script type="text/javascript" data-main="/js/requireMain.js" src="/js/lib/require.js"></script>
  <?php if ($this->fetch('script')): ?>
    <?php echo $this->fetch('script'); ?>
  <?php endif; ?>
	<!-- Additional local javascript -->
	
</body> <!-- body end -->
</html>
