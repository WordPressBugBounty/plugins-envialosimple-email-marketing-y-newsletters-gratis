<?php global $lang; ?>
<div class="wrap es-page">
    <div id="es-config-page">
        <div class="row">
            <div class="col-lg-6">
                <div class="logoBlock">
                    <img class="logo" src="<?php echo ES_PLUGIN_URL_BASE.'/assets/img/logo.png'; ?>" />
                </div>
                <h1 class="titlePage">
                    <strong><?php echo esc_html(__("Configuración de la cuenta","envialosimple")); ?> </strong>
                    <span>
                        <?php if(!empty($dataProfile->data)): ?>
                            <svg width="24" height="24" x="0" y="0" class="stencil--easier-to-select" style="opacity: 1;"><defs></defs><rect x="0" y="0" width="24" height="24" fill="transparent" class="stencil__selection-helper"></rect><style>#mq-stencil-icon-undefined55606167 * { vector-effect: non-scaling-size; }</style><g id="mq-stencil-icon-undefined55606167" fill="rgb(98, 156, 68)" stroke-width="0" stroke="none" stroke-dasharray="none"><svg preserveAspectRatio="none" width="100%" viewBox="0 0 24 24" height="100%" xmlns="http://www.w3.org/2000/svg"><path d="M17 7h-4v2h4c1.65 0 3 1.35 3 3s-1.35 3-3 3h-4v2h4c2.76 0 5-2.24 5-5s-2.24-5-5-5zm-6 8H7c-1.65 0-3-1.35-3-3s1.35-3 3-3h4V7H7c-2.76 0-5 2.24-5 5s2.24 5 5 5h4v-2zm-3-4h8v2H8z"></path></svg></g></svg>
                            <?php echo esc_html(__("Conectado","envialosimple")); ?> 
                        <?php else: ?>
                            <svg width="24" height="24" x="0" y="0" class="stencil--easier-to-select" style="opacity: 1;"><defs></defs><rect x="0" y="0" width="24" height="24" fill="transparent" class="stencil__selection-helper"></rect><style>#mq-stencil-icon-undefinedd1552d98 * { vector-effect: non-scaling-size; }</style><g id="mq-stencil-icon-undefinedd1552d98" fill="rgb(255, 56, 35)" stroke-width="0" stroke="none" stroke-dasharray="none"><svg preserveAspectRatio="none" width="100%" viewBox="0 0 24 24" height="100%" xmlns="http://www.w3.org/2000/svg"><path d="M14.39 11L16 12.61V11zM17 7h-4v1.9h4c1.71 0 3.1 1.39 3.1 3.1 0 1.27-.77 2.37-1.87 2.84l1.4 1.4C21.05 15.36 22 13.79 22 12c0-2.76-2.24-5-5-5zM2 4.27l3.11 3.11C3.29 8.12 2 9.91 2 12c0 2.76 2.24 5 5 5h4v-1.9H7c-1.71 0-3.1-1.39-3.1-3.1 0-1.59 1.21-2.9 2.76-3.07L8.73 11H8v2h2.73L13 15.27V17h1.73l4.01 4.01 1.41-1.41L3.41 2.86 2 4.27z"></path></svg></g></svg>
                            <?php echo esc_html(__("Desconectado","envialosimple")); ?>
                        <?php endif; ?>
                    </span>
                </h1>
                <p class="textKey"><?php echo esc_html(__("El siguiente paso es conectar tu cuenta de EnvíaloSimple con WordPress.","envialosimple")); ?><br /><?php echo esc_html(__("Para hacerlo, necesitas una clave API de EnvíaloSimple.","envialosimple")); ?><a href="https://tutoriales.envialosimple.com/cuentas/configurar-mi-cuenta/api-y-api-keys" target="_blank">&nbsp;<?php echo esc_html(__("Obtener clave API.","envialosimple")); ?></a></p>
                <form method="POST" novalidate>
                    <?php if(empty($error)): ?>
                        <div class="form-group mb20">
                            <textarea name="apikey" type="text" id="apikey" placeholder="<?php echo esc_html(__("Copia y pega aquí tu clave API","envialosimple")); ?>" class="form-control textareaKey" ><?php echo esc_html($apiKey); ?></textarea>
                        </div>
                    <?php else: ?>
                        <div class="form-group has-danger mb20">
                            <textarea name="apikey" type="text" id="apikey" placeholder="<?php echo esc_html(__("Copia y pega aquí tu clave API","envialosimple")); ?>" class="form-control textareaKey is-invalid" ><?php echo esc_html($apiKey); ?></textarea>
                            <div class="invalid-feedback"><?php echo esc_html(__("La clave ingresada es incorrecta. Por favor, verifique el valor ingresado y que la clave esté Activa.","envialosimple")); ?></div>
                        </div>
                    <?php endif; ?>
                    <input type="hidden" name="form_submitted" value="true" />
                    <input type="hidden" name="esma_nonce" value="<?php echo esc_attr( $esma_nonce ); ?>" />
                    <p class="submit">
                        <input type="submit" name="submit" id="submit" class="btn btn-primary" value="Guardar cambios">
                    </p>
                </form>
                <?php if(!empty($dataProfile->data)): ?>
                    <div class="profileBlock">
                        <p class="title"><?php echo esc_html(__("Datos de tu cuenta de EnvíaloSimple","envialosimple")); ?></p>
                        <p>
                            <strong><?php echo esc_html(__("Usuario","envialosimple")); ?></strong><br/>
                            <?php echo esc_html($dataProfile->data->email); ?>
                        </p>
                        <p>
                            <strong><?php echo esc_html(__("ID de la cuenta","envialosimple")); ?></strong><br/>
                            <?php echo esc_html($dataProfile->data->id); ?>
                        </p>
                        <p>
                            <strong><?php echo esc_html(__("Tipo de cuenta","envialosimple")); ?></strong><br/>
                            <?php 
                                $subscription_type = isset($dataProfile->data->subscription->Type) ? $dataProfile->data->subscription->Type : 'default';

                                switch ($subscription_type) {
                                    case 'Prepaid':
                                        echo esc_html__('Prepaga', 'envialosimple');
                                        break;
                                    case 'Monthly':
                                        echo esc_html__('Mensual', 'envialosimple');
                                        break;
                                    default:
                                        echo esc_html__('Free', 'envialosimple');
                                        break;
                                }
                            ?>
                        </p>
                    </div>
                <?php endif; ?>
            </div>
            <div class="imgRightBlock col-lg-6 d-none d-lg-block">
                <img src="<?php echo ES_PLUGIN_URL_BASE.'/assets/img/config_1.svg'; ?>" />
            </div>
        </div>
        
    </div>
</div>
