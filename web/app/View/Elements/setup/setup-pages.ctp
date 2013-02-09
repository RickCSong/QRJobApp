<!-- Page 0 -->
<div id="setup-page-0">
	<div class="setup-heading">
		<h1> Connect your device </h1>
	</div>

	<div class="setup-body">

		<div class="control-group-help">
			<label class="control-label" for="setup-serial">Device serial number</label>
			<div class="controls">
				<input id="setup-serial" class="validate[required]" type="text" placeholder="Serial Number"> 
				<p class="control-help-block"> We should be able to automatically detect brand </p>
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="setup-location">IP address</label>
			<div class="controls">
				<input id="setup-location" class="validate[required]" type="text" placeholder="XXX.XX.XX.XX"> 
			</div>
		</div>

	</div>
</div>
<!-- End of Page 0 -->

<!-- Page 1 -->
<div id="setup-page-1" class="setup-inactive">
	<div class="setup-heading">
		<h1> Give your device a name </h1>
	</div>

	<div class="setup-body">
		<div class="control-group">
			<label class="control-label" for="setup-location">Device name</label>
			<div class="controls">
				<input id="setup-location" class="validate[required]" type="text"> 
			</div>
		</div>
	</div>

</div>
<!-- End of Page 1 -->


<!-- Page 2 -->
<div id="setup-page-2" class="setup-inactive">
	<div class="setup-heading">
		<h1> Customize additional settings </h1>
	</div>

	<div class="setup-body">

		<div class="control-group">
			<label class="control-label" for="setup-location">Location in home</label>
			<div class="controls">
				<input id="setup-location" class="validate[required]" type="text" placeholder="Location"> 
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="multiSelect">Multiselect option</label>
			<div class="controls">
        <select id="multiSelect" multiple="multiple">
          <option>1</option>
          <option>2</option>
          <option>3</option>
          <option>4</option>
          <option>5</option>
        </select>
      </div>
		</div>

		<div class="control-group">
      <label class="control-label" for="optionsCheckbox">Checkbox</label>
      <div class="controls">
        <label class="checkbox">
          <input type="checkbox" id="optionsCheckbox" value="option1">
          Option one is this and that—be sure to include why it's great
        </label>
      </div>
    </div>

    <div class="control-group">
			<label class="control-label" for="multiSelect">Multiselect option</label>
			<div class="controls">
        <select id="multiSelect" multiple="multiple">
          <option>1</option>
          <option>2</option>
          <option>3</option>
          <option>4</option>
          <option>5</option>
        </select>
      </div>
		</div>

	</div>
</div>
<!-- End of Page 2 -->


<!-- Page 3 -->
<div id="setup-page-3" class="setup-inactive">
	<div class="setup-heading">
		<h1> Finalize </h1>
	</div>

	<div class="setup-body">
		List finalized selections here.
	</div>
</div>
<!-- End of Page 3 -->
