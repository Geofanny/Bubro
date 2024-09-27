<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class DashboardController extends Controller
{
	public function index()
	{
		$productsCount = Product::count();

		$categoriesCount = Category::withCount('products')->get();
		$categories = $categoriesCount->pluck('name');
		$counts = $categoriesCount->pluck('products_count');

		// dd($counts);

		return view('dashboard-admin/index',[
			'products' => $productsCount,
			'categories' => $categories,
			'counts' => $counts,
		]);
	}
}
