document.addEventListener('DOMContentLoaded',function(){
  var t=document.querySelector('.nav-toggle'),m=document.querySelector('.nav-menu');
  if(t&&m){t.addEventListener('click',function(){m.classList.toggle('open');});}
});
