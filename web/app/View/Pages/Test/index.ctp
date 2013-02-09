<?php $this->assign('title', "HomeHub - Test"); ?>

<?php  $this->start('css'); ?>
  <!-- Supply additional CSS here -->
  <link href="/css/homehub-test.css" rel="stylesheet">  
<?php $this->end('css'); ?>

<div class="row-fluid">
  <div class="span12">
    <div> 
      <button class="btn" id="poll-temp-btn"> Poll Temperature </button>
      <button class="btn" id="set-temp-btn"> Set Temperature </button>
      <button class="btn" id="inc-temp-btn"> + Temperature </button>
      <button class="btn" id="dec-temp-btn"> - Temperature </button>
      <button class="btn" id="poll-state-btn" style="margin-left: 50px"> Poll State </button>
      <button class="btn" id="turn-on-btn"> Turn On </button>
      <button class="btn" id="turn-off-btn"> Turn Off </button>

      <button class="btn" id="get-name-btn" style="margin-left: 50px"> Get Sys </button>
      <button class="btn" id="change-name-1-btn"> Change Name 1 </button>
      <button class="btn" id="change-name-2-btn"> Change Name 2 </button>

      <button class="btn" id="clear-log-btn" style="float: right;"> Clear Log </button>
      <!-- <button class="btn" id="python-btn" style="float: right;"> Test Python </button> -->
    </div>
    <div id="logger">
    </div>

    <div class="control-group">
      <div class="controls">
        <div class="input-append">
          <input type="text" id="parse-input" size="16" style="width: 90%; height: 30px; padding-left: 10px"><button type="button" class="btn" id="parse-btn" style="width: 9%; height: 40px;"> Send </button>
        </div>
      </div>
    </div>

  </div><!--/span-->
</div><!--/row-->


<?php $this->start('script'); ?>

<script type="text/javascript" src="/js/homehub.logger.js"></script>  <!-- homehub -->

<!-- Supply additional javascript here -->
<script type="text/javascript">

HomeHub.logger.init("#logger");

$("#poll-temp-btn").click(function() {
  HomeHub.logger.curl({
    'device': 'thermostat',
    'command': 'getTemp',
    'attr': {}
  });
});

$("#set-temp-btn").click(function() {
  HomeHub.logger.curl({
    'device': 'thermostat',
    'command': 'setTemp',
    'attr': {"temperature": 80}
  });
});

$("#inc-temp-btn").click(function() {
  HomeHub.logger.curl({
    'device': 'thermostat',
    'command': 'raiseTemp',
    'attr': {"temperature": 1}
  });
});

$("#dec-temp-btn").click(function() {
  HomeHub.logger.curl({
    'device': 'thermostat',
    'command': 'lowerTemp',
    'attr': {"temperature": 1}
  });
});

$("#poll-state-btn").click(function() {
  HomeHub.logger.curl({
    'device': 'thermostat',
    'command': 'getState',
    'attr': {}
  });
});

$("#turn-on-btn").click(function() {
  HomeHub.logger.curl({
    'device': 'thermostat',
    'command': 'setState',
    'attr': {"state": "on"}
  });
});

$("#turn-off-btn").click(function() {
  HomeHub.logger.curl({
    'device': 'thermostat',
    'command': 'setState',
    'attr': {"state": "off"}
  });
});

$("#get-name-btn").click(function() {
  HomeHub.logger.curl({
    'device': 'thermostat',
    'command': 'getName',
    'attr': {}
  });
});

$("#change-name-1-btn").click(function() {
  HomeHub.logger.curl({
    'device': 'thermostat',
    'command': 'setName',
    'attr': {"name": "Rick-Thermostat"}
  });
});

$("#change-name-2-btn").click(function() {
  HomeHub.logger.curl({
     'device': 'thermostat',
    'command': 'setName',
    'attr': {"name": "Osbert-Thermostat"}
  });
});
/*
$("#python-btn").click(function() {
  var input = 'Raise the thermostat temperature by 2 degrees'
  HomeHub.logger.python(input);
});
*/
$("#parse-btn").click(function() {
  var input = $("#parse-input").val();
  $("#parse-input").val('');
  HomeHub.logger.python(input);
});

$('#parse-input').keypress(function(e) {
  if(e.which == 13) {
      jQuery(this).blur();
      jQuery('#parse-btn').focus().click();
  }
});

$("#clear-log-btn").click(function() {
  HomeHub.logger.reset();
});

setInterval('HomeHub.logger.update()', 500)

</script>
<?php $this->end('script'); ?>