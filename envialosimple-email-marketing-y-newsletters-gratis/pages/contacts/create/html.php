<?php global $lang; 
$months = array(
    1 => __('Enero', 'envialosimple'),
    2 => __('Febrero', 'envialosimple'),
    3 => __('Marzo', 'envialosimple'),
    4 => __('Abril', 'envialosimple'),
    5 => __('Mayo', 'envialosimple'),
    6 => __('Junio', 'envialosimple'),
    7 => __('Julio', 'envialosimple'),
    8 => __('Agosto', 'envialosimple'),
    9 => __('Septiembre', 'envialosimple'),
    10 => __('Octubre', 'envialosimple'),
    11 => __('Noviembre', 'envialosimple'),
    12 => __('Diciembre', 'envialosimple')
);

?>
<div class="wrap es-page" >
    <div id="contactsCreate">
        <div class="btnBackBlock">
            <a href="<?php menu_page_url('es-plugin-contacts'); ?>" class="btn btn-link"><i class="fa fa-chevron-left" aria-hidden="true"></i> <?php echo esc_html(__("Volver","envialosimple")); ?></a>
        </div>
        <h1><?php echo esc_html(__("Crear contacto","envialosimple")); ?></h1>
        <form @submit.prevent="submitForm">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb20">
                        <h6 class="mb20"><?php echo esc_html(__("Datos de contacto","envialosimple")); ?></h6>
                        <div class="form-group " >
                            <label class="form-label"  for="email"><?php echo esc_html(__("Correo electrónico","envialosimple")); ?></label>
                            <input name="email" type="text" ref="emailBlock" id="email" class=" form-control" v-model="formData.email"  />
                        </div>
                        <div v-for="customfield in customfields" class="form-group ">
                            <label class="form-label"  :for="'customFields'+customfield.id">{{customfield.name}} <span class="optional"><?php echo esc_html(__("(opcional)","envialosimple")); ?></span></label>
                            <div v-if="customfield.type == 'Text field' || customfield.type == 'Hidden field'">
                                <input  :ref="'customFieldsBlock'+customfield.id" type="text" :id="'customFieldsBlock'+customfield.id" class=" form-control"  v-model="customFieldsValues[customfield.id]" />
                            </div>
                            <div v-if="customfield.type == 'Check box'" :id="'customFieldsBlock'+customfield.id" :ref="'customFieldsBlock'+customfield.id">
                                <label class="d-block mb10" v-for="(value, index) in getValuesFields(customfield)">
                                    <input type="checkbox" :id="'customFieldsBlock'+customfield.id+index" :value="value" v-model="customFieldsValues[customfield.id]" />
                                    {{value}}
                                </label>
                            </div>
                            <div v-if="customfield.type == 'Radio button'" :id="'customFieldsBlock'+customfield.id" :ref="'customFieldsBlock'+customfield.id">
                                <label class="d-block mb10" v-for="(value, index) in getValuesFields(customfield)">
                                    <input type="radio" :id="'customFieldsBlock'+customfield.id+index" :value="value" v-model="customFieldsValues[customfield.id]" />
                                    {{value}}
                                </label>
                            </div>
                            <div v-if="customfield.type == 'Drop list'" >
                                <select class="form-control mw100i" :id="'customFieldsBlock'+customfield.id" v-model="customFieldsValues[customfield.id]" :ref="'customFieldsBlock'+customfield.id">
                                    <option value=""><?php echo esc_html(__("Seleccione un valor","envialosimple")); ?></option>
                                    <option v-for="(value, index) in getValuesFields(customfield)" :value="value" >{{value}}</option>
                                </select>
                            </div>
                            <div v-if="customfield.type == 'Anual Date'" >
                                <div class="row fieldDate" :id="'customFieldsBlock'+customfield.id" :ref="'customFieldsBlock'+customfield.id">
                                    <div class="col-sm-6">
                                        <label><?php echo esc_html(__("Mes","envialosimple")); ?></label>
                                        <select class="form-control mw100i"  v-model="customFieldsValues[customfield.id][0]" >
                                            <option value=""></option>
                                            <?php foreach($months as $num => $month): ?>
                                                <option value="<?php echo esc_attr($num); ?>"><?php echo esc_html($month); ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-6">
                                        <label><?php echo esc_html(__("Día","envialosimple")); ?></label>
                                        <input class="form-control" maxlength="2" type="text" v-model="customFieldsValues[customfield.id][1]" v-on:keypress="isNumber($event)"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="btnSubmit">
                        <button type="submit" class="btn btn-primary"><?php echo esc_html(__("Crear contacto","envialosimple")); ?></button>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb20">
                        <h6 class="mb20"><?php echo esc_html(__("Lista para suscribir al contacto","envialosimple")); ?></h6>
                        <singlelist-maillists-component
                            v-bind:options="maillists"
                            v-bind:selected="maillistSelected"
                            v-bind:pagination="paginationMaillist"
                            v-bind:required="requiredMailList"
                            :remove="removeMaillist"
                            :add="addMaillist"
                            :search="getMaillists"
                        ></singlelist-maillists-component>
                    </div>
                </div>
            </div>
        </form>
        <loading-component v-bind:loading="loading" ></loading-component>
        <toast-component :close="hideToast" v-bind:msg="msgToast" v-bind:show="showToast"></toast-component>
        <success-msg-component v-bind:show="showSuccess" v-bind:msg="msgSuccess" :closeaction="hideModalSuccess" btnmsg="Volver al listado" :btnaction="actionBtnModalSuccess"></success-msg-component>
    </div>
</div>
