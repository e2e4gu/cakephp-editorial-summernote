function elfinderDialog(context){ // <------------------ +context
    var fm = $('<div/>').dialogelfinder({
        url : '/summernote/files/list', // change with the url of your connector
        lang : 'en',
        width : 840,
        height: 450,
        destroyOnClose : true,
        getFileCallback : function(file, fm) {
            context.summernote('editor.insertImage', fm.convAbsUrl(file.url));
        },
        commandsOptions : {
            getfile : {
                oncomplete : 'close',
                folders : false
            }
        }
    }).dialogelfinder('instance');
}
