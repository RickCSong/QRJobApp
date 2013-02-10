'use strict';

define(

  [
    'flight/lib/component',
    'lib/mustache',
    'app/data',
    'app/templates'
  ],

  function(defineComponent, Mustache, dataStore, templates) {
    return defineComponent(jobItems);

    function jobItems() {

      this.serveJobItems = function(ev, data) {
        this.select('itemContainerSelector').html(this.renderItems(this.assembleItems()));
      };

      this.renderItems = function(items) {
        return Mustache.render(templates.jobItem, {jobItems: items});
      };

      this.assembleItems = function() {
        var items = [];

        dataStore.jobs.forEach(function(each) {
          items.push(this.getItemForView(each));  
        }, this);
        items[0].selected = "selected";
        return items;
      };

      this.getItemForView = function(itemData) {
        var thisItem, thisJob, msg

        thisItem = {id: "job_" + itemData.id};
        thisItem.title = itemData.company + " - " + itemData.title;

        return thisItem;
      };


      this.serveJobDescription = function(ev, data) {
        this.select('descriptionContainerSelector').html(
          this.renderDescription(
            this.getDescription(data)
          )
        );

        $('#qrcode').qrcode({
          width: 100,
          height: 100,
          text  : data.job_id
        }); 
      }

      this.renderDescription = function(item) {
        return Mustache.render(templates.jobDescription, item);
      };

      this.getDescription = function(itemData) {
        var thisItem, thisJob;

        thisItem = {id: "job_" + itemData.job_id};
        thisJob = dataStore.jobs.filter(function(job) {
          return itemData.job_id == job.id;
        })[0];

        thisItem.title = thisJob.title;
        thisItem.company = thisJob.company;
        thisItem.location = thisJob.location;
        thisItem.field = thisJob.field;
        thisItem.duration = thisJob.duration;
        thisItem.description = thisJob.description;
        thisItem.area = thisJob.area;

        return thisItem;
      };


      this.after("initialize", function() {
        this.on("uiJobItemsRequested", this.serveJobItems);
        this.on("uiJobDescriptionRequested", this.serveJobDescription);
      });
    }
  }
);
