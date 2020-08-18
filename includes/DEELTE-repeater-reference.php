<?php add_action('admin_init', 'pre_add_meta_boxes', 2);
function pre_add_meta_boxes() {
    add_meta_box( 'preinvoice-group', 'Invoice Line Item', 'pre_repeatable_meta_box_display', 'pre_mentor_invoices', 'normal', 'default');
}
function pre_repeatable_meta_box_display() {
    global $post;
    $preinvoice_group = get_post_meta($post->ID, 'preinvoice_group', true);
     wp_nonce_field( 'pre_repeatable_meta_box_nonce', 'pre_repeatable_meta_box_nonce' );
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
    jQuery('#pre_invoice_discount_percent').val();
    jQuery('#formated_total').val(0);
    jQuery('#pre_Discount_Total').val();
    function updateTotal(discount) {
        var discount = parseFloat(jQuery('#pre_invoice_discount_percent').val());

        var subtotal = 0.00;
        var total = 0.00;
        var list = document.getElementsByClassName("custome_prices");

         for(var i = 0; i < list.length; ++i) {
             subtotal1 = (subtotal + parseFloat(list[i].value));
              subtotal = subtotal1;
         }
         discountAmt = ((subtotal*discount)/100).toFixed(2);
         total = (subtotal - discountAmt).toFixed(2);
         var pre_final = parseFloat(jQuery("#formated_total").val(subtotal));
         jQuery("#pre_Discount_Total").val(total);
         jQuery("#pre_grand_Total").val(subtotal.toFixed(2));

      }
    </script>
<script>
     jQuery('#pre_invoice_discount_percent').on( 'change',function (){
        updateTotal();


    });


 </script>

 <table id="repeatable-fieldset-one" width="100%">
  <tbody>
    <?php
     if ( $preinvoice_group ) :
      foreach ( $gpminvoice_group as $field ) {
    ?>
    <tr>
      <td>Invoice Item
        <input type="text"  style="width:80%;"  name="invoiceItem[]" value="<?php if($field['invoiceItem'] != '') echo esc_attr( $field['invoiceItem'] ); ?>" /></td>
      <td>Invoice Price
        <input type="text"  style="width:80%;"   onchange='updateTotal();' class="widefat custome_prices" name="price[]" value="<?php if ($field['price'] != '') echo esc_attr( $field['price'] ); ?>" /></td>
      <td><a class="button remove-row" href="#1">Remove</a></td>
    </tr>
    <?php
    }
    else :
    // show a blank one
    ?>
    <tr>
      <td>Invoice Item
        <input type="text"   style="width:80%;" name="invoiceItem[]" /></td>
      <td>Invoice Price
        <input type="text"  style="width:80%;"  id="input" class="widefat custome_prices" name="price[]" onchange='updateTotal();' value="0.00" onfocus="(this.value == '0.00') && (this.value = '')"
       onblur="(this.value == '') && (this.value = '0.00')"  placeholder="0.00" /></td>
      <td><a class="button  cmb-remove-row-button button-disabled" href="#">Remove</a></td>
    </tr>
    <?php endif; ?>

    <!-- empty hidden one for jQuery -->
    <tr class="empty-row screen-reader-text">
      <td>Invoice Item
        <input type="text" style="width:80%;"  name="invoiceItem[]"/></td>
      <td>Invoice Price
        <input type="text"  style="width:80%;"   class="widefat custome_prices" name="price[]" onchange='updateTotal();'  value="0.00" onfocus="(this.value == '0.00') && (this.value = '')"
       onblur="(this.value == '') && (this.value = '0.00')"  placeholder="0.00"/></td>
      <td><a class="button remove-row" href="#">Remove</a></td>
    </tr>
  </tbody>
</table>
<p><a id="add-row" class="button" href="#">Add another</a></p>
<div class="invoice_status">

  <div class="cmb-th">
    <label for="pre_invoice_status">Invoice Status</label>
  </div>
  <div class="cmb-td">
    <ul class="cmb2-radio-list cmb2-list">
      <li>
       <input type="hidden" style="width:80%;"  id="formated_total" name="formated_total"/>
        <?php  $pre_invoice_status = get_post_meta($post->ID, 'pre_invoice_status', true);?>
     <input type="radio" class="cmb2-option" name="pre_invoice_status" id="pre_invoice_status" value="standard" <?php if($pre_invoice_status=='standard'){ ?>checked="checked"<?php }?> <?php if($pre_invoice_status!='standard'||$pre_invoice_status!='custom'){ ?>checked="checked"<?php }?>>
        <label for="pre_invoice_status">Pending</label>
      </li>
      <li>
        <input type="radio" class="cmb2-option" name="pre_invoice_status" id="pre_invoice_status"  <?php if($pre_invoice_status=='custom'){ ?>checked="checked"<?php }?> value="custom">
        <label for="pre_invoice_status">Paid</label>
      </li>
    </ul>
  </div>
<div class="clearfix"></div>
</div>
<?php
}
add_action('save_post', 'pre_repeatable_meta_box_save');
function pre_repeatable_meta_box_save($post_id) {
    if ( ! isset( $_POST['pre_repeatable_meta_box_nonce'] ) ||
    ! wp_verify_nonce( $_POST['pre_repeatable_meta_box_nonce'], 'pre_repeatable_meta_box_nonce' ) )
        return;

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return;

    if (!current_user_can('edit_post', $post_id))
        return;

    $old = get_post_meta($post_id, 'preinvoice_group', true);
    $new = array();
    $invoiceItems = $_POST['invoiceItem'];
    $prices = $_POST['price'];
     $count = count( $invoiceItems );
     for ( $i = 0; $i < $count; $i++ ) {
        if ( $invoiceItems[$i] != '' ) :
            $new[$i]['invoiceItem'] = stripslashes( strip_tags( $invoiceItems[$i] ) );
             $new[$i]['price'] = stripslashes( $prices[$i] ); // and however you want to sanitize
        endif;
    }
    if ( !empty( $new ) && $new != $old )
        update_post_meta( $post_id, 'preinvoice_group', $new );
    elseif ( empty($new) && $old )
        delete_post_meta( $post_id, 'preinvoice_group', $old );
        $pre_invoice_status= $_REQUEST['pre_invoice_status'];
        update_post_meta( $post_id, 'pre_invoice_status', $pre_invoice_status );