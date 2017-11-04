  <?php echo $header; ?><?php echo $column_left; ?>
  <div id="content">
    
	<div class="page-header">
    <div class="container-fluid">
      <h1><?php echo $heading_title; ?></h1>
	  <h4><?php echo $customers['customer_name']; ?></h4>
      </div>
  </div>


			<div class="container-fluid" >
	         <div class="table-condensed">
          <table class="table table-bordered table-hover"  <?php //style="width: 100%; max-width: 600px; display: block; font-size:10px;"?> >
            <thead>
              <tr>
                <td class="text-left"><?php echo $cdetails_head; ?></td>
				<td class="text-center"><?php echo $cdetails_customer_id; ?></td>
				<td class="text-center"><?php echo $cdetails_customer_name; ?></td>
				<td class="text-center"><?php echo $cdetails_group; ?></td>
				<td class="text-center"><?php echo $cdetails_phone; ?></td>
				<td class="text-center"><?php echo $cdetails_email; ?></td>
				<td class="text-center"><?php echo $cdetails_date_added; ?></td>
				<td class="text-center"><?php echo $cdetails_credits; ?></td>
				<td class="text-center"><?php echo $cdetails_points; ?></td>
              </tr>
            </thead>
            <tbody>

			  <tr>
				<td class="text-left"><a href="<?php echo $customers['edit']; ?>" data-toggle="tooltip" title="<?php echo $button_edit; ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a></td>
				<td class="text-center"><?php echo $customers['customer_id']; ?></td>
				<td class="text-center"><?php echo $customers['customer_name']; ?></td>
				<td class="text-center"><?php echo $customers['customer_group']; ?></td>
				<td class="text-center"><?php echo $customers['telephone']; ?></td>
				<td class="text-center"><?php echo $customers['email']; ?></td>
				<td class="text-center"><?php echo $customers['date_added']; ?></td>
				<td class="text-center"><?php echo $customers['credit']; ?></td>
				<td class="text-center"><?php echo $customers['points']; ?></td>
			  </tr>

            </tbody>
          </table>
        </div>
		</div>
			
		  
			<div class="container-fluid" >
	<div id="widnow2">
    <div id="title_bar2">
			<div class="panel panel-default">
				<div id="button2" style="font-size:10px;" class="panel-heading"><h3><?php echo $orders_summary. ' '; ?><i class="fa fa-caret-right"></i></h3></div>
			</div>
		 <div class="table-condensed">
          <table class="table table-bordered table-hover">
            <thead>
				<tr>
				<th class="text-left"><?php echo $orders_status; ?></th>
				<td class="text-center"><?php echo $orders_number; ?></td>
				<td class="text-center"><?php echo $orders_products; ?></td>
				<td class="text-center"><?php echo $orders_value; ?></td>
				</tr>
			</thead>	
            <tbody>
			<?php if (isset($ordertotals)) { ?>
			<?php foreach ($ordertotals as $ototal) { ?>
			<tr>
				<th class="text-left"><?php echo $ototal['order_status']; ?></th>
				<td class="text-center"><?php echo $ototal['orders'] ?></td>
				<td class="text-center"><?php echo $ototal['products'] ?></td>
				<td class="text-center"><?php echo $ototal['totals'] ?></td>
			</tr>
				<?php } ?>
			<?php } else { ?>
			<tr>
				<td class="text-center" colspan="4"><?php echo $text_no_results; ?></td>
			</tr>
			<?php } ?>
            </tbody>
          </table>
			</div>
		</div>
    <div id="box2">
		
		<?php echo $orders; ?>
    </div>
	</div>
			</div>

	<div class="container-fluid" >
	<?php //// test ?>
	<div id="widnow">
    <div id="title_bar">
			<div class="panel panel-default">
				<div id="button" style="font-size:10px;" class="panel-heading"><h3><i class="fa fa-calendar"></i> <?php echo $activities_header. ' '; ?><i class="fa fa-caret-right"></i></h3></div>
			</div>
			 <div class="table-condensed">
				<table class="table table-bordered table-hover" <?php //style="width: 100%; max-width: 200px; display: block; font-size:10px;" ?> >
					<thead>
						<tr>
							<td class="text-center"><?php echo $activities_logins; ?></td>
							<td class="text-center"><?php echo $activities_number; ?></td>
							<td class="text-center"><?php echo $activities_updates; ?></td>
						</tr>
					</thead>
					<tbody>				
						<tr>
							<th class="text-center"><?php echo $activities_count['logins']; ?></th>
							<td class="text-center"><?php echo $activities_count['orders'] ?></td>
							<td class="text-center"><?php echo $activities_count['updates'] ?></td>
						</tr>
					</tbody>
				</table>
			</div>
				
        
		</div>
    <div id="box">
		
		<?php echo $activity; ?>
    </div>
	</div>
		
	</div>
	
	
				<div class="container-fluid" >
	<div id="widnow3">
    <div id="title_bar3" class="panel-heading">
	
				<div class="panel panel-default">
					<div id="button3" style="font-size:10px;" class="panel-heading"><h3> <i class="fa fa-coffee"></i> <?php echo $leads_header. ' '; ?><i class="fa fa-caret-right"></i></h3></div>
				</div>
		</div>
    <div id="box3">
		
		<?php echo $sales; ?>
    </div>
	</div>
			</div>
	
  
  				<div class="container-fluid" >
	<div id="widnow4">
    <div id="title_bar4" class="panel-heading">
	
			<div class="panel panel-default">
					<div id="button4" style="font-size:10px;" class="panel-heading"><h3> <i class="fa fa-coffee"></i> <?php echo $services_header. ' '; ?><i class="fa fa-caret-right"></i></h3></div>
				</div>
		</div>
    <div id="box4">
		
		<?php echo $services; ?>
    </div>
	</div>
			</div>

  				<div class="container-fluid" >
	<div id="widnow5">
    <div id="title_bar5" class="panel-heading">
	
			<div class="panel panel-default">
					<div id="button5" style="font-size:10px;" class="panel-heading"><h3><?php echo $returns_header. ' '; ?><i class="fa fa-caret-right"></i></h3></div>
				</div>
		</div>
    <div id="box5">
		
		<?php echo $returns; ?>
    </div>
	</div>
			</div>


