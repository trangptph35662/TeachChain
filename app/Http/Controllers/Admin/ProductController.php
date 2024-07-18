<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Catelogue;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductGallery;
use App\Models\ProductSize;
use App\Models\ProductVariant;
use App\Models\Tag;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    const PATH_VIEW = 'admin.products.';
    public function index()
    {
        //
        $data = Product::query()->with(['catelogue', 'tags'])->latest('id')->get();
        // dd($data->first()->catelogue) ;
        return view(self::PATH_VIEW . __FUNCTION__, compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $catelogues = Catelogue::query()->pluck('name', 'id')->all();
        $size = ProductSize::query()->pluck('name', 'id')->all();
        $colors = ProductColor::query()->pluck('name', 'id')->all();
        $tags = Tag::query()->pluck('name', 'id')->all();
        return view(self::PATH_VIEW . __FUNCTION__, compact('catelogues', 'size', 'colors', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        list(
            $dataProduct,
            $dataProductVariants,
            $dataProductGalleries,
            $dataProductTags
        ) = $this->handleData($request);

        try {
            //code...
            DB::beginTransaction();
            $product = Product::query()->create($dataProduct);

            foreach ($dataProductVariants as $item) {
                $item += ['product_id' => $product->id];
                ProductVariant::query()->create($item);
            }

            $product->tags()->attach($dataProductTags);

            foreach ($dataProductGalleries as $item) {

                $item += ['product_id' => $product->id];
                ProductGallery::query()->create($item);
            }
            DB::commit();

            return redirect()->route('admin.products.index');

        } catch ( Exception $exception) {

            DB::rollBack();

            if (!empty($dataProduct['img_thumb']) && Storage::exists($dataProduct['img_thumb'])) {
                Storage::delete($dataProduct['img_thumb']);
            }

            $dataHasImage = $dataProductVariants + $dataProductGalleries;

            foreach ($dataHasImage as $item) {
                if (!empty($item['image']) && Storage::exists($item['image'])) {
                    Storage::delete($item['image']);
                }
            }
            return back()->with('error', $exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $id)
    {
        //
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
        $product->load([
            'catelogue',
            'tags',
            'galleries',
            'variants',
        ]);
    //   dd($product) ;
        $catelogues = Catelogue::query()->pluck('name', 'id')->all();
        $sizes = ProductSize::query()->pluck('name', 'id')->all();
        $colors = ProductColor::query()->pluck('name', 'id')->all();
        $tags = Tag::query()->pluck('name', 'id')->all();
        return view(self::PATH_VIEW . __FUNCTION__, compact('catelogues', 'sizes', 'colors', 'tags', 'product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
        $dataHasImg =  $product->variants->toArray() + $product->galleries->toArray();

        try {


            DB::transaction(function () use ($product) {
                $product->tags()->sync([]);

                $product->galleries()->delete();

                $product->variants()->delete();

                $product->delete();
            }, 3);

            foreach($dataHasImg as $item){
                if(!empty($item->image) && Storage::exists($item->image)){
                    Storage::delete($item->image);
                }
            }

            return back();
        } catch (Exception $ex) {
            return back();
        }
    }

    public function handleData(Request $request)
    {
        $dataProduct = $request->except(['product_variants', 'tags', 'product_galleries']);

        $dataProduct['is_active']      ??= 0;
        $dataProduct['is_hot_deal']    ??= 0;
        $dataProduct['is_good_deal']   ??= 0;
        $dataProduct['is_new']         ??= 0;
        $dataProduct['is_show_home']   ??= 0;
        $dataProduct['slug'] = Str::slug($dataProduct['name']) . '-' . $dataProduct['sku'];

        if ($dataProduct['img_thumb']) {
            $dataProduct['img_thumb'] = Storage::put('products', $dataProduct['img_thumb']);
        }


        $dataProductVariantsTmp = $request->product_variants;
        $dataProductVariants = [];

        foreach ($dataProductVariantsTmp as $key => $item) {
            $tmp = explode('-', $key);
            $dataProductVariants[] = [
                'product_size_id' => $tmp[0],
                'product_color_id' => $tmp[1],
                'quantity' => $item['quantity'],
                'image' => !empty($item['image']) ? Storage::put('product_variants', $item['image']) : null,
            ];
        }

        $dataProductGalleriesTmp = $request->product_galleries ?: null;
        $dataProductGalleries = [];
        foreach ($dataProductGalleriesTmp as $image) {
            if (!empty($image)) {
                $dataProductGalleries[] = [
                    'image' => Storage::put('product_galleries', $image),
                ];
            }
        }


        $dataProductTags = $request->tags;
        return [$dataProduct, $dataProductVariants, $dataProductGalleries, $dataProductTags];
    }
}
