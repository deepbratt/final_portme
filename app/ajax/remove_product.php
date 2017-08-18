<?php
include("../config.php");
$remove_id = $_POST['remove_id']-1;
$cat_id = $_POST['cat_id'];
//$a=array("red","green","blue","yellow","brown");
//print_r(array_slice($a,2));
$select_data = mysqli_query($mysqli,"select * from tbl_products where product_id='$cat_id'");
$fetch_data = mysqli_fetch_array($select_data);

$attr_name = explode(',',$fetch_data['attr_name']);
unset($attr_name[$remove_id]);
$new_attr_name = implode(',',$attr_name);
//print_r($attr_name);

$attr_value = explode(',',$fetch_data['attr_value']);
unset($attr_value[$remove_id]);
$new_attr_value = implode(',',$attr_value);
//print_r($attr_value);

$update_query = mysqli_query($mysqli,"update tbl_products set attr_name='$new_attr_name',attr_value='$new_attr_value' where product_id='$cat_id'");
if($update_query){
	$select_query = mysqli_query($mysqli,"select * from tbl_products where product_id='$cat_id'");
	$fetch_query = mysqli_fetch_array($select_query);
?>

	<div class="row atrri_add_cont">
			<div class="col-sm-3 ache_ekta">
			</div>
			<div class="col-sm-4">
				<div class="form-group">
					<label style="font-size:13px;">
						Attribute
					</label>																
					<?php
					 $attri = explode(",",$fetch_query['attr_name']);
					 foreach($attri as $attri_fetch)
					 {
					?>
					<input type="text" name="attri[]" class="form-control" value="<?php echo $attri_fetch;?>" placeholder="Eg: color" >
					<p class="help-block with-errors"></p>
					<?php
					 }
					?>															
				</div>
			</div>

			<div class="col-sm-5">
				<div class="form-group">
					<div class="col-sm-10">
						<label style="font-size:13px;">
							Options
						</label>																
					<?php
					 $option = explode(",",$fetch_query['attr_value']);
					 foreach($option as $option_fetch)
					 {
					?>
					<input type="text" name="optn[]" class="form-control" value="<?php echo $option_fetch;?>" placeholder="Eg: color" >
					<p class="help-block with-errors"></p>
					<?php
					 }
					?>
					<p class="help-block with-errors"></p>
					</div>
					<?php
					
					for($i=1;$i<=count($option);$i++){
						$function = "remove_prev('".$i."')";
					?>
					<input type="text" id="cat_id" value="<?php echo $productcat_id;?>" style="display:none;">
					 <div class='col-sm-2' style='margin-top:30px;'><a href='javascript:void(0);' onclick="<?php echo $function;?>" style='color:#ef5350;'><i class='fa fa-trash'></i></a></div>
					<?php
					}
					?>
				</div>
			</div>
	</div>
	

<?php
}
?>