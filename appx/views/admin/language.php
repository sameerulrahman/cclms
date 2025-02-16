<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <?php echo get_phrase('language'); ?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i><?php echo get_phrase('home'); ?></a></li>
            <li><?php echo get_phrase('web_data'); ?></li>
            <li class="active"><?php echo get_phrase('language'); ?></li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <?php if ($this->session->flashdata("message")) : ?>
                    <div class="alert alert-info alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-info"></i><?php echo get_phrase('notification'); ?></h4>
                        <?php echo $this->session->flashdata("message") ?>
                    </div>
                <?php endif; ?>
                <?php if ($this->session->flashdata("message_error")) : ?>
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-info"></i><?php echo get_phrase('error'); ?></h4>
                        <?php echo $this->session->flashdata("message_error") ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                 
                <button class="btn btn-flat <?php echo setting_all('buttons'); ?> btn-sm pull-right" data-toggle="modal" data-target="#addLang">
                    <?php echo get_phrase('add_new_language'); ?>
                </button><br><br>

                <div class="box-body table-responsive">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#main" data-toggle="tab"><?php echo get_phrase('home'); ?></a></li>
                            <?php 
                                $fields = $this->db->list_fields('languages');
                                foreach($fields as $field):
                                
                                    if($field == 'id' || $field == 'phrase')
                                        continue;
                            ?>
                            <li><a href="#<?php echo $field; ?>" data-toggle="tab"><?php echo ucwords($field); ?></a></li>
                            <?php endforeach; ?>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane active" id="main">
                                <button class="btn btn-flat btn-sm pull-right" data-toggle="modal" data-target="#addPhrase">
                                    <?php echo get_phrase('add_phrase'); ?>
                                </button><br><br>
                                <h4><?php echo get_phrase('phrases'); ?></h4>
                                <table class="table table-hover display table-bordered">
                                    <thead>
                                        <tr>
                                            <th> <?php echo get_phrase('id'); ?></th>
                                            <th> <?php echo get_phrase('phrases'); ?></th>
                                            <th> <?php echo get_phrase('action'); ?> </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $phrases = $this->Admin_model->get_row('languages');
                                            foreach ($phrases as $phrase):
                                        ?>
                                            <tr>
                                                <td><?php echo $phrase['id']; ?> </td>
                                                <td><?php echo $phrase['phrase']; ?> </td>
                                                <td>
                                                    <a onclick="confirm_modal('<?php echo base_url().'language/phrase/delete/'.$phrase['id']?>');"  href="#" >
                                                        <button class="btn btn-danger btn-xs">
                                                            <i class="fa fa-trash"></i> <?php echo get_phrase('delete'); ?>
                                                        </button>
                                                    </a>
                                                </td>
                                            </tr>
                                        
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>

                                <h4><?php echo get_phrase('languages'); ?></h4>
                                <table class="table table-hover display table-bordered">
                                    <thead>
                                        <tr>
                                            <th> <?php echo get_phrase('id'); ?> </th>
                                            <th> <?php echo get_phrase('language_name'); ?></th>
                                            <th> <?php echo get_phrase('action'); ?> </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                            $languages = $this->db->list_fields('languages');
                                            $counter = 0;
                                            foreach($languages as $language):
                                            
                                                if($language == 'id' || $language == 'phrase')
                                                    continue;
                                        ?>
                                            <tr>
                                                <td><?php echo ++$counter; ?></td>
                                                <td><?php echo ucfirst($language); ?> </td>
                                                <td>
                                                    <a onclick="confirm_modal('<?php echo base_url().'language/language_manage/delete_language/'.$language; ?>');"  href="#" >
                                                        <button class="btn btn-danger btn-xs">
                                                            <i class="fa fa-trash"></i> <?php echo get_phrase('delete'); ?>
                                                        </button>
                                                    </a>
                                                </td>
                                                
                                            </tr>
                                        
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            <?php 
                                $fields = $this->db->list_fields('languages');
                                foreach($fields as $field):
                                
                                    if($field == 'id' || $field == 'phrase')
                                        continue;
                            ?>
                            <div class="tab-pane" id="<?php echo $field; ?>">
                                <table class="table table-hover display table-bordered">
                                    <thead>
                                        <tr>
                                            <th> <?php echo get_phrase('id'); ?></th>
                                            <th> <?php echo get_phrase('phrase'); ?></th>
                                            <th> <?php echo get_phrase('translation'); ?></th>
                                            <th> <?php echo get_phrase('edit'); ?> </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $phrases = $this->Admin_model->get_row('languages');
                                            foreach ($phrases as $phrase):
                                        ?>
                                            <tr>
                                                <td><?php echo $phrase['id']; ?> </td>
                                                <td><?php echo $phrase['phrase']; ?> </td>
                                                <td id="translation_<?php echo $phrase['id']."_".$field; ?>"><?php echo $phrase[$field]; ?> </td>
                                                <td>
                                                    <a  href="#" data-toggle="modal"  data-target="#edit_<?php echo $phrase['id'].'_'.$field; ?>" >
                                                        <button class="btn btn-info btn-xs">
                                                            <i class="fa fa-edit "></i> Edit
                                                        </button>
                                                    </a>
                                                </td>
                                            </tr>
                                            <div class="modal fade" id="edit_<?php echo $phrase['id'].'_'.$field; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                            <h4 class="modal-title" id="myModalLabel"><?php echo get_phrase('edit'); ?> <?php echo ucwords($field); ?> <?php echo get_phrase('translation'); ?></h4>
                                                        </div>
                                                        <?php echo form_open(base_url('language/phrase/edit_phrase'), 'id="edit_phrase_'.$field.'_'. $phrase['id'].'"'); ?>
                                                                <div class="modal-body">
                                                                <div id="result"></div>
                                                                <div class="form-group">
                                                                    <div class="col-sm-10">
                                                                        <label><?php echo $phrase['phrase']; ?></label>
                                                                        <input type="text" id="translation_value_<?php echo $phrase['id'].'_'.$field; ?>" value="<?php echo $phrase[$field]; ?>" class="form-control" name="translation">
                                                                    </div>
                                                                    <br><br>
                                                                    <input type="hidden" name="id" value="<?php echo $phrase['id']; ?>">
                                                                    <input type="hidden" name="language" value="<?php echo $field; ?>">
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-flat btn-default" data-dismiss="modal"><?php echo get_phrase('close'); ?></button>
                                                                <button type="submit" onclick="edit_p('<?php echo $phrase['id']; ?>', '<?php echo $field; ?>')" class="btn btn-flat <?php echo setting_all('buttons'); ?>"><?php echo get_phrase('update'); ?></button>
                                                            </div>
                                                        <?php echo form_close(); ?>
                                                    </div>
                                                </div>
                                            </div>  
 
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                   
            </div>
        </div>
    </section>
