@extends('not-logged.mainStoreTemplate')

@section('mainTitle',  $post->titleNoHyphen .' Bruno Hans Blog' )

@section('mainMeta')
    <meta name="twitter:" content="Bruno Hans">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@BrunoHansStore">
    <meta name="twitter:creator" content="@BrunoHansStore">
    <meta name="twitter:title" content="{{$post->titleNoHyphen}}">
    <meta name="twitter:description" content="{{$post->titleNoHyphen}}">
    <meta name="twitter:image:src" content="{{$post->imageToShow}}">
@stop

@section('mainHeader')
    @include('blog.headerBlog')
@stop

@section('mainContent')
    <div class="blogContainer">
        <table>
            <tr>
                <td width="25%">
                </td>
                <td width="50%">
                    {!! $post->content !!}
                </td>
                <td width="25%">
                </td>
            </tr>
        </table>
    </div>
@stop

@section('mainFooter')
    @include('blog.blogFooter')
@stop

