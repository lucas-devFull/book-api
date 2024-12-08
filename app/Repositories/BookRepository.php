<?php
// app/Http/Repositories/BookRepository.php
namespace App\Repositories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Collection;

class BookRepository
{
    public function all(): Collection
    {
        return Book::all();
    }

    public function find($id): ?Book
    {
        return Book::find($id);
    }

    public function create(array $data): Book
    {
        return Book::create($data);
    }

    public function update($id, array $data): ?Book
    {
        $book = $this->find($id);
        if ($book) {
            $book->update($data);
            return $book;
        }
        return null;
    }

    public function delete($id): bool
    {
        $book = $this->find($id);
        if ($book) {
            return $book->delete();
        }
        return false;
    }
}
