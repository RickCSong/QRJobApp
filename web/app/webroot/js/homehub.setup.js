HomeHub.setup = {};

HomeHub.setup.device = function() {
	var ulSetupList = $("#setup-list");

	var btnSetupNext = $("#setup-next");
	var btnSetupPrev = $("#setup-prev");
	var btnSetupFinish = $("#setup-finish");

	var setupStages = []
	var numSetupStages = $("li", ulSetupList).size();
	var curStage = 0;

	var deviceSerial;
	var deviceName;

	// Setup initial stages
	for (var i = 0; i < numSetupStages; i++) {
		setupStages.push($("#setup-page-" + i));
	}

	// 
	updateDisplay = function() { 	
		$("li", ulSetupList).each(function() {
			if ($(this).index() == curStage) {
				$(this).addClass("active");
			} else {
				$(this).removeClass("active");
			}
		});

		$.each(setupStages, function(index, stage) {
			if (index == curStage) {
				stage.removeClass("setup-inactive");
			} else {
				stage.addClass("setup-inactive");
			}
		});
	}

	var setupButtons = function() {	
		$("#setup-form").validationEngine({
			onFailure: function() {
        $("#setup-next").click(false);
        $("#setup-next").addClass('disabled');
      },
      onSuccess: function() {
        $("#setup-next").click(true);
        $("#setup-next").removeClass('disabled');
      }
		});

		changeStage();

		// These mess up click
		btnSetupNext.click(function() {
			curStage = (curStage + 1);
			changeStage();
		});

		btnSetupPrev.click(function() {
			curStage = (curStage - 1);
			changeStage();
		});

		btnSetupFinish.click(function() {
			alert("serial: " + deviceSerial + "\nname: " + deviceName);
		});
	};
	
	var changeStage = function() {
		deviceSerial = $("#setup-serial").val();
		deviceName = $("#setup-name").val();		

		if (curStage == 0) {
			btnSetupPrev.hide();
		} else {
			btnSetupPrev.show();
		}

		if (curStage == (numSetupStages - 1)) {
			btnSetupNext.hide();
			btnSetupFinish.show();
		} else {
			btnSetupNext.show();
			btnSetupFinish.hide();
		}

		updateDisplay();
	}
	
	return {
		layout: function() {
			setupButtons();
		}
	};
}();