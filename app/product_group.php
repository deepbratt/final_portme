<?php
include("config.php");
$business_id = $_SESSION['business_id'];
if((isset($_GET['del_id'])) && ($_GET['del_id'] != ""))
{
	$delete_id = $_GET['del_id'];
	$delete_query = mysqli_query($mysqli,"update tbl_productcat set status = 'inactive' WHERE productcat_id='".$delete_id."'");
	if($delete_query)
	{
		$data = "success";
		echo "<script>window.location.href='product_group.php'</script>";
	}
	else{
		$data = "error";
	}
}
?>
<!DOCTYPE html>
<html lang=en>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<title>My Product Group | Port-ME </title>
	<?php include("metalinks.php");?>
	<style>
		.dt-buttons a{
			border:1px solid #CCC;
			padding:3px 8px;
			margin:5px;
			color:#000;
			font-size:12px;
			border-radius:3px;
			float:right;
			margin-bottom:10px;
			background:#f6f6f6;
		}
		.dt-buttons a:hover{
			background:#fff;
		}
		div.dataTables_wrapper div.dataTables_filter{
			text-align:left !important;
			padding:5px;
		}
		div.dataTables_wrapper div.dataTables_filter input{
			width:300px !important;
		}
	</style>
</head>


<body>

	<!--[if lt IE 8]>
	<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
	<![endif]-->

	<div id="rs-wrapper">
		<?php 
			include("header.php");
			include("sidebar.php");
		?>


		<!-- BEGIN MAIN CONTENT -->
		<article class="rs-content-wrapper">
			<div class="rs-content">
				<div class="rs-inner">

					<!-- Begin Dashhead -->
					<div class="rs-dashhead m-b-lg" style="background:#f5f5f5">
						<div class="rs-dashhead-content">
							<div class="rs-dashhead-titles">
								<h3 class="rs-dashhead-title m-t">
									Product Group
									<!--<div style="float:right;">
										<span style="padding:10px 10px;font-size:15px;font-weight:normal;color:#4a89dc;cursor:pointer;border-right:1px solid #CCC;"> <i class="fa fa-lightbulb-o"></i> &nbsp;&nbsp;Page Tutorial</span>

										<span style="padding:10px 5px;font-size:25px;font-weight:normal;color:#000;cursor:pointer;" style="float:-right;"> <i class="fa fa-remove"></i> </span>
									</div>-->
								</h3>
								
							</div>
							<div class="rs-dashhead-toolbar">
								<button type="button" class="btn btn-success btn-wide rs-btn-icon block-on-mobile" onclick="window.location.href='add_productgroup.php'">
									<span class="gcon gcon-upload-to-cloud icon-btn"></span>
									Add New
								</button>
							</div><!-- /.rs-dashhead-toolbar -->
							
						</div><!-- /.rs-dashhead-content -->
						
					</div><!-- /.rs-dashhead -->
					<!-- End Dashhead -->

					<!-- Begin default content width -->
					<div class="container-fluid">
					<!--<?php
					   if(isset($data) && $data == "success"){
					  ?>
					  <div class="col-md-12 col-sm-12">
					   <p style="text-align:center;background:#5cb85c;border:1px solid #CCC;border-radius:5px;padding:5px;color:#fff;font-weight:bold;margin-left:15px;"> Your Product Group added successfully.</p>
					  </div>
					  <?php
					   }else if(isset($data) && $data == "error"){
					  ?>
					  <div class="col-md-12 col-sm-12">
					   <p style="text-align:center;background:#ff0066;border:1px solid #CCC;border-radius:5px;padding:5px;color:#fff;font-weight:bold;margin-left:15px;"> Something went wrong! Please try again later. </p>
					  </div>
					  <?php
					  }
					 ?>-->

						<!-- Begin Panel -->
						<div class="panel panel-plain panel-rounded table-responsive">
								<table class="table table-b-t table-b-b datatable-default rs-table table-default" style="border-right:1px solid #f5f5f5;border-left:1px solid #f5f5f5;">
									<thead>
							            <tr>
							                <th>Inventry Type</th>
							                <th>Group Name</th>
							                <th>Description</th>
							                <th>HSN Code</th>
							                <th>UQC Diamension</th>
											<th>Action</th>
							            </tr>
							        </thead>
							        <tbody>
									<?php
									$select_query = mysqli_query($mysqli,"select * from tbl_productcat where business_id = '$business_id' and status = 'active'");
									while($fetch_query = mysqli_fetch_array($select_query))
									{
										$description = substr($fetch_query['description'],0,70);
									?>
							            <tr>
							                <td><?php echo ucfirst($fetch_query['type']);?></td>
							                <td><?php echo ucfirst($fetch_query['category_name']);?></td>
							                <td><?php echo $description;?><?php echo((strlen($fetch_query['description']) > 70)?'...':'');?></td>
							                <td><?php echo $fetch_query['HSN_code'];?></td>
							                <td><?php echo $fetch_query['UQC_dmension'];?></td>
											<td>
												<a href="view_product_group.php?view_id=<?php echo $fetch_query['productcat_id'];?>"> <i class="fa fa-eye"></i></a>
												<a href="edit_product_group.php?edit_id=<?php echo $fetch_query['productcat_id'];?>" class="fa fa-pencil" style="height:10px;margin:5px;"></a>
												<a href="?del_id=<?php echo $fetch_query['productcat_id'];?>" class="fa fa-trash" style="height:10px;margin:5px;"></a>
											</td>
							            </tr>
									<?php
									}
									?>
							           
							        </tbody>
								</table>
						</div><!-- /.panel -->
						<!-- End Panel -->

					</div><!-- /.container-fluid -->

				</div><!-- /.rs-inner -->
			</div><!-- /.rs-content -->
		</article><!-- /.rs-content-wrapper -->
		<!-- END MAIN CONTENT -->

	<?php include("footer.php");?>
	<!-- Page Plugins -->
	<script src="js/datatables.min.js"></script>
	<!--<script src="js/datatables-example.js"></script>-->
	

	
	<script src="https://cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.flash.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
	<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
	<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.print.min.js"></script>

	<script>
		$(document).ready(function() {
			$('.datatable-default').DataTable( {
				dom: 'Bfrtip',
				columnDefs: [{ 
					  "targets": -1
				}],
				buttons: [
					'copy', 'csv', 'excel', 'pdf', 'print'
				]
			} );
		} );
	</script>

</body>
</html>