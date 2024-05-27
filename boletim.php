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

    if(window.mobileCheck()){
        link = 'https://wa.me/send?text='+text
    } else {
        link = 'whatsapp://send?text='+text
    }
    link = encodeURI()
    window.open(link,'_blank').focus()

})

window.mobileCheck = function() {
  let check = false;
  (function(a){if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4))) check = true;})(navigator.userAgent||navigator.vendor||window.opera);
  return check;
};

</script>
