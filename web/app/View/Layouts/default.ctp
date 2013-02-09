<!DOCTYPE html>
<html lang="en">
<!-- head -->
<html>
  <head>
    <meta charset="utf-8">
    <title>Flight Mail</title>
    <link rel="stylesheet" href="/css/bootstrap-responsive.css">
    <link rel="stylesheet" href="/css/bootstrap.css">
    <link rel="stylesheet" href="/css/custom.css">
  </head>

<!-- body -->
<body>
  <?php echo $this->fetch('content'); ?>

	<script type="text/javascript" src="/js/lib/jquery.js"></script>
    <script type="text/javascript" src="/js/lib/es5-shim.js"></script>
    <script type="text/javascript" src="/js/lib/es5-sham.js"></script>
    <script type="text/javascript" data-main="/js/requireMain.js" src="/js/lib/require.js"></script>
    <script>
      require(
        [
          'flight/lib/compose',
          'flight/lib/registry',
          'flight/lib/advice',
          'flight/lib/logger',
          'flight/tools/debug/debug'
        ],

        function(compose, registry, advice, withLogging, debug) {
          debug.enable(true);
          compose.mixin(registry, [advice.withAdvice, withLogging]);
          require(['app/boot/page'], function(initialize) {
            initialize();
          });
        }
      );
    </script>
	<!-- Additional local javascript -->
	
</body> <!-- body end -->
</html>
