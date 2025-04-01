<?php global $lang; ?>
<div class="wrap es-page">
    <div id="maillistsCreate">
        <div class="btnBackBlock">
            <a href="<?php menu_page_url('es-plugin-maillists'); ?>" class="btn btn-link"><i class="fa fa-chevron-left" aria-hidden="true"></i> <?php echo esc_html(__("Volver","envialosimple-email-marketing-y-newsletters-gratis")); ?></a>
        </div>
        <h1><?php echo esc_html(__("Crear lista de contactos","envialosimple-email-marketing-y-newsletters-gratis")); ?></h1>
        <form @submit.prevent="submitForm">
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group mb20">
                        <label class="form-label" for="apikey"><?php echo esc_html(__("Nombre","envialosimple-email-marketing-y-newsletters-gratis")); ?>:</label>
                        <input name="name" ref="nameBlock" type="text" id="name" class="form-control" v-model="formData.name"  >
                    </div>
                    <div class="btnsBlock">
                        <button type="submit" class="btn btn-primary"><?php echo esc_html(__("Crear lista","envialosimple-email-marketing-y-newsletters-gratis")); ?></button>
                    </div>
                </div>
            </div>
        </form>
        <loading-component v-bind:loading="loading" ></loading-component>
        <toast-component :close="hideToast" v-bind:msg="msgToast" v-bind:show="showToast"></toast-component>
        <success-msg-component v-bind:show="showSuccess" v-bind:msg="msgSuccess" :closeaction="hideModalSuccess" btnmsg="Volver al listado" :btnaction="actionBtnModalSuccess"></success-msg-component>
    </div>
</div>
