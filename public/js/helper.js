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
