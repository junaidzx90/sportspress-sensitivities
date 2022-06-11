<div class="sensitivity_wrapper">
  <div class="sensitivity_cards_container">
  <?php
    global $post;
    $author_id = $post->post_author;

    update_user_fields($author_id);

    $data1 = get_user_meta($author_id, 'sensitivity_one');
    if(is_array($data1) && array_key_exists(0, $data1)){
      $data1 = $data1[0];
    }
    
    $data2 = get_user_meta($author_id, 'sensitivity_two');
    if(is_array($data2) && array_key_exists(0, $data2)){
      $data2 = $data2[0];
    }
    
    $data3 = get_user_meta($author_id, 'sensitivity_three');
    if(is_array($data3) && array_key_exists(0, $data3)){
      $data3 = $data3[0];
    }
  ?>

    <div class="sensitivity_camera_sensitivity">
      <h4>Camera Sensitivity (Free Look)</h4>
      <div class="sensitivity_rows_container">

        <?php
        if(is_array($data1) && sizeof($data1) > 0){
          foreach($data1 as $d1){
            ?>
            <div class="sensitivity_card">
              <i class="fa-solid fa-eye"></i>
              <h2><?php echo $d1['value'] ?>%</h2>
              <p><?php echo $d1['text'] ?></p>
            </div>
            <?php
          }
        }else{
          echo '<p class="notfound">No data found.</p>';
        }
        ?>
      </div>
    </div>


    <div class="sensitivity_camera">
      <h4>Camera</h4>
      <div class="sensitivity_rows_container">
      <?php
        if(is_array($data2) && sizeof($data2) > 0){
          foreach($data2 as $d2){
            ?>
            <div class="sensitivity_card">
              <i class="fa-solid fa-camera"></i>
              <h2><?php echo $d2['value'] ?>%</h2>
              <p><?php echo $d2['text'] ?></p>
            </div>
            <?php
          }
        }else{
          echo '<p class="notfound">No data found.</p>';
        }
        ?>
      </div>
    </div>


    <div class="sensitivity_ads_sensitivity">
      <h4>ADS sensitivity</h4>
      <div class="sensitivity_rows_container">
      <?php
        if(is_array($data3) && sizeof($data3) > 0){
          foreach($data3 as $d3){
            ?>
            <div class="sensitivity_card">
              <i class="fa-solid fa-location-crosshairs"></i>
              <h2><?php echo $d3['value'] ?>%</h2>
              <p><?php echo $d3['text'] ?></p>
            </div>
            <?php
          }
        }else{
          echo '<p class="notfound">No data found.</p>';
        }
        ?>
      </div>
    </div>
  </div>
</div>