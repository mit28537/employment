window.onload = function() {

  menuObj1 = document.getElementById("menu1");
  menuObj2 = document.getElementById("menu2");
  menuObj3 = document.getElementById("menu3");
  menuObj4 = document.getElementById("menu4");

  menuObj1.onmouseover = function() {
    menuObj1.style.backgroundColor = '#707070';
    menuObj1.style.color = '#000000';
  };
  menuObj2.onmouseover = function() {
    menuObj2.style.backgroundColor = '#707070';
    menuObj2.style.color = '#000000';
  };
  menuObj3.onmouseover = function() {
    menuObj3.style.backgroundColor = '#707070';
    menuObj3.style.color = '#000000';
  };
  menuObj4.onmouseover = function() {
    menuObj4.style.backgroundColor = '#707070';
    menuObj4.style.color = '#000000';
  };
  
  menuObj1.onmouseout = function() {
    menuObj1.style.backgroundColor = '#585858';
    menuObj1.style.color = '#FFFFFF';
  };
  menuObj2.onmouseout = function() {
    menuObj2.style.backgroundColor = '#585858';
    menuObj2.style.color = '#FFFFFF';
  };
  menuObj3.onmouseout = function() {
    menuObj3.style.backgroundColor = '#585858';
    menuObj3.style.color = '#FFFFFF';
  };
  menuObj4.onmouseout = function() {
    menuObj4.style.backgroundColor = '#585858';
    menuObj4.style.color = '#FFFFFF';
  };
  
  menuObj1.onclick = function() {
    location.href = menuObj1.getAttribute("_target");
  };
  menuObj2.onclick = function() {
    location.href = menuObj2.getAttribute("_target");
  };
  menuObj3.onclick = function() {
    location.href = menuObj3.getAttribute("_target");
  };
  menuObj4.onclick = function() {
    location.href = menuObj4.getAttribute("_target");
  };
  
};

function changeBgColor( id, color ){
  document.getElementById(id).style.backgroundColor = color;
}