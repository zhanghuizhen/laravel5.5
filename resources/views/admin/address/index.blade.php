@extends('layouts.app')

@section('title', '小区信息')

@section('sidebar')
    @parent
@endsection

@section('content')

    <div class="row-fluid">
        <div class="page-header" style="color: gray">
            <h1>小区信息 <small>列表</small></h1>
        </div>

        <div class="btn-group">
            <form class="form-search"  action="{{ url('admin/address/address') }}" method="POST" >
                <input type="text" class="input-medium search-query" name="address">
                <button type="submit" class="btn">根据内容筛选</button>
            </form>
        </div>

        <table class="table table-bordered" style="background: white;">
            <thead>
            <tr>
                <th>序号</th>
                <th>小区地址</th>
                <th>创建时间</th>
                <th>更新时间</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($list as $value)
                <tr class="list-users">
                    <td>{{$value->id}}</td>
                    <td>{{$value->address}}</td>
                    <td>{{$value->created_at}}</td>
                    <td>{{$value->updated_at}}</td>

                    <td>
                        <div class="btn-group">
                            <a class="btn btn-mini dropdown-toggle" data-toggle="dropdown" href="#">Actions <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="{{url('admin/address/edit', ['id' => $value->id])}}"><i class="icon-pencil"></i> 更新</a></li>
                                <li><a href="{{url('admin/address/show', ['id' => $value->id])}}"><i class="icon-user"></i> 详情</a></li>
                                <li><a href="{{url('admin/address/delete', ['id' => $value->id])}}" onclick="deleteData(this); return false;"><i class="icon-trash"></i> 删除</a></li>
                            </ul>
                        </div>
                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    {{ $list->links() }}

    <a href="{{url('admin/address/create')}}" class="btn btn-success">New Address</a>

    <script>
        function deleteData(obj)
        {
            target = obj;
            if(confirm('您确认要删除该条数据吗？')){
                $.ajax({
                    url:$(obj).attr('href'),
                    type:"DELETE",
                    success:function(data){
                        if(data=="ok"){
                            alert('删除成功');
                            //在页面中删除这个记录
                            //target.parentNode.parentNode.parentNode.removeChild( target.parentNode.parentNode);
                            window.location.reload();
                        }else{
                            alert('删除失败');
                        }
                    }
                });
            }
        }
    </script>

@endsection