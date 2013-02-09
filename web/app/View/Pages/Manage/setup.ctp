<?php $this->assign('title', "HomeHub - Manage"); ?>

<?php  $this->start('css'); ?>
  <!-- Supply additional CSS here -->
  <link href="/css/homehub-setup.css" rel="stylesheet">  
<?php $this->end('css'); ?>

<div class="row-fluid setup-content">
  <div class="span3 setup-sidebar">
    <?php echo $this->element("setup/setup-list")?>
  </div>
  <div class="span9"> 

    <form id="setup-form">
      <?php echo $this->element("setup/setup-pages")?>
    </form>

    <div class="setup-nav"> 
      <button class="btn btn-primary setup-nav-button" id="setup-prev"> &laquo; Previous</button>
      <button class="btn btn-primary setup-nav-button" id="setup-next"> Next &raquo;</button>
      <button class="btn btn-primary setup-nav-button" id="setup-finish"> Finish </button>
    </div>
  </div>

</div>

<?php $this->start('script'); ?>
  <!-- Supply additional javascript here -->
  
<script type="text/javascript">
HomeHub.setup.device.layout();
</script>
  
<?php $this->end('script'); ?>