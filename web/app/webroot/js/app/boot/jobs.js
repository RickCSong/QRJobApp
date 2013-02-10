'use strict';

define(

  [
    'app/component_data/job_items',
    'app/component_ui/job_items',
    'app/component_ui/job_folders',
  ],

  function(
    JobItemsData,
    JobItemsUI,
    JobFoldersUI) {

    function initialize() {
      //JobItemsData.attachTo(document);
      //JobItemsUI.attachTo('#job-items', {itemContainerSelector: '#job_panel'});
      JobFoldersUI.attachTo('#job-items');
    }

    return initialize;
  }
);
