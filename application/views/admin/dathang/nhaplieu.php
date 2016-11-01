<script type="text/javascript">
(function($)
{
	
	$(document).ready(function()
	{

	});
	
	$(document).ready(function()
	{  
		//sử dụng autocomplete với input có id = key
		$( "input#param_user_name" ).autocomplete({
			source:'<?php echo admin_url('autocompletejqueryui/searchUserNames'); ?>', //link xử lý dữ liệu tìm kiếm
		});
		
		$( "input#param_user_refer" ).autocomplete({
			source:'<?php echo admin_url('autocompletejqueryui/searchUserReferNames'); ?>', //link xử lý dữ liệu tìm kiếm
		});
	});
	
})(jQuery);
</script>


<?php $this->load->view('admin/dathang/_common'); ?>

<!-- Main content wrapper -->
<div class="wrapper">

   <!-- Form -->
	<form  class="form" id="form" action="<?php echo $action; ?>" method="post">
		<fieldset>
			<div class="widget">
				<div class="title">
					<img src="<?php echo public_url('admin'); ?>/images/icons/dark/add.png" class="titleIcon" />
					<h6><?php echo lang('add'); ?> <?php echo lang('mod_user'); ?></h6>
				</div>
				
				<style>
				.formRow-One_Two {width: 48%; float: left; margin-left: 10px; margin-top: 10px;}
				
				.formRow-One_Three {width: 28%; float: left; margin-left: 10px; margin-top: 10px;}
				
				.formRow-One_Four {width: 22%; float: left; margin-left: 10px; margin-top: 10px;}
				</style>

				<div class="formRow-One_Three">
					<label class="formLeft" for="param_user_name"><?php echo lang('dathang_user_name'); ?>:<span class="req">*</span></label>
					<div class="formRight">
						<span class="oneTwox"><input name="user_name" id="param_user_name" _autocheck="true" type="text" /></span>
						<span name="user_name_autocheck" class="autocheck"></span>
						<div name="user_name_error" class="clear error"><?php echo form_error('user_name')?></div>
					</div>
					<div class="clear"></div>
				</div>

				<div class="formRow-One_Three">
					<label class="formLeft" for="param_password"><?php echo lang('dathang_ngay'); ?>:<span class="req">*</span></label>
					<div class="formRight">
						<span class="oneTwox"><input name="ngay_dat_hang" id="param_ngay_dat_hang" _autocheck="true" type="text" /></span>
						<div name="ngay_dat_hang_autocheck" class="autocheck"></div>
						<div name="ngay_dat_hang_error" class="clear error"><?php echo form_error('ngay_dat_hang')?></div>
					</div>
					<div class="clear"></div>
				</div>
				
				<div class="formRow-One_Three">
					<label class="formLeft" for="param_user_refer"><?php echo lang('dathang_nguoi_gioi_thieu'); ?>:<span class="req">*</span></label>
					<div class="formRight">
						<span class="oneTwox"><input name="user_refer" id="param_user_refer" _autocheck="true" type="text" /></span>
						<span name="user_refer_autocheck" class="autocheck"></span>
						<div name="user_refer_error" class="clear error"><?php echo form_error('user_refer')?></div>
					</div>
					<div class="clear"></div>
				</div>
				
				<div class="formRow">
					<label class="formLeft" for="param_address"><?php echo lang('dathang_bao_nhieu_mat_hang'); ?>:</label>
					<div class="formRight">
						<span class="oneTwo"><input name="bao_nhieu_mat_hang" id="param_bao_nhieu_mat_hang" type="text" _autocheck="true" /></span>
						<div name="bao_nhieu_mat_hang_autocheck" class="autocheck"></div>
						<div name="bao_nhieu_mat_hang_error" class="clear error"><?php echo form_error('bao_nhieu_mat_hang')?></div>
					</div>
					<div class="clear"></div>
				</div>

				<div class="input_fields_wrap">
					<div>
						<div class="formRow-One_Four">
							<label class="formLeft" for="param_password_repeat"><?php echo lang('dathang_product_name'); ?>:<span class="req">*</span></label>
							<div class="formRight">
								<span class="oneTwox"><input name="product_name[]" id="param_product_name" _autocheck="true" type="text" /></span>
								<div name="product_name_autocheck" class="autocheck"></div>
								<div name="product_name_error" class="clear error"><?php echo form_error('product_name')?></div>
							</div>
							<div class="clear"></div>
						</div>

						<div class="formRow-One_Four">
							<label class="formLeft" for="param_name"><?php echo lang('dathang_so_luong'); ?>:<span class="req">*</span></label>
							<div class="formRight">
								<span class="oneTwox"><input name="so_luong[]" id="param_so_luong" type="text" _autocheck="true" /></span>
								<div name="so_luong_autocheck" class="autocheck"></div>
								<div name="so_luong_error" class="clear error"><?php echo form_error('so_luong')?></div>
							</div>
							<div class="clear"></div>
						</div>

						<div class="formRow-One_Four">
							<label class="formLeft" for="param_phone"><?php echo lang('dathang_gia_don_vi'); ?>:</label>
							<div class="formRight">
								<span class="oneTwox"><input name="gia_don_vi[]" id="param_gia_don_vi" type="text" _autocheck="true" /></span>
								<div name="gia_don_vi_autocheck" class="autocheck"></div>
								<div name="gia_don_vi_error" class="clear error"><?php echo form_error('gia_don_vi')?></div>
							</div>
							<div class="clear"></div>
						</div>
						
						<div class="formRow-One_Four">
							<input class="remove_field" name="phone" id="param_phone" type="button" value="<?php echo lang('dathang_button_xoa_dong_hang'); ?>" _autocheck="true" />
						</div>
						
						<div style="clear: both;"></div>
					</div>
				</div>
				
				<div class="formRow">
					<input class="add_field_button" name="phone" id="param_phone" type="button" value="<?php echo lang('dathang_button_them_dong_hang'); ?>" _autocheck="true" />
				</div>

				<!--<div class="formRow">
					<label class="formLeft" for="param_address"><?php echo lang('address'); ?>:</label>
					<div class="formRight">
						<span class="oneTwo"><input name="address" id="param_address" type="text" _autocheck="true" /></span>
						<div name="address_autocheck" class="autocheck"></div>
						<div name="address_error" class="clear error"><?php echo form_error('address')?></div>
					</div>
					<div class="clear"></div>
				</div>

				<div class="formRow">
					<label class="formLeft" for="param_cmnd"><?php echo lang('cmnd'); ?>:</label>
					<div class="formRight">
						<span class="oneTwo"><input name="cmnd" id="param_cmnd" type="text" _autocheck="true" /></span>
						<div name="cmnd_autocheck" class="autocheck"></div>
						<div name="cmnd_error" class="clear error"><?php echo form_error('cmnd')?></div>
					</div>
					<div class="clear"></div>
				</div>

				<div class="formRow">
					<label class="formLeft" for="param_address_giaohang"><?php echo lang('address_giaohang'); ?>:</label>
					<div class="formRight">
						<span class="oneTwo"><input name="address_giaohang" id="param_address_giaohang" type="text" _autocheck="true" /></span>
						<div name="address_giaohang_autocheck" class="autocheck"></div>
						<div name="address_giaohang_error" class="clear error"><?php echo form_error('address_giaohang')?></div>
					</div>
					<div class="clear"></div>
				</div>

				<div class="formRow">
					<label class="formLeft" for="param_dob"><?php echo lang('dob'); ?>:</label>
					<div class="formRight">
						<span class="oneTwo"><input name="dob" id="param_dob" type="text" _autocheck="true" /></span>
						<div name="dob_autocheck" class="autocheck"></div>
						<div name="dob_error" class="clear error"><?php echo form_error('dob')?></div>
					</div>
					<div class="clear"></div>
				</div>-->

           		<div class="formSubmit">
           			<input type="submit" name="dathang_nhaplieu" value="<?php echo lang('button_add'); ?>" class="redB" />
           			<input type="reset" value="<?php echo lang('button_reset'); ?>" class="basic" />
           		</div>
        		<div class="clear"></div>
				
				<script>
				$(document).ready(function() {
					var max_fields      = 10; //maximum input boxes allowed
					var wrapper         = $(".input_fields_wrap"); //Fields wrapper
					var add_button      = $(".add_field_button"); //Add button ID
					
					var x = 1; $('#param_bao_nhieu_mat_hang').val(x); //initlal text box count
					$(add_button).click(function(e){ //on add input button click
						e.preventDefault();
						if(x < max_fields){ //max input box allowed
							x++; $('#param_bao_nhieu_mat_hang').val(x); //text box increment
							$(wrapper).append('<div> \
							<div class="formRow-One_Four"> \
						<label class="formLeft" for="param_password_repeat"><?php echo lang('dathang_product_name'); ?>:<span class="req">*</span></label> \
						<div class="formRight"> \
							<span class="oneTwox"><input name="product_name[]" id="param_product_name" _autocheck="true" type="text" /></span> \
							<div name="product_name_autocheck" class="autocheck"></div> \
							<div name="product_name_error" class="clear error"><?php echo form_error('product_name')?></div> \
						</div> \
						<div class="clear"></div> \
					</div> \
 \
					<div class="formRow-One_Four"> \
						<label class="formLeft" for="param_name"><?php echo lang('dathang_so_luong'); ?>:<span class="req">*</span></label> \
						<div class="formRight"> \
							<span class="oneTwox"><input name="so_luong[]" id="param_so_luong" type="text" _autocheck="true" /></span> \
							<div name="so_luong_autocheck" class="autocheck"></div> \
							<div name="so_luong_error" class="clear error"><?php echo form_error('so_luong')?></div> \
						</div> \
						<div class="clear"></div> \
					</div> \
 \
					<div class="formRow-One_Four"> \
						<label class="formLeft" for="param_phone"><?php echo lang('dathang_gia_don_vi'); ?>:</label> \
						<div class="formRight"> \
							<span class="oneTwox"><input name="gia_don_vi[]" id="param_gia_don_vi" type="text" _autocheck="true" /></span> \
							<div name="gia_don_vi_autocheck" class="autocheck"></div> \
							<div name="gia_don_vi_error" class="clear error"><?php echo form_error('gia_don_vi')?></div> \
						</div> \
						<div class="clear"></div> \
					</div> \
					 \
					<div class="formRow-One_Four"> \
						<input class="remove_field" name="phone" id="param_phone" type="button" value="<?php echo lang('dathang_button_xoa_dong_hang'); ?>" _autocheck="true" /> \
						 \
					</div> \
					 \
					<div style="clear: both;"></div> \
					</div>'); //add input box
						}
					});
					
					$(wrapper).on("click",".remove_field", function(e){ //user click on remove text
							e.preventDefault(); $(this).parent('div').parent('div').remove(); x--; $('#param_bao_nhieu_mat_hang').val(x);
					})
				});
				</script>

			</div>
		</fieldset>
	</form>

</div>
