function rebootNums(){
    for (i=0; i != $('.wrapper.main').length; i++){

        // добавить номера в классы "wrapper"
        wrapper = $('.wrapper.main')[i]
        wrapper.classList='wrapper'
        wrapper.classList.add('wrapper','main','editor', i+1)

        // добавить содержимое в теги "for"
        for(j=0; j != 3; j++){
            $('.wrapper.'+ (i+1) +' div[for]')[j].attributes.for.value= i+1
        }
    }
}
rebootNums()

arr = $("textarea")
for (i = 0; i != arr.length; i++) {

    // Отобразить текст в textarea аттребуте value
    if (arr[i].attributes.value != ''){
        arr[i].value = arr[i].attributes.value.value
    }


    // увеличить размер textarea если много текста
    if (arr[i].value != ''){
        arr[i].style.height = arr[i].scrollHeight + 'px'
    }

}

// убрать все галочки в чекбоксах и радио
arr = $("input")
for (i = 0; i != arr.length; i++) {
    arr[i].checked = false
}

function niceFileButton(e){

    a =e.parentElement.attributes.class.value
    a= '.' + a.replaceAll(' ','.')
    
    if (e.files != 0){
        $(a+ " .input__file-button-text")[0].innerText = 'Файл выбран'
    }else{
        $(a+ " .input__file-button-text")[0].innerText = 'Выберите файл'
    }
}

function correctHeight(e){
    if(e.scrollTop > 0){e.style.height = e.scrollHeight + 'px'}
}

function wrapperUp(e){
    num = (e.attributes.for.value) * 1
    if (num != 1){

        //запомнить значения value

        inputsMain = []
        inputsSecondary = []
        inputMainTextarea = ''
        inputSecondaryTextarea = ''

        if ($('.wrapper.'+ num +' textarea')[0]){
            inputMainTextarea = $('.wrapper.'+ num +' textarea')[0].value
        }

        if ($('.wrapper.'+ (num-1) +' textarea')[0]){
            inputSecondaryTextarea = $('.wrapper.'+ (num-1) +' textarea')[0].value
        }

        arr = $('.wrapper.'+ num +' input')
            for (i=0;i != arr.length; i++){
                inputsMain[i] = arr[i].value
        }

        arr = $('.wrapper.'+ (num-1) +' input')
            for (i=0;i != arr.length; i++){
                inputsSecondary[i] = arr[i].value
        }


        // переместить текущий блок вниз, а блок внизу, вверх

        if (num == 1){
        }
        else{
            wrapperHTML = $('.wrapper.' + num)[0].innerHTML
            $('.wrapper.' + (num))[0].innerHTML = $('.wrapper.' + (num - 1))[0].innerHTML
            $('.wrapper.' + (num - 1))[0].innerHTML = wrapperHTML
        }
        
        //вставить value обратно

        arr = $('.wrapper.'+ (num-1) +' input')
            for (i=0;i != arr.length; i++){
                arr[i].value = inputsMain[i]
                if ($('.wrapper.'+ (num-1) +' textarea')[0]){
                    $('.wrapper.'+ (num-1) +' textarea')[0].value = inputsMain[i]
                }
        }

        arr = $('.wrapper.'+ num +' input')
            for (i=0;i != arr.length; i++){
                arr[i].value = inputsSecondary[i]
                if ($('.wrapper.'+ num +' textarea')[0]){
                    $('.wrapper.'+ num +' textarea')[0].value = inputsSecondary[i]
                }
        }

        if ($('.wrapper.'+ (num-1) +' textarea')[0]){
            $('.wrapper.'+ (num-1) +' textarea')[0].value = inputMainTextarea
        }

        if ($('.wrapper.'+ num +' textarea')[0]){
            $('.wrapper.'+ num +' textarea')[0].value = inputSecondaryTextarea
        }

        //поменять номера в классах

        wrapper = $('.wrapper.' + num)[0]
        wrapper.classList.remove(num)
        wrapper.classList.add(num - 1)

        wrapper = $('.wrapper.' + (num-1) )[1]
        wrapper.classList.remove(num - 1)
        wrapper.classList.add(num)

        // поменять номера в атрибутах for

        for(i=0; i != 3; i++){
            $('*[for=' + (num - 1) + ']')[0].attributes.for.value= num
        }

        for(i=0; i != 3; i++){
            $('*[for=' + (num) + ']')[0].attributes.for.value= num - 1
        }

    }
    
}

