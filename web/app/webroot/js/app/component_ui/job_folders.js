'use strict';

define(

  [
    'flight/lib/component',
    './with_select'
  ],

  function(defineComponent, withSelect) {

    return defineComponent(jobItems, withSelect);

    function jobItems() {

      this.defaultAttrs({
        selectedClass: 'selected',
        selectionChangedEvent: 'uiJobItemSelectionChanged',

        //selectors
        itemSelector: 'li.job-item',
        selectedItemSelector: 'li.job-item.selected',
      });

      this.fetchJobItem = function(ev, data) {
        this.trigger('uiJobDescriptionRequested', {job_id: data.selectedIds[0].substring(4)});
      }

      this.after('initialize', function() {
        this.trigger('uiJobItemsRequested');
        this.on('uiJobItemSelectionChanged', this.fetchJobItem);
        this.trigger('uiJobDescriptionRequested', {job_id: "job_1".substring(4)});
      });
    }
  }
);
