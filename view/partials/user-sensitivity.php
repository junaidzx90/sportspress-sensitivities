<?php
    $fields = get_option("sensitivities_fields");
    if(!is_array($fields)){
        $fields = [];
    }

    $fields_1 = [];
    $fields_2 = [];
    $fields_3 = [];
    if(array_key_exists(0, $fields)){
        $fields_1 = $fields[0];
    }
    if(array_key_exists(1, $fields)){
        $fields_2 = $fields[1];
    }
    if(array_key_exists(2, $fields)){
        $fields_3 = $fields[2];
    }
?>

<?php

function getFieldsValue($arrray1, $array2){
    $values = [];
    foreach($arrray1 as $key => $val){
        $num = $array2[$key];
        $values[$key] = ["text" => $val, "value" => $num];
    }

    return $values;
}

if(isset($_POST['save_user_sc_fields'])){
    $fieldsValue = $_POST['sc_fields'];

    $values1 = getFieldsValue($fields_1, $fieldsValue[1]);
    $values2 = getFieldsValue($fields_2, $fieldsValue[2]);
    $values3 = getFieldsValue($fields_3, $fieldsValue[3]);

    update_user_meta(get_current_user_id(  ), 'sensitivity_one', $values1);
    update_user_meta(get_current_user_id(  ), 'sensitivity_two', $values2);
    update_user_meta(get_current_user_id(  ), 'sensitivity_three', $values3);
}
?>

<div id="sensitivity__form">
    <form action="" method="post">
        <div class="sensitivity">
            <p>Camera Snsitivity (Free Look)</p>
            <div class="sensitivity__contents">
                <?php
                if(is_array($fields_1) && sizeof($fields_1) > 0){
                    $values1 = get_user_meta(get_current_user_id(  ), 'sensitivity_one');
                    if(!is_array($values1)){
                        $values1 = [];
                    }

                    foreach($fields_1 as $key => $field){
                        $value1 = ((array_key_exists(0, $values1) && array_key_exists($key, $values1[0]))?$values1[0][$key]['value']:0);
                        ?>
                        <div class="sc_field">
                            <p class="field_desc"><?php echo $field ?></p>
                            <div class="sc_range">
                                <output><?php echo $value1 ?>%</output>
                                <input class="sc_slider" max="300" name="sc_fields[1][<?php echo $key ?>]" type="range" value="<?php echo $value1 ?>"/>
                            </div>
                        </div>
                        <?php
                    }
                }else{
                    echo '<p class="notfound_error">Fields not found!</p>';
                }
                ?>
            </div>
        </div>
        <div class="sensitivity">
            <p>Camera</p>
            <div class="sensitivity__contents">
                <?php 
                
                if(is_array($fields_2) && sizeof($fields_2) > 0){
                    $values2 = get_user_meta(get_current_user_id(  ), 'sensitivity_two');
                    if(!is_array($values2)){
                        $values2 = [];
                    }

                    foreach($fields_2 as $key => $field){
                        $value2 = ((array_key_exists(0, $values2) && array_key_exists($key, $values2[0]))?$values2[0][$key]['value']:0);
                        ?>
                        <div class="sc_field">
                            <p class="field_desc"><?php echo $field ?></p>
                            <div class="sc_range">
                                <output><?php echo $value2 ?>%</output>
                                <input class="sc_slider" max="300" name="sc_fields[2][<?php echo $key ?>]" type="range" value="<?php echo $value2 ?>"/>
                            </div>
                        </div>
                        <?php
                    }
                }else{
                    echo '<p class="notfound_error">Fields not found!</p>';
                }
                ?>
            </div>
        </div>
        <div class="sensitivity">
            <p>ADS Snsitivity</p>
            <div class="sensitivity__contents">
                <?php 

                if(is_array($fields_3) && sizeof($fields_3) > 0){
                    $values3 = get_user_meta(get_current_user_id(  ), 'sensitivity_three');
                    if(!is_array($values3)){
                        $values3 = [];
                    }

                    foreach($fields_3 as $key => $field){
                        $value3 = ((array_key_exists(0, $values3) && array_key_exists($key, $values3[0]))?$values3[0][$key]['value']:0);
                        ?>
                        <div class="sc_field">
                            <p class="field_desc"><?php echo $field ?></p>
                            <div class="sc_range">
                                <output><?php echo $value3 ?>%</output>
                                <input class="sc_slider" max="300" name="sc_fields[3][<?php echo $key ?>]" type="range" value="<?php echo $value3 ?>"/>
                            </div>
                        </div>
                        <?php
                    }
                }else{
                    echo '<p class="notfound_error">Fields not found!</p>';
                }
                ?>
            </div>
        </div>

        <button type="submit" name="save_user_sc_fields">Save Changes</button>
    </form>
</div>