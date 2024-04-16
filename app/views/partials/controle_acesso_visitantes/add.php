
<?php
$comp_model = new SharedController;
$current_page = get_current_url();
$csrf_token = Csrf :: $token;

$show_header = $this->show_header;
$view_title = $this->view_title;
$redirect_to = $this->redirect_to;

?>

<section class="page">
    
    <?php
    if( $show_header == true ){
    ?>
    
    <div  class="bg-light p-3 mb-3">
        <div class="container">
            
            <div class="row ">
                
                <div class="col-12 ">
                    <h3 class="record-title"><?php print_lang('adicionar_novo'); ?></h3>
                    
                </div>
                
            </div>
        </div>
    </div>
    
    <?php
    }
    ?>
    
    <div  class="">
        <div class="container">
            
            <div class="row ">
                
                <div class="col-md-7 comp-grid">
                    
                    <?php $this :: display_page_errors(); ?>
                    
                    <div  class=" animated fadeIn">
                        <form id="controle_acesso_visitantes-add-form" role="form" novalidate enctype="multipart/form-data" class="form form-horizontal needs-validation" action="<?php print_link("controle_acesso_visitantes/add?csrf_token=$csrf_token") ?>" method="post">
                            <div>
                                
                                
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="data"><?php print_lang('data'); ?> <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <input id="ctrl-data" class="form-control datepicker  datepicker"  required="" value="<?php  echo $this->set_field_value('data',date_now()); ?>" type="datetime" name="data" placeholder="<?php print_lang('entrar_data'); ?>" data-enable-time="false" data-min-date="" data-max-date="" data-date-format="Y-m-d" data-alt-format="d/m/Y" data-inline="false" data-no-calendar="false" data-mode="single" />
                                                    
                                                    
                                                    <div class="input-group-append">
                                                        <span class="input-group-text"><i class="material-icons">date_range</i></span>
                                                    </div>
                                                    
                                                </div>
                                                
                                                
                                            </div>
                                        </div>
                                    </div>
                                    
                                    
                                    
                                    
                                    <div class="form-group ">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="turno"><?php print_lang('turno'); ?> <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    
                                                    <select required=""  id="ctrl-turno" name="turno"  placeholder="<?php print_lang('selecione_um_valor_'); ?>"    class="custom-select" >
                                                        <option value=""><?php print_lang('selecione_um_valor_'); ?></option>
                                                        
                                                        <?php 
                                                        $turno_options = $comp_model -> controle_acesso_visitantes_turno_option_list();
                                                        if(!empty($turno_options)){
                                                        foreach($turno_options as $option){
                                                        $value = (!empty($option['value']) ? $option['value'] : null);
                                                        $label = (!empty($option['label']) ? $option['label'] : $value);
                                                        $selected = $this->set_field_selected('turno',$value, '');
                                                        ?>
                                                        <option <?php echo $selected; ?> value="<?php echo $value; ?>">
                                                            <?php echo $label; ?>
                                                        </option>
                                                        <?php
                                                        }
                                                        }
                                                        ?>
                                                        
                                                    </select>
                                                    
                                                    
                                                </div>
                                                
                                                
                                            </div>
                                        </div>
                                    </div>
                                    
                                    
                                    
                                    
                                    <div class="form-group ">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="nome"><?php print_lang('nome'); ?> <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input id="ctrl-nome"  value="<?php  echo $this->set_field_value('nome',''); ?>" type="text" placeholder="<?php print_lang('entrar_nome'); ?>"  required="" name="nome"  class="form-control " />
                                                        
                                                        
                                                        
                                                    </div>
                                                    
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        
                                        
                                        
                                        
                                        <div class="form-group ">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label class="control-label" for="rg"><?php print_lang('rg'); ?> <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <div class="">
                                                        <input id="ctrl-rg"  value="<?php  echo $this->set_field_value('rg',''); ?>" type="text" placeholder="<?php print_lang('entrar_rg'); ?>"  required="" name="rg"  class="form-control " />
                                                            
                                                            
                                                            
                                                        </div>
                                                        
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            
                                            
                                            
                                            <div class="form-group ">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <label class="control-label" for="placa"><?php print_lang('placa'); ?> <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <div class="">
                                                            <input id="ctrl-placa"  value="<?php  echo $this->set_field_value('placa',''); ?>" type="text" placeholder="<?php print_lang('entrar_placa'); ?>"  required="" name="placa"  class="form-control " />
                                                                
                                                                
                                                                
                                                            </div>
                                                            
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                
                                                
                                                
                                                <div class="form-group ">
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <label class="control-label" for="colaboradores_id_viasolo"><?php print_lang('buscar_visitado'); ?> </label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <div class="">
                                                                
                                                                <select data-endpoint="<?php print_link('api/json/controle_acesso_visitantes_colaboradores_id_viasolo_option_list') ?>" id="ctrl-colaboradores_id_viasolo" data-load-select-options="visitado" name="colaboradores_id_viasolo"  placeholder="<?php print_lang('selecione_um_valor_'); ?>"    class="selectize-ajax" >
                                                                    <option value=""><?php print_lang('selecione_um_valor_'); ?></option>
                                                                    
                                                                </select>
                                                                
                                                                
                                                            </div>
                                                            
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                
                                                
                                                
                                                <div class="form-group ">
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <label class="control-label" for="visitado"><?php print_lang('visitado'); ?> </label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <div class="">
                                                                
                                                                <select  id="ctrl-visitado" data-load-path="<?php print_link('api/json/controle_acesso_visitantes_visitado_option_list') ?>" name="visitado"  placeholder="<?php print_lang('selecione_um_valor_'); ?>"    class="selectize" >
                                                                    <option value=""><?php print_lang('selecione_um_valor_'); ?></option>
                                                                    
                                                                </select>
                                                                
                                                                
                                                            </div>
                                                            
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                
                                                
                                                
                                                <div class="form-group ">
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <label class="control-label" for="entrada"><?php print_lang('entrada'); ?> <span class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <div class="input-group">
                                                                <input id="ctrl-entrada" class="form-control datepicker  datepicker"  required="" value="<?php  echo $this->set_field_value('entrada',time_now()); ?>" type="time" name="entrada" placeholder="<?php print_lang('entrar_entrada'); ?>" data-enable-time="true" data-min-date="" data-max-date=""  data-alt-format="H:i" data-date-format="H:i:S" data-inline="false" data-no-calendar="true" data-mode="single" /> 
                                                                    
                                                                    <div class="input-group-append">
                                                                        <span class="input-group-text"><i class="material-icons">access_time</i></span>
                                                                    </div>
                                                                    
                                                                </div>
                                                                
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    
                                                    
                                                    
                                                </div>
                                                <div class="form-group form-submit-btn-holder text-center">
                                                    <div class="form-ajax-status"></div>
                                                    <button class="btn btn-primary" type="submit">
                                                        <?php print_lang('enviar'); ?>
                                                        <i class="material-icons">send</i>
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                        
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        
                    </section>
                    