
// login form ajax handler
$('.form-login').on('submit', function (event) {
    event.preventDefault();
    let url = $('.form-login').data('url');
    $.ajax({
        url: url,
        method: "POST",
        data: $(this).serialize(),
        success: function(respone) {
            // console.log(respone);
            let res = $.parseJSON(respone);
            if(res.success){
                window.location.href="http://localhost/cclms/";
            }else{
                notify('error', `${res.message}`);
            }
        },
        // error: function (error) {
        //     console.error(error.responseText);
        // }
    })
})