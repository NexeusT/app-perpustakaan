<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = [
            ['id' => 1, 'name' => 'Novel'],
            ['id' => 2, 'name' => 'Teknologi'],
            ['id' => 3, 'name' => 'Komik'],
        ];

        return view('categories.index', compact('categories'));
    }
}