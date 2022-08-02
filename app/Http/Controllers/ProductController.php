<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            //Listar los productos
            //$products = Product::all();
            $products = Product::whereNotNull('name')->with(['categories', 'storages', 'sizes'])->orderBy('name', 'asc')->get();
            //$total = Post::sum('views');
            $response = $products;
            return response()->json($response, 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 422);
        }
    }

    public function sum(){
        try {
            //Listar los productos
            $products = Product::all();
            $count = count($products);
            //$properties = Property::withCount(['rooms'])->get();

            $response = $count;
            return response()->json($response, 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 422);
        }
    }

    public function all()
    {
        try {
            /*  Listado de productos
           incluyendo los generos que tiene asignados
           y la información del usuario
            */
            $products = Product::orderBy('name', 'asc')->with(["categories", "sizes"])->get();
            $response = $products;

            return response()->json($response, 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|min:3',
                'code' => 'required|min:3',
                'cost' => 'required|numeric',
                'price' => 'required|numeric'
            ]
        );

        if ($validator->fails()) {
            return response()->json($validator->messages(), 422);
        }

        try {
            //Instancia
            $product = new Product();
            $product->name = $request->input('name');
            $product->code = $request->input('code');
            $product->cost = $request->input('cost');
            $product->price = $request->input('price');

            //Información de la imagen
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $nombreImagen = time() . "foto." . $file->getClientOriginalExtension();
                $imageUpload = Image::make($file->getRealPath());
                $path = 'images/';
                $imageUpload->save(public_path($path) . $nombreImagen);
                $product->image = url($path) . "/" . $nombreImagen;
            }
            //Guardar el producto en la BD
            if ($product->save()) {

                //Categorias - Solo es necesario con la imagen
                $categories = $request->input('category_id');
                //Solo es necesario con la imagen
                if (!is_array($request->input('category_id'))) {
                    //Formato array relación muchos a muchos
                    $categories = explode(',', $request->input('category_id'));
                }
                if (!is_null($request->input('category_id'))) {
                    //Agregar categorias
                    $product->categories()->attach($categories);
                }

                //Tallas
                $sizes = $request->input('size_id');
                if (!is_array($request->input('size_id'))) {
                    $sizes = explode(',', $request->input('size_id'));
                }
                if (!is_null($request->input('size_id'))) {
                    $product->sizes()->attach($sizes);
                }
                //Proveedores
                $providers = $request->input('provider_id');
                if (!is_array($request->input('provider_id'))) {
                    $providers = explode(',', $request->input('provider_id'));
                }
                if (!is_null($request->input('provider_id'))) {
                    $product->providers()->attach($providers);
                }

                //Bodegas
                $storages = $request->input('storage_id');
                if (!is_array($request->input('storage_id'))) {
                    $storages = explode(',', $request->input('storage_id'));
                }
                if (!is_null($request->input('storage_id'))) {
                    $product->storages()->attach($storages, ['quantity' => 0, 'limit' => 1]);
                }


                $respuesta = 'Producto creado!';
                return response()->json($respuesta, 201);

            } else {
                $response = [
                    'msg' => 'Error durante la creación del producto.'
                ];
                return response()->json($response, 404);
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            //Obtener un producto
            $product = Product::where('id', $id)->with(['categories', 'storages', 'sizes', 'providers'])->first();
            $response = $product;
            return response()->json($response, 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|min:3',
                'code' => 'required|min:3',
                'cost' => 'required|numeric',
                'price' => 'required|numeric'
            ]
        );

        if ($validator->fails()) {
            return response()->json($validator->messages(), 422);
        }

        $product = Product::find($id);
        $product->name = $request->input('name');
        $product->code = $request->input('code');
        $product->cost = $request->input('cost');
        $product->price = $request->input('price');

        //Validar usuario que actualiza coincida con el que lo registro
        //$user = auth('api')->user();
        //$user_id = $user->id;

        //Información de la imagen
        if ($request->hasFile('image')) {
            //Borrar la imagen anterior

            //Obtener archivo de imagen anterior
            $productoImagen = $product->image;
            if (File::exists($productoImagen)) {
                //Borrar imagen anterior
                File::delete($productoImagen);
            }

            $file = $request->file('image');
            $nombreImagen = time() . "foto." . $file->getClientOriginalExtension();
            $imageUpload = Image::make($file->getRealPath());
            $path = 'images/';
            $imageUpload->save(public_path($path) . $nombreImagen);
            $product->image = url($path) . "/" . $nombreImagen;
        }
        //Actualizar producto
        if ($product->update()) {

            //Solo es necesario con la imagen
            if (!is_array($request->input('category_id'))) {
                //Formato array relación muchos a muchos
                $categories = explode(',', $request->input('category_id'));
            }
            if (!is_null($request->input('category_id'))) {
                //Agregar generos
                $product->categories()->sync($categories);
            }

            //Tallas
            if (!is_array($request->input('size_id'))) {
                $sizes = explode(',', $request->input('size_id'));
            }
            if (!is_null($request->input('size_id'))) {
                $product->sizes()->sync($sizes);
            }

            //Proveedores
            if (!is_array($request->input('provider_id'))) {
                $providers = explode(',', $request->input('provider_id'));
            }
            if (!is_null($request->input('provider_id'))) {
                $product->providers()->sync($providers);
            }

            //Storages
            if (!is_array($request->input('storage_id'))) {
                $storages = explode(',', $request->input('storage_id'));
            }
            if (!is_null($request->input('storage_id'))) {
                $product->storages()->syncWithPivotValues($storages, ['quantity' => 0, 'limit' => 1]);
            }

            $response = 'Producto actualizado!';
            return response()->json($response, 200);
        }
        $response = [
            'msg' => 'Error durante la actualización.'
        ];

        return response()->json($response, 404);
    }

    public function products_categories(Request $request)
    {
        try {
            $categories = $request->input('categories');
            //Listar los productos
            $products = Product::whereHas('categories', function ($query) use ($categories) {
                $query->whereIn('category_id', [$categories]);
            })->with(["categories"])->get();
            $response = $products;
            return response()->json($response, 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
