<h3>Sensitivities</h3>
<hr>
<div>
    <p>Shortode: <code>sensitivities</code></p>
</div>
<?php

if(isset($_POST['sensitivity_fields'])){
    $fields = ((isset($_POST['cs_fields'])) ? $_POST['cs_fields'] : '');

    if(is_array($fields) && sizeof($fields) > 0){
        $cs_fields = [];
        foreach($fields as $data){
            $single = array_map(function($el){
                return sanitize_text_field( stripcslashes($el) );
            }, $data);
    
            $cs_fields[] = $single;
        }
    
        update_option( 'sensitivities_fields', $cs_fields );
    }
   
}

?>

<form method="post">
    <div id="sensitivities">

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

        <div class="sensitivity">
            <h4>Camera Snsitivity (Free Look)</h4>
            <div class="sensitivity__contents">
                <div class="input_fields">
                    <?php
                    if(is_array($fields_1) && sizeof($fields_1) > 0){
                        foreach($fields_1 as $key => $field){
                            ?>
                            <div class="sc_input">
                                <span class="remove_cs_field">+</span>
                                <input type="text" placeholder="Description" name="cs_fields[1][<?php echo $key ?>]" value="<?php echo $field ?>">
                            </div>
                            <?php
                        }
                    }else{
                       echo '<p>No fields are added.</p>';
                    }
                    ?>
                </div>
                <button class="button-secondary add_cs_field" data-pos="1">Add field</button>
            </div>
        </div>
        <div class="sensitivity">
            <h4>Camera</h4>
            <div class="sensitivity__contents">
                <div class="input_fields">
                    <?php
                    if(is_array($fields_2) && sizeof($fields_2) > 0){
                        foreach($fields_2 as $key => $field){
                            ?>
                            <div class="sc_input">
                                <span class="remove_cs_field">+</span>
                                <input type="text" placeholder="Description" name="cs_fields[2][<?php echo $key ?>]" value="<?php echo $field ?>">
                            </div>
                            <?php
                        }
                    }else{
                       echo '<p>No fields are added.</p>';
                    }
                    ?>
                </div>
                <button class="button-secondary add_cs_field" data-pos="2">Add field</button>
            </div>
        </div>
        <div class="sensitivity">
            <h4>ADS Snsitivity</h4>
            <div class="sensitivity__contents">
                <div class="input_fields">
                    <?php
                    if(is_array($fields_3) && sizeof($fields_3) > 0){
                        foreach($fields_3 as $key => $field){
                            ?>
                            <div class="sc_input">
                                <span class="remove_cs_field">+</span>
                                <input type="text" placeholder="Description" name="cs_fields[3][<?php echo $key ?>]" value="<?php echo $field ?>">
                            </div>
                            <?php
                        }
                    }else{
                       echo '<p>No fields are added.</p>';
                    }
                    ?>
                </div>
                <button class="button-secondary add_cs_field" data-pos="3">Add field</button>
            </div>
        </div>
    </div>
    <button type="submit" name="sensitivity_fields" class="button-primary">Save Setting</button>
</form>