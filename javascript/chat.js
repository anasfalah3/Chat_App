const form = document.querySelector(".typing-area"),
inputField = form.querySelector(".input-field"),
sendBtn = form.querySelector("button"),
chatBox = document.querySelector(".chat-box");

form.onsubmit = (e)=>{
      e.preventDefault(); //preventing form from submiting
}

sendBtn.onclick = ()=>{
            //ajax
      let xhr = new XMLHttpRequest(); //creating xml object
      xhr.open("POST", "php/insert-chat.php", true);
      xhr.onload = ()=>{
            if (xhr.readyState === XMLHttpRequest.DONE) {
                  if (xhr.status === 200) {
                        inputField.value = ""; // clear input after sending the message
                        scrollToBottom();
                  }
            }
      }
      // we have to send the form data through ajax to php
      let formData = new FormData(form); //creating new formData objext
      xhr.send(formData); // sending the form data to php

}

chatBox.onmouseenter = () =>{
      chatBox.classList.add("active");
}
chatBox.onmouseleave = () =>{
      chatBox.classList.remove("active");
}


setInterval(() => {
  //ajax
  let xhr = new XMLHttpRequest(); //creating xml object
  xhr.open("POST", "php/get-chat.php", true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.response;
        //console.log(data);
        chatBox.innerHTML = data;
        if (!chatBox.classList.contains("active")) { // if active class not contains in chatbox the scroll to bottom
            scrollToBottom();
        }
      }
    }
  };
  // we have to send the form data through ajax to php
  let formData = new FormData(form); //creating new formData objext
  xhr.send(formData); // sending the form data to php
}, 500);

function scrollToBottom() {
      
      chatBox.scrollTop = chatBox.scrollHeight;
}