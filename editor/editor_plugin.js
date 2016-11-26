(function() {
     tinymce.create('tinymce.plugins.DeveloperProjectPortfolio', {
          init : function(ed, url) {
               ed.addButton( 'button_dpp_project', {
                    title : ed.settings.dpp_menu_name,
                    image : url + '/images/folder.png',
                    type : 'menubutton'
               }
             );
             this.addMenuItems(ed);
          },

          addMenuItems: function(ed) {
            var menuItems = ed.settings.dpp_customers.split(',');
            ed.buttons.button_dpp_project.menu = [];
            for (i = 0; i < menuItems.length; i++) {
              var id = menuItems[i].split(':')[0];
              var name = menuItems[i].split(':')[1];
              ed.buttons.button_dpp_project.menu.push({text: name,
                id: id,
                onclick: function() {
                  ed.insertContent('[dpp_projects customer-id="' + this.settings.id + '" customer-name="' + this.settings.text + '"]');
                }
              });
            }
          },

          createControl : function(n, cm) {
               return null;
          },
     });
     tinymce.PluginManager.add( 'dpp_project_script', tinymce.plugins.DeveloperProjectPortfolio );
})();
