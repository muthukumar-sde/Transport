<?php 
include('include/header.php');
?>

<style type="text/css">
div#partyerror span.ValidationErrors {
	position:relative !important;
	left:15px !important;
	margin-bottom: -13px !important;
}
span.ErrorField {
    color: rgba(118, 118, 118, 1.0) !important;
}
</style>
        <!-- START CONTAINER -->
        <div class="page-container row-fluid">

            <?php include('include/sidebar.php');?>
            <!-- START CONTENT -->
            <section id="main-content" class=" ">
                <section class="wrapper main-wrapper" style=''>

                    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                        <div class="page-title">

                            <div class="pull-left">
                                <h1 class="title">Edit Daily Movement Details</h1>                            </div>


                        </div>
                    </div>
                    <div class="clearfix"></div>


                    <div class="col-lg-12">
                        <section class="box nobox">
                            <div class="content-body">
 
    <div class="row">
       
       <!-- edit form column -->
       <div class="col-md-12 col-sm-12 col-lg-12 personal-info">
       <?php if($this->session->flashdata('success_msg')!=null){ ?>
        <div class="alert alert-success alert-dismissable">
          <a class="panel-close close" data-dismiss="alert">×</a> 
          <i class="fa fa-check-square"></i>
          <?php echo $this->session->flashdata('success_msg'); ?>
        </div>  
        <?php } ?>    
        
        <!-- <form class="form-horizontal" role="form"> -->
        <?php echo form_open_multipart('daily_movement/validate_edit_daily_movement_details', array('class'=>'form-horizontal','name'=>'daily_movement')); 
        foreach ($read_daily_movement_details->result() as $row) {
          # code...
        }
        ?>
          <span style="color:red; "><?php echo validation_errors(); ?></span>          
           <div class="form-group">
            <label class="col-lg-2 control-label">Date:</label>
            <div class="col-lg-3">              
              <?php  
                $data1 = array(
                        'name'        => 'daily_movement_date',
                        'id'          => 'daily_movement_date',
                        'value'       => date("d M Y", strtotime($row->Daily_mvnt_dtl_date)),
                        'maxlength'   => '20',
                        'class'       => 'form-control datepicker',
                        'data-format' => 'dd MM yyyy',
                        'placeholder' => 'Select a Date',
						'readonly'    => 'readonly'
                      ); 
                echo form_input($data1);?>
            </div>
            <input type="hidden" id="id" name="id" value="<?php echo $row->Daily_mvnt_dtl_id; ?>">
             <label class="col-lg-2 control-label">Vehicle Number:</label>
            <div class="col-lg-3">              
             <span id="transport_vehicle_type" class="" >  
             <?php
			 if($row->Daily_mvnt_dtl_transport_type=="T"){  $checked="checked"; } else{  $checked="";  } 
			 $data = array(
			 'name' => 'transport_type',
			 'id'   => 'thirumala_transport',
			 'value'=> 'T',
			 'checked' => $checked,
			 'onclick' => 'check_vehicle_type()'
			 );
			 echo form_radio($data);
			  ?>
              <strong>Thirumala</strong>
              <?php
			  if($row->Daily_mvnt_dtl_transport_type=="O"){ $checked="checked"; } else{ $checked="";  }  
			  $data = array(
			  'name' => 'transport_type',
			  'id'   => 'other_transport',
			  'value'=> 'O',
			  'checked' => $checked,
			  'onclick' => 'check_vehicle_type()'
			  );
			  echo form_radio($data);
			  ?>
              <strong>Other</strong>
               </span>

            </div>
          </div>
          <div class="form-group">
           <label class="col-lg-2 control-label">Vehicle Number:</label>
            <div class="col-lg-3">  
              <?php 
			 foreach($vehicle_number_list->result() as $Vehicle) {
				$option_thiru[''] = "Select Thirumala Vehicle";
			 	$option_thiru[$Vehicle->Vehicle_dtl_id] = $Vehicle->Vehicle_dtl_number;
			 }
			 echo form_dropdown('vehicle_no', $option_thiru, $row->Daily_mvnt_dtl_vehicle_no, 'class="form-control" id="vehicle_no"')
			 ?>
            </div>
            <label class="col-lg-2 control-label">Other Vehicle:</label>
            <div class="col-lg-3"> 
             <?php 
			 foreach($vehicle_other_list->result() as $Vehicle) {
				$option_thiru[''] = "Select Other Vehicle";
			 	$option_other[$Vehicle->Vehicle_dtl_id] = $Vehicle->Vehicle_dtl_number;
			 }
			 echo form_dropdown('other_vehicle', $option_other, $row->Daily_mvnt_dtl_vehicle_no, 'class="form-control" id="other_vehicle"')
			 ?>
             
            </div>
          </div>
          <div class="form-group">
           <label class="col-lg-2 control-label">Party Name:</label>
            <div class="col-lg-3">              
              <?php                
                $options_party_nme['']='Select Party Name';
                foreach($party_name_list->result() as $party_nme)
                {                  
                  $options_party_nme[$party_nme->Party_dtl_id] = $party_nme->Party_dtl_name;                   
                } 
                echo form_dropdown('party_name', $options_party_nme, $row->Daily_mvnt_dtl_party_name, 'class="form-control" id="party_name"');
              ?> 
            </div>
            <label class="col-lg-2 control-label">Container Type:</label>
            <div class="col-lg-3">             
             <span id="container_type" class="" >              
             <?php
			  if($row->Daily_mvnt_dtl_container_type=="BC"){  $checked="checked"; } else{  $checked="";  } 
			 $data = array(
			 'name' => 'container_type',
			 'id'   => 'billing_container',
			 'value'=> 'BC',
			 'checked' => $checked,
			 'onclick' => 'check_container_type()'
			 );
			 echo form_radio($data);
			  ?>
              <strong>Billing Container</strong>
              <?php
			   if($row->Daily_mvnt_dtl_container_type=="NC"){  $checked="checked"; } else{  $checked="";  } 
			  $data = array(
			  'name' => 'container_type',
			  'id'   => 'new_container',
			  'value'=> 'NC',
			  'checked' => $checked,
			  'onclick' => 'check_container_type()'
			  );
			  echo form_radio($data);
			  ?>
              <strong>New Container</strong>
               </span>
            </div>
            
          </div>
          <div class="form-group">
           <label class="col-lg-2 control-label">Container Number:</label>
            <div class="col-lg-3">             
             <?php                
                $options_container['']='Select Container No';
                foreach($party_name_list->result() as $container)
                {                  
                                    
                } 
                echo form_dropdown('container_no', $options_container, $row->Daily_mvnt_dtl_container_no, 'class="form-control" id="container_no"');
              ?> 
            </div>
            <label class="col-lg-2 control-label">Container Number:</label>
            <div class="col-lg-3">             
             <?php
			 $data = array(               
               'name'        => 'new_con_no',
			   'id'          => 'new_con_no',
			   'value'       => $row->Daily_mvnt_dtl_new_container_no,
			   'class'       => 'form-control',
			   'placeholder' =>'Enter Container Number'
			   );
			   echo form_input($data);
              ?> 
            </div>
            
          </div>
          <div class="form-group">
            <label class="col-lg-2 control-label">Pick up:</label>
            <div class="col-lg-3">              
              <?php 
                  $data2 = array(
                        'name'        => 'pick_up',
                        'id'          => 'pick_up',
                        'value'       => $row->Daily_mvnt_dtl_pickup_place,
                        'maxlength'   => '150',
                        'class'       => 'form-control',
						'placeholder' => 'Enter Pick up'
                      ); 
                  echo form_input($data2);
              ?>
            </div>
             <label class="col-lg-2 control-label">Drop:</label>
            <div class="col-lg-3">              
              <?php 
                  $data2 = array(
                        'name'        => 'drop',
                        'id'          => 'drop',
                        'value'       => $row->Daily_mvnt_dtl_drop_place,
                        'maxlength'   => '150',
                        'class'       => 'form-control',
						'placeholder' => 'Enter Drop'
                      ); 
                  echo form_input($data2);
              ?>
            </div>
          </div>          
          <div class="form-group">
           <label class="col-lg-2 control-label">Place Name:</label>
            <div class="col-lg-3">              
              <?php                
                $options_place['']='Select Place Name';
                foreach($place_name_list->result() as $place)
                {                  
                  $options_place[$place->Driver_pay_rate_id] = $place->Driver_pay_rate_place_name;                   
                } 
                echo form_dropdown('place_name', $options_place, $row->Daily_mvnt_dtl_place, 'class="form-control" id="place_name"');
              ?> 
            </div>
           
             <label class="col-lg-2 control-label">Party Advance(Rs):</label>
            <div class="col-lg-3">              
              <?php 
                  $data2 = array(
                        'name'        => 'party_advance',
                        'id'          => 'party_advance',
                        'value'       => $row->Daily_mvnt_dtl_party_adv,
                        'maxlength'   => '50',
                        'class'       => 'form-control',
                        'onkeyup'     => 'checkInt(this)',
						'placeholder' => 'Enter Party Advance'
                      ); 
                  echo form_input($data2);
              ?>
            </div>
          </div> 
         
          <div class="form-group">
            <label class="col-lg-2 control-label">Driver Name:</label>
            <div class="col-lg-3">              
              <?php                
                $options_driver_nme['']='Select Driver Name';
                foreach($driver_list->result() as $driver_nme)
                {                  
                  $options_driver_nme[$driver_nme->Driver_dtl_id] = $driver_nme->Driver_dtl_name;                   
                } 
                echo form_dropdown('driver_name', $options_driver_nme, $row->Daily_mvnt_dtl_driver_name, 'class="form-control" id="driver_name"');
              ?> 
            </div>
             <label class="col-lg-2 control-label">Driver Advance(Rs):</label>
            <div class="col-lg-3">              
              <?php 
                  $data2 = array(
                        'name'        => 'driver_advance',
                        'id'          => 'driver_advance',
                        'value'       => $row->Daily_mvnt_dtl_advance,
                        'maxlength'   => '10',
                        'class'       => 'form-control',
                        'onkeyup'     => 'checkInt(this)',
						'placeholder' => 'Enter Driver Advance'
                      ); 
                  echo form_input($data2);
              ?>
            </div>
          </div>
          <div class="form-group">
          
            <label class="col-lg-2 control-label">Party Mamul:</label>

            <div class="col-lg-3"> 
               <?php 
                  $data2 = array(
                        'name'        => 'party_mamul',
                        'id'          => 'party_mamul',
                        'value'       => $row->Daily_mvnt_dtl_party_mamul,
                        'maxlength'   => '10',
                        'class'       => 'form-control',
                        'onkeyup'     => 'checkInt(this)',
						'placeholder' => 'Enter Party Mamul'
                      ); 
                  echo form_input($data2);
              ?>
            </div>
            
            <label class="col-lg-2 control-label">Party Rent:</label>
            <div class="col-lg-3">              
              <?php 
                  $data2 = array(
                        'name'        => 'rent',
                        'id'          => 'rent',
                        'value'       => $row->Daily_mvnt_dtl_rent,
                        'maxlength'   => '10',
                        'class'       => 'form-control',
                        'onkeyup'     => 'checkInt(this)',
						'placeholder' => 'Enter Party rent'
                      ); 
                  echo form_input($data2);
              ?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-2 control-label">Transport Name:</label>
            <div class="col-lg-3">              
              <?php                
                $options_transport_nme['']='Select Transport Name';
                foreach($transport_name_list->result() as $transport_nme)
                {                  
                  $options_transport_nme[$transport_nme->Transport_dtl_id] = $transport_nme->Transport_dtl_name;                   
                } 
                echo form_dropdown('transport_name', $options_transport_nme, $row->Daily_mvnt_dtl_trp_name, 'class="form-control" id="transport_name"');
              ?> 
            </div>
             <label class="col-lg-2 control-label">Transport Advance(Rs):</label>
            <div class="col-lg-3">              
              <?php 
                  $data2 = array(
                        'name'        => 'transport_advance',
                        'id'          => 'transport_advance',
                        'value'       => $row->Daily_mvnt_dtl_trp_adv,
                        'maxlength'   => '50',
                        'class'       => 'form-control',
                        'onkeyup'     => 'checkInt(this)',
						'placeholder' => 'Enter Transports Advance'
                      ); 
                  echo form_input($data2);
              ?>
            </div>
          </div>
          <div class="form-group">
          
            <label class="col-lg-2 control-label">Load Status:</label>
            <div class="col-lg-3">   
            <span id="loading_status" class="" style="width:100%;" >         
              
                <?php
				if($row->Daily_mvnt_dtl_loading_status=="L"){  $checked="checked"; } else{  $checked="";  }   
                $data6 = array(
                                'name'        => 'loading_status',
                                'id'          => 'loading_status_1',
                                'value'       => 'L',
								'checked'     => $checked
                              ); 
                echo form_radio($data6);
               ?> <strong>Loading</strong> &nbsp;&nbsp; 
               <?php 
			   if($row->Daily_mvnt_dtl_loading_status=="U"){ echo $checked="checked"; } else{ echo $checked="";  }    
                $data6 = array(
                                'name'        => 'loading_status',
                                'id'          => 'loading_status_2',
                                'value'       => 'U',
								'checked'     => $checked
                              ); 
                echo form_radio($data6);
               ?> <strong>Unloading</strong>
               </span>
            </div>
            
            <label class="col-lg-2 control-label">Transport Rent:</label>
            <div class="col-lg-3">              
              <?php 
                  $data2 = array(
                        'name'        => 'transport_rent',
                        'id'          => 'transport_rent',
                        'value'       => $row->Daily_mvnt_dtl_trp_rent,
                        'maxlength'   => '10',
                        'class'       => 'form-control',
                        'onkeyup'     => 'checkInt(this)',
						'placeholder' => 'Enter Transport rent'
                      ); 
                  echo form_input($data2);
              ?>
            </div>
          </div>
          <div class="form-group">
          <label class="col-lg-2 control-label">Diesel Rate:</label>
            <div class="col-lg-3">              
              <?php 
                  $data2 = array(
                        'name'        => 'diesel_rate',
                        'id'          => 'diesel_rate',
                        'value'       => $row->Daily_mvnt_dtl_diesel_rate,
                        'maxlength'   => '10',
                        'class'       => 'form-control',
                        'onkeyup'     => 'checkInt(this)'
                      ); 
                  echo form_input($data2);
              ?>
            </div>
            <label class="col-md-1 control-label"></label>
            <div class="col-md-3">              
              <?php echo form_submit('submit', 'Save', 'class="btn btn-primary" onclick="form_validation()"'); ?>
              <span></span>
              <input type="reset" class="btn btn-default" value="Cancel" onClick="javascript: document.location.href='daily_movement_details_list'" >
            </div>
          </div> 
      </form>
       
      </div>
  </div>
  <!-- End .row -->
  
  

                            </div>
                        </section></div>



                </section>
            </section>
            <!-- END CONTENT -->


                </div>
        <!-- END CONTAINER -->
        <!-- LOAD FILES AT PAGE END FOR FASTER LOADING -->
