'use strict';

define(

  [
    'app/component_data/job_items',
    'app/component_ui/job_folders',
  ],

  function(
    JobItemsData,
    JobFoldersUI) {

    function initialize() {
      JobItemsData.attachTo(document, {
        itemContainerSelector: '#job-items',
        descriptionContainerSelector: '#job-description'
      });
      JobFoldersUI.attachTo('#job-items');
    }

    return initialize;
  }
);