</div>

<div class="modal fade" id="addLang" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel"><?php echo get_phrase('add_languages'); ?></h4>
            </div>
            <?php echo form_open(base_url('language/language_manage/add_language')); ?>
            <div class="modal-body">
                <div id="result"></div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label"><?php echo get_phrase('language_name'); ?></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="language">
                    </div>
                    <br><br>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-flat btn-default" data-dismiss="modal"><?php echo get_phrase('close'); ?></button>
                <button type="submit" class="btn btn-flat <?php echo setting_all('buttons'); ?>"><?php echo get_phrase('add'); ?></button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>



<div class="modal fade" id="addPhrase" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel"><?php echo get_phrase('add_phrase'); ?></h4>
            </div>
            <?php echo form_open(base_url('language/phrase/add_phrase')); ?>
            <div class="modal-body">
                <div id="result"></div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label"><?php echo get_phrase('phrase'); ?></label>
                    <div class="col-sm-10">
                        <input type="text" placeholder="only alphabet and underscore are allowed" class="form-control" name="phrase">
                    </div>
                    <br><br>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-flat btn-default" data-dismiss="modal"><?php echo get_phrase('close'); ?></button>
                <button type="submit" class="btn btn-flat <?php echo setting_all('buttons'); ?>"><?php echo get_phrase('add'); ?></button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>