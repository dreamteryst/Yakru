<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function jsonData()
    {
        return Category::has('courses')->with(['courses' => function($query) {
            $query->latest();
        }])->get();
    } 
}
