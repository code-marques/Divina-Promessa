//vars
var contator = 0;
var contator_2 = 0;
var contator_3 = 0;
var sub_post_barra = document.getElementsByClassName('sub-posts-barra');
var arrow = document.getElementsByClassName('arrow');

//dropdown

function posts(a){
  contator = contator + a;
  if(contator == 1) {
    sub_post_barra[0].style = "top: 0px; height: auto;";
    arrow[0].innerHTML = "&larr;";

  } else {
    sub_post_barra[0].style = "top: -2000px; height: 0px;";
    arrow[0].innerHTML = "&darr;";
    contator = 0;
  }
}

function contatos(b){
  contator_2 = contator_2 + b;
  if(contator_2 == 1) {
    sub_post_barra[1].style = "top: 0px; height: auto;";
    arrow[1].innerHTML = "&larr;";
  } else {
    sub_post_barra[1].style = "top: -2000px; height: 0px;";
    arrow[1].innerHTML = "&darr;";
    contator_2 = 0;
  }
}

function eventos(c){
  contator_3 = contator_3 + c;
  if(contator_3 == 1) {
    sub_post_barra[2].style = "top: 0px; height: auto;";
    arrow[2].innerHTML = "&larr;";
  } else {
    sub_post_barra[2].style = "top: -2000px; height: 0px;";
    arrow[2].innerHTML = "&darr;";
    contator_3 = 0;
  }
}

function atribuir_opcoes(a){  
  if(a == "") {
    var option = document.getElementById('response-option');
    option.innerHTML = '<option>Escolha um semestre</option>'
  } else {
    if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              var option = document.getElementById('response-option');              
              option.innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","../paginas/materlista.php?sem="+a,true);
        xmlhttp.send();
  }
}