$(document).ready(function(){

$('#add_comment').on('click',function (e){


    console.log($('#is_auth').val());
    if ($('#is_auth').val() == ""){
        e.preventDefault();
        e.stopPropagation();
        location.href = $('#login_route').val();

    }

})
$('.filtr_select').on('change',function (){

   $route = $('#filtr_route').val();
   $filtr_time = $('#in_time').val();
   $filtr_topic = $('#topic').val();
   console.log($filtr_time);
   console.log($filtr_topic);

    $.ajax({
        type: "POST",
        url: $route,
        data: {


            time: $filtr_time,
            topic: $filtr_topic

        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        dataType: 'json',

        success: function (response) {
            console.log(response)
            if (response.view) {
                $('#comments_row').empty();
                $('#comments_row').append(response.view);
            } else {
                console.log('chka')
            }

        },
        error: function () {
            alert('error ajax');
        }
    });

});

});
