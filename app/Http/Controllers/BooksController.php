<?php

namespace App\Http\Controllers;


namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\user;
use Laravel\Lumen\Routing\Controller as BaseController;
use illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BooksController extends Controller
{
    // public function __construct()
    // {
    //     //
    // }

    public function index()
    {
        return Book::all();
    }

    // public function time()
    // {
    //     $date = Carbon::now();
    //     return response()->json(['Time' => [
    //         'date' => $date->toDateTimeString(),
    //         'timezone_type' => $date->getTimezone()
    //     ]]);
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

    public function update(Request $request, $id)
    {
    try {
        $book = Book::findOrFail($id);
        }   catch (ModelNotFoundException $e) {
        return response()->json([
        'message' => 'book not found'
        ], 404);
        }

        $book->fill(

        $request->only(['title','description', 'author'])   
        );
        $book->save();

        return response()->json([
        'updated' => true,
        'data' => $book
        ],200);
    }


    public function destroy($id)
    {
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

    public function authors(){
        return Authors::all();
    }

    public function authorsid(Request $request, $id)
    {
        $result = DB::select("SELECT * FROM authors WHERE id = $id");
        if(empty($result)){
            return response()->json(['message'=> 'Authors Not Found'], 404);
        }
        else{
        return $result;
        }
    }

    public function AuthorsAdd(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'gender' => 'required',
            'biography' => 'required'
        ]);

        $authors = Authors::create(
            $request->only(['name', 'gender', 'biography'])
        );

        return response()->json([
            'created' => true,
            'data' => $authors
        ], 201);
    }

    public function AuthorsUpdate(Request $request, $id){
        try {
            $authors = Authors::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Authors not found'
            ], 404);
        }

        $authors->fill(
            $request->only(['name', 'gender', 'biography'])
        );
        $authors->save();

        return response()->json([
            'updated' => true,
            'data' => $authors
        ], 200);
    }

    public function AuthorsDestroy($id){
        try {
            $authors = Authors::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => [
                'message' => 'Authors not found'
                ]
            ], 404);
        }
        $authors->delete();
        return response()->json([
            'deleted' => true
        ], 200);
    }




}