'use strict';

define(

  [
    'app/component_data/mail_items',
    'app/component_data/compose_box',
    'app/component_data/move_to',
    'app/component_ui/mail_items',
    'app/component_ui/mail_controls',
    'app/component_ui/compose_box',
    'app/component_ui/mail_folders',
    'app/component_ui/move_to_selector'
  ],

  function(
    MailItemsData,
    ComposeBoxData,
    MoveToData,
    MailItemsUI,
    MailControlsUI,
    ComposeBoxUI,
    MailFoldersUI,
    MoveToSelectorUI) {

    function initialize() {
      MailItemsData.attachTo(document);
      ComposeBoxData.attachTo(document);
      MoveToData.attachTo(document);
      MailItemsUI.attachTo('#mail_items', {itemContainerSelector: '#mail_items_TB'});
      MailControlsUI.attachTo('#mail_controls');
      ComposeBoxUI.attachTo('#compose_box');
      MailFoldersUI.attachTo('#folders');
      MoveToSelectorUI.attachTo('#move_to_selector', {moveActionSelector: '#move_mail'});
    }

    return initialize;
  }
);
