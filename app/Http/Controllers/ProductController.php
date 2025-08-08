<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Weather;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class ProductController extends Controller
{

  public function index(Request $req, Weather $weather): View
  {
    /* Query Builder: https://laravel.com/docs/11.x/queries */

    /* SELECT */
    $products = Product::all('id', 'name', 'category_id');
    foreach($products as $p) {
      $p->cat_name = $p->category?->name; // !! n+1 problem: one select category.name for each product !!
    }
    // solution to n+1 problem
    $products = Product::with('category')->get(); // "eager loading" : select * from `category` where `category`.`id` in (1, 2, 3, 4, 5, 6, 7)

    $products = Product::where('id', '>', 2)->limit(2)->get();
    $product = Product::all()->first();
    $category_name = $product->category?->name;  //  ~ if category_id is not null (see belongsTo() in Model)


    /* INSERT */
    $product = new Product();
    $product->name = "IPhone";
    $product->save();
    $id = $product->id; // last inserted id
    // or
    $product_2 = Product::create(['name' => 'Galaxy']); // need $fillable in Model (security reason)

    /* UPDATE */
    $product = Product::find($id);
    $product->name = 'updated name';
    $product->save();

    /* DELETE */
    $product->delete();
    $product_2->delete();

    /* RELATION */
    $category_name = Product::all()->first()->category?->name; // needs belongsTo() in Model
    $products = Category::find(6)->posts; // needs hasMany() in Model



    /* --------------------------------------------------------- */



    $products = Product::orderBy('created_at', 'desc')->paginate(8)->appends(['sort' => 'votes']);

    return view('product.index', [
      "products" =>$products
    ]);
  }


  public function show(string $name, Product $product): RedirectResponse | View | string
  {

    // "Model Binding" --> autofetch product with param "id"
    // $product = Product::find($id);

    if ($product->name != $name) {
      return to_route('products.show', ['name' => $product->name, 'id' => $product->id]);
    }
    return view('product.show', compact('product'));
  }


  public function destroy(int $id): RedirectResponse
  {
    $product = Product::find($id);
    $product->delete();
    return redirect()->route('products.index');
  }
}
