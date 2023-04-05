<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Http\Requests\CategoryUpdateManyRequest;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {
        $categories = Category::query()
            ->with('parent')
            ->get();
        return view('categories.index', compact('categories'));
    }

    public function create(CategoryService $categoryService): View
    {
        return view('categories.create', [
            'categories' => $categoryService->forSelect()
        ]);
    }

    public function store(CategoryRequest $request, CategoryService $categoryService): RedirectResponse
    {
        $input = $request->validated();
        $categoryService->store($input);

        return redirect(route('categories.index', ['locale' => app()->getLocale()]));
    }

    public function updateMany(CategoryUpdateManyRequest $request, CategoryService $categoryService): RedirectResponse
    {
        $categoryService->updateMany($request->validated());

        return back();
    }
}
