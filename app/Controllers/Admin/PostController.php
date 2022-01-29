<?php

namespace App\Controllers\Admin;

use App\Controllers\Controller;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = (new Post($this->getDB()))->all();
        return $this->view('admin.post.index', compact('posts'));
    }

    public function delete(int $id)
    {
        $post = new Post($this->getDB());
        $result = $post->delete($id);
        if ($result) {
            return header('Location: /admin/posts');
        }
    }

    public function edit(int $id)
    {
        $post = (new Post($this->getDB()))->findById($id);
        return $this->view('admin.post.edit', compact('post'));
    }

    public function update(int $id)
    {
        $post  = new Post($this->getDB());
        $result = $post->update($id, $_POST);
        if ($result) {
            return header('Location: /admin/posts');
        }
    }
}