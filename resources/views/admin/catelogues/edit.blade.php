@extends('admin.layouts.master')

@section('title')
     Sửa
@endsection

@section('content')
<form action="{{route('admin.catelogues.update', $model)}}" method="post" enctype="multipart/form-data">
@csrf
@method('PUT')
    <div class="mt-2 mb-3">
    <label for="" class="form-label">Name: </label>
    <input type="text" name="name" class="form-control" id="" placeholder="Nhập tên" value="{{$model->name}}" >
</div>
<div class="mt-2 mb-3">
    <label for="" class="form-label">Cover: </label>
    <input type="file" name="cover" id="" class="form-control" >
    <img src="{{\Storage::url($model->cover)}}" alt="" width="60px">
</div>
<div class="mt-2 mb-3">
    <label for="" class="form-label">Is_active: </label>
    <input type="checkbox" name="is_active" id="" value="1" 
    @if ($model->is_active)
    checked
    @endif
     class="form-check-input">
</div>
<div>
    <button type="submit" class="btn btn-primary">Submit</button>
</div>
</form>
@endsection