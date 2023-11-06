<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="CSS/style.css">
</head>
<body>
    <?php

    include('../settings.php');

    $connection = mysqli_connect($HOST, $USER, $PASSWORD, $DB_NAME);
    $sql_request = "SELECT * FROM form_content ORDER BY form_id";
    $result = mysqli_query($connection, $sql_request);
    $memory = '';

    foreach($result as $row){

        $form_num = $row['form_id'];

        if ($form_num != $memory){

            if ($close_tag == true){
                $close_tag = false;
                echo 
                '<button onclick="">Сохранить ответы</button>
                <div class="status"></div>
                </form>';
            }

            echo 
            "<form onsubmit='event.preventDefault();'>
            <h2>Форма $form_num</h2>";
            $memory = $form_num;
            $close_tag = true;
        }

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
    <button onclick="saveForm()">Сохранить ответы</button>
    <div class="status"></div>

    </form>

</body>
<script src="JS/jquery-3.1.1.min.js"></script>
<script src="JS/saved_forms.js"></script>
</html>

