function callback_form(param) {
  var container = document.querySelector('.form-wrapper');
  var containerForm = document.querySelector('.contact-form');
  console.log(container.contains(event.target));
  if (!(containerForm.contains(event.target)) && container.style.display != param) container.style.display=param;
}

function setCursorPosition(pos, elem) {
  elem.focus();
  if (elem.setSelectionRange) elem.setSelectionRange(pos, pos);
  else if (elem.createTextRange) {
      var range = elem.createTextRange();
      range.collapse(true);
      range.moveEnd("character", pos);
      range.moveStart("character", pos);
      range.select()
  }
}

function mask(event) {
  var matrix = this.defaultValue,
      i = 0,
      def = matrix.replace(/\D/g, ""),
      val = this.value.replace(/\D/g, "");
      def.length >= val.length && (val = def);
  matrix = matrix.replace(/[_\d]/g, function(a) {
      return val.charAt(i++) || "_"
  });
  this.value = matrix;
  i = matrix.lastIndexOf(val.substr(-1));
  i < matrix.length && matrix != this.defaultValue ? i++ : i = matrix.indexOf("_");
  setCursorPosition(i, this)
}
document.getElementById('phone_2020').addEventListener("input", mask, false);

function getXmlHttp() {
var xmlhttp;
try {
  xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
} catch (e) {
try {
  xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
} catch (E) {
  xmlhttp = false;
}
}
if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
  xmlhttp = new XMLHttpRequest();
}
return xmlhttp;
}

function sendciba(){
      event.preventDefault(); 
      let  form = document.getElementById('contact-form_1'); 
      let param = new Map();  // обьявляем пустой массив
for (let a = 0; a < (form.elements.length); a++){ 
      if (form.elements[a].name) {
      param[form.elements[a].name] = form.elements[a].value;

  }
}
var data = [
      'sendform='+JSON.stringify(param),
  ]
    var url = 'smssend.php'; 
    var xmlhttp = getXmlHttp(); 
    xmlhttp.open('POST', url, true); 
    xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded'); 
    xmlhttp.send(data.join('&'));
    printResponce = document.getElementById('responce_form');  
    xmlhttp.onreadystatechange = function() { 
      if (xmlhttp.readyState == 4) { 
        if(xmlhttp.status == 200) { 
            result = (JSON.parse(xmlhttp.responseText)); 
            
              printResponce.textContent = result['message'];
        }else{
              printResponce.textContent = result['message'];
        }
      } 
        setTimeout(function(){
            printResponce.textContent = '';
        },1500)
    };
// $.ajax({
//     url: 'smssend.php',
//     type: 'POST',
//     data: {sendform: JSON.stringify(param)},
//     success: function(data,textStatus){
//     alert(data);
//     },
//     error: function(object,textStatus,errorThrown){
//     alert(object);
//     }
// });

}


