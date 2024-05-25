
let form = document.querySelector('form')
let resultBox = document.querySelector('.result')
let loader = document.querySelector('.loader')
let copyButton = document.querySelector('button.copy')

document.querySelector('.createNew').addEventListener('click', (event)=>{
    form.querySelector('input').value = ''
    resultBox.style.display = "none"
    form.style.display = "flex" 
})

document.querySelector('button.submit').addEventListener('click', (e)=>{
    e.preventDefault()
    loader.style.display = "block"
    form.style.display = "none" 

    content = new FormData;
    content.append('url', document.getElementById('link').value)

    api = "../../src/Api/CreateLink.php"
    fetch(api,{
        method: "POST",
        body: content,
    })
    .then(resp => resp.json())
    .then((data) => {
        loader.style.display = "none"
        resultBox.style.display = "block"
        console.log(data)

        resultBox.querySelector('h4').innerText = 'https://os.jor.br/' + data.token
    })
})

copyButton.addEventListener('click', ()=>{
    link = resultBox.querySelector('h4').innerText
    navigator.clipboard.writeText(link)

    copyButton.className = "copy active"
    copyButton.innerHTML = '<i class="fa fa-check"></i> Copiado'
    setTimeout(()=>{
        copyButton.className = "copy"
        copyButton.innerHTML = '<i class="fa fa-copy"></i> Copiar'
    },2000)    
})
    