<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class ShopController extends Controller
{
    /**
     * Display the shop page with products (e-commerce store).
     */
    public function index(\Illuminate\Http\Request $request)
    {
        $query = Product::where('is_active', true)->with('category');

        $search = $request->input('q');
        if ($search && trim($search) !== '') {
            $term = '%' . trim($search) . '%';
            $query->where(function ($q) use ($term) {
                $q->where('title', 'like', $term)
                    ->orWhere('description', 'like', $term)
                    ->orWhere('sku', 'like', $term)
                    ->orWhereHas('category', fn ($c) => $c->where('name', 'like', $term));
            });
        }

        $categorySlug = $request->input('category');
        if ($categorySlug && trim($categorySlug) !== '') {
            $cat = Category::where('slug', trim($categorySlug))->first();
            if ($cat) {
                $query->where('category_id', $cat->id);
            }
        }

        $products = $query->orderBy('order', 'asc')
            ->orderBy('title', 'asc')
            ->paginate(12)
            ->withQueryString();

        $categories = Category::orderBy('order', 'asc')
            ->orderBy('name', 'asc')
            ->get();

        return view('shop.index', compact('products', 'search', 'categories', 'categorySlug'));
    }

    /**
     * Display a single product.
     */
    public function show($slug)
    {
        $product = Product::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        return view('shop.show', compact('product'));
    }
}
