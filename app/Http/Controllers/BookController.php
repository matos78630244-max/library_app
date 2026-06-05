<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class BookController extends Controller
{
    /**
     * Lista paginada del catálogo de libros.
     */
    public function index()
    {
        $books = Book::with(['category', 'authors'])
            ->latest()
            ->paginate(12);

        return view('books.index', compact('books'));
    }

    /**
     * Muestra el formulario para crear un nuevo libro.
     */
    public function create()
    {
        $categories = Category::orderBy('name')->get();
        $authors    = Author::orderBy('last_name')->get();

        return view('books.create', compact('categories', 'authors'));
    }

    /**
     * Persiste un libro nuevo. (Pendiente — Guía 7).
     */
    public function store(Request $request)
    {
        //dd($request);
        // 1. Validar
        $validated = $request->validate([
            'title'             => 'required|string|max:255',
            'isbn'              => 'required|string|size:13|unique:books,isbn',
            'publisher'         => 'nullable|string|max:200',
            'publish_year'      => 'nullable|integer|min:1000|max:'.date('Y'),
            'pages'             => 'nullable|integer|min:1',
            'language'          => 'nullable|string|max:30',
            'description'       => 'nullable|string',
            'cover_url'         => 'nullable|url|max:500',
            'total_copies'      => 'required|integer|min:1',
            'category_id'       => 'required|exists:categories,id',
            'authors'           => 'required|array|min:1',
            'authors.*'         => 'integer|exists:authors,id',
        ]); 
        // 2. Determinar copias disponibles
            $validated['available_copies'] = $validated['total_copies'];
        // 3. Crear libro
            $book = Book::create($validated);
        // 4. Asociar autores
            $book->authors()->sync($request->input('authors', []));
        // 5. Mostrar mensaje flash
           session()->flash('success', 'Libro registrado exitosamente.');
            return redirect()->route('books.show', $book);
    }

    /**
     * Muestra la ficha de detalle de un libro.
     */
    public function show(Book $book)
    {
        $book->load(['authors', 'category', 'activeLoans.member.user']);

        return view('books.show', compact('book'));
    }

    /**
     * Muestra el formulario de edición. (Pendiente — Guía 7).
     */
    public function edit(Book $book)
    {
        $categories = Category::orderBy('name')->get();
        $authors = Author::orderBy('last_name')->get();
        return view('books.edit', compact('book', 'categories', 'authors'));
    }

    /**
     * Actualiza un libro. (Pendiente — Guía 7).
     */
    public function update(Request $request, Book $book)
    {
        //dd($request);
        // 1. Validar
        $validated = $request->validate([
            'title'             => 'required|string|max:255',
            'publisher'         => 'nullable|string|max:200',
            'publish_year'      => 'nullable|integer|min:1000|max:'.date('Y'),
            'pages'             => 'nullable|integer|min:1',
            'language'          => 'nullable|string|max:30',
            'description'       => 'nullable|string',
            'cover_url'         => 'nullable|url|max:500',
            'total_copies'      => 'required|integer|min:1',
            'category_id'       => 'required|exists:categories,id',
            'authors'           => 'required|array|min:1',
            'authors.*'         => 'integer|exists:authors,id',
        ]); 
        // 2. Determinar copias disponibles
            $loanedCopies = $book->total_copies - $book->available_copies;
            $newTotal = $validated['total_copies'];
            $validated['available_copies'] = max(0, $newTotal - $loanedCopies);
        // 3. Actualizar libro
            $book->update($validated);
        // 4. Sincronizar autores
            $book->authors()->sync($request->input('authors', []));
        // 5. Mostrar mensaje flash
           session()->flash('success', 'Libro actualizado exitosamente.');
            return redirect()->route('books.show', $book);
    }

    /**
     * Elimina un libro. (Pendiente — Guía 7).
     */
    public function destroy(Book $book)
    {
        // TODO: Borrado lógico en Guía 7
        if($book->activeLoans()->count()>0){
            return back()-> with(
            'error',
            'No se puede eliminar un libro con prestamos activos'
            );
        }
        $book->delete();
        session()->flash('success','Libro eliminado correctamente');
        return redirect()->route('books.index'); 
    }
}
