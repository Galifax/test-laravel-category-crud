<?php
namespace App\Services;

use App\Models\Category;

class CategoryService
{
    private Category $model;

    public function __construct()
    {
        $this->model = new Category;
    }

    public function forSelect(): array
    {
        return $this->model::query()
            ->get()
            ->map(function(Category $category) {
                return [
                    'key' => $category->id,
                    'val' => $category->getLocaleName()
                ];
            })
            ->toArray();
    }

    public function store($data): void
    {
        $data[$this->model->keyNameLocale()] = $data['name'];
        unset($data['name']);

        Category::query()
            ->forceCreate($data);
    }

    public function updateMany($data): void
    {
        foreach($data['category'] as $key => $category) {
            $categoryModel = Category::query()
                ->where('id', $key)
                ->first();

            $arr = [
                $this->model->keyNameLocale() => $category['name']
            ];

            if (!empty($categoryModel)) {
                $categoryModel
                    ->forceFill($arr)
                    ->save();
            }
        }
    }
}
