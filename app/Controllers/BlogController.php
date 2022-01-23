<?php

namespace App\Controllers;

class BlogController extends Controller
{
    public function index()
    {
        return $this->view('blog.index');
    }

    public function show(int $id)
    {
        $req = $this->db->getPDO()->query('SELECT * FROM post;');
        $posts = $req->fetchAll();
        $postsLength = count($posts);
        for ($i = 0; $i < $postsLength; ++$i) {
            echo $posts[$i]->title;
        }
        return $this->view('blog.show', compact('id'));
    }
}