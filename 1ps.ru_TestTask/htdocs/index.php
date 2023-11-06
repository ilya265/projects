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
        <h2>Меню</h2>
        <div style='margin:10px auto; width: 301px'>
            <select name="" id="" onchange="changeHref()">
                <option value="" disabled selected hidden>Выберите форму</option>
                <?php

                include('../settings.php');
                try{
                    $connection = mysqli_connect($HOST, $USER, $PASSWORD, $DB_NAME);
                }
                catch (Throwable $error){
                    echo "<option value=''>ошибка подключения к базе данных</option>";
                }
                $result = mysqli_query($connection, 'SELECT DISTINCT form_id from form_content');

                foreach($result as $row){
                    $value= $row['form_id'];
                    echo "<option value='$value'>Форма $value</option>";
                }


                
                ?>
            </select>
        </div>
        <div class="operations"><a href="" class="change_form">Изменить форму</a></div>
        <div class="operations" onclick="deleteForm()"><a href="" class="delete_form">Удалить форму</a></div>
        <div class="operations"><a href="change_form.php?new=1" class="create_new">Добавить новую</a></div>
        <div class="operations"><a href='saved_forms.php'>Готовые формы</a></div>
        <div class="status" style="margin: 0 auto;"></div>

    </form>
</body>
<script src="JS/jquery-3.1.1.min.js"></script>
<script src="JS/index.js"></script>
</html>