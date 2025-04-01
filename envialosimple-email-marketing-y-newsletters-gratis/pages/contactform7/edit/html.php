<?php global $lang; ?>
<div class="wrap es-page">
    <div id="es-contactform7-list">
        <div v-if="!notfound">
            <div class="btnBackBlock">
                <a href="<?php menu_page_url('es-plugin-contactform7'); ?>" class="btn btn-link"><i class="fa fa-chevron-left" aria-hidden="true"></i> <?php echo esc_html(__("Volver","envialosimple-email-marketing-y-newsletters-gratis")); ?></a>
            </div>
            <div class="row" v-if="form">
                <div class="col-md-6">
                    <h1 class=""><?php echo esc_html(__("Editar formulario de contacto","envialosimple-email-marketing-y-newsletters-gratis")); ?> - {{form.title}}</h1>
                    <p><?php echo esc_html(__("Tienes configurados algunos formularios Contact Form 7 en tu blog y puedes aprovecharlos para enriquecer tus listas de contactos de EnvíaloSimple. En caso de presentarse un error en la vinculación de los campos personalizados, se enviará un correo electrónico con los valores que intentó registrar el contacto. El correo electrónico del contacto siempre se registrará.","envialosimple-email-marketing-y-newsletters-gratis")); ?></p>
                    <p><?php echo __("<b>Correo de confirmación de suscripción</b>. Le enviaremos uno a cada contacto que complete este formulario. Este mail asegura que tus campañas sean recibidas por las personas correctas y te protege de suscripciones indeseadas. Te invitamos a leer los beneficios del mismo","envialosimple-email-marketing-y-newsletters-gratis"); ?><a target="_blank" href="<?php echo esc_html(__("https://faqs.envialosimple.com/contactos-y-listas/formularios","envialosimple-email-marketing-y-newsletters-gratis")); ?>"> &nbsp;<?php echo esc_html(__("aquí.","envialosimple-email-marketing-y-newsletters-gratis")); ?></a></p>
                    <div class="formListsBlock mt20" v-if="form">

                        <div class="" v-if="formSelected">
                            <div class="form-group mb40" >
                                <label><strong><?php echo esc_html(__("Selecciona la lista a la que suscribirás a los contactos","envialosimple-email-marketing-y-newsletters-gratis")); ?></strong></label>
                                <singlelist-maillists-component
                                    v-bind:options="maillists"
                                    v-bind:selected="config.mailList"
                                    v-bind:pagination="paginationMaillist"
                                    v-bind:required="requiredMailList"
                                    :remove="removeMaillist"
                                    :add="addMaillist"
                                    :search="getMaillists"
                                ></singlelist-maillists-component>
                            </div>
                        </div>
                        <div v-if="config.mailList">
                            <p><strong><?php echo esc_html(__("Ahora por favor selecciona que datos deseas sincronizar con EnvíaloSimple","envialosimple-email-marketing-y-newsletters-gratis")); ?></strong></p>
                            <div class="row">
                                <div class="col">
                                    <label class="mb10"><?php echo esc_html(__("Campo formulario Contact Form 7","envialosimple-email-marketing-y-newsletters-gratis")); ?></label>
                                </div>
                                <div class="col-auto">&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                <div class="col">
                                    <label class="mb10"><?php echo esc_html(__("Campo Personalizado EnvíaloSimple","envialosimple-email-marketing-y-newsletters-gratis")); ?></label>
                                </div>
                            </div>
                            <div class="row" v-if="field.name" v-for="(field, index) in contactFormFields">
                                <div class="col">
                                    <div  class="form-group mb20" >
                                        <p class="form-control">{{field.name}}</p>
                                    </div>
                                </div>
                                <div class="col-auto mt5">
                                    <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                                </div>
                                <div class="col">
                                    <div class="form-group mb20">
                                        <select class="form-control" v-model="config.associatedFields[field.name]" >
                                            <option value=""></option>
                                            <option value="emailbase" v-if="ifUsedEmail(field)">Email</option>
                                            <option :value="customField.id" v-for="customField in customFields" v-if="ifUsed(customField,field.name)">{{customField.name}}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="mt-3 btnSubmit" v-if="formSelected">
                <button class="btn btn-primary" v-on:click="setConfig">GUARDAR</button>
            </div>
        </div>
        
        <notfound-component v-bind:show="notfound" v-bind:msg="msgBackList" :action="backList"></notfound-component>
        
        <loading-component v-bind:loading="loading" ></loading-component>
        <toast-component :close="hideToast" v-bind:msg="msgToast" v-bind:show="showToast"></toast-component>
        <success-msg-component v-bind:show="showSuccess" v-bind:msg="msgSuccess" :closeaction="hideModalSuccess" btnmsg="Volver al listado" :btnaction="actionBtnModalSuccess"></success-msg-component>
    </div>

</div>
