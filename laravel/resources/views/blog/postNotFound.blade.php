@extends('not-logged.mainStoreTemplate')

@section('mainTitle', 'Bruno Hans Blog')

@section('mainHeader')
    @include('blog.headerBlog')
@stop

@section('mainContent')
    <div class="blogContainer" style="text-align: center">
        <br/>
        <br/>
        <h2>Error : {{$error}}
            <br/>
            <br/>
            <a href="/blog">
                <button>Volver</button>
            </a>
        </h2>
    </div>
@stop

@section('mainFooter')
    @include('blog.blogFooter')
@stop