$(".button").click(function() {
  $(".social.twitter").toggleClass("clicked");
  $(".social.facebook").toggleClass("clicked");
  $(".social.google").toggleClass("clicked");
  $(".social.youtube").toggleClass("clicked");
});

let form = document.getElementById("formulaire");
let emaildest = document.getElementById("emailexpe");
let emailexpe = document.getElementById("emaildest");
let message = document.getElementById("message");

form.addEventListener("submit", function(e) {
  // e.preventDefault();

  if (
    !emaildest.value.match(
      /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/
    )
  ) {
    alert("Tapez un email valable");
    email.style.borderColor = "red";
  } else if (
    !emailexpe.value.match(
      /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/
    )
  ) {
    alert("Tapez un email valable");
    email.style.borderColor = "red";
  } else if (!message.value.match(/^[a-zA-Z ]+$/)) {
    alert("Pensez à taper un message !");
    message.style.borderColor = "red";
  } else if (
    emaildest.value.match(
      /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/
    ) &&
    emailexpe.value.match(
      /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/
    ) &&
    message.value.match(/^[a-zA-Z ]+$/)
  ) {
    form.submit();
    console.log("form submitted");
  } else {
    alert("Veuillez remplir correctement tous les champs");
  }
});

let popup = document.querySelector(".popup");
popup.addEventListener("click", function(e) {
  popup.classList.add("none");
});


let upload = document.querySelector('#upload');

let children = [];
function displayFileName(element, children, parent){
    const p = document.createElement("p");
    p.innerHTML = element.name;
    parent.appendChild(p);
    children.push(element.name);
}

document.querySelector("#file").addEventListener("change", function(e) {
  for (let i = 0; i < this.files.length; i++) {
    const items = document.querySelector("#items");
    const element = this.files[i];

    if (children.length !== 0) {
      if (!children.includes(element.name)) {
        displayFileName(element, children, items);
      }
    } 
    else {
        displayFileName(element, children, items);
    }
  }
  upload.innerHTML = "Votre envoi :"
});
