function testBlogContent() {

    createPost(0);
}

function createBlogContent() {
    createPost(1);
}

function createPost($isTest) {
    var nicE = new nicEditors.findEditor('postContent');

    var postIsTest = document.getElementById('isTest');
    postIsTest.value = '1';

    var postContent = document.getElementById('postContentTextHtml');
    //postContent.value = nicE.getContent();
    postContent.value = tinyMCE.get('mytextarea').getContent()

    var post = document.getElementById('uploadPostForm');
    post.submit();
}