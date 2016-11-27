function testBlogContent() {

    createPost(1);
}

function createBlogContent() {
    createPost(0);
}

function createPost(isTest) {
    var nicE = new nicEditors.findEditor('postContent');

    var postIsTest = document.getElementById('isTest');
    postIsTest.value = isTest;

    var postContent = document.getElementById('postContentTextHtml');
    postContent.value = tinyMCE.get('mytextarea').getContent()

    var post = document.getElementById('uploadPostForm');
    post.submit();
}