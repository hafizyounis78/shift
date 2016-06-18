<!-- BEGIN PAGE CONTENT-->

<script type="text/javascript">

var sessionValue = "<?php echo $this->session->userdata('itemname'); ?>";

</script>

<style>

.modal-body {
    max-height: calc(100vh - 210px);
    overflow-y: auto;
}
/*.modal-header {
    padding:9px 15px;
    border-bottom:1px solid #eee;
    background-color: #F90;
    -webkit-border-top-left-radius: 5px;
    -webkit-border-top-right-radius: 5px;
    -moz-border-radius-topleft: 5px;
    -moz-border-radius-topright: 5px;
     border-top-left-radius: 5px;
     border-top-right-radius: 5px;
 }
*/
@media print {
   #btnprint
    {    
     display: none !important;
    }

  #printable
    {
     display: block !important;
    }
}
</style>



<div id="nonprintable" class="row">
  <div class="col-md-12">
  <!--<span id="widget" class="widget" >-->
      <div  class="portlet box green-meadow calendar ">
      
          <div class="portlet-title">
              <div class="caption">
                  <i class="fa fa-gift"></i><?php echo $this->lang->line('Schedule');  ?>
                  <input type="button" id="btnprint" name="btnprint" class="btn btn-default" onclick="printCalender();"  value="Print"/>
              </div>
          </div>
        
          <div  class="portlet-body">
              <div class="row">
              <?php if ($this->session->userdata('itemname') == "gm" ||$this->session->userdata('itemname') == "admin")	{ ?>
         
                  <!--Calender-->
                  
                  <div id="widget" class="col-md-9 col-sm-12">
                   <?php } else {?>
                      <div id="widget" class="col-md-12 col-sm-12">
                       <?php } ?>
                  
                      <div id="calendar" class="has-toolbar">
                      </div>
                  </div>
              </div>
              <!-- END CALENDAR PORTLET-->
          </div>
          <!--<div id="responsive" class="modal fade in" aria-hidden="false" tabindex="-1" style="display: block;">-->
        
<!-- /.modal -->
          
      </div>
  </div>
<!--  </span>-->
</div>
<!-- END PAGE CONTENT-->
<div id="printable" style="display:none"></div>
