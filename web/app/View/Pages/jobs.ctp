<?php $this->assign('title', "QRapp.ly - Jobs"); ?>

<?php  $this->start('css'); ?>
  <!-- Supply additional CSS here -->
  <link rel="stylesheet" href="/css/app/jobs.css">
<?php $this->end('css'); ?>

<br>
<div class="container-fluid">
  <div class="row-fluid">
    <div class="span2">
      <div class="sidebar-nav">

        <button id="new_job" class="btn compose">New Job</button>

        <br><br>

        <ul id="job-items" class="nav nav-list">
        </ul>
      </div>
    </div>

    <div id="job-description" class="span10">
    	
    </div>
  </div>
</div>

<?php $this->start('script'); ?>
<script type="text/javascript" src="/js/lib/jquery.qrcode.min.js"></script>
<script type="text/javascript">
	$.when(
      $.ajax({
          url: '/data/applicants.json'
      }),
      $.ajax({
          url: '/data/applications.json'
      }),
      $.ajax({
          url: '/data/jobs.json'
      })
    ).then( function(users, applications, jobs){
      define('bootstrapData', function () {
        return {
          users: users[0],
          applications: applications[0],
          jobs: jobs[0]
        }
      });
      
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

          require(['app/boot/jobs'], function(initialize) {
            initialize();
          });
        }
      );
  });
</script>


<?php $this->end('script'); ?>
