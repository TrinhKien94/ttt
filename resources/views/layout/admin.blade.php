<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Home Bookstore</title>
        <meta name="keywords" content="Book Store Template, Free CSS Template, CSS Website Layout, CSS, HTML" />
        <meta name="description" content="Book Store Template, Free CSS Template, Download CSS Website" />
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
        <link rel="stylesheet" href="{{ url() }}/css/templatemo_style.css" type="text/css"/>
        <link rel="stylesheet" href="{{ url() }}/css/jquery-ui/jquery-ui.css">
        <script type="text/javascript">
             $(document).ready(function() {
                $('.select').removeClass('visible');
                $('.checkbox').attr("checked",false);
                $('.parent').click(function() {
                    var $ul = $(this).siblings("ul");
                    $ul.toggleClass('visible');
                });
                $(".buy_now_button").click(function(event){
                    event.preventDefault();
                    $.post("{{url('cart')}}", $( this ).closest("form").serialize(), function($respone) {
                        if($respone=='notLogin')
                            window.location.href = "{{url('auth/login')}}";
                        else{
                            $(".cart-price").text($respone);
                        }   
                    });
                });
                $(".quantity_input").on('change',function(event){
                    event.preventDefault();
                    $total_price=$(this).parent().parent().parent().parent().find(".cart_total_price");
                    $book_id=$(this).closest("input");
                    $.post("{{url('cart_update')}}", $( this ).closest("form").serialize(), function($respone) {
                        if($respone.login=='false'){
                            window.location.href = "{{url('auth/login')}}";
                        }else{
                            $total_price.text($respone.subtotal);
                            $(".cart-price").text($respone.total);
                        }
                    },'json');
                });
                $(".cart_quantity_delete").on('click',function(event){
                    event.preventDefault();
                    $html_will_delete=$(this).parent().parent().parent();
                    $.post("{{url('cart_delete')}}", $( this ).closest("form").serialize(), function($respone ) {
                        if($respone=='notLogin')
                            window.location.href = "{{url('auth/login')}}";
                        else{
                            $(".cart-price").text($respone);
                            $html_will_delete.remove();
                            if($respone == 0){
                                $("table").remove();
                                $("p").remove();
                                $("#templatemo_content_right").append("<p>You have no items in the shopping cart</p>");
                                $("button").closest("div").remove();
                            }
                        }
                    });
                });
                $(".cart_remove").click(function(event){
                    event.preventDefault();
                    $.post("{{url('cart_remove')}}", $( this ).closest("form").serialize(), function() {
                        $("table").remove();
                        $("p").remove();
                        $(".cart-price").text("0");
                        $("#templatemo_content_right").append("<p>You have no items in the shopping cart</p>");
                        $("button").closest("div").remove();
                    });
                });

                $(".checkbox").click(function(){
                    $select = $(this).parent().parent().find(".select");
                    $select.toggleClass('visible');
                });
                $(".delete-book").click(function(event){
                    event.preventDefault();
                    $this = $(this);
                    $book_stt=$(this).parent().parent().parent().find('.book_stt');
                    if($book_stt.text().trim()=='Chưa xóa'){
                        $.post("{{url('book/delete')}}", $( this ).closest("form").serialize(), function() {
                            $book_stt.text('Đã xóa');
                            $this.text('Hoàn tác');
                        });
                    }else{
                        $.post("{{url('book/undo_delete')}}", $( this ).closest("form").serialize(), function() {
                            $book_stt.text('Chưa xóa');
                            $this.text('Xóa');
                        });                        
                    }
                });
                $(".delete-user").click(function(event){
                    event.preventDefault();
                    $html_will_delete=$(this).parent().parent().parent();
                    if (confirm('Bạn có chắc muốn xóa người dùng này không?')) {
                        $.post("{{url('/delete_user')}}", $( this ).closest("form").serialize(), function() {
                            $html_will_delete.remove();
                        });
                    }
                });
                $(".admin-button").click(function(event){
                    event.preventDefault();
                    $this = $(this);
                    $admin_stt=$(this).parent().parent().parent().find('.admin_stt');
                    if($admin_stt.text().trim()=='User'){
                        $.post("{{url('/admin_users/toAdmin')}}", $( this ).closest("form").serialize(), function() {
                            $admin_stt.text('Admin');
                            $this.attr('value', 'Giáng chức');;
                        });
                    }else{
                        $.post("{{url('/admin_users/toUser')}}", $( this ).closest("form").serialize(), function() {
                            $admin_stt.text('User');
                            $this.attr('value', 'Bổ nhiệm admin');
                        });                        
                    }
                });
                $('.show-content').click(function(event) {
                    event.preventDefault();
                    $curRow = $(this).parent().parent().parent(); // or however you're getting the current `tr`.
                    $curRow.next('tr').find('td').toggleClass('visible-cell');
                    $.post("{{url('/setReadStt')}}", $( this ).closest("form").serialize(), function() {
                        $curRow.find('.rq_stt').text('Đã đọc');
                    });     
                });
                $('.delete-request').click(function(event){
                    event.preventDefault();
                    $curRow = $(this).parent().parent().parent();
                    $html_will_delete=$(this).parent().parent().parent();
                    if (confirm('Bạn có chắc muốn xóa yêu cầu này không?')) {
                        $.post("{{url('/request/delete')}}", $( this ).closest("form").serialize(), function() {
                            $curRow.next('tr').remove();
                            $html_will_delete.remove();
                        });
                    }
                });
                $(".admin-order").click(function(event){
                    event.preventDefault();
                    $this = $(this);
                    if($this.text().trim()=='Đã giao hàng'){
                        $.post("{{url('/admin/orders/nodone')}}", $( this ).closest("form").serialize(), function() {
                            $this.text('Chưa giao');
                        });
                    }else{
                        $.post("{{url('/admin/orders/done')}}", $( this ).closest("form").serialize(), function() {
                            $this.text('Đã giao hàng');
                        });                        
                    }
                });
            });  
        </script>
    </head>

    <body>
        <div id="templatemo_container">
            
            @include('layout.header2')

            <div id="templatemo_content">
                @yield('sidebar')
                

                <div id="templatemo_content_right">
                    
                    @yield('content')

                </div>
            </div>
            
            @include('layout.footer')
            
        </div>
    </body>
</html>
