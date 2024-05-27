<?php

use OSJ\Service\LinkService;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require('autoload.php');

$linkService = new LinkService;
$osAPI = "https://www.opiniaosocialista.com.br/wp-json/wp/v2/posts";
$osJson = file_get_contents($osAPI);
$osJson = json_decode($osJson, TRUE);
?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
    *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    
    body {
        background-color: #ECE5DD;
        padding:48px;
        font-family: sans-serif;
    }

    .report-card {
        border-radius: 24px;
        max-width: 540px;
        box-shadow: 0 1px 3px 0 #0003;
        max-height: 720px;
        overflow: hidden;
        background-color: #DCF8C6;
        position:relative;
    }
    .report-card .content{
        padding: 24px 24px 128px 24px;
        overflow-y: scroll;
        height: 100%;
        max-height: 720px;
    }
    .report-card .actions{
        display: flex;
        align-items: center;
        justify-content: center;
        gap:8px;
        width: 100%;
        position: absolute;
        z-index: 2;
        bottom: 0;
        padding:24px;
        background: linear-gradient(0deg, #000, #0000);
        opacity: 0;
        transition: all .3s ease-in-out;
    }

    .report-card:hover .actions{
        opacity: 1;
        transition: all .3s ease-in-out;
    }
    .btn{
        padding: 12px 24px;
        border-radius: 8px;
        width: fit-content;
        cursor: pointer;
    }

    .btn.copy{
        background-color: #fff;
        color: #090;
    }
    .btn.share{
        background-color:#090;
        color: #fff;
    }
</style>
<div class="report-card">
    <div class="actions">
        <a class="btn copy"><i class="fa fa-copy"></i> Copiar</a>
        <a class="btn share"><i class="fab fa-whatsapp"></i> WhatsApp</a>
    </div>
    <div class="content">
    <?php

    echo "\u{1F4CC} <b>Confira as últimas notícias do Opinião Socialista</b><br/><br/>";
    foreach ($osJson as $post) {

        $url = $post['link'] . "?utm_source=whatsapp";
        $url = $linkService->registerLink($url);
        $url = "https://os.jor.br/" . $url;

        echo "\u{2B55} <b>" . $post['title']['rendered'] . "</b><br/>" . $url . "<br/><br/>";
    }

    echo "\u{270A}\u{1F3FE} Acompanhe nossas publicações nas redes: \u{270A}\u{1F3FE}\u{1F6A9}<br/><br/>
\u{1F449}\u{1F3FE} Site<br/>
http://www.opiniaosocialista.org.br
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

    echo "------------------------<br/>Envie sua sugestão de pauta. Mantenha o nosso número salvo.
<br/><br/>    
Recebeu esta mensagem de amigos e gostaria de receber outras? Clique: https://os.jor.br/whatsapp
<br/><br/>
<b>Jornal Opinião Socialista</b>, órgão oficial de imprensa do PSTU.";

    ?>
</div></div>

<script>
document.querySelector('.btn.copy').addEventListener('click',()=>{
    copyButton = event.target
    console.log(copyButton)
    text = copyButton.parentElement.parentElement.querySelector('.content').innerText
    navigator.clipboard.writeText(text)

    copyButton.innerHTML = '<i class="fa fa-check"></i> Copiado'
    setTimeout(() => {
        copyButton.innerHTML = '<i class="fa fa-copy"></i> Copiar'
    }, 2000)
})

document.querySelector('.btn.share').addEventListener('click',()=>{
    shareButtons = event.target
    console.log(shareButtons)
    text = shareButtons.parentElement.parentElement.querySelector('.content').innerText
    link = encodeURI('https://wa.me/send?text='+text)
    window.open(link,'_blank').focus()

})

</script>
