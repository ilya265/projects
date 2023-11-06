<?php
try{
if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    include('../settings.php');

    try{
        $connection = mysqli_connect($HOST, $USER, $PASSWORD, $DB_NAME);
    }
    catch (Throwable $error){
        echo json_encode(array("status" => "ОШИБКА ПОДКЛЮЧЕНИЯ К БАЗЕ ДАННЫХ"));
    }

    header('Content-Type: application/json');

    $arr= $_POST['data'];
    $form_num = $_POST['form_num'];


    if ($_POST['production']){

        $sql_request = "DELETE FROM form_content WHERE form_id=(SELECT DISTINCT form_id FROM current_form)";
        $result = mysqli_query($connection, $sql_request);

        $sql_request= 'INSERT INTO form_content (tag_id, tag_position, tag, tag_name, tag_value, form_id) SELECT tag_id, tag_position, tag, tag_name, tag_value, form_id FROM current_form;';
        $result = mysqli_query($connection, $sql_request);
        
        echo json_encode(array("status" => "0"));
        die;
    }else{
        $sql_request= 'INSERT INTO current_form (tag_position, tag, tag_name, tag_value, form_id) VALUES ';
        for ($i=0; $i != count($arr); ++$i){
            $sql_request = $sql_request . '(';
            $sql_request = $sql_request . '"' . $i+1 . '"' . ',';
            $sql_request = $sql_request . '"' . $arr[$i]['tag'] . '"' .',';
            $sql_request = $sql_request . '"' . $arr[$i]['name'] . '"' . ',';
            $sql_request = $sql_request . '"' . $arr[$i]['value'] . '"' . ',';
            $sql_request = $sql_request . $form_num;
            $sql_request = $sql_request . '), ';
        }

        $sql_request = substr($sql_request,0,-2);
    }


    try{
        if ($_POST['delete_form']){
            $form_id = $_POST['delete_form'];
            $result = mysqli_query($connection, "DELETE * FROM form_content WHERE form_id ='$form_id'");
        }else{
            $result = mysqli_query($connection, $sql_request);
            $result = mysqli_query($connection, "DELETE FROM current_form WHERE form_id=$form_num");
            $result = mysqli_query($connection, $sql_request);
        }
    }
    catch (Throwable $error){
        echo json_encode(array("status" => "ОШИБКА ЗАПИСИ В БАЗУ ДАННЫХ"));
        echo $error;
    }

    echo json_encode(array("status" => 0));
    mysqli_close($connection);
}else{
    echo 'сюда нельзя';
}
}catch (Throwable $error){
    echo $error;
}
?>