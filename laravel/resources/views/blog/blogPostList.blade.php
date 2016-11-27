@extends('not-logged.mainStoreTemplate')

@section('mainTitle', 'Bruno Hans Blog')

@section('mainHeader')
    @include('blog.headerBlog')
@stop

@section('mainContent')
    <div class="blogContainer">
        @foreach ($postList as $post)
            <table>
                <tr>
                    <td width="25%">
                    </td>
                    <td width="50%">
                        <a href="/blog/{{$post->title}}">{!! $post->resume !!}</a>
                    </td>
                    <td width="25%">
                    </td>
                </tr>
            </table>
            <br/><br/>
            <br/><br/>
        @endforeach
    </div>
@stop

@section('mainFooter')
    @include('blog.blogFooter')
@stop