<script>
     $(document).ready(function(){
     $('#party_name').change(function(){
	 var party_name = $('#party_name').val();
	/* alert(party_name);*/
            $.ajax({
                type: "GET",
                url:"<?php echo base_url(); ?>/index.php/party_billing/check_container",
                data:{"party_name": party_name},
                success: function(data)
                {
					//document.getElementById('container_no').value=data;
					jQuery("#container_no").html(data);
					/*alert(data);*/
                }
            });
        });
    });       
</script>

 <script type="text/JavaScript">  
/*function validate() 
{
if( document.daily_movement.vehicle_no.value == "" )
   {
     alert( "Please select Vehicle Number!" );
     return false;
   }
}
*/
</script>
 <script type="text/JavaScript">  
function check_vehicle_type() 
{
   if(document.getElementById('thirumala_transport').checked)
   {
		 document.getElementById('other_vehicle').disabled=true;
		 document.getElementById('transport_name').disabled=true;
		 document.getElementById('transport_advance').disabled=true;
     document.getElementById('transport_rent').disabled=true;
		 document.getElementById('vehicle_no').disabled=false;
		 document.getElementById('driver_name').disabled=false;
	     document.getElementById('driver_advance').disabled=false;
   }
   else if(document.getElementById('other_transport').checked){
	    
	   document.getElementById('driver_name').disabled=true;
	   document.getElementById('driver_advance').disabled=true;
	   document.getElementById('vehicle_no').disabled=true;
	   document.getElementById('other_vehicle').disabled=false;
	   document.getElementById('transport_name').disabled=false;
		 document.getElementById('transport_advance').disabled=false;
     document.getElementById('transport_rent').disabled=false;
   }
   
}
if(document.getElementById('thirumala_transport').checked)
   {
		 document.getElementById('other_vehicle').disabled=true;
		 document.getElementById('transport_name').disabled=true;
		 document.getElementById('transport_advance').disabled=true;
     document.getElementById('transport_rent').disabled=true;
		 document.getElementById('vehicle_no').disabled=false;
		 document.getElementById('driver_name').disabled=false;
	     document.getElementById('driver_advance').disabled=false;
   }
   else if(document.getElementById('other_transport').checked){
	    
	   document.getElementById('driver_name').disabled=true;
	   document.getElementById('driver_advance').disabled=true;
	   document.getElementById('vehicle_no').disabled=true;
	   document.getElementById('other_vehicle').disabled=false;
	   document.getElementById('transport_name').disabled=false;
	   document.getElementById('transport_advance').disabled=false;
     document.getElementById('transport_rent').disabled=false;
   }
