'use strict';

define(

  [
    'flight/lib/component',
    'lib/mustache',
    'app/data',
    'app/templates'
  ],

  function(defineComponent, Mustache, dataStore, templates) {
    return defineComponent(mailItems);

    function mailItems() {

      this.defaultAttrs({
        folder: 'inbox'
      });

      this.serveMailItems = function(ev, data) {
        var folder = (data && data.folder) || this.attr.folder;
        this.trigger("dataMailItemsServed", {markup: this.renderItems(this.assembleItems(folder))})
      };

      this.renderItems = function(items) {
        return Mustache.render(templates.mailItem, {mailItems: items});
      };

      this.assembleItems = function(folder) {
        var items = [];

        dataStore.applications.forEach(function(each) {
          each.folder = "inbox"
          if (each.folder == folder) {
            items.push(this.getItemForView(each));  
          }
        }, this);
        
        return items;
      };

      this.getItemForView = function(itemData) {
        var thisItem, thisContact, thisJob, msg

        thisItem = {id: "application_" + itemData.id};

        thisContact = dataStore.users.filter(function(user) {
          return user.id == itemData.user_id
        })[0];

        thisJob = dataStore.jobs.filter(function(job) {
          return job.id == itemData.job_id
        })[0];

        thisItem.name = [thisContact.firstName, thisContact.lastName].join(' ');
        thisItem.contactId = "contact_" + thisContact.id;
        thisItem.school = thisContact.school;
        thisItem.phone = thisContact.phone;
        thisItem.email = thisContact.email;
        thisItem.jobName = thisJob.company + " - " + thisJob.title;

        return thisItem;
      };

      this.after("initialize", function() {
        this.on("uiMailItemsRequested", this.serveMailItems);
        this.on("dataMailItemsRefreshRequested", this.serveMailItems);
      });
    }
  }
);
