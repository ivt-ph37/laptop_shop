@extends('admin.master_admin')
@section('content')

<div class="col-lg-12">
    <h1 class="page-header">Category
        <small>List</small>
    </h1>

    @if(session('thongbao'))
        <div class="alert alert-success" role="alert">
            {{session('thongbao')}}
        </div>
    @endif
<form action="" method="get" id="form-search">
        @csrf
    <div class="input-group custom-search-form" style="width: 50%;">
        <input type="text" class="form-control" id="search" name="search" placeholder="Search...">
        <span class="input-group-btn">
            <button class="btn btn-default" id="butsearch" type="submit"  >
                <i class="fa fa-search"></i>
            </button>
        </span>
    </div>
</form> 

    <div class="alert alert-success" id="mess" role="alert">
    </div>

</div>

<div id="table_pag">


    <table class="table table-striped table-bordered table-hover" id="dataTables-example">

        <thead>
            <tr align="center">
                <th>STT</th>
                <th>Name</th>
                <th class="ab">Parent_Categoy</th>
                <th>Desription</th>
                <th></th>
                <th colspan="2">Action</th>
            </tr>
        </thead>
        <tbody id="bodydd">
            @foreach($categoies as $key=>$item)
            <tr class="odd gradeX" align="center">
                <td>{{$item->id}}</td>
                <td id="name">{{$item->name}}</td>
                <td id="parent_id" class="ab">
                    @if($item->parent_id == 0)
                        {!!"None"!!}
                    @else
                       @foreach($categories as $va)
                            @if($va->id == $item->parent_id)
                                {{$va->name}}
                            @else
                                @foreach($va->childrenCategories as $childCategory)
                                    @include('admin.cate.dequy', ['child_category' => $childCategory])
                                @endforeach
                            @endif

                        @endforeach          
                    @endif
                </td>
                <td id="desription">{!!$item->desription!!}</td>
                <td><a href="{{route('category.show',$item->id)}}">Show</a></td>
                <td class="center">
                    <button data-url="{{route('category.edit',$item->id)}}" class="btn btn-primary btn-edit" data-toggle="modal" data-target="#edit" type="button"><i class="fa fa-pencil fa-fw" ></i> </button>
                </td>
                <td class="center">
                    <button data-url="{{ route('category.destroy',$item->id) }}"​ type="button" data-target="#delete" data-toggle="modal" class="btn btn-danger btn-delete"><i class="fa fa-trash-o  fa-fw"></i></button>
                </td>
                
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div style="text-align: center;">
    {!!  $categoies->links() !!}
</div>

@include('admin.cate.edit')

@endsection
@section('sr')

<script>

$(document).ready(function () {

    $('#mess').hide();

    $('.pagination a').unbind('click').on('click', function(e) {
        e.preventDefault();
        var page= $(this).attr('href').split('page=')[1];
        fetch_data(page);
    }) 
    function fetch_data(page){
        $.ajax({
            type:"get",
            url: '?page='+page,
            
            success:function($resuld){
                $('body').html($resuld);
                
            }
        })
    }
     $('#form-search').submit(function(e){
        $('.pagination').hide();
                        e.preventDefault();
                        $.ajax({
                            type: 'get',
                            url: 'category/search',
                        data: {
                            'search': $('#search').val(), 
                        },
                        success: function($resuld) {
                            $('#bodydd').html($resuld);
                        var html ='';
                        $.each($resuld.data,function($key,$value){
                        // console.log($key);

                            var $a='';
                            if ($value['parent_id'] == 0) {
                                    $a = 'None';
                                } 
                            else {
                                   $.each($resuld.categories,function($keyy,$values){
                        
                                         if ($value['parent_id' ] == $values['id']) {
                                                 $a = $values['name'];
                                             }
                                         else
                                         {
                                            $.each($values.children_categories,function($keyy,$valuess)
                                            {
                        
                                            if ($value['parent_id' ] == $valuess['id']) {
                                                 $a = $valuess['name'];
                                             }
                                             else
                                             {
                                                 $.each($valuess.categories,function($keyy,$valuesss)
                                                 {
                        
                                                     if ($value['parent_id' ] == $valuesss['id']) 
                                                     {
                                                         $a = $valuesss['name'];
                                                                 }
                                                                        });                                       
                                                                  }
                                                             }); 
                                                   }
                                         }); 
                                     }
                            if ($value['desription'] == null) {
                                $value['desription'] = '';
                            }                         
                            html +='<tr><td>'+$value['id']+'</td><td>'+$value['name']+'</td><td>'+$a+'</td><td>'+$value['desription']+'</td><td><a href="http://127.0.0.1/admin/category/'+$value['id']+'">Show</a></td><td class="center"><button data-url="http://127.0.0.1/admin/category/'+$value['id']+'/edit" class="btn btn-primary btn-edit" data-toggle="modal" data-target="#edit" type="button"><i class="fa fa-pencil fa-fw" ></i> </button></td><td class="center"><button data-url="http://127.0.0.1/admin/category/'+$value['id']+'"​ type="button" data-target="#delete" data-toggle="modal" class="btn btn-danger btn-delete"><i class="fa fa-trash-o  fa-fw"></i></button></td>';
                            html += '</tr>';
                        });
                             $('#bodydd').html(html);
                            }

                        })
                    })

    $(document).on('click', '.btn-delete', function(e){
        var url = $(this).attr('data-url');
        var _this = $(this);
        if (confirm('Ban co chac muon xoa khong?')) {
            $.ajax({
                type: 'delete',
                url: url,
                data: { _token: '{{csrf_token()}}' },
                success: function(response) {
                    alert('Xoa thanh cong');
                    _this.parent().parent().remove();
                    window.location.reload();
                },

            })
        }
    })

   $(document).on('click', '.btn-edit', function(e){
        $('.error').hide();
        var url = $(this).attr('data-url');

        e.preventDefault();

        $.ajax({

                type: 'get',
                url: url,
                success: function (response) {
                    $('.tittle').text(response.data.name);
                    $('#name-edit').val(response.data.name);
                    $('#parent-edit').val(response.data.parent_id);
                    CKEDITOR.instances['desription-edit'].setData(response.data.desription);
                    $('#form-edit').attr('data-url','{{ asset('admin/category/') }}/'+response.data.id)
                },
            })
        })
    $('#form-edit').submit(function(e){
                        e.preventDefault();
                        var url=$(this).attr('data-url');
                        $.ajax({
                            type: "PUT",
                            url: url,
                        data: {
                            _token: '{{csrf_token()}}' ,
                            'name': $('#name-edit').val(),  
                            'parent_id': $('#parent-edit').val(),
                            'desription': CKEDITOR.instances['desription-edit'].getData(),
                            '_method':'put',

                        },
                        success: function($resuld) {
                            if($resuld.error == 'true'){
                                
                                if ($resuld.mess.name) {
                                    $('.error').show();
                                    $('.error').text($resuld.mess.name[0]);
                                }else{$('.error').hide()};
                               
            
                            }else{
                            $('#edit').hide();
                            $('#name').text($resuld.data.name);
                            $('#parent_id').text($resuld.data.parent_id);
                            $('#desription').text($resuld.data.desription);
                            $('#mess').show();
                            $('#mess').html($resuld.message,{timeOut:5000});
                            toastr.success($resuld.message);
                            window.location.reload();
                            }

                        },
                        })
                    })

})
   
</script>
@endsection



               