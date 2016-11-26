@extends('not-logged.mainStoreTemplate')

@section('mainTitle', 'Bruno Hans Blog')

@section('mainIncludes')
    <script type="text/javascript" src="{{ URL::asset('js/niceedit/nicEdit.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/blog.js') }}"></script>

    <script src='//cdn.tinymce.com/4/tinymce.min.js'></script>
    <script>
        tinymce.init({
            selector: "#mytextarea",
            height: 500,
            plugins: [
                "advlist autolink autosave link image lists charmap print preview hr anchor pagebreak spellchecker",
                "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                "table contextmenu directionality emoticons template textcolor paste fullpage textcolor colorpicker textpattern"
            ],

            toolbar1: "newdocument fullpage | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | styleselect formatselect fontselect fontsizeselect",
            toolbar2: "cut copy paste | searchreplace | bullist numlist | outdent indent blockquote | undo redo | link unlink anchor image media code | insertdatetime preview | forecolor backcolor",
            toolbar3: "table | hr removeformat | subscript superscript | charmap emoticons | print fullscreen | ltr rtl | spellchecker | visualchars visualblocks nonbreaking template pagebreak restoredraft",

            menubar: false,
            toolbar_items_size: 'small',

            style_formats: [{
                title: 'Bold text',
                inline: 'b'
            }, {
                title: 'Red text',
                inline: 'span',
                styles: {
                    color: '#ff0000'
                }
            }, {
                title: 'Red header',
                block: 'h1',
                styles: {
                    color: '#ff0000'
                }
            }, {
                title: 'Example 1',
                inline: 'span',
                classes: 'example1'
            }, {
                title: 'Example 2',
                inline: 'span',
                classes: 'example2'
            }, {
                title: 'Table styles'
            }, {
                title: 'Table row 1',
                selector: 'tr',
                classes: 'tablerow1'
            }],

            templates: [{
                title: 'Test template 1',
                content: 'Test 1'
            }, {
                title: 'Test template 2',
                content: 'Test 2'
            }],
            content_css: [
                '//fast.fonts.net/cssapi/e6dc9b99-64fe-4292-ad98-6974f93cd2a2.css',
                '//www.tinymce.com/css/codepen.min.css'
            ]
        });
    </script>
@stop

@section('mainHeader')
    @include('blog.headerBlog')
@stop

@section('mainContent')
    <script>
        //bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
        bkLib.onDomLoaded(function() {
            new nicEditor({fullPanel: true}).panelInstance('postContent');
        });

    </script>

    <h1>CREATE/EDIT POST</h1> <a href="/blogTest"> <button> Ver Post en Test </button></a>
    <form id="uploadPostForm" action="/blogAdmin/uploadPost" method="post">
        <input type="hidden" name="_token" value="<?php echo csrf_token() ?>">
        <input id='isTest' type="hidden" value="{{$post->test}}" name="isTest"/>
        <br/>
        TITULO DEL POST
        <br/>
        <input id='postTitle' type="text" value="{{$post->title}}" name="postTitle"/>
        <br/>
        <input id='postContentTextHtml' type="hidden" name="postContentTextHtml"/>

        <br/>
        <textarea id="mytextarea">{{$post->content}}</textarea>
        <br/>
    </form>
    <button onclick="testBlogContent()"> Testear/PROBAR</button>
    <button onclick="createBlogContent()"> GUARDAR/PUBLICAR </button>
    <br/>
    <br/>
@stop
