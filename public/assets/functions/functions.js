document.addEventListener("DOMContentLoaded", function(){

  $('#signUp').on('shown.bs.modal', function () {
    $('#signUpModal').trigger('focus');
  });

    let allEvents = Array.from(document.getElementsByClassName("card"));
    let addToCartbuttons = Array.from(document.querySelectorAll('#addToCart'));
    let eventId = Array.from(document.getElementsByClassName('eventId'));
    let eventName = Array.from(document.getElementsByClassName('eventName'));
    let eventPrice = Array.from(document.getElementsByClassName('eventPrice'));

    let elements = {eventId, eventName, eventPrice, addToCartbuttons};

    if(getCookie("cart") != null){
      var data = [];
      theCart = getCookie("cart");
      let theCart1 = JSON.parse(theCart);
      for(let i = 0; i < theCart1.length; i++){
        data.push(theCart1[i]);
      }
    }else{
      console.log("Finns Inte");
      var data = [];
    }

    let removeFromCartButtons = Array.from(document.getElementsByClassName('removeCartButton'));

    for(let i=0;i < removeFromCartButtons.length;i++){
      removeFromCartButtons[i].addEventListener("click", function(){
        let id = document.getElementById("removeCartId"+i).innerText;
        id = parseInt(id, 10);
        removeFromCart(id);
      });
    }

    /*

      TO DO LIST:
      TO DO LIST:
      TO DO LIST:
      TO DO LIST:
      TO DO LIST:
      TO DO LIST:
      
      Se till att input fältet med antal biljetter är ifylld ( Loopa igenom data variabeln och kolla om värdet i ['eventId'] finns fler gånger i arrayen. En for loop i en for loop
      
      for(let i=0; i < "arrayen.length"; i++){
        "let value = arrayen[i][eventId];"
        for(let a=0; a < "arrayen.length"; a++){
          if(value == arrayen[a]){
            Gör nåt
          }
        }
      }

    */
    
  function removeFromCart(cartItemNr){
    if(data.length == 1){
      document.cookie = "cart="+ JSON.stringify(data) + "; expires= Thu, 21 Aug 2014 20:00:00 UTC;";
    }else{
      data.pop(cartItemNr);
      document.cookie = "cart="+ JSON.stringify(data);
    }
    location.reload();
  } 

  for(let i = 0; i < allEvents.length; i++){
    elements["addToCartbuttons"][i].addEventListener('click', function(){
    data.push(
      {
        "eventId": elements["eventId"][i].value,
        "eventName": elements["eventName"][i].innerText,
        "eventPrice": elements["eventPrice"][i].innerText,
      }
     );
       document.cookie = "cart="+ JSON.stringify(data);
  });
}

function getCookie(cname) {
  var name = cname + "=";
  var decodedCookie = decodeURIComponent(document.cookie);
  var ca = decodedCookie.split(';');
  for(var i = 0; i <ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return 0;
}


});