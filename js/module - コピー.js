window.onload = function() {
  /*
  var menuObj = new Array();
  
  for (var i=1 ; i < 4 ; ++i){
    menuObj[i] = document.getElementById("menu"+i);

    menuObj[i].onmouseover = function() {
      menuObj[i].style.backgroundColor = '#707070';
    };
    
    menuObj[i].onmouseout = function() {
      menuObj[i].style.backgroundColor = '#585858';
    };
    
    menuObj[i].onclick = function() {
      alert(menuObj[i].getAttribute("_target"));
    };
    
  } /* */
  
  menuObj1 = document.getElementById("menu1");
  menuObj2 = document.getElementById("menu2");
  menuObj3 = document.getElementById("menu3");

  menuObj1.onmouseover = function() {
    menuObj1.style.backgroundColor = '#707070';
  };
  menuObj2.onmouseover = function() {
    menuObj2.style.backgroundColor = '#707070';
  };
  menuObj3.onmouseover = function() {
    menuObj3.style.backgroundColor = '#707070';
  };
  
  menuObj1.onmouseout = function() {
    menuObj1.style.backgroundColor = '#585858';
  };
  menuObj2.onmouseout = function() {
    menuObj2.style.backgroundColor = '#585858';
  };
  menuObj3.onmouseout = function() {
    menuObj3.style.backgroundColor = '#585858';
  };
  
  menuObj1.onclick = function() {
    alert(menuObj1.getAttribute("_target"));
  };
  menuObj2.onclick = function() {
    alert(menuObj2.getAttribute("_target"));
  };
  menuObj3.onclick = function() {
    alert(menuObj3.getAttribute("_target"));
  };
};