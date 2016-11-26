@extends('not-logged.mainStoreTemplate')

@section('mainTitle', 'Bruno Hans Blog')

@section('mainHeader')
    @include('blog.headerBlog')
@stop

@section('mainContent')
    <h2>{{$message}}</h2>
    <br/>
    <br/>
    <h2>Upload Blog Image</h2>
    <br/>
    <form action="uploadBlogImage" method="post" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="<?php echo csrf_token() ?>">

        <table>
            <tr>
                <td>Carpeta/titulo del post</td>
                <td><input type="text" name="folder"/></td>
            </tr>
            <tr>
                <td>Nombre de la imagen</td>
                <td><input type="text" name="name"/></td>
            </tr>
            <tr>
                <td>Select image to upload:</td>
                <td><input type="file" name="image" id="image"></td>
            </tr>

            <tr>
                <td colspan="2" align="center">
                    <br/>
                    <br/>
                    <input type="submit" value="upload"/>
                </td>
            </tr>

        </table>

    </form>
@stop