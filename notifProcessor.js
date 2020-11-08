let myblock = document. querySelectorAll('.errBlock');
myblock.forEach(block => block. addEventListener('click', removeBlock));
function removeBlock() {
    let block = this;
    block.style.opacity = 1;
    let blocked = setInterval(function() {
        if (block.style.opacity > 0) block.style.opacity -= .1;
        else {
            block.remove();
        }
    }, 60)
}
