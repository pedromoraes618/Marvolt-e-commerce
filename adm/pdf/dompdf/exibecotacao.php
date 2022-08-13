<?php
function exibecotacao()
{
// chamando os arquivos necessários do DOMPdf
require_once 'lib/html5lib/Parser.php';
require_once 'lib/php-font-lib-master/src/FontLib/Autoloader.php';
require_once 'lib/php-svg-lib-master/src/autoload.php';
require_once 'src/Autoloader.php';

// definindo os namespaces
Dompdf\Autoloader::register();
use Dompdf\Dompdf;
// inicializando o objeto Dompdf
$dompdf = new Dompdf();
// coloque nessa variável o código HTML que você quer que seja inserido no PDF
$codigo_html = $html;
// carregamos o código HTML no nosso arquivo PDF
$dompdf->loadHtml($codigo_html);
// (Opcional) Defina o tamanho (A4, A3, A2, etc) e a oritenação do papel, que pode ser 'portrait' (em pé) ou 'landscape' (deitado)
$dompdf->setPaper('A4', 'portrait');
// Renderizar o documento
$dompdf->render();
// pega o código fonte do novo arquivo PDF gerado
$output = $dompdf->output();
// defina aqui o nome do arquivo que você quer que seja salvo
file_put_contents("cotacao.pdf", $output);
// redirecionamos o usuário para o download do arquivo
die("<script>location.href='cotacao.pdf';</script>");
}
?>