setTimeout(
    () => {
        let myblock = document. querySelectorAll('.errBlock');
        let myblock2 = document. querySelectorAll('.succBlock');
        myblock2.forEach(block => removeBlock(block));
        myblock.forEach(block => removeBlock(block));
        function removeBlock(blocker) {
            let block = blocker;
            block.style.opacity = 1;
            let blocked = setInterval(function() {
                if (block.style.opacity > 0) block.style.opacity -= .1;
                else {
                    block.remove();
                }
            }, 60)    
        }
    },
    2000
  );
 
    