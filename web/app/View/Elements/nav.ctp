<div class="nav-collapse">
  <ul class="nav">
  	<?php
   		
  		$nav = array(
		    'jobs',
		    'applications'
		);

	    // nav variable is passed from controllers
  		if (isset($name)) {
  			$name = strtolower($name);
  		} else {
  			$name = null;
  		}

	    foreach ($nav as $menu) {
	      if ($name == $menu) {
	        $active = " class=\"active\"";
	      } else {
	        $active = "";
	      }
	      
	      if ($menu != 'home') {
	      	$link = "/$menu";
	      } else {
	      	$link = "/";
	      }
	      echo "<li" . $active . "><a href=\"$link\">" . ucfirst($menu) . "</a></li>\n";
	    }
  	?>
  </ul>
</div><!--/.nav-collapse -->