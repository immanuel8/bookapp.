<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Laravel\Lumen\Routing\Controller as BaseController;

class BooksController extends BaseController
{
    public function index(){
        return Book::all();
    }
}