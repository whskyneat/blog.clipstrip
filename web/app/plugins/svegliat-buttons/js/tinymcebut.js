// Script for add button on TinyMCE editor

(function() {

tinymce.create('tinymce.plugins.tinymcebut', {

init : function(ed, url) {

ed.addButton('tinymcebut', {

title : 'Button',

image : url+'/tiny_nota.png',

onclick : function() {

ed.selection.setContent('[button-orange text="Download" title="Download plugin" url="http://www.svegliatemplate.com/"]' + ed.selection.getContent() );

}

});

},

createControl : function(n, cm) {

return null;

},

});

tinymce.PluginManager.add('tinymcebut', tinymce.plugins.tinymcebut);

})();