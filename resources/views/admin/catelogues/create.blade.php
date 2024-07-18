@extends('admin.layouts.master')

@section('title')
    Thêm mới
@endsection

@section('content')
<form action="{{route('admin.catelogues.store')}}" method="post" enctype="multipart/form-data">
@csrf
    <div class="mt-2 mb-3">
    <label for="" class="form-label">Name: </label>
    <input type="text" name="name" class="form-control" id="" placeholder="Nhập tên" >
</div>
<div class="mt-2 mb-3">
    <label for="" class="form-label">Cover: </label>
    <input type="file" name="cover" id="" class="form-control">
</div>
<div class="mt-2 mb-3">
    <label for="" class="form-label">Is_active: </label>
    <input type="checkbox" name="is_active" id="" value="1" checked class="form-check-input">
</div>
<div>
    <button type="submit" class="btn btn-primary">Submit</button>
</div>
</form>
@endsection