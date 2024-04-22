<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Type;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Carbon\Carbon;




class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $title = 'Perpus | Books';
    // menampilkan halaman utama
    public function index()
    {
        return view('dashboard.books.index', [
            'books' => Book::latest()->get(),
            'title' => $this->title
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    // menampilkan form tambah data
    public function create()
    {
        return view('dashboard.books.create', [
            'title' => $this->title,
            'types' => Type::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    // menyimpan data ke db
    public function store(StoreBookRequest $request)
    {
        $validatedData = $request->validate([
            'title' => ['required', 'min:3', 'max:100'],
            'desc' => ['nullable', 'required'],
            'type_id' => ['required'],
            'stock' => ['required'],
            'publisher' => ['required'],
            'writer' => ['required'],
            'publish_date' => ['required'],
            'image' => ['image', 'file', 'required']
        ]);

        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('book-image');
        }

        Book::create($validatedData);
        return redirect('dashboard/books')->with('success', 'Book Successfully added!');
    }

    /**
     * Display the specified resource.
     */
    // menampilkan detail data
    public function show(Book $book)
    {
        return view('dashboard.books.show', [
            'book' => $book,
            'title' => $this->title
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    // menampilkann form edit data
    public function edit(Book $book)
    {
        return view('dashboard.books.edit', [
            'title' => $this->title,
            'book' => $book,
            'types' => Type::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    // mengupdate data ke db
    public function update(UpdateBookRequest $request, Book $book)
    {
        $validatedData = $request->validate([
            'title' => ['required', 'min:3', 'max:100'],
            'desc' => ['nullable', 'required'],
            'type_id' => ['required'],
            'stock' => ['required'],
            'publisher' => ['required'],
            'writer' => ['required'],
            'publish_date' => ['required'],
            'image' => ['image', 'file']
        ]);

        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('book-image');
        }
        $book = Book::where('id', $book->id)->update($validatedData);
        return redirect('/dashboard/books/')->with('successEdit', "$request->title successfully updated!");
    }

    /**
     * Remove the specified resource from storage.
     */
    // menghapus data buku
    public function destroy(Book $book)
    {
        Book::destroy($book->id);
        return redirect('/dashboard/books')->with('successDelete', 'Book has been deleted!');
    }

    // export ke pdf
    public function exportPDF()
    {
        $book = Book::all();
        $data['books'] = $book;
        // $pdf = Pdf::loadView('pdf.qr', $book);
        // return $pdf->stream();
        $pdf = Pdf::loadView('pdf.book', $data);
        return $pdf->download(Carbon::now() . '_books_report.pdf');
    }
}
