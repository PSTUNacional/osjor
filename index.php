<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Encurtador de links | Opinião Socialista</title>
    <base href=".">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <h1>Encurtador de links</h1>
    <div class="result">
        <h6>Link criado com sucesso!</h6>
        <h4>https://os.jor.br/</h4>
        <div>
            <button class="copy"><i class="fa fa-copy"></i> Copiar</button>
            <button class="createNew secondary"><i class="fa fa-plus"></i> Criar novo</button></div>
    </div>
    <form>
        <input type="text" name="url" id="link"/>
        <button class="submit"><i class="fa fa-link"></i> Encurtar</button>
    </form>
    <div class="loader"></div> 
    <script src="assets/js/functions.js"></script>
</body>
</html>