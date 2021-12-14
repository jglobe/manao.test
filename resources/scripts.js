$(document).on('click', '#authorization_submit',function(){
    $.ajax({
        method: "POST",
        url: "actions/authorization.php",
        data: $("#authorization_form").serialize()
    })
        .done(function( data ) {
            if ( data.success ){
                // редирект после авторизации, закомм для проверки отправки формы
                // window.location.href = 'login.php';
            } else {
                $('.auth_error').text('');
                for (let error in data.errors) {
                    for (let error in data.errors) {
                        let targetClass = '.auth_error.'+error;
                        $(targetClass).text(data.errors[error]);
                    }
                }
            }
        });
});
$(document).on('click', '#registration_submit',function(){
    $.ajax({
        method: "POST",
        url: "actions/registration.php",
        data: $("#registration_form").serialize()
    })
        .done(function( data ) {
            if (data.success) {
                $('.reg_error').text('');
                document.getElementById('registration_form').reset();
                // редирект после регистрации, закомм для проверки отправки формы
                // window.location.href = 'index.php';
            } else {
                $('.reg_error').text('');
                for (let error in data.errors) {
                    let targetClass = '.reg_error.'+error;
                    $(targetClass).text(data.errors[error]);
                }
            }
        });
});
$(document).on('click', '#logout_submit',function(){
    $.ajax({
        method: "POST",
        url: "actions/logout.php",
        data: $("#logout_form").serialize()
    })
        .done(function( data ) {
            if (data.success) {
                // редирект после логаута, закомм для проверки отправки формы
                // window.location.href = 'login.php';
            }
        });
});