<?php
/**
 * Formação Full Stack PHP Developer UpInside
 * @author Robson V. Leite <https://www.upinside.com.br>
 *
 * Document content and charset
 */
header("Content-Type: text/html; charset=utf-8");

/**
 * [ PHP Basic Config ] Configurações basicas do sistema
 * Configura o timezone da aplicação
 */
date_default_timezone_set("America/Sao_Paulo");

ini_set("display_errors", 1);
ini_set("error_reporting", E_ALL);
ini_set('xdebug.overload_var_dump', 1);


/**
 * [ php config ] Altera modo de erro e exibição do var_dump.
 * display_errors: Erros devem ser exibidos.
 * error_reporting: Todos os tipos de erros
 * overload_var_dump: Omitir a linha de caminho do var_dump.
 */
ini_set("display_errors", 1);
ini_set("error_reporting", E_ALL);
ini_set('xdebug.overload_var_dump', 1);

const GOOGLE_CLIENT_ID = 'seu_cliente_id';
const GOOGLE_CLIENT_SECRET = 'sua_chave_secreta';
const GOOGLE_CLIENT_REDIRECT_URL = 'sua_url';