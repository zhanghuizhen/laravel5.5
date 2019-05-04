@extends('layouts.app')

@section('title', '生活服务')

@section('sidebar')
    @parent
@endsection

@section('content')

    <div class="row-fluid">
        <div class="page-header">
            <h1>生活服务 <small>详情</small></h1>
        </div>
        <table class="table" style="width: 500px;background: white">
            <tr>
                <th>用户地址</th>
                <td>{{$data->user_address}}</td>
            </tr>
            <tr>
                <th>类型</th>
                @if ( $data->type == 'house_clean' )
                    <td>家庭保洁</td>
                @elseif ($data->type == 'car_wash')
                    <td>上门洗车 </td>
                @elseif ($data->type == 'express')
                    <td>代取快递 </td>
                @endif
            </tr>
            <tr>
                <th>到达时间</th>
                <td>{{$data->arrived_at}}</td>
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
                <th>创建人id</th>
                <td>{{$data->user_id}}</td>
            </tr>
            <tr>
                <th>发布时间</th>
                <td>{{$data->published_at}}</td>
            </tr>
            <tr>
                <th>完成时间</th>
                <td>{{$data->finish_time}}</td>
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

    <a href="{{url('admin/service/index')}}" class="btn btn-success">返回列表</a>

@endsection