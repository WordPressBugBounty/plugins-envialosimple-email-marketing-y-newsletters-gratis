<?php global $lang; ?>
<div class="wrap es-page">
    <div id="es-welcome-page">
        <div class="row">
            <div class="col-lg-6">
                <div class="logoBlock">
                    <img class="logo" src="<?php echo ES_PLUGIN_URL_BASE.'/assets/img/logo.png'; ?>" />
                </div>
                <p class="titlePage">
                    <?php echo esc_html(__("Te damos la bienvenida al plugin de EnvíaloSimple","envialosimple-email-marketing-y-newsletters-gratis")); ?> 
                </p>
                <p class="titlePage"><?php echo esc_html(__("Integra tus herramientas y conecta rápidamente con tus clientes.","envialosimple-email-marketing-y-newsletters-gratis")); ?><br/><?php echo esc_html(__("¡Dale potencia a tu negocio!","envialosimple-email-marketing-y-newsletters-gratis")); ?></p>
                <ul class="listCharacters">
                    <li>
                        <?php echo __("Vincula campañas y contactos con tu cuenta de EnvíaloSimple.","envialosimple-email-marketing-y-newsletters-gratis"); ?>
                    </li>
                    <li>
                        <?php echo esc_html(__("Diseña newsletters en minutos a partir de tus posteos.","envialosimple-email-marketing-y-newsletters-gratis")); ?>
                    </li>
                    <li>
                        <?php echo esc_html(__("Gestiona y enriquece tus listas de contactos.","envialosimple-email-marketing-y-newsletters-gratis")); ?>
                    </li>
                    <li>
                        <?php echo esc_html(__("Vincula tus formularios de Contact Form 7 con las listas de EnvíaloSimple e incrementa tu audiencia.","envialosimple-email-marketing-y-newsletters-gratis")); ?>
                    </li>
                </ul>
                <p class="btnBlock1">
                    <?php if(empty($dataProfile)):?>
                        <a  href="<?php echo esc_html(get_site_url().'/wp-admin/admin.php?page=es-plugin-config'); ?>" class="btn btn-primary btn-lg mb10">
                            <?php echo esc_html(__("Vincular con EnvíaloSimple","envialosimple-email-marketing-y-newsletters-gratis")); ?>
                        </a>
                    <?php else: ?>
                        <a href="<?php echo esc_html(get_site_url().'/wp-admin/admin.php?page=es-plugin-campaigns-create'); ?>" class="btn btn-primary btn-lg mb10">
                            <?php echo esc_html(__("Crear una nueva campaña","envialosimple-email-marketing-y-newsletters-gratis")); ?>
                        </a>
                    <?php endif; ?>
                </p>
                <p class="btnBlock2">
                    <?php echo esc_html(__("¿Aún no tienes una cuenta?","envialosimple-email-marketing-y-newsletters-gratis")); ?>
                    <a target="_blank" href="<?php echo esc_html('https://envialosimple.donweb.com/es-ar/cuenta'); ?>">
                        <?php echo esc_html(__("Súmate a EnvíaloSimple","envialosimple-email-marketing-y-newsletters-gratis")); ?>
                    </a>
                </p>
            </div>
            <div class="imgRightBlock col-lg-6 d-none d-lg-block">
                <img src="<?php echo ES_PLUGIN_URL_BASE.'/assets/img/config_1.svg'; ?>" />
            </div>
        </div>
        
    </div>
</div>
