<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Book;
use Illuminate\http\Request;

class BooksController extends Controller
{
    
    public function index()
    {
        return Book::all();
    }

    // tambahin method show($id) buat kerjain tugas yg nomer 1

    // public function show($id){
    //     //return book::find($id);
    //     return $book = Book::find($id);
    // }

    
    public function getBookbyId($id){
        $book = DB::table('books')->where('id', $id)->first();
        if($book){
            return response()->json(['message'=>'Success', 'data'=>$book], 200);
        }else{
            return response()->json(['message'=>'Book not found'], 404);
        }

    }

    public function store(Request $request){
        $this->validate($request, [
        'title' => 'required',
        'description' => 'required',
        'author' => 'required'
        ]);

        $book = Book::create(
        $request->only(['title', 'description', 'author'])
        );

        return response()->json([
        'created' => true,
        'data' => $book
        ], 201);
    }

  public function update(Request $request, $id){
        try {
        $book = Book::findOrFail($id);
        } catch (ModelNotFoundException $e) {
        return response()->json([
            'message' => 'book not found'
        ], 404);
        }

        $book->fill(
        $request->only(['title', 'description', 'author'])
        );
        $book->save();

        return response()->json([
        'updated' => true,
        'data' => $book
        ], 200);
    }

    public function destroy($id){
        try {
        $book = Book::findOrFail($id);
        } catch (ModelNotFoundException $e) {
        return response()->json([
            'error' => [
            'message' => 'book not found'
            ]
        ], 404);
        }

        $book->delete();

        return response()->json([
        'deleted' => true
        ], 200);
  }




    


    
}