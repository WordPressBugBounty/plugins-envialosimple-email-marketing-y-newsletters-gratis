<?php
/*--- endpoints ---*/
//getForms
add_action('rest_api_init', function () {
    register_rest_route('envialosimple/v1', '/contactsform7/getForms', array(
        'methods' => 'GET',
        'callback' => 'contactsform7_getforms',
        'permission_callback' => function () {
            return true;
        }
    ));
});
//getFieldsById
add_action('rest_api_init', function () {
    register_rest_route('envialosimple/v1', '/contactsform7/getFieldsById', array(
        'methods' => 'GET',
        'callback' => 'contactsform7_getFieldsById',
        'permission_callback' => function () {
            return true;
        }
    ));
});
add_action('rest_api_init', function () {
    register_rest_route('envialosimple/v1', '/contactsform7/getFormById', array(
        'methods' => 'POST',
        'callback' => 'contactsform7_getFormById',
        'permission_callback' => function () {
            return true;
        }
    ));
});
//getConfig
add_action('rest_api_init', function () {
    register_rest_route('envialosimple/v1', '/contactsform7/getConfig', array(
        'methods' => 'GET',
        'callback' => 'contactsform7_getconfig',
        'permission_callback' => function () {
            return true;
        }
    ));
});
add_action('rest_api_init', function () {
    register_rest_route('envialosimple/v1', '/contactsform7/setConfig', array(
        'methods' => 'POST',
        'callback' => 'contactsform7_setconfig',
        'permission_callback' => function () {
            return true;
        }
    ));
});
add_action('rest_api_init', function () {
    register_rest_route('envialosimple/v1', '/contactsform7/getAllConfigs', array(
        'methods' => 'POST',
        'callback' => 'contactsform7_getallconfigs',
        'permission_callback' => function () {
            return true;
        }
    ));
});
add_action('rest_api_init', function () {
    register_rest_route('envialosimple/v1', '/contactsform7/deleteById', array(
        'methods' => 'POST',
        'callback' => 'contactsform7_delete',
        'permission_callback' => function () {
            return true;
        }
    ));
});
/*-----------------*/


/*--- functions ---*/
function contactsform7_getforms() {
    $forms = get_posts(array(
        'post_type'     => 'wpcf7_contact_form',
        'numberposts'   => -1
    ));
    return $forms;
}
function contactsform7_getFieldsById() {
    $form_ID = sanitize_text_field($_GET['id']);
    $ContactForm = WPCF7_ContactForm::get_instance( $form_ID );
    $form_fields = $ContactForm->scan_form_tags();
    return $form_fields;
}
function contactsform7_getFormById($req) {
    $data = $req->get_params();
    $id = $data['id'];
    $contactForm = WPCF7_ContactForm::get_instance( $id );
    if($contactForm) {
        $data = [
            'id' => $id,
            'title' => $contactForm->title
        ];
        return $data;
    }
    return null;

}
function contactsform7_getconfig() {
    $id = sanitize_text_field($_GET['id']);
    return json_decode(get_option('es_config_contactform7_active_'.$id));
}
function contactsform7_setconfig($req) {
    $data = $req->get_params();
    $id = $data['id'];
    $value = json_encode($data['value']);
    update_option('es_config_contactform7_active_'.$id, $value);
    return true;
}
function contactsform7_getallconfigs($req) {
    global $wpdb;
    $data = $req->get_params();

    $allowedOrderBy = array(
        'contactFormId'   => "{$wpdb->posts}.ID",
        'contactFormName' => "{$wpdb->posts}.post_title",
    );
    $orderByKey = (!empty($data['orderby']) && isset($allowedOrderBy[$data['orderby']]))
        ? $data['orderby']
        : 'contactFormId';
    $orderByColumn = $allowedOrderBy[$orderByKey];

    $order = (!empty($data['order']) && strtoupper($data['order']) === 'ASC') ? 'ASC' : 'DESC';

    $limit = (!empty($data['limit'])) ? max(1, intval($data['limit'])) : 10;
    $page  = (!empty($data['page']))  ? max(1, intval($data['page'])) : 1;
    $offset = ($page - 1) * $limit;

    $optionLike = $wpdb->esc_like('es_config_contactform7_active_') . '%';

    $filterSql = '';
    $filterArgs = array();
    if (!empty($data['filter'])) {
        $filterSql = " AND {$wpdb->posts}.post_title LIKE %s ";
        $filterArgs[] = '%' . $wpdb->esc_like($data['filter']) . '%';
    }

    $queryCount = $wpdb->prepare(
        "SELECT count(option_id) as count
         FROM {$wpdb->options}
         WHERE {$wpdb->options}.option_name LIKE %s",
        $optionLike
    );

    $querySql = "
        SELECT {$wpdb->options}.option_value,
            {$wpdb->posts}.ID as contactFormId,
            {$wpdb->posts}.post_title as contactFormName
        FROM {$wpdb->options}
        INNER JOIN {$wpdb->posts}
            ON ({$wpdb->posts}.post_type = 'wpcf7_contact_form'
                AND {$wpdb->posts}.ID = (SUBSTRING_INDEX({$wpdb->options}.option_name, 'es_config_contactform7_active_', -1))
                {$filterSql}
            )
        WHERE {$wpdb->options}.option_name LIKE %s
        ORDER BY {$orderByColumn} {$order}
        LIMIT %d, %d
    ";

    $queryArgs = array_merge($filterArgs, array($optionLike, $offset, $limit));
    $query = $wpdb->prepare($querySql, $queryArgs);

    $countForms = $wpdb->get_results($queryCount);
    $forms = array();
    $forms['count'] = $countForms[0]->count;
    if ($forms['count'] > 0) {
        $forms['forms'] = $wpdb->get_results($query);
    } else {
        $forms['forms'] = null;
    }

    return $forms;
}

function contactsform7_delete($req) {
    $data = $req->get_params();
    $id = $data['id'];
    try {
        delete_option('es_config_contactform7_active_'.$id);
        return new WP_REST_Response(['status'=>'ok'], 200);
    } catch (\Throwable $th) {
        return new WP_REST_Response(['status'=>'error'], 500);
    }
}
/*-----------------*/