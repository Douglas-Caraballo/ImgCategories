<?php
class AddImg{
    // Add a form field in the category page
    public function add_category_img($taxonomy){?>
    <div>
        <label for="category-image-id"><?php _e('Image'); ?></label>
        <input type="hidden" id="category-image-id" name="category-image-id" class="custom_media_url" value="">
        <div id="category-image-wrapper"></div>
        <p>
            <input type="button" class="button tax_media_button" id="media_button" name="media_button" value="<?php _e('Add Image'); ?>">
            <input type="button" class="button tax_media_remove" id="media_remove" name="media_remove" value="<?php _e('Remove Image'); ?>">
        </p>
    </div>
    <?php
    }

    // save the form field
    public function save_category_img($term_id, $tt_id){
        if(isset($_POST['category-image-id'])&& '' !==$_POST['category-image-id']){
            $image = $_POST['category-image-id'];
            add_term_meta( $term_id,'category-image-id',$image, true);
        }
    }

    // edit the from field
    public function update_category_img($term, $taxonomy){?>
        <tr class="form-field term-group-wrap">
            <th scope="row">
                <label for="category-image-id"><?php _e('Image'); ?></label>
            </th>
            <td>
                <?php $image_id= get_term_meta( $term -> $term_id, 'category-image-id', true); ?>
                <input type="hidden" id="category-image-id" name="category-image-id" value="<?php echo $image_id; ?>">
                <div id="category-image-wrapper">
                    <?php if($image_id){
                        echo wp_get_attachment_image( $image_id, 'thumbnail' );
                    } ?>
                </div>
                <p>
                    <input type="button" class="button tax_media_button" id="media_button" name="media_button" value="<?php _e( 'Add Image'); ?>">
                    <input type="button" class="button tax_media_remove" id="media_remove" name="media_remove" value="<?php _e( 'Remove Image'); ?>">
                </p>
            </td>
        </tr>
        <?php
    }
    // Update the form field value
    public function updated_category_img($term_id, $tt_id){
        if(isset($_POST['category-image-id'])&& ''!==$_POST['category-image-id']){
            $image=$_POST['category-image-id'];
            update_term_meta( $term_id, 'category-image-id', $image );
        }else{
            update_term_meta( $term_id, 'category-image-id', '' );
        }
    }

    public function load_media(){
        wp_enqueue_media();
    }

    // add sript
    public function add_scrip(){?>
        <script>
            JQuery(document).ready(function($){
                function media_upload(button_class){
                    var _custom_media = true,
                        _orig_send_attachment = wp.media.editor.send.attachment;
                    $('body').on('click', button_class, function(e){
                        var button_id = '#'+$(this).attr('id');
                        var send_attachment_bkp = wp.media.editor.send.attachment;
                        var button = $(button_id);
                        _custom_media = true;
                        wp.media.editor.send.attachment = function (props, attachment){
                            if(_custom_media){
                                $('#category-image-id').val(attachment.id);
                                $('#category-image-wrapper').html('<img class="custom_media_image" src"" style="margin:0;padding:0; max-height:100px;float:none;"/>');
                                $('#category-image-wrapper .custom_media_image').attr('src', attachment.url).css('display','block');
                            }else{
                                return _orig_send_attachment.apply(button_id,[props, attachment]);
                            }
                        }
                        wp.media.editor.open(button);
                        return false;
                    });
                }
                media_upload('.tax_media_button.button');
                $('body').on('click','.tax_media_remove',function(){
                    $('#category-image-id').val('');
                    $('#category-image-wrapper').html('<img class="custom_media_image" src"" style="margin:0;padding:0; max-height:100px;float:none;"/>');
                });
                $(document).ajaxComplete(function(event, xhr, settings){
                    var queryStringArr=settings.data.split('&');
                    if($.inArray('action=add-tag',queryStringArr)!== -1){
                        var xml= xhr.responseXML;
                        $response=$(xml).find('term_id').text();
                        if($response!=""){
                            $('#category-image-wrapper').html('');
                        }
                    }
                });
            });
        </script>
    <?php
    }
}
