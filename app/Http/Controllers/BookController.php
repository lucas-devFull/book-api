<?php

// app/Http/Controllers/BookController.php
namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Services\BookService;
use App\Http\Resources\BookResource;
use Illuminate\Http\Request;

class BookController extends Controller
{
    protected $bookService;

    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }

    public function index()
    {
        $books = $this->bookService->getAllBooks();
        return BookResource::collection($books);
    }

    public function show($id)
    {
        $book = $this->bookService->getBookById($id);
        return new BookResource($book);
    }

    public function store(BookRequest $request)
    {
        $data = $request->validated();
        $book = $this->bookService->createBook($data);
        return new BookResource($book, 201);
    }

    public function update(BookRequest $request, $id)
    {
        $data = $request->validated();
        $book = $this->bookService->updateBook($id, $data);
        return new BookResource($book);
    }

    public function destroy($id)
    {
        $this->bookService->deleteBook($id);
        return response()->json(['message' => 'Book deleted successfully.'], 204);
    }
}

