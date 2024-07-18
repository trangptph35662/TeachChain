@extends('admin.layouts.master')

@section('title')
    Chi tiết 
@endsection
@section('content')
    <table class="table">
        <thead>
            <tr>
                <th>Trường</th>
                <th>Giá trị</th>
            </tr>
        </thead>
        <tbody>
            @foreach($model->toArray() as $key => $value)
            <tr>
                <td>{{ $key }}</td>
                <td>
                    @php
                        if($key == 'cover') {
                            $url = \Storage::url($value) ;
                           echo " <img src=\"$url\" alt=\"\" width = \" 60px\"> " ;
                        }elseif (Str::contains($key, 'is_')) {
                            echo $value ? 'Yes' : 'No' ;

                        }else{
                            echo $value ;
                        }
                    @endphp
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{route('admin.catelogues.index')}}" class="btn btn-dark">Quay lại</a>
@endsection