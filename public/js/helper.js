// queryselector
const selector = ($param) => document.querySelector($param);
// disable button for action
const disableButton = (button) => {
    setTimeout(() => {
        button.disabled = true;
    }, 1);
    setTimeout(() => {
        button.disabled = false;
    }, 10000);
}

document.addEventListener('keydown', function(event) {
    if (event.ctrlKey && event.key === 'y') {
      // Call your function here
      yourFunction();
    }
  });
  function  yourFunction(){
    console.log("apon is calling");
  }


  // -------------------animation----------------------------------------
  var box = document.getElementById('animatedBox');
  var colors = ['rgb(6, 122, 255,0.1)', 'rgb(7, 9, 234)', ]; // Array of colors
  function animateBorderColor(index) {
      box.style.borderColor = colors[index];
      box.style.boxShadow = '0 0 20px ' + colors[index]; // Update box shadow color
      index = (index + 1) % colors.length; // Increment index and wrap around the array length
      setTimeout(function() {
          animateBorderColor(index); // Recursive call to continue the animation
      }, 7000);
  }
  animateBorderColor(0); // Start the animation at index 0
