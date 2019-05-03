@extends('layouts.app')

@section('title', '小区信息')

@section('sidebar')
    @parent
@endsection

@section('content')

    <div class="row-fluid">
        <div class="page-header">
            <h1>小区信息 <small>详情</small></h1>
        </div>
        <table class="table table-striped" style="width: 500px">
            <tr>
                <th>小区地址</th>
                <td>{{$data->address}}</td>
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

    <a href="{{url('admin/address/index')}}" class="btn btn-success">返回列表</a>

@endsection