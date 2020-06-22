
$(document).on('click', '#btn_logout', (event) => {
    event.preventDefault();
    // console.log('ab');
    $.ajax({
        type: 'get',
        url: '/logout',
        // headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        timeout: 30000,
        success: (data) => {
            window.location.reload();
        },
        error: () => {
        }
    });
}); 

$(document).ready(function(){
    $(".remove_item_cart").click(function(){
        var url = $(this).attr('data-url');
        var _this = $(this);
        if(confirm('Do you want remove?')){
            $.ajax({
            type: 'get',
            url : url,
            
            success:function(data){
                window.location.reload();
                // alert(123);
            }
        });
        }
        
        
    });
});





















