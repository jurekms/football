window.localStorage.setItem('token', 'DUPA TOKENOWA');

  // Store "old" sync function
  var backboneSync = Backbone.sync

  // Now override
  Backbone.sync = function (method, model, options) {

    /*
     * "options" represents the options passed to the underlying $.ajax call
     */
    var token = window.localStorage.getItem('token');

    if (token) {
      options.headers = {
        'x-access-token': token
      }
    }

    // call the original function
    backboneSync(method, model, options);
  };
