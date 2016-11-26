@extends('not-logged.mainStoreTemplate')

@section('mainTitle', 'Bruno Hans Blog')

@section('mainHeader')
    @include('blog.headerBlog')
@stop

@section('mainContent')
    <br/>
    <br/>
    <div style="text-align: center">
        <h2>Error : {{$error}}
            <br/>
            <br/>
            <a href="/blog">
                <button>Volver</button>
            </a>
        </h2>
    </div>
@stop
