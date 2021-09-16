jQuery(document).ready(function(){
    jQuery("#notiPromotion").click(function(){
        jQuery("#popupNotiPromotion").css('display','block');
    });
});
// jQuery(document).ready(function(){
//     jQuery('#notiPromotion').click(function(){
//         var hostname = window.location.hostname;
//         jQuery.ajax({
//            type : "post",
//            dataType : "json",
//            url : 'https://localhost/diva-home/wp-admin/admin-ajax.php', 
//            data : {
//                 action: "load_promotion",
//            },
//            beforeSend: function(){
//                 // Có thể thực hiện công việc load hình ảnh quay quay trước khi đổ dữ liệu ra
//            },
//            success: function(response) {
//                console.log(response);
//             jQuery('.list-noti-promotion').html(response);
//            },
//            error: function( jqXHR, textStatus, errorThrown ){
//                 console.log( 'The following error occured: ' + textStatus, errorThrown );
//            }
//        });
//     });
// });
if(document.getElementById("popupNotiPromotion")){
    document.addEventListener('mouseup', function(e) {
        var popupNotiPromotion = document.getElementById("popupNotiPromotion");
        if (!popupNotiPromotion.contains(e.target)) {
            popupNotiPromotion.style.display = 'none';
        }
    });
}
