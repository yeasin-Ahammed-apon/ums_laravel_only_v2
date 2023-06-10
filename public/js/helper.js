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
