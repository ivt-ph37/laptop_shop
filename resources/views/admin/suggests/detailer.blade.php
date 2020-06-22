@extends('admin.master_admin')
@section('content')
<div class="col-lg-12">
  
                        <h1 class="page-header">User of 
                            <small style="font-size: 40px;color: red;">{{$suggets->username}}</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>Email</th>                      
                                <th>Telephone</th>
                                <th>Content</th>
                                <th>Name_product</th>
                                <th>Quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="odd gradeX" align="center">
                                <td>{{$suggets->id}}</td>
                                <td>{{$suggets->email}}</td>
                                <td>{{$suggets->telephone}}</td>
                                <td>{{$suggets->content}}</td>
                                <td>{{$suggets->name_product}}</td>
                                <td>{{$suggets->quantity}}</td>
                            </tr>
                          
                        </tbody>
                    </table>

                   
@endsection