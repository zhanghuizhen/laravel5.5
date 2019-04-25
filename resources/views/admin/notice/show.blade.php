@extends('layouts.app')

@section('title', '小区公告')

@section('sidebar')
    @parent
@endsection

@section('content')

    <div class="row-fluid">
        <div class="page-header">
            <h1>小区公告 <small>查看</small></h1>
        </div>
        <table class="table table-bordered" style="width: 500px">
            <tr>
                <th>标题</th>
                <td>{{$data->title}}</td>
            </tr>
            <tr>
                <th>内容</th>
                <td>{{$data->content}}</td>
            </tr>
            <tr>
                <th>地址</th>
                <td>{{$data->address}}</td>
            </tr>
            <tr>
                <th>图片</th>
                <td><img style="width:80px; height:50px" src="{{ $data->cover }}" alt=""></td>
            </tr>
        </table>
    </div>

    <a href="{{url('admin/notice/index')}}" class="btn btn-success">返回列表</a>

@endsection