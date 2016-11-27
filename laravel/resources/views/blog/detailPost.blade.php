@extends('not-logged.mainStoreTemplate')

@section('mainTitle',  $post->titleNoHyphen .' Bruno Hans Blog' )

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

