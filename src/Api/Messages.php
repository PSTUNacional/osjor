<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

use OSJ\Service\LinkService;

require($_SERVER['DOCUMENT_ROOT'].'/autoload.php');
$linkService = new LinkService;

$messages = [];

/* =================================

    Last posts 

================================= */
$osAPI = "https://www.opiniaosocialista.com.br/wp-json/wp/v2/posts";
$osJson = file_get_contents($osAPI);
$osJson = json_decode($osJson, TRUE);

$messages[0] = "\u{1F4CC} <b>Confira as últimas notícias do Opinião Socialista</b><br/><br/>";
foreach ($osJson as $post) {

    $url = $post['link'] . "?utm_source=whatsapp";
    $url = $linkService->registerLink($url);
    $url = "https://os.jor.br/" . $url;

    $messages[0] .= "\u{2B55} <b>" . $post['title']['rendered'] . "</b><br/>" . $url . "<br/><br/>";
}

$messages[0] .= "\u{270A}\u{1F3FE} Acompanhe nossas publicações nas redes: \u{270A}\u{1F3FE}\u{1F6A9}<br/><br/>
\u{1F449}\u{1F3FE} Site<br/>
https://www.opiniaosocialista.com.br
<br/><br/>
\u{1F449}\u{1F3FE} Whatsapp<br/>
https://os.jor.br/whatsapp
<br/><br/>
\u{1F449}\u{1F3FE} Canal Whatsapp<br/>
https://os.jor.br/wpcanal
<br/><br/>
\u{1F449}\u{1F3FE} Telegram<br/>
https://os.jor.br/telegram
<br/><br/>
\u{1F449}\u{1F3FE} Facebook<br/>
https://os.jor.br/facebook
<br/><br/>
\u{1F449}\u{1F3FE} Twitter<br/>
https://os.jor.br/twitter
<br/><br/>
\u{1F449}\u{1F3FE} Instagram<br/>
https://os.jor.br/insta
<br/><br/>
\u{1F449}\u{1F3FE} YouTube<br/>
https://os.jor.br/youtube
<br/><br/>";

$messages[0] .= "------------------------<br/>Envie sua sugestão de pauta. Mantenha o nosso número salvo.
<br/><br/>    
Recebeu esta mensagem de amigos e gostaria de receber outras? Clique: https://os.jor.br/whatsapp
<br/><br/>
<b>Jornal Opinião Socialista</b>, órgão oficial de imprensa do PSTU.";

/* =================================

    Last OS Edition

================================= */

$lastEd = "https://www.opiniaosocialista.com.br/archive/pdf/getlastpdf.php";
$lastEd = file_get_contents($lastEd);
$lastEd = json_decode($lastEd, TRUE);
$lastEd = $lastEd[0];

$tagId = 'https://www.opiniaosocialista.com.br/wp-json/wp/v2/tags?search=os' . $lastEd;
$tagId = file_get_contents($tagId);
$tagId = json_decode($tagId, TRUE);
$tagId = $tagId[0]['id'];

$posts = "https://www.opiniaosocialista.com.br/wp-json/wp/v2/posts?tags=" . $tagId . '&per_page=50';
$posts = file_get_contents($posts);
$posts = json_decode($posts, TRUE);

$messages[1] = "\u{1F4F0} <b>SAIU O OPINIÃO SOCIALISTA Nº" . $lastEd . "</b><br/><br/>";

foreach ($posts as $post) {
    if (in_array("Editorial", $post['categories_names'])) {
        $url = $linkService->registerLink($post['link'] . '?utm_source=whatsapp');
        $messages[1] .= "\u{2712} <b>EDITORIAL</b><br/>" . $post['title']['rendered'] . '<br/>https://os.jor.br/' . $url . '<br/><br/>';
    }
}

$messages[1] .= "\u{1F4CC} <b>NESTA EDIÇÃO</b><br/><br/>";

foreach ($posts as $post) {
    if (!in_array("Editorial", $post['categories_names'])) {
        $url = $linkService->registerLink($post['link'] . '?utm_source=whatsapp');
        $messages[1] .= "\u{1F4CD} <b>" . $post['categories_names'][0] . "</b><br/>" . $post['title']['rendered'] . '<br/>https://os.jor.br/' . $url . '<br/><br/>';
    }
}

$messages[1] .= "---------------<br/>\u{1F4F0} Adquira com qualquer militante do PSTU ou leia em nosso Portal<br/>www.opiniaosocialista.com.br/edicao/".$lastEd;

/* =================================

    Colunas

================================= */

$colunas = "https://www.opiniaosocialista.com.br/wp-json/wp/v2/posts?categories=1602&per_page=5";
$colunas = file_get_contents($colunas);
$colunas = json_decode($colunas, TRUE);

$messages[2] = "\u{1F4CC} <b>Confira as últimas colunas do Opinião Socialista</b><br/><br/>";

foreach ($colunas as $post) {
    if (!in_array("Editorial", $post['categories_names'])) {
        $url = $linkService->registerLink($post['link'] . '?utm_source=whatsapp');
        $messages[2] .= "\u{270F} <b>" . explode(",", $post['author_name'])[0] . "</b><br/>" . $post['title']['rendered'] . '<br/>https://os.jor.br/' . $url . '<br/><br/>';
    }
}
$messages[2] .= "---------------<br/><br/>Leia mais no nosso site<br/>www.opiniaosocialista.com.br";

header('Content-Type: application/json; charset=utf-8');
echo json_encode($messages);