<script type="text/javascript"><!--
$("#button").click(function(){
    if($(this).html() == "<h3><i class=\"fa fa-calendar\"></i> <?php echo $activities_header. ' '; ?><i class=\"fa fa-caret-right\"></i></h3>"){
        $(this).html("<h3><i class=\"fa fa-calendar\"></i> <?php echo $activities_header. ' '; ?><i class=\"fa fa-caret-down\"></i></h3>");
    }
    else{
        $(this).html("<h3><i class=\"fa fa-calendar\"></i> <?php echo $activities_header. ' '; ?><i class=\"fa fa-caret-right\"></i></h3>");
    }
    $("#box").slideToggle();
});

//--></script>

<script type="text/javascript"><!--

$("#button2").click(function(){

	    if($(this).html() == "<h3><?php echo $orders_summary. ' '; ?><i class=\"fa fa-caret-right\"></i></h3>"){
        $(this).html("<h3><?php echo $orders_summary. ' '; ?><i class=\"fa fa-caret-down\"></i></h3>");
    }
    else{
        $(this).html("<h3><?php echo $orders_summary. ' '; ?><i class=\"fa fa-caret-right\"></i></h3>");
    }
    $("#box2").slideToggle();
	
});

//--></script>

<script type="text/javascript"><!--

$("#button3").click(function(){

	    if($(this).html() == "<h3> <i class=\"fa fa-coffee\"></i> <?php echo $leads_header. ' '; ?><i class=\"fa fa-caret-right\"></i></h3>"){
        $(this).html("<h3> <i class=\"fa fa-coffee\"></i> <?php echo $leads_header. ' '; ?><i class=\"fa fa-caret-down\"></i></h3>");
    }
    else{
        $(this).html("<h3> <i class=\"fa fa-coffee\"></i> <?php echo $leads_header. ' '; ?><i class=\"fa fa-caret-right\"></i></h3>");
    }
    $("#box3").slideToggle();
	
});

//--></script>

<script type="text/javascript"><!--

$("#button4").click(function(){

	    if($(this).html() == "<h3> <i class=\"fa fa-coffee\"></i> <?php echo $services_header. ' '; ?><i class=\"fa fa-caret-right\"></i></h3>"){
        $(this).html("<h3> <i class=\"fa fa-coffee\"></i> <?php echo $services_header. ' '; ?><i class=\"fa fa-caret-down\"></i></h3>");
    }
    else{
        $(this).html("<h3> <i class=\"fa fa-coffee\"></i> <?php echo $services_header. ' '; ?><i class=\"fa fa-caret-right\"></i></h3>");
    }
    $("#box4").slideToggle();
	
});

//--></script>

<script type="text/javascript"><!--

$("#button5").click(function(){

	    if($(this).html() == "<h3><?php echo $returns_header. ' '; ?><i class=\"fa fa-caret-right\"></i></h3>"){
        $(this).html("<h3><?php echo $returns_header. ' '; ?><i class=\"fa fa-caret-down\"></i></h3>");
    }
    else{
        $(this).html("<h3><?php echo $returns_header. ' '; ?><i class=\"fa fa-caret-right\"></i></h3>");
    }
    $("#box5").slideToggle();
	
});

//--></script>

<script type="text/javascript"><!--

	window.onload = function() {
		$("#box").slideToggle();
		$("#box2").slideToggle();
		$("#box3").slideToggle();
		$("#box4").slideToggle();
		$("#box5").slideToggle();
	}

//--></script>