function wrapperDown(e){

    num = (e.attributes.for.value) * 1

    //запомнить значения value

    inputsMain = []
    inputsSecondary = []
    inputMainTextarea = ''
    inputSecondaryTextarea = ''

    if ($('.wrapper.'+ num +' textarea')[0]){
        inputMainTextarea = $('.wrapper.'+ num +' textarea')[0].value
    }

    if ($('.wrapper.'+ (num+1) +' textarea')[0]){
        inputSecondaryTextarea = $('.wrapper.'+ (num+1) +' textarea')[0].value
    }

    arr = $('.wrapper.'+ num +' input')
        for (i=0;i != arr.length; i++){
            inputsMain[i] = arr[i].value
    }

    arr = $('.wrapper.'+ (num+1) +' input')
        for (i=0;i != arr.length; i++){
            inputsSecondary[i] = arr[i].value
    }
    
    // переместить текущий блок вниз, а блок вверху, вверх
    if (num == $('.wrapper.main').length){
    }
    else{
        wrapperHTML = $('.wrapper.' + num)[0].innerHTML
        $('.wrapper.' + num)[0].innerHTML = $('.wrapper.' + (num+1))[0].innerHTML
        $('.wrapper.' + (num+1))[0].innerHTML = wrapperHTML
    }

    //вставить value обратно

    arr = $('.wrapper.'+ (num+1) +' input')
        for (i=0;i != arr.length; i++){
            arr[i].value = inputsMain[i]
    }

    arr = $('.wrapper.'+ num +' input')
        for (i=0;i != arr.length; i++){
            arr[i].value = inputsSecondary[i]
    }

    if ($('.wrapper.'+ (num+1) +' textarea')[0]){
        $('.wrapper.'+ (num+1) +' textarea')[0].value = inputMainTextarea
    }

    if ($('.wrapper.'+ num +' textarea')[0]){
        $('.wrapper.'+ num +' textarea')[0].value = inputSecondaryTextarea
    }

    //поменять номера в классах

    wrapper = $('.wrapper.' + num)[0]
    wrapper.classList.remove(num)
    wrapper.classList.add(num + 1)

    wrapper = $('.wrapper.' + (num+1) )[0]
    wrapper.classList.remove(num + 1)
    wrapper.classList.add(num)

    // поменять номера в атрибутах for
    for(i=0; i != 3; i++){
        $('*[for=' + (num) + ']')[0].attributes.for.value= num + 1
    }

    for(i=0; i != 3; i++){
        $('*[for=' + (num + 1) + ']')[0].attributes.for.value= num
    }

}

function wrapperDelete(e){

    num = (e.attributes.for.value) * 1
    $('.wrapper.main.' + num)[0].remove()
    arr = $('.wrapper.main')

    rebootNums()

}

