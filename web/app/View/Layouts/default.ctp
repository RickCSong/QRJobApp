<!DOCTYPE html>
<html lang="en">
<!-- head -->
<head>
  <meta charset="utf-8" />
  <title><?php echo $this->fetch('title'); ?></title>  

  <link href="/css/bootstrap.min.css" rel="stylesheet"> <!-- bootstrap -->
  <link href="/css/bootstrap-responsive.min.css" rel="stylesheet"> <!-- bootstrap responsive -->

  <link href="/css/nv.d3.css" rel="stylesheet"> <!-- nvd3 -->

  <link href="/css/validationEngine.jquery.css" rel="stylesheet"/> <!-- validation engine -->

  <link href="/css/homehub.css" rel="stylesheet">  
  
  <?php 
  	echo $this->fetch('css');
  ?>  
</head> <!-- head -->

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
		

		<!-- content -->
		<div class="content-block container-fluid">
			<?php echo $this->fetch('content'); ?>
		</div>

		<div class="push"><!--//--></div>
	</div> <!-- wrapper -->

	<footer>
	  <div class="container-fluid">
	  	<p>
	  		<?php echo $this->element('footer-nav'); ?>
		  	<?php echo $this->element('footer-brand'); ?>
		  </p>
	  </div>
	</footer>

	<!-- External scripts here -->
	<!-- <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script> jquery -->
	<script type="text/javascript" src="/js/jquery-1.7.1.min.js"></script>  <!-- jquery -->
	<script type="text/javascript" src="/js/bootstrap.min.js"></script>  <!-- bootstrap -->
	<script type="text/javascript" src="/js/spin.min.js"></script>  <!-- spin -->

	<script type="text/javascript" src="/js/jquery.validationEngine-en.js" charset="utf-8"></script> <!-- Validation Engine Locale-->
	<script type="text/javascript" src="/js/jquery.validationEngine.js" charset="utf-8"></script> <!-- Validation Engine -->

	<script type="text/javascript" src="/js/d3.v2.min.js"></script>  <!-- d3 -->
	<script type="text/javascript" src="/js/nv.d3.js"></script>  <!-- nvd3 -->

	<script type="text/javascript" src="/js/homehub.js"></script>  <!-- homehub -->
	<script type="text/javascript" src="/js/homehub.setup.js"></script>  <!-- homehub -->

	<!-- Additional local javascript -->
	<?php if ($this->fetch('script')): ?>
		<?php echo $this->fetch('script'); ?>
	<?php endif; ?>

</body> <!-- body end -->
</html>
