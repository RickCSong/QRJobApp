<?php $this->assign('title', "QRapp.ly - Applications"); ?>

<?php  $this->start('css'); ?>
  <!-- Supply additional CSS here -->
  <link rel="stylesheet" href="/css/app/applications.css">
<?php $this->end('css'); ?>

<br>
<div class="container-fluid">
  <div class="row-fluid">
    <div class="span2">
      <div class="sidebar-nav">

        <ul id="folders" class="nav nav-list">
          <li class="folder-item selected" id="inbox"><i class="icon-folder-close"></i> Inbox</li>
          <li class="folder-item" id="later"><i class="icon-folder-close"></i> Later</li>
          <li class="folder-item" id="sent"><i class="icon-share-alt"></i> Sent</li>
          <li class="folder-item" id="trash"><i class="icon-trash"></i> Trash</li>
        </ul>
      </div>
    </div>

    <div id="mail_panel" class="span10">

      <div id="mail_controls" class="btn-toolbar" style="margin: 0 0 13px">
        <div class="btn-group">
          <button id="delete_mail" class="btn mail-action" disabled><i class="icon-trash"></i> delete</button>
          <button id="move_mail" class="btn mail-action" disabled><i class="icon-move"></i> move</button>
          <button id="forward" class="btn compose mail-action single-item" disabled><i class="icon-arrow-right"></i> forward</button>
          <button id="reply" class="btn compose mail-action single-item" disabled><i class="icon-pencil"></i> reply</button>
        </div>
      </div>

      <table id="mail_items" class="hero-unit table table-hover" style="background-color: #FFFFFF">
        <tbody id="mail_items_TB">
        </tbody>
      </table>
    </div>
  </div>
</div>

<div id="compose_box" class="compose-box modal hide fade in"></div>
<div id="move_to_selector" class="move-to-selector hide"></div>

<?php $this->start('script'); ?>

<script type="text/javascript" src="/js/lib/jquery.qrcode.min.js"></script>
<!-- Supply additional javascript here -->
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

          require(['app/boot/applications'], function(initialize) {
            initialize();
          });
        }
      );
  });
  
</script>

<?php $this->end('script'); ?>