function addWrapper(){

    tag = $('select')[0].value

    if (tag == "paragraph"){

        html = 
        "<div class='wrapper main editor' tag='paragraph'> \
            <textarea class='editor value' onkeyup='correctHeight(this)' value=''></textarea> \
            <div class='wrapper attributes'> \
                <div class='delete' for='' onclick='wrapperDelete(this)'>x</div> \
                <div class='up' for='' onclick='wrapperDown(this)'>></div> \
                <div class='down' for='' onclick='wrapperUp(this)'><</div> \
            </div> \
        </div>"

    }else if (tag == "textarea"){

        html = 
        "<div class='wrapper main editor' tag='textarea'> \
            <textarea class='editor value' onkeyup='correctHeight(this)' name='' value=''></textarea> \
            <div class='wrapper attributes'> \
                <span>name=</span> \
                <input class='attributes name' type='text' value=''> \
                <div class='delete' for='' onclick='wrapperDelete(this)'>x</div> \
                <div class='up' for='' onclick='wrapperDown(this)'>></div> \
                <div class='down' for='' onclick='wrapperUp(this)'><</div> \
            </div> \
        </div>"

    }else if(tag=='text'){
        html=
        "<div class='wrapper main editor' tag='text'> \
            <input type='text' class='value' name='' value=''> \
            <div class='wrapper attributes'> \
                <span>name=</span> \
                <input class='attributes name' type='text' value=''> \
                <div class='delete' for='' onclick='wrapperDelete(this)'>x</div> \
                <div class='up' for='' onclick='wrapperDown(this)'>></div> \
                <div class='down' for='' onclick='wrapperUp(this)'><</div> \
            </div> \
        </div>"

    }else if(tag == "checkbox"){
        html=
        "<div class='wrapper main editor' tag='checkbox'> \
            <input type='checkbox' name='' value=''> \
            <input class='attributes value' type='text'> \
            <div class='wrapper attributes'> \
                <span>name=</span> \
                <input class='attributes name' type='text' type='text'> \
                <div class='delete' for='' onclick='wrapperDelete(this)'>x</div> \
                <div class='up' for='' onclick='wrapperDown(this)'>></div> \
                <div class='down'  for='' onclick='wrapperUp(this)'><</div> \
            </div> \
        </div>"

    }else if(tag == "radio"){

        html=
        "<div class='wrapper main editor' tag='radio'> \
            <input type='radio' name='' value=''> \
            <input class='attributes value' type='text'> \
            <div class='wrapper attributes'> \
                <span>name=</span> \
                <input class='attributes name' type='text' type='text'> \
                <div class='delete' for='' onclick='wrapperDelete(this)'>x</div> \
                <div class='up' for='' onclick='wrapperDown(this)'>></div> \
                <div class='down'  for='' onclick='wrapperUp(this)'><</div> \
            </div> \
        </div>"

    }else if(tag == "file"){
        html=
        "<div class='wrapper main editor' tag='file'> \
            <label class='input__file-button'> \
                <input name='' type='file' class='input input__file' onchange='niceFileButton(this)'> \
                <span class='input__file-button-text'>Выберите файл</span> \
            </label> \
            <div class='wrapper attributes'> \
                <span>name=</span> \
                <input class='attributes name' type='text'> \
                <div class='delete' for='' onclick='wrapperDelete(this)'>x</div> \
                <div class='up' for='' onclick='wrapperDown(this)'>></div> \
                <div class='down' for='' onclick='wrapperUp(this)'><</div> \
            </div> \
        </div>"
    }

    $('button')[0].insertAdjacentHTML("beforebegin", html); 
    rebootNums()
}

// собрать всю инфу из wrapper'ов и отправить через ajax
function saveForm(){

    data = []
    arr = $('.wrapper.main')
    $('.status')[0].innerHTML = ''

    for (i=0;i != arr.length; i++){
        data[i] = {}
    
        data[i].tag = $('.wrapper.main.' + (i+1))[0].attributes.tag.value
    
        if ($('.wrapper.main.' + (i+1) + ' .name')[0]){

            if ($('.wrapper.main.' + (i+1) + ' .name')[0].value != ''){
                data[i].name = $('.wrapper.main.' + (i+1) + ' .name')[0].value
            }
            else{
                data[i].name = ''
            }
        }
        else{
            data[i].name = ''
        }
        
        if ($('.wrapper.main.' + (i+1) + ' .value')[0]){
            if ($('.wrapper.main.' + (i+1) + ' .value')[0].value != ''){
                data[i].value = $('.wrapper.main.' + (i+1) + ' .value')[0].value
            }
            else{
                data[i].value = ''
            }
        }
        else{
            data[i].value = ''
        }
    
    }

    data_obj = {'data': data,'form_num': form_num}

    $.ajax({
        url: 'save_form.php',
        method: 'POST',
        data: data_obj,
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