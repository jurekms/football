(function(){

    window.App = {
      Models          : {},
      Collections     : {},
      Views           : {},
      Routers         : {},
      FormsValidators : {},
      Regions: {
          appMenuItems:       $("#menu-items"),
          appEditDashboard:   $("#edit-dashboard")
      },
      ViewInstances : {}

    };



    App.FormsValidators.userEditFV = {
      fields: {
        username: {
          identifier: 'username',
          rules: [
            {
              type   : 'empty',
              prompt : 'Musisz podać nazwę użytkownika.'
            }
          ]
        },
        first_name: {
          identifier: 'first_name',
          rules: [
            {
              type   : 'empty',
              prompt : 'Musisz podać imię użytkownika.'
            }
          ]
        },
        last_name: {
          identifier: 'last_name',
          rules: [
            {
              type   : 'empty',
              prompt : 'Musisz podać nazwisko użytkownika.'
            }
          ]
        },
        groups: {
          identifier: 'groups',
          rules: [
            {
              type   : 'empty',
              prompt : 'Wybierz przynajmniej jedną rolę.'
            }
          ]
        }


      }
    };



    App.showEditRegionViews = function(view) {
      if(App.ViewInstances.editRegionViews) {
        App.ViewInstances.editRegionViews.remove();
      }
      App.ViewInstances.editRegionViews = view;

    };

    App.showMsgUnauthorizedError = function(){
      alert('BŁĄD AUTORYZACJI - PRAWDOPODOBNIE ZOSTAŁEŚ WYLOGOWANY');
      App.router.navigate('/',{trigger : true});
      window.location.reload(true);
    };

    App.showMsgServerError = function(colectionModel, response, options) {

      switch(response.status){
        case 401:
          App.showMsgUnauthorizedError();
          break;
        default:
      };

    };



})()
