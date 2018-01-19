var editor = new wangEditor('content');
editor.config.uploadImgUrl = '/posts/img/upload';

editor.config.uploadHeaders = {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
};

editor.create();