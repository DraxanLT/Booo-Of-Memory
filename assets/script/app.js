

var screenSize = window.innerWidth;  

console.log(screenSize);  

if (screenSize >= 600) {  
  particlesJS.load('particles-js', '/assets/script/particles.json', function() {
    console.log('callback - particles.js config loaded');
  });
} else {
  console.log("none");  
}