function check_container_type(){
	
	if(document.getElementById("billing_container").checked){
		
		document.getElementById("container_no").disabled=false;
		document.getElementById("new_con_no").disabled=true;
	}
	else if(document.getElementById("new_container").checked){
		
		document.getElementById("container_no").disabled=true;
		document.getElementById("new_con_no").disabled=false;
	}
}
if(document.getElementById("billing_container").checked){
		
		document.getElementById("container_no").disabled=false;
		document.getElementById("new_con_no").disabled=true;
	}
	else if(document.getElementById("new_container").checked){
		
		document.getElementById("container_no").disabled=true;
		document.getElementById("new_con_no").disabled=false;
	}



$(document).ready(function(){
	$('#other_vehicle').change(function(){
		alert("sdfsdf");
		var other_vehicle = $('#other_vehicle').val();
		
		$.ajax({
			type : "GET",
			url  : "<?php echo base_url(); ?>/index.php/vehicle_details/ajax_check_transport_name",
			data : {"other_vehicle" : other_vehicle},
			success : function(data){
				jQuery("#transport_name").html(data);
				/*alert(data);*/
			}
		});
	});
});
$(document).ready(function(){
	$("#party_name").change(function(){
		var e = document.getElementById("transport_name");
        var trname = e.options[e.selectedIndex].text;
		/*alert(trname);*/
		if((trname=="SRI SABAHRI TRANSPORT")||(trname=="SRI MURUGAN TRANSPORT")){
			
		 document.getElementById('driver_name').disabled=false;
	     document.getElementById('driver_advance').disabled=false;			
		}
		else{
		
	   document.getElementById('driver_name').disabled=true;
	   document.getElementById('driver_advance').disabled=true;
		}
		
	});
	
	
});
if(document.getElementById("transport_name").value!=""){
		
		var e = document.getElementById("transport_name");
        var trname = e.options[e.selectedIndex].text;
		/*alert(trname);*/
		if((trname=="SRI SABAHRI TRANSPORT")||(trname=="SRI MURUGAN TRANSPORT")){
			
		 document.getElementById('driver_name').disabled=false;
	     document.getElementById('driver_advance').disabled=false;			
		}
		else{
		
	   document.getElementById('driver_name').disabled=true;
	   document.getElementById('driver_advance').disabled=true;
		}
}




</script>


<?php include('include/footer.php');
include('validation/add_daily_movement_details.php');
?>
        