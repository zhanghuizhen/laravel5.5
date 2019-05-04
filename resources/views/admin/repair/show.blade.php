@extends('layouts.app')

@section('title', '报修')

@section('sidebar')
    @parent
@endsection

@section('content')

    <div class="row-fluid">
        <div class="page-header">
            <h1>报修 <small>详情</small></h1>
        </div>
        <table class="table" style="width: 500px;background: white">
            <tr>
                <th>分类</th>
                <td>{{$data->part}}</td>
            </tr>
            <tr>
                <th>描述</th>
                <td>{{$data->description}}</td>
            </tr>
            <tr>
                <th>状态</th>
                @if ( $data->state == 'unfinished' )
                    <td> 未完成</td>
                @elseif ($data->state == 'finish')
                    <td> 完成 </td>
                @endif
            </tr>
            <tr>
                <th>用户id</th>
                <td>{{$data->user_id}}</td>
            </tr>
            <tr>
                <th>报修地址</th>
                <td>{{$data->address}}</td>
            </tr>
            <tr>
                <th>相关图片</th>
                <td><img style="width:80px; height:50px" src="{{ $data->image }}" alt=""></td>
            </tr>
            <tr>
                <th>上门维修时间</th>
                <td>{{$data->repair_time}}</td>
            </tr>
            <tr>
                <th>完成时间</th>
                <td>{{$data->finish_time}}</td>
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

    <a href="{{url('admin/repair/index')}}" class="btn btn-success">返回列表</a>

@endsection