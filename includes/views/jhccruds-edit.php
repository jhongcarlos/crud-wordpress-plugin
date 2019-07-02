<div class="wrap">
    <h1><?php _e( 'Add New Item', 'wedevs' ); ?></h1>

    <?php $item = wd_get_jhccrud( $id ); ?>

    <form action="" method="post">

        <table class="form-table">
            <tbody>
                <tr class="row-imei">
                    <th scope="row">
                        <label for="imei"><?php _e( 'IMEI', 'wedevs' ); ?></label>
                    </th>
                    <td>
                        <input type="number" name="imei" id="imei" class="regular-text" placeholder="<?php echo esc_attr( 'IMEI', 'wedevs' ); ?>" value="<?php echo esc_attr( $item->imei ); ?>" required="required" />
                    </td>
                </tr>
                <tr class="row-branch">
                    <th scope="row">
                        <label for="branch"><?php _e( 'Branch', 'wedevs' ); ?></label>
                    </th>
                    <td>
                        <select name="branch" id="branch" required="required">
                            <option value="SM North EDSA
" <?php selected( $item->branch, 'SM North EDSA
' ); ?>><?php echo __( 'SM North EDSA', 'wedevs' ); ?></option>
                            <option value="Starmall
" <?php selected( $item->branch, 'Starmall
' ); ?>><?php echo __( 'Starmall', 'wedevs' ); ?></option>
                            <option value="SM MOA" <?php selected( $item->branch, 'SM MOA' ); ?>><?php echo __( 'SM MOA', 'wedevs' ); ?></option>
                        </select>
                    </td>
                </tr>
                <tr class="row-status">
                    <th scope="row">
                        <label for="status"><?php _e( 'Status', 'wedevs' ); ?></label>
                    </th>
                    <td>
                        <select name="status" id="status" required="required">
                            <option value="0
" <?php selected( $item->status, '0
' ); ?>><?php echo __( '', 'wedevs' ); ?></option>
                            <option value="1
" <?php selected( $item->status, '1
' ); ?>><?php echo __( '', 'wedevs' ); ?></option>
                            <option value="2" <?php selected( $item->status, '2' ); ?>><?php echo __( '', 'wedevs' ); ?></option>
                        </select>
                    </td>
                </tr>
             </tbody>
        </table>

        <input type="hidden" name="field_id" value="<?php echo $item->id; ?>">

        <?php wp_nonce_field( 'lorem' ); ?>
        <?php submit_button( __( 'Update Device', 'wedevs' ), 'primary', 'submit_transaction' ); ?>

    </form>
</div>