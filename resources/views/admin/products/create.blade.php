@extends('admin.layouts.master')

@section('title')
    Thêm mới
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Thêm mới sản phẩm</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Sản phẩm</a></li>
                        <li class="breadcrumb-item active">Thêm mới</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <form action="{{ route('admin.products.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Thông tin</h4>

                    </div><!-- end card header -->
                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row gy-4">
                                <div class="col-xxl-3 col-md-6">
                                    <div>
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" class="form-control" name="name" id="name">
                                    </div>
                                    <div>
                                        <label for="name" class="form-label">Sku</label>
                                        <input type="text" class="form-control" name="sku" id="sku"
                                            value="{{ strtoupper(Str::random(8)) }}">
                                    </div>
                                    <div>
                                        <label for="name" class="form-label">Price regular</label>
                                        <input type="text" class="form-control" name="price_regular" id="price_regular"
                                            value="0">
                                    </div>
                                    <div>
                                        <label for="name" class="form-label">Price sale</label>
                                        <input type="text" class="form-control" name="price_sale" id="price_sale"
                                            value="0">
                                    </div>
                                </div>
                                <div class="col-xxl-3 col-md-6">
                                    <div>
                                        <label for="name" class="form-label">Catelogues</label>
                                        <select type="text" class="form-select" name="catelogue_id" id="">
                                            @foreach ($catelogues as $id => $name)
                                                <option value="{{ $id }}">{{ $name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <label for="img_thumb" class="form-label">Img_thumb</label>
                                        <input type="file" name="img_thumb" id="" class="form-control">
                                    </div>

                                    <div class="col-md-6">
                                        <div class="row">
                                            @php
                                                $is = [
                                                    'is_active' => 'primary',
                                                    'is_hot_deal' => 'danger',
                                                    'is_good_deal' => 'info',
                                                    'is_new' => 'warning',
                                                    'is_show_home' => 'success',
                                                ];
                                            @endphp
                                        </div>

                                        <!-- Disabled Switchs -->
                                        @foreach ($is as $key => $color)
                                            <div class="form-check form-switch form-switch-{{ $color }}">
                                                <input class="form-check-input" type="checkbox" name="{{ $key }}"
                                                    role="switch" id="{{ $key }}" value="1"
                                                    @if ($key == 'is_active') checked @endif>
                                                <label class="form-check-label" for="{{ $key }}">
                                                    {{ \Str::convertCase($key, MB_CASE_TITLE) }} </label>
                                            </div>
                                        @endforeach



                                    </div>
                                </div>

                                <div class="col-xxl-3 col-md-6">
                                    <!-- Example Textarea -->
                                    <div>
                                        <label for="exampleFormControlTextarea5" class="form-label"> Description</label>
                                        <textarea class="form-control" id="description" name="description" rows="2"></textarea>
                                    </div>
                                    <div>
                                        <label for="exampleFormControlTextarea5" class="form-label"> material</label>
                                        <textarea class="form-control" id="material" name="material" rows="2"></textarea>
                                    </div>
                                    <div>
                                        <label for="exampleFormControlTextarea5" class="form-label"> user_manual</label>
                                        <textarea class="form-control" id="user_manual" name="user_manual" rows="2"></textarea>
                                    </div>
                                </div>
                                <div class="col-xxl-3 col-md-6">
                                    <div>
                                        <label for="" class="form-label"> Content</label>
                                        <textarea class="form-control" id="content" name="content"></textarea>
                                    </div>
                                </div>
                                <!--end col-->


                                <!--end col-->
                            </div>
                            <!--end row-->
                        </div>


                    </div>

                    {{-- biến thể  --}}
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Biến thể</h4>

                    </div>
                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row gy-4">

                                <table class="table">
                                    <tr>
                                        <th>Size</th>
                                        <th>Color</th>
                                        <th>Quantity</th>
                                        <th>Image</th>
                                    </tr>
                                    @foreach ($size as $sizeID => $sizeName)
                                        @php($flagRowSpan = true)
                                        @foreach ($colors as $colorID => $colorName)
                                            <tr>
                                                @if ($flagRowSpan)
                                                    <td style="vertical-align: middle" rowspan="{{ count($colors) }}">
                                                        <b> {{ $sizeName }}</b>
                                                    </td>
                                                @endif
                                                @php($flagRowSpan = false)

                                                <td>
                                                    <div
                                                        style="with: 50px; height: 50px; background:{{ $colorName }} ">
                                                    </div>
                                                </td>
                                                <td>
                                                    <input type="text"
                                                        name="product_variants[{{ $sizeID . '-' . $colorID }}][quantity]"
                                                        id="" value="0" class="form-control">
                                                </td>
                                                <td>
                                                    <input type="file"
                                                        name="product_variants[{{ $sizeID . '-' . $colorID }}][image]"
                                                        id="" class="form-control">
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endforeach

                                </table>





                                <!--end col-->
                            </div>
                            <!--end row-->
                        </div>


                    </div>

                    {{-- galery --}}
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Gallery</h4>
                        <button type="button" class="btn btn-primary" onclick="addImageGallery()">Thêm ảnh</button>
                    </div>
                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row gy-4" id="gallery_list">
                                <div class="col-md-4" id="gallery_default_item">
                                    <label for="gallery_default" class="form-label">Image</label>
                                    <div class="d-flex">
                                        <input type="file" name="product_galleries[]" id="gallery_default"
                                            class="form-control">
                                    </div>

                                </div>


                            </div>
                            <!--end row-->
                        </div>


                    </div>

                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row gy-4">
                                <select name="tags[]" id="tags" multiple class="form-control">
                                    @foreach ($tags as $tagID => $tagName)
                                        <option value="{{ $tagID }}">{{ $tagName }}</option>
                                    @endforeach
                                </select>

                            </div>
                            <!--end row-->
                        </div>


                    </div>
                </div>
            </div>
            <!--end col-->
        </div>
        <div>
            <button class="btn btn-info" type="submit">Submit</button>
        </div>
    </form>
@endsection

@section('script-libs')
    <script src="//cdn.ckeditor.com/4.8.0/basic/ckeditor.js"></script>
@endsection

@section('script')
    <script>
        CKEDITOR.replace('content');

        function addImageGallery() {
            console.log('Hàm addImageGallery được gọi');
            let id = 'gen' + '_' + Math.random().toString(36).substring(2, 15).toLowerCase();
           
            let html = `<div class="col-md-4" id="${id}_item">
                                <label for="${id}" class="form-label">Image</label>
                                <div class="d-flex">
                                     <input type="file" name="product_galleries[]" id="${id}" class="form-control">
                                    <button type="button" class="btn btn-danger" onclick="removeImageGallery('${id}_item')">
                                        <span class="bx bx-trash"></span>
                                    </button>
                                </div>
                               
                            </div>
                            `;
                           $('#gallery_list').append(html) 

        }

        function removeImageGallery(id) {
            if (confirm('Chắc chắn xoá?')) {
                $('#' + id).remove();
            }
        }
    </script>
@endsection
