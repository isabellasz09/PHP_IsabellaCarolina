function mascara(o,f){
    //define o objeto e chama a função
    objeto=o
    funcao=f
    setTimeout("executaMascara()",1)

}

function executaMascara(){
    objeto.value=funcao(objeto.value)
}

//mascaras
//telefone

function nome(variavel){
    variavel=variavel.replace(/\d/g,"")
    return variavel
}


function telefone(variavel){
    variavel=variavel.replace(/\D/g,"")
    variavel=variavel.replace(/^(\d\d)(\d)/g,"($1) $2") 
    //adiciona parenteses em volta dos dois primeiros digitos
    variavel=variavel.replace(/(\d{4})(\d)/,"$1-$2") 
    //adiciona hifem entre o quarto e o quinto digito 
    return variavel
}

function cnpj(variavel){
    variavel=variavel.replace(/\D/g,"")
    variavel=variavel.replace(/(\d{2})(\d)/,"$1.$2") 
    variavel=variavel.replace(/(\d{3})(\d)/,"$1.$2")
    variavel=variavel.replace(/(\d{3})(\d)/,"$1/$2")
    variavel=variavel.replace(/(\d{4})(\d)/,"$1.$2")
    variavel=variavel.replace(/(\d{3})(\d)/,"$1-$2")
    return variavel
}

function numero(variavel){
    variavel=variavel.replace(/\D/g,"")
    return variavel
}

function bairro(variavel){
    variavel=variavel.replace(/\d/g,"")
    return variavel
}

function cidade(variavel){
    variavel=variavel.replace(/\d/g,"")
    return variavel
}

function estado(variavel){
    variavel=variavel.replace(/\d/g,"")
    return variavel
}

function cep(variavel){
    variavel=variavel.replace(/\D/g,"")//remove caracteres não numericos
    variavel=variavel.replace(/(\d{2})(\d)/,"$1.$2") 
    variavel=variavel.replace(/(\d{3})(\d)/,"$1-$2") 
    return variavel
}