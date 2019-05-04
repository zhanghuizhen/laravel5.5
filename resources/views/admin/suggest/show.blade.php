@extends('layouts.app')

@section('title', '投诉意见')

@section('sidebar')
    @parent
@endsection

@section('content')

    <div class="row-fluid">
        <div class="page-header">
            <h1>投诉意见 <small>详情</small></h1>
        </div>
        <table class="table" style="width: 500px;background: white">
            <tr>
                <th>问题描述</th>
                <td>{{$data->description}}</td>
            </tr>
            <tr>
                <th>类型</th>
                <td>{{$data->type}}</td>
            </tr>
            <tr>
                <th>地址</th>
                <td>{{$data->address}}</td>
            </tr>
            <tr>
                <th>相关图片</th>
                <td><img style="width:80px; height:50px" src="{{ $data->image }}" alt=""></td>
            </tr>
            <tr>
                <th>状态</th>
                @if ( $data->state == 'published' )
                    <td>已发布</td>
                @elseif ($data->state == 'offline')
                    <td>已下线 </td>
                @endif
            </tr>
            <tr>
                <th>创建人id</th>
                <td>{{$data->user_id}}</td>
            </tr>
            <tr>
                <th>发布时间</th>
                <td>{{$data->published_at}}</td>
            </tr>
            <tr>
                <th>创建时间</th>
                <td>{{$data->created_at}}</td>
            </tr>
            <tr>
                <th>更新时间</th>
                <td>{{$data->updated_at}}</td>
            </tr>
        </table>
    </div>

    <a href="{{url('admin/suggest/index')}}" class="btn btn-success">返回列表</a>

@endsection