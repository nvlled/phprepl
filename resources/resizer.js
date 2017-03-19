
function allowResize(dragNode, resizeNode, onresize) {
    var dragging = false;
    var startY = null;
    var startHeight = 0;
    dragNode.onmousedown = function(e) {
        dragging = true;
        startY = e.clientY;
        startHeight = parseInt(getComputedStyle(resizeNode).height);
    }
    window.addEventListener("mousemove", function(e) {
        if (!dragging)
            return;
        var diff = e.clientY - startY;
        var newsize = startHeight + diff;
        console.log(newsize);
        resizeNode.style.height = newsize+"px";
        onresize(newsize);
    });
    window.addEventListener("mouseup", function() {
        dragging = false;
    });
}

