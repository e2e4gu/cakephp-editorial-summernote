function elfinderDialog() {
  var fm = $('<div/>').dialogelfinder({
    //url : '/files/list.json', // change with the url of your connector
    url : '/summernote/files/list', // change with the url of your connector
    lang : 'en',
    width : 840,
    height: 450,
    destroyOnClose : true,
    getFileCallback : function(files, fm) {
      $('.editor').summernote('editor.insertImage', files.url);
    },
    commandsOptions : {
      getfile : {
        oncomplete : 'close',
        folders : false
      }
    }

  }).dialogelfinder('instance');
}
