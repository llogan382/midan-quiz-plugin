<?php


//function to add meta boxes

function lwd_add_meta_boxes() {

    add_meta_box(
        'lwd_quest_group',
        'Quiz Questions',
        'lwd_meta_box_display',
        'lwd_social_quiz',
        'normal',
        'default');

}

// Create a function to display meta boxes

function lwd_meta_box_display() {
    global $post;
    $gpminvoice_group = get_post_meta($post->ID, 'customdata_group', true);
     wp_nonce_field( 'gpm_repeatable_meta_box_nonce', 'gpm_repeatable_meta_box_nonce' );
    ?>
    <script type="text/javascript">
    jQuery(document).ready(function( $ ){
        $( '#add-row' ).on('click', function() {
            var row = $( '.empty-row.screen-reader-text' ).clone(true);
            row.removeClass( 'empty-row screen-reader-text' );
            row.insertBefore( '#repeatable-fieldset-one tbody>tr:last' );
            return false;
        });

        $( '.remove-row' ).on('click', function() {
            $(this).parents('tr').remove();
            return false;
        });
    });
  </script>
  <table id="repeatable-fieldset-one" width="100%">
  <tbody>
    <?php
     if ( $gpminvoice_group ) :
      foreach ( $gpminvoice_group as $field ) {
    ?>
    <tr>
      <td width="15%">
        <input type="text"  placeholder="Title" name="TitleItem[]" value="<?php if($field['TitleItem'] != '') echo esc_attr( $field['TitleItem'] ); ?>" /></td>

<?php
        $n = 0;
        $input = sprintf(
        '<input %s id="%s" name="%s[]" ' . $n . 'type="%s" value="%s">'
					);


        while($n < 5){
            echo $input;
        }
        ?>

    </tr>
    <?php
    }
    else :
    // show a blank one
    ?>
    <tr>
      <td>
        <input type="text" placeholder="Title" title="Title" name="TitleItem[]" /></td>
      <td>
          <textarea  placeholder="Description" name="TitleDescription[]" cols="55" rows="5">  </textarea>
          </td>
      <td><a class="button  cmb-remove-row-button button-disabled" href="#">Remove</a></td>
    </tr>
    <?php endif; ?>

    <!-- empty hidden one for jQuery -->
    <tr class="empty-row screen-reader-text">
      <td>
        <input type="text" placeholder="Title" name="TitleItem[]"/></td>
      <td>
          <textarea placeholder="Description" cols="55" rows="5" name="TitleDescription[]"></textarea>
          </td>
      <td><a class="button remove-row" href="#">Remove</a></td>
    </tr>
  </tbody>
</table>
<p><a id="add-row" class="button" href="#">Add another</a></p>
 <?php
}


// function to add a question


// function to save post


// "admin footer" for media portion