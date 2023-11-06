$('select')[0].value = ''

function changeHref(){
    href = 'change_form.php'
    value = $('select')[0].value
    
    $('.change_form')[0].attributes.href.value = href + "?form_num=" + value
}

function deleteForm(){

    $.ajax({
        url: 'save_form.php',
        method: 'POST',
        data: {'deleteForm':1},
        success: function(response){
            if (response.status == 0){
                $('.status')[0].innerHTML = 'Успешно сохранено'
            }
            else{
                $('.status')[0].innerHTML = response.status
            }
        },
        error: function(response){
            $('.status')[0].innerHTML = 'Ошибка подключения к серверу'
        }
    });
}
