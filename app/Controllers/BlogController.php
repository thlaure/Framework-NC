<?php

namespace App\Controllers;

class BlogController extends Controller
{
    public function welcome()
    {
        return $this->view('blog.welcome');
    }

    public function index()
    {
        $stmt = $this->db->getPDO()->query('SELECT * FROM post ORDER BY created_at DESC;');
        $posts = $stmt->fetchAll();
        return $this->view('blog.index', compact('posts'));
    }

    public function show(int $id)
    {
        $stmt = $this->db->getPDO()->prepare('SELECT * FROM post WHERE id = ?');
        $stmt->execute([$id]);
        $post = $stmt->fetch();
        return $this->view('blog.show', compact('post'));
    }
}