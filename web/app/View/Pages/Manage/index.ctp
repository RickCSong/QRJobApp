<?php $this->assign('title', "HomeHub - Manage"); ?>

<?php  $this->start('css'); ?>
  <!-- Supply additional CSS here -->
<?php $this->end('css'); ?>

<!-- Consider using a tabular interface.  That way, they can monitor and manage every device without navbar tabs -->

<div class="row-fluid">
  <div class="span3">
    <div class="well sidebar-nav">
      <ul class="nav nav-list">

        <li class="nav-header">Living Room</li>
        <li class="nav-element active">
          <a href="#">Thermostat</a>
        </li>
        <li class="nav-element">
          <a href="#">TV</a>
        </li>
        <li class="nav-element">
          <a href="#">Music</a>
        </li>
        

        <li class="nav-header">Kitchen</li>
        <li class="nav-element">
          <a href="#">Stove</a>
        </li>
        <li class="nav-element">
          <a href="#">Oven</a>
        </li>

        <li class="nav-header">Additional</li>
        <li class="nav-element">
          <a href="#">Lights</a>
        </li>
        <li class="nav-element">
          <a href="#">Garage</a>
        </li>
        <li class="nav-element">
          <a href="#">Sprinklers</a>
        </li>

        <li class="divider"></li>


        <li>
          <button class="btn btn-success" onClick="window.location='/manage/setup'">
            <i class="icon-plus icon-white"></i>
            Add new device
          </button>
        </li>
      </ul>
    </div><!--/.well -->
  </div><!--/span-->
  <div class="span9">
    <div class="row-fluid">
      <div class="tabbable"> <!-- Only required for left/right tabs -->
        <ul class="nav nav-tabs">
          <li class="active"><a href="#tab1" data-toggle="tab">Monitor</a></li>
          <li><a href="#tab2" data-toggle="tab">Manage</a></li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane active" id="tab1">

            <h2>Temperature</h2>
            <div style="height: 300px;">
              <div id="chart" >
                <svg>
                </svg>
              </div>
            </div>

          </div> <!-- tab-pane 1 -->

          <div class="tab-pane" id="tab2">

            <div class="row-fluid">
              <div class="span4">
                <h2>Heading</h2>
                <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
                <p><a class="btn" href="#">View details &raquo;</a></p>
              </div><!--/span-->
              <div class="span4">
                <h2>Heading</h2>
                <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
                <p><a class="btn" href="#">View details &raquo;</a></p>
              </div><!--/span-->
              <div class="span4">
                <h2>Heading</h2>
                <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
                <p><a class="btn" href="#">View details &raquo;</a></p>
              </div><!--/span-->
            </div>

            <div class="row-fluid">
              <div class="span4">
                <h2>Heading</h2>
                <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
                <p><a class="btn" href="#">View details &raquo;</a></p>
              </div><!--/span-->
              <div class="span4">
                <h2>Heading</h2>
                <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
                <p><a class="btn" href="#">View details &raquo;</a></p>
              </div><!--/span-->
              <div class="span4">
                <h2>Heading</h2>
                <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
                <p><a class="btn" href="#">View details &raquo;</a></p>
              </div><!--/span-->
            </div>

          </div> <!-- tab-pane 2 -->  

        </div>
      </div>

    </div><!--/row-->
  </div><!--/span-->
</div><!--/row-->


<?php $this->start('script'); ?>
<!-- Supply additional javascript here -->
<script type="text/javascript">

  // Fix in future
  function renderGraph() {
    nv.addGraph(function() {  
      var chart = nv.models.lineChart();

      chart.xAxis
          .axisLabel('Time')
          .tickFormat(d3.format(',r'));

      chart.yAxis
          .axisLabel('Temperature (F)')
         .tickFormat(d3.format('.02f'));

      d3.select('#chart svg')
          .datum(sinAndCos())
        .transition().duration(500)
          .call(chart);

      nv.utils.windowResize(function() { d3.select('#chart svg').call(chart) });

      return chart;
    });  
  }

  renderGraph();

  /**************************************
  * Simple test data generator
  */

  function sinAndCos() {
    var sin = [],
        cos = [];

    for (var i = 0; i < 100; i++) {
      sin.push({x: i, y: Math.sin(i/10)});
      cos.push({x: i, y: .5 * Math.cos(i/10)});
    }

    return [
      {
        values: sin,
        key: 'Sine Wave',
        color: '#ff7f0e'
      },
      {
        values: cos,
        key: 'Cosine Wave',
        color: '#2ca02c'
      }
    ];
  }


</script>
<?php $this->end('script'); ?>