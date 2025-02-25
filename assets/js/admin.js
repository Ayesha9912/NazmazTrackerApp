console.log("clickes");

let msg = document.querySelectorAll('#msg');

setTimeout(() => {
    msg.forEach(item => {
        item.style.display = 'none';
    });
}, 3000);


function previewMode(){
  let content = document.querySelector('#preview_content').value;
  document.querySelector('#preview').innerHTML = content;
} 


