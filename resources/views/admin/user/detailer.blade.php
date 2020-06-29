@extends('admin.master_admin')
@section('content')
<div class="col-lg-12">
    @foreach($users as $item)
                        <h1 class="page-header">User: 
                            <small style="font-size: 40px;color: #6b00ff;">{{$item->username}}</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>fullname</th>
                                <th>Email</th>
                                <th>Level</th>
                                <th>Telephone</th>
                                <th>Sex</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            
                            <!-- <div>
                                <img src="/avatars/" alt="" width="300px"></img>
                            </div> -->
                            <tr class="odd gradeX" align="center">
                                <td>{{$item->id}}</td>
                                <td>{{$item->fullname}}</td>
                                <td>{{$item->email}}</td>
                                <td>
                                    @if($item->level == 1)
                                    {{"Admin"}}
                                    @else
                                        {{"User"}}
                                    @endif
                                </td>
                                <td>{{$item->telephone}}</td>
                                <td>
                                    @if($item->sex == 0)
                                    {{"Nam"}}
                                    @else
                                        {{"Nữ"}}
                                    @endif
                                </td>
                                
                            </tr>
                             @endforeach
                        </tbody>
                    </table>

                   
@endsection