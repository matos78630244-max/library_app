<?php
 
namespace App\Http\Controllers;
 
use App\Models\Author;
use Illuminate\Http\Request;
 
class AuthorController extends Controller
{
    /**
     * Lista paginada de autores con conteo de libros.
     */
    public function index()
    {
        $authors = Author::withCount('books')
            ->orderBy('last_name')
            ->paginate(15);
 
        return view('authors.index', compact('authors'));
    }
 
    /**
     * Muestra la ficha del autor con sus libros.
     */
    public function show(Author $author)
    {
        $author->load('books.category');
 
        return view('authors.show', compact('author'));
    }
 
    // Métodos placeholder — se implementan en guías posteriores
    public function create()
{
    return view('authors.create');
}

public function store(Request $request)
{
    $validated = $request->validate([
        'first_name'  => 'required|string|max:100',
        'last_name'   => 'required|string|max:100',
        'nationality' => 'nullable|string|max:80',
        'birth_date'  => 'nullable|date|before:today',
        'biography'   => 'nullable|string',
    ]);

    $author = Author::create($validated);

    session()->flash('success', 'Autor registrado correctamente.');
    return redirect()->route('authors.show', $author);
}

public function edit(Author $author)
{
    return view('authors.edit', compact('author'));
}

public function update(Request $request, Author $author)
{
    $validated = $request->validate([
        'first_name'  => 'required|string|max:100',
        'last_name'   => 'required|string|max:100',
        'nationality' => 'nullable|string|max:80',
        'birth_date'  => 'nullable|date|before:today',
        'biography'   => 'nullable|string',
    ]);

    $author->update($validated);

    session()->flash('success', 'Autor actualizado correctamente.');
    return redirect()->route('authors.show', $author);
}

public function destroy(Author $author)
{
    if ($author->books()->count() > 0) {
        return back()->with('error', 'No se puede eliminar un autor con libros asociados.');
    }

    $author->delete();

    session()->flash('success', 'Autor eliminado correctamente.');
    return redirect()->route('authors.index');
}
}
