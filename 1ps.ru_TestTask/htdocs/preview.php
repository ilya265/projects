<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="CSS/style.css">
</head>
<body>
    <form onsubmit="event.preventDefault();">
        <h2>Форма <?php echo $_GET['form_num']?></h2>
        <?php

        include('../settings.php');

        $form_num = $_GET['form_num'];
        $connection = mysqli_connect($HOST, $USER, $PASSWORD, $DB_NAME);
        $sql_request = "SELECT * FROM current_form WHERE form_id=$form_num";
        $result = mysqli_query($connection, $sql_request);

        foreach($result as $row){
         
            if($row['tag'] == 'paragraph'){
                echo "<div class='wrapper main' tag='paragraph'> 
                <p>". $row["tag_value"] ."
                </div>";
            }

            elseif($row['tag'] == 'textarea'){
                echo "<div class='wrapper main' tag='textarea'> 
                <textarea onkeyup='correctHeight(this)' name='". $row["tag_name"] ."' value='". $row["tag_value"] ."'>
                </textarea> 
                </div>";
            }

            elseif($row['tag'] == 'text'){
                echo "<div class='wrapper main' tag='text'> 
                <input type='text' name='". $row["tag_name"] ."' value='". $row["tag_value"] ."'> 
                </div>";
            }

            elseif($row['tag'] == 'checkbox'){
                echo "<div class='wrapper main' tag='checkbox'> 
                <input type='checkbox' name='". $row["tag_name"] ."' value='". $row["tag_value"] ."'> 
                <p>". $row["tag_value"] ."</p>
                </div>";
            }
            elseif($row['tag'] == 'radio'){
                echo "<div class='wrapper main' tag='radio'> 
                <input type='radio' name='". $row["tag_name"] ."' value='". $row["tag_value"] ."''> 
                <p>". $row["tag_value"] ."</p>
                </div>";
            }
            elseif($row['tag'] == 'file'){
                echo "<div class='wrapper main' tag='file'> 
                <label class='input__file-button'> 
                    <input name='". $row["tag_name"] ."' type='file' class='input input__file' onchange='niceFileButton(this)'> 
                    <span class='input__file-button-text'>Выберите файл</span> 
                </label> 
                </div>";
            }
        }

        ?>
        <button onclick="saveForm()">Сохранить изменения</button>
        <div class="status"></div>

    </form>
</body>
<script src="JS/jquery-3.1.1.min.js"></script>
<script src="JS/preview.js"></script>
<script>
function saveForm(){

$.ajax({
    url: 'save_form.php',
    method: 'POST',
    data: {'production':'1'},
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
</script>
</html> 
