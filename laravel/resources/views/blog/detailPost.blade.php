@extends('not-logged.mainStoreTemplate')

@section('mainTitle',  $post->title .' Bruno Hans Blog' )

@section('mainHeader')
    @include('blog.headerBlog')
@stop

@section('mainContent')
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

