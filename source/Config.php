<?php

/**
 * DATABASE
 */


    define("CONF_DB_HOST", "www.hgmrastreadores.com.br");
    define("CONF_DB_USER", "hgmras52_dflix");
    define("CONF_DB_PASS", "dflix7778");
    define("CONF_DB_NAME", "hgmras52_dflix");




/**
 * PROJECT URLs
 */
define("CONF_URL_BASE", "https://www.localhost/hgmrastreadores");
define("CONF_URL_BASE_ADMIN", "http://www.localhost/hgmrastreadores/admin");
define("CONF_URL_BASE_DELIVERY", "https://www.localhost/hgmrastreadores/delivery");
define("CONF_URL_APP", "https://www.localhost/hgmrastreadores/admin");
define("CONF_URL_TEST", "https://www.localhost/hgmrastreadores");
define("CONF_URL_ADMIN", "/admin");
define("LINK_ASSETS_APP", "https://www.localhost/hgmrastreadores/admin");

/**
 * SITE
 */
define("CONF_SITE_NAME", "HGM Rastreadores");
define("CONF_SITE_TITLE", "HGM Rastreadores com Seguro");
define("CONF_SITE_DESC",
        "Rastreador com seguro para veiculos e caminhão melhor custo beneficio do mercado, rastreador com seguro é HGM Rastreadores");
define("CONF_SITE_LANG", "pt_BR");
define("CONF_SITE_DOMAIN", "hgmrastreadores.com.br");
define("CONF_SITE_ADDR_STREET", "Av Gago Coutinho");
define("CONF_SITE_ADDR_NUMBER", "544");
define("CONF_SITE_ADDR_COMPLEMENT", "sobreloja");
define("CONF_SITE_ADDR_CITY", "Santo André");
define("CONF_SITE_ADDR_STATE", "SP");
define("CONF_SITE_ADDR_ZIPCODE", "09070-000");




/**
 * DATES
 */
define("CONF_DATE_BR", "d/m/Y H:i:s");
define("CONF_DATE_APP", "Y-m-d H:i:s");

/**
 * PASSWORD
 */
define("CONF_PASSWD_MIN_LEN", 8);
define("CONF_PASSWD_MAX_LEN", 40);
define("CONF_PASSWD_ALGO", PASSWORD_DEFAULT);
define("CONF_PASSWD_OPTION", ["cost" => 10]);

/**
 * VIEW
 */
define("CONF_VIEW_PATH", __DIR__ . "/../../shared/views");
define("CONF_VIEW_EXT", "php");
define("CONF_VIEW_THEME", "default");
define("CONF_VIEW_APP", "http://www.localhost/hgmrastreadores/themes/admin");
//define("CONF_VIEW_APP", "cafeapp");

/**
 * UPLOAD
 */
define("CONF_UPLOAD_DIR", "storage");
define("CONF_UPLOAD_IMAGE_DIR", "images");
define("CONF_UPLOAD_FILE_DIR", "files");
define("CONF_UPLOAD_MEDIA_DIR", "medias");

/**
 * IMAGES
 */
define("CONF_IMAGE_CACHE", CONF_UPLOAD_DIR . "/" . CONF_UPLOAD_IMAGE_DIR . "/cache");
define("CONF_IMAGE_SIZE", 2000);
define("CONF_IMAGE_QUALITY", ["jpg" => 75, "png" => 5]);

/**
 * MAIL
 */
define("CONF_MAIL_HOST", "mail.hgmrastreadores.com.br");
define("CONF_MAIL_PORT", "587");
define("CONF_MAIL_USER", "send@hgmrastreadores.com.br");
define("CONF_MAIL_PASS", "dflix7778");
define("CONF_MAIL_SENDER", ["name" => "HGM Rastreadores", "address" => "contato@hgmrastreadores.com.br"]);
define("CONF_MAIL_SUPPORT", "contato@hgmrastreadores.com.br");
define("CONF_MAIL_OPTION_LANG", "br");
define("CONF_MAIL_OPTION_HTML", true);
define("CONF_MAIL_OPTION_AUTH", true);
define("CONF_MAIL_OPTION_SECURE", "tls");
define("CONF_MAIL_OPTION_CHARSET", "utf-8");

/**
 * PAGAR.ME
 */
define("CONF_PAGARME_MODE", "test");
define("CONF_PAGARME_LIVE", "ak_live_bAB9hNqoiNEtF7Ox8zDEToDiWtHBly");
define("CONF_PAGARME_TEST", "ak_test_bAB9hNqoiNEtF7Ox8zDEToDiWtHBly");
define("CONF_PAGARME_BACK", CONF_URL_BASE) . "/pay/callback";



