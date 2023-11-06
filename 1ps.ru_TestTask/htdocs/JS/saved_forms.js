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