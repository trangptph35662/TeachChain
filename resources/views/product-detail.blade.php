<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Document</title>
</head>

<body>
<div class="container">
    <img src="{{$product->img_thumb}}" alt="" width="100px">
    <table class="table">
        <thead>
            <tr>
                <th>Trường</th>
                <th>Giá trị</th>
            </tr>
        </thead>
        <tbody>
            <tr>
            <td>SKU</td>
            <td> {{$product->slug}} </td>
            </tr>
            <tr>
                <td>Giá thường</td>
                <td> {{$product->price_regular}} </td>
            </tr>
            <tr>
                <td>Giá sale</td>
                <td> {{$product->price_sale}} </td>
            </tr>
        </tbody>
    </table>

    <div class="row">
        <form action="{{route('cart.add')}}" method="post" enctype="multipart/form-data">
            @csrf

            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <label for="">Color</label>

            @foreach ($colors as $id=>$name)
                <div class="form-check">
                    <input type="radio" name="product_color_id" class="form-check-input"  value="{{$id}}" id="">
                    <label class="form-check-label" for="radio_color_{{$id}}"> {{$name}} </label>
                </div>
            @endforeach
            <label for="">Size</label>

            @foreach ($sizes as $id=>$name)
                <div class="form-check">
                    <input type="radio" name="product_size_id" class="form-check-input"  value="{{$id}}" id="">
                    <label class="form-check-label" for="radio_size_{{$id}}"> {{$name}} </label>
                </div>
            @endforeach

            <div class="mt-2 mb-3">
                <label for="">Số lượng</label>
                <input type="number" name="quantity" min="1" required value="1" class="form-control" id="">
            </div>

            <button type="submit" class="btn btn-info">Thêm vào giỏ</button>
        </form>
    </div>
</div>
</body>

</html>
