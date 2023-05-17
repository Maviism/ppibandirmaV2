<?php

namespace App\Http\Controllers;

use App\Models\Akastrat\Book;
use App\Models\Akastrat\Category;
use App\Models\Akastrat\Ebook;
use App\Http\Requests\StoreBookRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str; 
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::get();
        $ebooks = Ebook::get();
        $books = Book::with('bookCategory')->get();
        return view('admin/akastrat/index', [
            'categories' => $categories,
            'books' => $books,
            'ebooks' => $ebooks
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request)
    {
        try {
            DB::transaction(function () use ($request) : void{
                $book = Book::create([
                    'title' => $request->iTitle,
                    'author' => $request->iAuthor,
                    'number_of_pages' => $request->iNumOfPages,
                    'publisher' => $request->iPublisher,
                    'synopsis' => $request->iSynopsis,
                ]);
                foreach($request->sel2Category as $category){
                    $book->bookCategory()->create([
                        'category_id' => $category
                    ]);
                }

                if ($request->hasFile('ifImage')) {
                    $image = $request->file('ifImage');
                    $filename = time() . '.' . $image->getClientOriginalExtension();
                    $image->storeAs('public/images/books', $filename);
                    $book->thumbnail_url = $filename;
                    $book->save();
                }
                
            });
            
        } catch (Exception $e) {
            if (isset($book)) {
                $book->delete();
            }
            return redirect('admin/pojokbaca');
        }



        return redirect()->back();
    }

    public function storeCategory(Request $request)
    {
        $request->validate([
            'iCategory' => 'string|required'
        ]);

        Category::create([
            'name' => $request->iCategory,
            'slug' => Str::slug($request->iCategory)
        ]);

        return redirect('/admin/pojokbaca');
    }

    public function storeEbook(Request $request)
    {
        $request->validate([
            'iFolderName' => 'string|required',
            'iFolderUrl' => 'url|required'
        ]);

        Ebook::create([
            'folder_name' => $request->iFolderName,
            'folder_url' => $request->iFolderUrl,
        ]);

        return redirect('/admin/pojokbaca');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $book = Book::findOrFail($id);

        $categories = Category::get();
        return view('admin.akastrat.edit-book', [
            'categories' => $categories,
            'book' => $book
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreBookRequest $request, string $id)
    {
        $book = Book::findOrFail($id);

        $book->update([
            'title' => $request->iTitle,
            'author' => $request->iAuthor,
            'number_of_pages' => $request->iNumOfPages,
            'publisher' => $request->iPublisher,
            'synopsis' => $request->iSynopsis,
        ]);

        if ($request->hasFile('ifImage')) {

            $image = $request->file('ifImage');
            $filename = time() . '.' . $image->getClientOriginalExtension();

            // Delete the old image if exist
            if (!empty($book->thumbnail_url)) {
                Storage::delete('public/images/books/' . $book->thumbnail_url); 
            }
            $image->storeAs('public/images/books', $filename);
            $book->thumbnail_url = $filename;
            $book->save();
        }

        return redirect('/admin/pojokbaca');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $book = Book::findOrFail($id);

        // Check if the book exists
        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }
        if (!empty($book->thumbnail_url)) {
            Storage::delete('public/images/events/' . $book->thumbnail_url); 
        }

        // Perform the delete operation
        $book->delete();

        // Return a response indicating success
        return response()->json([
            'status' => 200,
            'message' => 'Book deleted successfully'
        ]);
    }

    public function destroyCategory(string $id)
    {
        $category = Category::findOrFail($id);
        // Check if the category exists
        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }
        // Perform the delete operation
        $category->delete();
        // Return a response indicating success
        return response()->json([
            'status' => 200,
            'message' => 'Category deleted successfully'
        ]);
    }

    public function destroyEbook(string $id)
    {
        $ebook = Ebook::findOrFail($id);
        // Check if the ebook exists
        if (!$ebook) {
            return response()->json(['message' => 'Ebook not found'], 404);
        }
        // Perform the delete operation
        $ebook->delete();
        // Return a response indicating success
        return response()->json([
            'status' => 200,
            'message' => 'Ebook deleted successfully']);   
    }
}
