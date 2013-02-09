HomeHub.logger = function() {
  var logger;
  var instance = false;

  function init(element) {
    logger = $(element);
  }

  function update() {
    if (!instance) {
      instance = true;
      $.ajax({
        type: "POST",
        url: "/test/process",
        data: {
          'function': 'update',
        },
        dataType: "json",
        success: function(data) {
          var autoScroll = ((logger[0].scrollHeight - logger.scrollTop()) == logger.innerHeight());

          logger.empty();

          if (data.text) {
            for (var i = 0; i < data.text.length; i++) {
              logger.append(data.text[i]);
            } 
          }

          if (autoScroll) {
            logger.scrollTop(logger[0].scrollHeight);
          }
          instance = false;
        }
      });
    } 
  }

  function send(device, message) { 
    update();

    $.ajax({
      type: "POST",
      url: "/test/process",
      data: {
        'function': 'send',
        'device': device, 
        'message': message
      },
      success: function(){
        update();
      }
    });
  }

  function curl(obj) { 
    obj['attr'] = JSON.stringify(obj['attr']);

    $.ajax({
      type: "POST",
      url: "/device",
      data: obj,
      success: function(data) {
        data = $.parseJSON(data);
        send("console", data['message']);
      }
    });
  }

  function python(input) {
    $.ajax({
      type: "POST",
      url: "/device/parse",
      data: {
        'inputDevice': 'console',
        'input': input
      },
      success: function(data) {
      }
    });
  }

  function reset() {
    $.ajax({
      type: "POST",
      url: "/test/process",
      data: {
        'function': 'reset',
      },
      success: function() {
        update();
      }
    });
  }

  return {
    init: init,
    update: update,
    send: send, 
    curl: curl,
    python: python,
    reset: reset
  }
}();