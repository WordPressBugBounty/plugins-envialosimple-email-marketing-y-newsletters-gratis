<?php global $lang; ?>
<div class="wrap es-page">
    <div id="campaignEdit">
        
        <div v-if="!notfound">
            <div class="btnBackBlock">
                <a href="<?php menu_page_url('es-plugin-campaigns'); ?>" class="btn btn-link"><i class="fa fa-chevron-left" aria-hidden="true"></i> <?php echo esc_html(__("Volver","envialosimple-email-marketing-y-newsletters-gratis")); ?></a>
            </div>
            <h1><?php echo esc_html(__("Editar campaña","envialosimple-email-marketing-y-newsletters-gratis")); ?></h1>
            <form @submit.prevent='submitForm'>
                <div class="alert alert-dismissible alert-warning" v-if="form.workspace == 'designer' && showDesigner">
                    <button type="button" class="btn-close" v-on:click="hideAlertDesigner()"></button>
                    <p class="mb-0">Ten presente que en caso de guardar algún cambio sobre la campaña, el contenido de la misma se transformará a Modo Programador y no podrá editarse desde el Editor visual de la herramienta.</p>
                </div>
                <div class="form-group mb30">
                    <label class="form-label" ><?php echo esc_html(__("Nombre de la campaña","envialosimple-email-marketing-y-newsletters-gratis")); ?></label>
                    <input name="name" type="text" ref="nameBlock" class=" form-control" v-model="form.name" />
                    <label><small class="text-muted"><?php echo esc_html(__("Este nombre no es visible para los destinatarios","envialosimple-email-marketing-y-newsletters-gratis")); ?></small></label>
                </div>
                <div class="row columnsBlock">
                    <div class="col-md-6">
                        <div class="mb20">
                            <h6><?php echo esc_html(__("Configuración general","envialosimple-email-marketing-y-newsletters-gratis")); ?></h6>
                            <div class="form-group">
                                <label class="form-label" ><?php echo esc_html(__("Asunto","envialosimple-email-marketing-y-newsletters-gratis")); ?></label>
                                <input  type="text" ref="subjectBlock" v-model="form.subject" class=" form-control"  />
                            </div>
                            <div class="form-group">
                                <label class="form-label" ><?php echo esc_html(__("Texto de vista previa","envialosimple-email-marketing-y-newsletters-gratis")); ?></label>
                                <input  type="text" ref="previewTextBlock" v-model="form.previewText" class=" form-control"  />
                                <label>
                                    <small class="text-muted"><?php echo esc_html(__("Este fragmento de texto aparecerá en la bandeja de entrada luego del asunto del correo.","envialosimple-email-marketing-y-newsletters-gratis")); ?></small>
                                </label>
                            </div>
                        </div>
                        
                        <div class="mb20">
                            <h6><?php echo esc_html(__("Datos del remitente","envialosimple-email-marketing-y-newsletters-gratis")); ?></h6>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="form-label" ><?php echo esc_html(__("Nombre del remitente","envialosimple-email-marketing-y-newsletters-gratis")); ?></label>
                                        <input  type="text" ref="fromAliasBlock" v-model="form.fromAlias" name="fromAlias" class=" form-control"  />
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group ">
                                        <label class="form-label" ><?php echo esc_html(__("Desde","envialosimple-email-marketing-y-newsletters-gratis")); ?></label>
                                        <input  type="text" ref="fromEmailBlock" v-model="form.fromEmail" name="fromEmail" placeholder="<?php echo esc_html(__("Ej: nombre@dominio.com","envialosimple-email-marketing-y-newsletters-gratis")); ?>"  class=" form-control"  />
                                    </div>
                                </div>
                            </div>
                            
                            
                            <div class="form-group">
                                <label class="form-label" ><?php echo esc_html(__("Responder a","envialosimple-email-marketing-y-newsletters-gratis")); ?></label>
                                <input type="text" ref="replyEmailBlock" v-model="form.replyEmail" name="replyEmail" placeholder="<?php echo esc_html(__("Ej: nombre@dominio.com","envialosimple-email-marketing-y-newsletters-gratis")); ?>"  class=" form-control"  />
                            </div>
                        </div>

                        <div class="mb20">
                            <h6><?php echo esc_html(__("Destinatarios","envialosimple-email-marketing-y-newsletters-gratis")) ?></h6>
                            <div class="mb10">
                                <label class="mb10 ">
                                    <input type="radio" @change="changeTypeList" v-model="type_list" value="maillist" name="type_list" />
                                    <?php echo esc_html(__("Listas","envialosimple-email-marketing-y-newsletters-gratis")); ?>
                                </label>
                                <label class="mb10 ml15">
                                    <input type="radio" @change="changeTypeList" v-model="type_list" value="segment" name="type_list" />
                                    <?php echo esc_html(__("Segmento","envialosimple-email-marketing-y-newsletters-gratis")); ?>
                                </label>
                            </div>
                            <div class="form-group ">
                                <duallist-maillists-component
                                    v-if="type_list == 'maillist'"
                                    v-bind:options="mailListsOptions"
                                    v-bind:selected="mailListsSelected"
                                    v-bind:pagination="paginationMailList"
                                    :add="addMaillist"
                                    :remove="removeMaillist"
                                    :search="getMailLists"
                                    :nextpage="nextPageMailList"
                                    :prevpage="prevPageMailList"
                                    :addall="addAllMailList"
                                    :removeall="removeAllMailList"
                                    v-bind:required="requiredMailList"
                                    v-bind:empty="emptyMailList"
                                ></duallist-maillists-component>
                                <singlelist-segments-component 
                                    v-if="type_list == 'segment'"
                                    v-bind:options="segments"
                                    v-bind:selected="segmentSelected"
                                    v-bind:pagination="paginationSegment"
                                    :remove="removeSegment"
                                    :add="addSegment"
                                    :search="getSegments"
                                    v-bind:required="requiredSegment"
                                    v-bind:empty="emptySegment"
                                ></singlelist-segments-component>
                            </div>
                        </div>
                        <div class="accordion mb20" id="accordionExample">
                            <div class="accordion-item">
                                <input class="d-none" type="checkbox" id="openColapse1" name="openColapse1" />
                                <h2 class="accordion-header" id="headingOne">
                                    <label for="openColapse1" class="accordion-button" type="button" >
                                        <?php echo esc_html(__("Opciones avanzadas","envialosimple-email-marketing-y-newsletters-gratis")); ?>
                                    </label>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show " aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="row mb25">
                                            <div class="col col-auto">
                                                <input type="checkbox" v-model="form.trackLinkClicks"  name="trackLinkClicks" />
                                            </div>
                                            <div class="col pl0">
                                                <div class="label">
                                                    <?php echo esc_html(__("Seguir enlaces","envialosimple-email-marketing-y-newsletters-gratis")); ?>
                                                </div>
                                                <p>
                                                    <?php echo esc_html(__("Conoce cuáles fueron los enlaces de tu campaña que más clics recibieron y quiénes los hicieron.","envialosimple-email-marketing-y-newsletters-gratis")); ?>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="row mb25">
                                            <div class="col col-auto">
                                                <input type="checkbox" v-model="form.trackReads" name="trackReads" />
                                            </div>
                                            <div class="col pl0">
                                                <div class="label">
                                                    <?php echo esc_html(__("Contar aperturas","envialosimple-email-marketing-y-newsletters-gratis")); ?>
                                                </div>
                                                <p>
                                                    <?php echo esc_html(__("Descubre desde cuáles dispositivos se abrió tu campaña. La ubicación, los días y los horarios de esas aperturas.","envialosimple-email-marketing-y-newsletters-gratis")); ?>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="row mb25">
                                            <div class="col col-auto">
                                                <input type="checkbox" v-model="form.trackAnalitics" name="trackAnalitics" />
                                            </div>
                                            <div class="col pl0">
                                                <div class="label">
                                                    <?php echo esc_html(__("Vincular con Google Analytics","envialosimple-email-marketing-y-newsletters-gratis")); ?>
                                                </div>
                                                <p>
                                                    <?php echo esc_html(__("Analiza el impacto de tu campaña en tu sitio web.","envialosimple-email-marketing-y-newsletters-gratis")); ?>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="row mb25">
                                            <div class="col col-auto">
                                                <input type="checkbox" v-model="form.sendReport" name="sendReport" />
                                            </div>
                                            <div class="col pl0">
                                                <div class="label">
                                                    <?php echo esc_html(__("Enviar informe","envialosimple-email-marketing-y-newsletters-gratis")); ?>
                                                </div>
                                                <p>
                                                    <?php echo esc_html(__("Recibe en tu correo un reporte completo al finalizar tu campaña.","envialosimple-email-marketing-y-newsletters-gratis")); ?>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="row mb25">
                                            <div class="col col-auto">
                                                <input type="checkbox" v-model="form.publicArchive" name="publicArchive" />
                                            </div>
                                            <div class="col pl0">
                                                <div class="label">
                                                    <?php echo esc_html(__("Agregar al archivo público","envialosimple-email-marketing-y-newsletters-gratis")); ?>
                                                </div>
                                                <p>
                                                    <?php echo esc_html(__("Suma tu campaña al archivo público para que pueda ser indexada por los motores de búsqueda, como Google.","envialosimple-email-marketing-y-newsletters-gratis")); ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 rightBlock">
                        <div class="emptyContent" v-if="!form.content">
                            <h6><?php echo esc_html(__("Contenido","envialosimple-email-marketing-y-newsletters-gratis")); ?></h6>
                            <p><?php echo esc_html(__("Crea un correo profesional que se adapta a dispositivos móviles utilizando el editor gráfico. También puedes elegir el modo programador del editor para realizar tu contenido.","envialosimple-email-marketing-y-newsletters-gratis")); ?></p>
                            <p class="btnBlock">
                                <div class="btnContent">
                                    <span class="btn btn-primary" ref="contentBlock" v-on:click="showModalContent()"><?php echo esc_html(__("Crear contenido","envialosimple-email-marketing-y-newsletters-gratis")); ?></span>
                                </div>
                            </p>
                        </div>
                        <div class="contentBlock" v-bind:class="{ 'd-none': !form.content}">
                            <div class="topBlock">
                                <h6><?php echo esc_html(__("Contenido","envialosimple-email-marketing-y-newsletters-gratis")); ?></h6>
                                <div class="mb20">
                                    <div class="contentActionsBlock" >
                                        <span class="delete" v-on:click="showRemoveContent">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                            <span>Eliminar</span>
                                        </span>
                                        <span class="edit" v-on:click="showModalContent">
                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                            <span>Editar</span>
                                        </span>
                                        <span class="sendEmail" v-bind:class="{'disabled': editedContent}"  v-on:click="(editedContent)?errorNeedSave():toggleEmailPreview()">
                                            <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                            <span>Probar email</span>
                                        </span>
                                    </div>
                                </div>
                                <div v-if="showEmailPreview && !editedContent" class="mb20 sendEmailPreviewBlock">
                                    <h6>Probar email</h6>
                                    <div class="form-group">
                                        <input type="email" class="form-control " v-model="emailPreview" ref="emailsBlock0" />
                                    </div>
                                    
                                    <div class="text-end ">
                                        <span class="btn btn-secondary" v-on:click="sendEmailPreview">Enviar</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="iframeBlock">
                                <iframe id="iframePreview" class="w100" ref="iframeContent" ></iframe>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="btnSubmit">
                    <button type="submit" class="btn btn-outline-primary mr10">GUARDAR</button>
                    <span class="btn btn-primary" v-on:click="checkStatusCampaign">CONTINUAR CON EL ENVÍO</span>
                </div>
            </form>
        </div>
        <div class="deleteContent">
            <success-msg-component v-bind:show="showDetele" v-bind:msg="msgDeleteContent" :closeaction="hideRemoveContent" btnmsg="Eliminar" :btnaction="removeContent"></success-msg-component>
        </div>
        <notfound-component v-bind:show="notfound" v-bind:msg="msgBackList" :action="backList"></notfound-component>
        <loading-component v-bind:loading="loading" ></loading-component>
        <toast-component :close="hideToast" v-bind:msg="msgToast" v-bind:show="showToast"></toast-component>
        <modal-campaign-content-component v-if="form.id" :save="saveContent" :cancel="hideModalContent" v-bind:show="showContent" v-bind:newcontent="newContent"></modal-campaign-content-component>
        <success-msg-component v-bind:show="showSuccess" v-bind:msg="msgSuccess" :closeaction="hideModalSuccess" btnmsg="Volver al listado" :btnaction="actionBtnModalSuccess" ></success-msg-component>
        <modal-send-campaign-component v-bind:loading="loadingSend" v-bind:responsesend="responseSendCampaign" v-bind:errors="errorsDate"  :cancel="hideModalSendCampaign" :accept="setSendEmail" v-bind:show="showModalSendCampaign"></modal-send-campaign-component>
    </div>
</div>
