
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
                        <form id="controle_acesso_caminhoes_internos-add-form" role="form" novalidate enctype="multipart/form-data" class="form form-horizontal needs-validation" action="<?php print_link("controle_acesso_caminhoes_internos/add?csrf_token=$csrf_token") ?>" method="post">
                            <div>
                                

                                
                                
                                
                                

                                
                                
                                
                                
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="motorista"><?php print_lang('motorista'); ?> <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="">
                                                <input id="ctrl-motorista" name="motorista" type="text" class="form-control">

                                                
                                                
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

                                                <input id="ctrl-placa" name="placa" type="text" class="form-control">

                                                
                                                
                                            </div>
                                            
                                            
                                        </div>
                                    </div>
                                </div>
                                
                                
                                
                                
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="saida"><?php print_lang('saida'); ?> <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                
                                                <input id="ctrl-saida" class="form-control datepicker  datepicker" required="" value="<?php  echo $this->set_field_value('saida',datetime_now()); ?>" type="datetime"  name="saida" placeholder="<?php print_lang('entrar_saida'); ?>" data-enable-time="true" data-min-date="" data-max-date="" data-date-format="Y-m-d H:i:S" data-alt-format="d/m/Y H:i" data-inline="false" data-no-calendar="false" data-mode="single" /> 
                                                    
                                                    <div class="input-group-append">
                                                        <span class="input-group-text"><i class="material-icons">date_range</i></span>
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
    