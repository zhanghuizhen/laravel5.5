@extends('layouts.app')

@section('title', '小区信息')

@section('sidebar')
    @parent
@endsection

@section('content')

    <div class="row-fluid">
        <div class="page-header">
            <h1>小区信息 <small>更新</small></h1>
        </div>
        <form class="form-horizontal" action="{{ url('admin/address/update',['id' => $data->id]) }}" method="POST" enctype="multipart/form-data">
            {{csrf_field()}}
            <fieldset>
                <div class="control-group">
                    <label class="control-label" for="address">小区地址</label>
                    <div class="controls">
                        <input type="text" class="input-xlarge" name="address" value="{{$data->address}}"/>
                    </div>
                </div>

                <div class="form-actions">
                    <input type="submit" class="btn btn-success btn-large" value="更新" /> <a class="btn" href="{{url('admin/address/index')}}">取消</a>
                </div>
            </fieldset>
        </form>
    </div>

@endsection