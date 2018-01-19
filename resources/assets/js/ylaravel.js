var editor = new wangEditor('content');

editor.config.uploadImgUrl = 'posts/image/upload';

editor.Config.uploadImgHeaders = {
    'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
};

editor.create();