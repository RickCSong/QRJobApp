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
        console.log(data.selectedIds[0]);

          //this.trigger('uiMailItemsRequested', {folder: data.selectedIds[0]});
      }

      this.after('initialize', function() {
        this.on('uiJobItemSelectionChanged', this.fetchJobItem);
      });
    }
  }
);
