<?php

namespace testmiguel\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use testmiguel\BlogImage;
use testmiguel\BlogPost;

class BlogController extends Controller
{
    public function indexAdmin(Request $request)
    {
        return $this->createPostAdmin($request);

    }

    public function loadPost(Request $request, $postName)
    {
        $post = '';
        if (Auth::check()) {
            if (Auth::user()->default_role == 1) {
                $post = BlogPost::where('title', '=', $postName)->first();
            }
        } else {
            $post = BlogPost::where('title', '=', $postName)->where('test', '=', 0)->first();
        }

        if ($post == '') {
            return view('blog.postNotFound', ['error' => 'Post not found']);
        } else {
            //TODO maybe read the first h1 from content and not just use the URL title
            $post->titleNoHyphen = strtoupper(str_replace('-', ' ', $post->title));
            return view('blog.detailPost', ['post' => $post]);
        }
    }

    public function indexUploadBlogImage(Request $request)
    {
        return view('blog.uploadBlogImage', ['message' => '']);
    }

    public function createPostAdmin(Request $request)
    {
        $post = new BlogPost();
        $post->content = "contenido";
        return view('blog.adminBlogCreate', ['post' => $post]);
    }

    public function editPostAdmin(Request $request, $postName)
    {
        $post = BlogPost::where('title', '=', $postName)->first();

        if ($post == '') {
            return view('blog.postNotFound', ['error' => 'Post not found']);
        } else {
            return view('blog.adminBlogCreate', ['post' => $post]);
        }
    }

    public function uploadBlogImage(Request $request)
    {
        $folder = $request->folder;
        $name = $request->name;

        if ($folder == '' || $name == '') {
            echo 'Error no puede estar vacio el nombre de la carpeta o el nombre';
            return;
        }

        $file = $request->file('image');
        if ($file == '') {
            echo 'No se subio el archivo';
            return;
        }

        $folder = trim($folder);
        $folder = str_replace(' ', '-', $folder);

        $name = trim($name);
        $name = str_replace(' ', '-', $name);

        $name = $name . "." . $file->getClientOriginalExtension();

        $folder = 'blog/' . $folder;
        $file->move($folder, $name);

        $blogImage = new BlogImage();
        $blogImage->folder = $folder;
        $blogImage->original_name = $file->getClientOriginalName();
        $blogImage->entire_name = $folder . "/" . $name;
        $blogImage->save();

        $message = 'Se cargo la imagen en ' . $blogImage->entire_name;

        return view('blog.uploadBlogImage', ['message' => $message]);

    }

    public function uploadPost(Request $request)
    {
        $postTitle = $request->postTitle;
        $postContent = $request->postContentTextHtml;
        $postTest = $request->isTest;

        $postTitle = trim($postTitle);
        $postTitle = str_replace(' ', '-', $postTitle);

        $post = BlogPost::where('title', '=', $postTitle)->first();
        if ($post == '') {
            $post = new BlogPost();
        }
        $post->title = $postTitle;
        $post->content = $postContent;
        $post->test = $postTest;
        $post->keywords = '';

        $post->save();

        echo 'Se creo el post con exito';

    }

    public function listUserPost(Request $request)
    {
        return $this->loadPostList(0);
    }

    public function listUserPostTest(Request $request)
    {
        return $this->loadPostList(1);
    }

    private function getPostResume($post)
    {
        $position = strpos($post->content, "<img");
        if ($position == false) {
            return $post->title;
        } else {
            $imgStr = substr($post->content, $position, strlen($post->content));
            $positionEnd = strpos($imgStr, "/>");
            return substr($post->content, 0, $position + $positionEnd);
        }

        return $post->title;
    }

    private function loadPostList($isTest)
    {
        $postList = BlogPost::where('test', $isTest)->orderBy('created_at', 'desc')->get();

        foreach ($postList as $post) {
            $post->resume = $this->getPostResume($post);
            $post->resume = str_replace('<h1', '<h2', $post->resume);
            $post->resume = str_replace('</h1', '</h2', $post->resume);
        }

        return view('blog.blogPostList', ['postList' => $postList]);
    }

}
