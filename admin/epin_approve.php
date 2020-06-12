<?php
include("AMframe/config.php");
include("includes/header.php");

if((!isset($_SESSION['admin_id'])) && ($_SESSION['admin_id']==""))
{
header("location:index.php");
echo "<script>window.location='index.php';</script>";
}

$menu6='class="active"';

if(isset($_REQUEST['act']))
{
$id=addslashes($_REQUEST['act']);
$act=$db->insertrec("update mlm_userpin set status ='1' where id ='$id'");

if($act)
{
header("location:epin_approve.php?actsucc");
echo "<script>window.location='epin_approve.php?actsucc';</script>";
}
}
if(isset($_REQUEST['inact']))
{
$id=addslashes($_REQUEST['inact']);
$act=$db->insertrec("update mlm_userpin set status ='0' where id ='$id'");

if($act)
{
header("location:epin_approve.php?inactsucc");
echo "<script>window.location='epin_approve.php?inactsucc';</script>";
}
}

?>
  		<script>
	function muldel()
	{
	//alert("df");
	var chks = document.getElementsByName('chkval[]');
    var hasChecked = false;
    for (var i = 0; i < chks.length; i++) {
        if (chks[i].checked) {
            hasChecked = true;
            break;
        }
    }
    if (hasChecked == false) {
        alert("Please select at least one.");
        return false;
    }
    return true;
	
	}
	
	</script>
		<div class="main-container container-fluid">
			<a class="menu-toggler" id="menu-toggler" href="#">
				<span class="menu-text"></span>
			</a>

			<?php include("includes/sidebar.php"); ?>

			<div class="main-content">
				<div class="breadcrumbs" id="breadcrumbs">
					<ul class="breadcrumb">
						<li>
							<i class="icon-home home-icon"></i>
							<a href="dashboard.php">Home</a>

							<span class="divider">
								<i class="icon-angle-right arrow-icon"></i>
							</span>
						</li>
					</ul><!--.breadcrumb-->

					
				</div>

				<div class="page-content">
					<!--/.page-header-->

					<div class="row-fluid">
						<div class="span12">
							<!--PAGE CONTENT BEGINS-->

							<!--/row-->
							<?php 
						   
						   if(isset($_REQUEST['success']))
						   {
						  ?> 
						  
						   <div class="alert alert-block alert-success">
								<button type="button" class="close" data-dismiss="alert">
									<i class="icon-remove"></i>
								</button>

							 <i class="icon-ok green"></i>
								<strong class="green">
									User Added Successfully !!!
								</strong>
						
							</div>
						   
						   <?php }
							if(isset($_REQUEST['suss']))
						   {
						  ?> 
						  
						   <div class="alert alert-block alert-success">
								<button type="button" class="close" data-dismiss="alert">
									<i class="icon-remove"></i>
								</button>

							 <i class="icon-ok green"></i>
								<strong class="green">
									Stock Added Successfully !!!
								</strong>
						
							</div>
						   
						   <?php }			   
						   if(isset($_REQUEST['upsucc']))
						   {
						  ?> 
						  
						   <div class="alert alert-block alert-success">
								<button type="button" class="close" data-dismiss="alert">
									<i class="icon-remove"></i>
								</button>

							 <i class="icon-ok green"></i>
								<strong class="green">
									User Updated Successfully !!!
								</strong>
						
							</div>
						   
						   <?php }					   
						   if(isset($_REQUEST['del']))
						   {
						  ?> 
						  
						   <div class="alert alert-block alert-error">
								<button type="button" class="close" data-dismiss="alert">
									<i class="icon-remove"></i>
								</button>

							 <i class="icon-trash red"></i>
								<strong class="red">
									User Deleted Successfully !!!
								</strong>
						
							</div>
						   
						   <?php }					   
						   if(isset($_REQUEST['actsucc']))
						   {
						  ?> 
						  
						<div class="alert alert-block alert-success">
								<button type="button" class="close" data-dismiss="alert">
									<i class="icon-remove"></i>
								</button>

							 <i class="icon-ok green"></i>
								<strong class="green">
									Epin Activated Successfully !!!
								</strong>
						
							</div>
						   
						   <?php }						   
						   if(isset($_REQUEST['inactsucc']))
						   {
						  ?> 
						  
						   <div class="alert alert-block alert-error">
								<button type="button" class="close" data-dismiss="alert">
									<i class="icon-remove"></i>
								</button>

							 <i class="icon-off red"></i>
								<strong class="red">
									Epin Deactivated Successfully !!!
								</strong>
						
							</div>
						   
						   <?php }					   
						   if(isset($_REQUEST['sus']))
						   {
						  ?> 
						  
						  	<div class="alert alert-block alert-success">
								<button type="button" class="close" data-dismiss="alert">
									<i class="icon-remove"></i>
								</button>

							 <i class="icon-ok green"></i>
								<strong class="green">
									Pay status activated successfully
								</strong>
						
							</div>
						   
						   <?php }
						   
						   ?>
						   
                           <form action="" method="post">
							<div class="row-fluid">
								
								<div class="table-header">
								Purchased Epin List
								</div>
 
								<table class="table table-striped table-bordered table-hover" id="sample-table-2">
									<thead>
										<tr>
											<th width="48">Sl.No</th>
											<th width="111">Epin</th>
											<th width="131">Profile Id</th>
											<th width="80">Membership Package</th>
											<th width="86" >Payment Mode</th>
											<th width="64" >Payslip Image</th>
											<th width="111" class="hidden-480">Action</th>
										</tr>
									</thead>

									<tbody>
									
									<?php
									$i=1;
									$euser=$db->get_all("select * from mlm_userpin order by id desc");
									foreach($euser as $user) {
									
									$memname=$db->singlerec("select * from mlm_membership where id ='$user[memberpack]'");
									?>
										<tr>
											<?php
											if(file_exists("../uploads/epinslip/".$user['payslip_image']) && $user['payslip_image']!='')
											{
												
												$payslip_image="../uploads/epinslip/".$user['payslip_image'];
											}
											else
											{
												$payslip_image="images/nouser.png";
											}
											
											//echo $payslip_image;exit;
											?>
											<td><?php echo $i; ?></td>
											<td><?php echo $user['epin']; ?></td>
											<td><?php echo $user['user_id']; ?></td>
									        <td><?php echo $memname['membership_name']; ?></td>
											<td><?php echo $user['pay_type'] ?></td>
											<td>
											<a href='#myModal' data-toggle='modal' data-target='#myModal' data-c=<? echo$payslip_image; ?> class='openModal'><img src="<?php echo $payslip_image; ?>" width="50" height="50"/></a>
											</td>
											<td class="td-actions" align="center">
												<div class="hidden-phone visible-desktop action-buttons">
													<?php if($user['status']=='1') { ?>
													
													<a class="green" href="epin_approve.php?inact=<?php echo $user['id'];?>" onclick="if(confirm('Are you sure to disapprove this epin')) { return true; } else { return false; }">
														<i class="icon-certificate bigger-130" title="click to disapprove"></i>
													</a>
													
													<?php } if($user['status']=='0') { ?>
												
												<a class="red" href="epin_approve.php?act=<?php echo $user['id']; ?>&profile=<? echo $user['user_id']?>" onclick="if(confirm('Are you sure to approve this epin')) { return true; } else { return false; }">
														<i class="icon-certificate bigger-130" title="click to approve"></i>
												  </a>
												  
												  <?php } ?>
												  
													<!--<a class="grey" href="epin_approve.php?delete=<?php echo $user['id'];?>" onclick="if(confirm('Are you sure to delete this record')) { return true; } else { return false; }">
														<i class="icon-trash bigger-130" title="click to delete"></i>
												  </a>-->
			                                    </div>
											   </td>
										     </tr>

									<?php $i++; }?>
												
								  </tbody>
							  </table>
						  </div>
								</div>
								
							<div class="modal-footer">
							
								</form>

								</div>

							</div><!--PAGE CONTENT ENDS-->
						</div><!--/.span-->
					</div><!--/.row-fluid-->
				</div><!--/.page-content-->

				<div class="ace-settings-container" id="ace-settings-container">
					<div class="btn btn-app btn-mini btn-warning ace-settings-btn" id="ace-settings-btn">
						<i class="icon-cog bigger-150"></i>
					</div>

					<div class="ace-settings-box" id="ace-settings-box">
						<div>
							<div class="pull-left">
								<select id="skin-colorpicker" class="hide">
									<option data-class="default" value="#438EB9" />#438EB9
									<option data-class="skin-1" value="#222A2D" />#222A2D
									<option data-class="skin-2" value="#C6487E" />#C6487E
									<option data-class="skin-3" value="#D0D0D0" />#D0D0D0
								</select>
							</div>
							<span>&nbsp; Choose Skin</span>
						</div>

						<div>
							<input type="checkbox" class="ace-checkbox-2" id="ace-settings-header" />
							<label class="lbl" for="ace-settings-header"> Fixed Header</label>
						</div>

						<div>
							<input type="checkbox" class="ace-checkbox-2" id="ace-settings-sidebar" />
							<label class="lbl" for="ace-settings-sidebar"> Fixed Sidebar</label>
						</div>

						<div>
							<input type="checkbox" class="ace-checkbox-2" id="ace-settings-breadcrumbs" />
							<label class="lbl" for="ace-settings-breadcrumbs"> Fixed Breadcrumbs</label>
						</div>

						<div>
							<input type="checkbox" class="ace-checkbox-2" id="ace-settings-rtl" />
							<label class="lbl" for="ace-settings-rtl"> Right To Left (rtl)</label>
						</div>
					</div>
				</div><!--/#ace-settings-container-->
			</div><!--/.main-content-->
		</div><!--/.main-container-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Payslip Image</h4>
      </div>

      <div class="modal-body">	  	  	
		<img id="image" src="">
      </div>
	  
      <div class="modal-footer">
       <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>   
      </div>

    </div>
  </div>
