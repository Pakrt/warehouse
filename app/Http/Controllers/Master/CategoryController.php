<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\ValidationException;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $category = Category::orderby('id', 'DESC')->get();

        return view('master.category.index', compact('category'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'bail|required|string|unique:categories',
            'name' => 'required|string',
        ]);

        $category = new Category;
        $category->fill($request->all());
        $category->save();

        return Redirect::route('category.index')
        ->with([
            'status' => 'success',
            'tittle' => 'Success',
            'messages' => 'Membuat data kategori'
        ]);
    }

    public function show(Category $category)
    {
        //
    }

    public function edit($id)
    {
        $category = Category::find($id);

        return view('master.category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        $category->update($request->all());

        return Redirect::route('category.index')
        ->with([
            'status' => 'success',
            'tittle' => 'Success',
            'messages' => 'Mengubah data kategori'
        ]);
    }

    public function destroy($id)
    {
        category::destroy($id);

        return Redirect::route('category.index')
        ->with([
            'status' => 'success',
            'tittle' => 'Success',
            'messages' => 'Menghapus data kategori'
        ]);
    }
}
