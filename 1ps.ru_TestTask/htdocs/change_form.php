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
        try{

        include('../settings.php');

        $form_num = $_GET['form_num'];
        $connection = mysqli_connect($HOST, $USER, $PASSWORD, $DB_NAME);
        $sql_request = "SELECT * FROM current_form WHERE form_id='$form_num'";
        if ($_GET['reset_changes']){
            $reset_changes = $_GET['reset_changes'];
            $sql_request = "INSERT INTO current_form (tag_id, tag_position, tag, tag_name, tag_value, form_id) SELECT tag_id, tag_position, tag, tag_name, tag_value, form_id FROM 'form_content' WHERE form_id=$form_num";
        }

        $result = mysqli_query($connection, $sql_request);
        //добавить кнопку сброса изменений
        if(mysqli_num_rows($result) == 0){
            $sql_request = "SELECT * FROM form_content WHERE form_id='$form_num'";
            $result = mysqli_query($connection, $sql_request);
        }
        if ($_GET['new']){
            $result = mysqli_query($connection, "SELECT MAX(form_id) AS form_id FROM form_content");

            $form_num = (int)(mysqli_fetch_array($result)['form_id'] + 1);
            header('Location:change_form.php?form_num='.$form_num);
            die;
        }else{
            foreach($result as $row){
            
                if($row['tag'] == 'paragraph'){
                    echo "<div class='wrapper main editor' tag='paragraph'> 
                    <textarea class='editor value' onkeyup='correctHeight(this)' value='". $row["tag_value"] ."'>
                    </textarea>
                    <div class='wrapper attributes'> 
                        <div class='delete' for='' onclick='wrapperDelete(this)'>x</div> 
                        <div class='up' for='' onclick='wrapperDown(this)'>></div> 
                        <div class='down' for='' onclick='wrapperUp(this)'><</div> 
                    </div> 
                </div>";
                }

                elseif($row['tag'] == 'textarea'){
                    echo "<div class='wrapper main editor' tag='textarea'> 
                    <textarea class='editor value' onkeyup='correctHeight(this)' name='' value='". $row["tag_value"] ."'>
                    <input class='value' value=''>
                    </textarea> 
                        <div class='wrapper attributes'> 
                            <span>name=</span> 
                            <input class='attributes name' type='text' value='". $row["tag_name"] ."'> 
                            <div class='delete' for='' onclick='wrapperDelete(this)'>x</div> 
                            <div class='up' for='' onclick='wrapperDown(this)'>></div> 
                            <div class='down' for='' onclick='wrapperUp(this)'><</div> 
                        </div> 
                    </div>";
                }

                elseif($row['tag'] == 'text'){
                    echo "<div class='wrapper main editor' tag='text'> 
                    <input type='text' class='value' name='' value='". $row["tag_value"] ."'> 
                        <div class='wrapper attributes'> 
                            <span>name=</span> 
                            <input class='attributes name' type='text' value='". $row["tag_name"] ."'> 
                            <div class='delete' for='' onclick='wrapperDelete(this)'>x</div> 
                            <div class='up' for='' onclick='wrapperDown(this)'>></div> 
                            <div class='down' for='' onclick='wrapperUp(this)'><</div> 
                        </div> 
                    </div>";
                }

                elseif($row['tag'] == 'checkbox'){
                    echo "<div class='wrapper main editor' tag='checkbox'> 
                    <input type='checkbox' name='' value=''> 
                    <input class='attributes value' type='text' value='". $row["tag_value"] ."'> 
                    <div class='wrapper attributes'> 
                        <span>name=</span> 
                        <input class='attributes name' type='text' type='text' value='". $row["tag_name"] ."'> 
                        <div class='delete' for='' onclick='wrapperDelete(this)'>x</div> 
                        <div class='up' for='' onclick='wrapperDown(this)'>></div> 
                        <div class='down'  for='' onclick='wrapperUp(this)'><</div> 
                        </div> 
                    </div>";
                }
                elseif($row['tag'] == 'radio'){
                    echo "<div class='wrapper main editor' tag='radio'> 
                    <input type='radio' name='' value=''> 
                    <input class='attributes value' type='text' value='". $row["tag_value"] ."'> 
                    <div class='wrapper attributes'> 
                        <span>name=</span> 
                        <input class='attributes name' type='text' type='text' value='". $row["tag_name"] ."'> 
                        <div class='delete' for='' onclick='wrapperDelete(this)'>x</div> 
                        <div class='up' for='' onclick='wrapperDown(this)'>></div> 
                        <div class='down'  for='' onclick='wrapperUp(this)'><</div> 
                    </div> 
                    </div>";
                }
                elseif($row['tag'] == 'file'){
                    echo "<div class='wrapper main editor' tag='file'> 
                    <label class='input__file-button'> 
                        <input name='' type='file' class='input input__file' onchange='niceFileButton(this)'> 
                        <span class='input__file-button-text'>Выберите файл</span> 
                    </label> 
                    <div class='wrapper attributes'> 
                        <span>name=</span> 
                        <input class='attributes name' type='text' value='". $row["tag_name"] ."'> 
                        <div class='delete' for='' onclick='wrapperDelete(this)'>x</div> 
                        <div class='up' for='' onclick='wrapperDown(this)'>></div> 
                        <div class='down' for='' onclick='wrapperUp(this)'><</div> 
                    </div> 
                </div>";
                }
            }
        }
        }catch(Throwable $err){
            echo $err;
        }
        ?>
        <button onclick="saveForm()">Сохранить изменения</button>
        <div class="status"></div>

    </form>
<div style='margin:10px auto; width: 301px'>
    <select name="" id="" >
        <option value="paragraph">Текст</option>
        <option value="textarea">Текстовое поле</option>
        <option value="text">Строковое поле</option>
        <option value="checkbox"> Чекбокс </option>
        <option value="radio"> Радио </option>
        <option value="file"> Файл </option>
    </select>
</div>
<div class="operations" onclick='addWrapper()'><a>Добавить</a></div>
<div class="operations"><a href="change_form.php?reset_changes='<?php echo $_GET['form_num']?>'">Сбросить изменения</a></div>
<div class="operations"><a href='preview.php?form_num=<?php echo $_GET['form_num']?>' >Предпросмотр</a></div>
</body>
<script src="JS/jquery-3.1.1.min.js"></script>
<script src="JS/script.js"></script>
<script>
    form_num = <?php echo $_GET['form_num']?>
</script>
</html>