</div> 

		<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-small btn-inverse">
			<i class="icon-double-angle-up icon-only bigger-110"></i>
		</a>

		<!--basic scripts-->

		<!--[if !IE]>-->

		<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
 	
		<!--<![endif]-->

		<!--[if !IE]>-->

		<script type="text/javascript">
			window.jQuery || document.write("<script src='assets/js/jquery-2.0.3.min.js'>"+"<"+"/script>");
		</script>

		<!--<![endif]-->

		<script type="text/javascript">
			if("ontouchend" in document) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="assets/js/bootstrap.min.js"></script>

		<!--page specific plugin scripts-->

		<script src="assets/js/jquery.dataTables.min.js"></script>
		<script src="assets/js/jquery.dataTables.bootstrap.js"></script>

		<!--ace scripts-->

		<script src="assets/js/ace-elements.min.js"></script>
		<script src="assets/js/ace.min.js"></script>

		<!--inline scripts related to this page-->
<script language="javascript">
$(document).ready(function () {             
    $('.openModal').click(function(){	
        var imgSrc = $(this).data('c');
     $("#image").attr('src',imgSrc);
         
    });
});
</script>
		<script type="text/javascript">
			$(function() {
				var oTable1 = $('#sample-table-2').dataTable( {
				"aoColumns": [
			      { "bSortable": false },
			      null, null, null, null,null,
				  { "bSortable": false }
				] } );
				
				
				$('table th input:checkbox').on('click' , function(){
					var that = this;
					$(this).closest('table').find('tr > td:first-child input:checkbox')
					.each(function(){
						this.checked = that.checked;
						$(this).closest('tr').toggleClass('selected');
					});
						
				});
			
			
				$('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
				function tooltip_placement(context, source) {
					var $source = $(source);
					var $parent = $source.closest('table')
					var off1 = $parent.offset();
					var w1 = $parent.width();
			
					var off2 = $source.offset();
					var w2 = $source.width();
			
					if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
					return 'left';
				}
			})
		</script>
		
	</body>
</html>
