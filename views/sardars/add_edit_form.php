<link href="<?php echo base_url(); ?>media/assets/css/custom.css" rel="stylesheet" type="text/css"/>
<script>
    $('#form').parsley();
</script>
<!-- END CSS for this page -->
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <div class="card mb-3">
            <div class="card-header">
                <h3><i class="fa fa-hand-pointer-o"></i> <?php echo $second_title; ?></h3>
            </div>

            <div class="card-body">
                <form method="post" action="<?php echo base_url(); ?>sardars/<?php echo $action; ?>"
                      data-parsley-validate
                      novalidate>
                    
                      <div class="form-group">                     
                         <label for="sardar_type">Sardar Type<span class="text-danger">*</span></label>                      
                        <select class="form-control select2" id="sardar_type" name="sardar_type" required> 
                          <option value="">-- Please Select --</option>
                            <?php
                            foreach ($sardar_types as $sardar_type) {
                            ?>
                            <option <?php if(isset($sardar_info) && $sardar_info[0]['sardar_type'] == $sardar_type['id']){ echo 'selected'; } ?> value="<?php echo $sardar_type['id']; ?>">
                                <?php echo $sardar_type['name']; ?>
                            </option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="name">Name<span class="text-danger">*</span></label>
                        <input type="text" name="name" data-parsley-trigger="change" required
                               value="<?php
                               if (isset($sardar_info)) {
                                   echo $sardar_info[0]['name'];
                               }
                               ?>" placeholder="Sardar Name" class="form-control" id="name">
                    </div> 

                   <div class="form-group">
                        <label for="sardar_id">Sardar ID<span class="text-danger">*</span></label>
                        <input type="text" name="sardar_id" data-parsley-trigger="change" required
                               value="<?php
                               if (isset($sardar_info)) {
                                   echo $sardar_info[0]['sardar_id'];
                               }
                               ?>" placeholder="Sardar ID" class="form-control" id="sardar_id">
                    </div>                     

                    <div class="form-group">                     
                         <label for="gender">Gender<span class="text-danger">*</span></label>                      
                        <select class="form-control select2" id="gender" name="gender">    
                            <?php
                            foreach ($genders as $gender) {
                            ?>
                            <option <?php if(isset($sardar_info) && $sardar_info[0]['gender'] == $gender['id']){ echo 'selected'; } ?> value="<?php echo $gender['id']; ?>">
                                <?php echo $gender['name']; ?>
                            </option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="name">Address<span class="text-danger">*</span></label>                
                        <textarea name="address" required id="address" class="form-control"><?php
                            if (isset($sardar_info)) {
                                echo $sardar_info[0]['address'];
                            }
                            ?></textarea>  
                    </div>

                    <div class="form-group">
                        <label for="name">Mobile<span class="text-danger">*</span></label>
                        <input type="text" name="mobile" data-parsley-trigger="change" required
                               value="<?php
                               if (isset($sardar_info)) {
                                   echo $sardar_info[0]['mobile'];
                               }
                               ?>" placeholder="Sardar Modile Number" class="form-control" id="mobile">
                    </div> 

                    <div class="form-group text-right m-b-0">
                        <?php
                        if ($action == 'edit') {
                            ?>
                            <input value="<?php echo $sardar_info[0]['id']; ?>" type="hidden" name="id">
                        <?php } ?>
                        <button class="btn btn-primary" type="submit">
                            Submit
                        </button>
                        <button type="reset" class="btn btn-secondary m-l-5">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div><!-- end card-->
    </div>
</div>






