var outputNode = document.querySelector("#output");
function remoteEval(code, onload) {
    var req = new XMLHttpRequest();
    req.open("POST", "eval.php");
    req.onload = onload;
    req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    req.send("script="+encodeURIComponent(code));
}

function request(method, url, data, onload) {
    var req = new XMLHttpRequest();
    var formData = new FormData();
    Object.keys(data).forEach(function(k) {
        formData.append(k, data[k]);
    });
    req.open(method, url);
    req.onload = onload;
    req.send(formData);
}

//var editorNode = document.getElementById('editor');
var bufferNode = document.querySelector('textarea[name=cmd]');
//var editor;

var codemirror = CodeMirror.fromTextArea(bufferNode, {
    mode: "php",
    lineNumbers: true,
});

//bufferNode.style.display = "none";
//editorNode.style.display = "inherit";

var evalForm = document.querySelector("form[name=eval]");
var evalBtn = evalForm.querySelector("input[type=submit]");
var evalSpinner = evalForm.querySelector(".spinner");
evalBtn.disabled = false;
evalForm.onsubmit = function(e) {
    evalSpinner.style.display = "inline";
    evalBtn.disabled = true;
    e.preventDefault();

    codemirror.save();
    var code = bufferNode.value.trim();
    bufferNode.textContent = code;
    remoteEval(code, function(e) {
        outputNode.innerHTML = e.target.response;
        evalSpinner.style.display = "none";
        evalBtn.disabled = false;
    });
}

window.addEventListener("load", function() {
    //allowResize(evalForm.querySelector(".drag"), editorNode.children[0],
    //        function(newsize) {
    //            localStorage["editor-size"] = newsize;
    //        });

    //console.log(editorNode.children);
    //if (! isNaN(localStorage["editor-size"]))
    //    editorNode.children[0].style.height = localStorage["editor-size"]+"px";
}, 900);

var saveForm = document.querySelector("form[name=save]");
var isExisting = document.querySelector("input[name=existing]").value == 1;
var saveBtn = saveForm.querySelector("input[type=submit]");
var saveSpinner = saveForm.querySelector(".spinner");
saveBtn.disabled = false;
saveForm.onsubmit = function(e) {
    saveSpinner.style.display = "inline";
    saveBtn.disabled = true;

    e.preventDefault();
    codemirror.save();
    var code = bufferNode.value.trim();
    var formData = new FormData(saveForm);
    var scriptName = formData.get("name");
    var msg = saveForm.querySelector(".msg");
    formData.append("script", code);

    if (scriptName.trim() == "" || code.trim() == "") {
        saveSpinner.style.display = "none";
        saveBtn.disabled = false;
        msg.textContent = "need script name and body to save";
        return;
    }

    function save(onload) {
        var req = new XMLHttpRequest();
        req.open("POST", "save.php");
        req.onload = function() {
            onload(req.responseText);
        }
        req.send(formData);
    }

    var nameInput = saveForm.querySelector("input[name=name]");
    var data = {name: scriptName};

    if (isExisting) {
        save(function(resp) {
            saveSpinner.style.display = "none";
            saveBtn.disabled = false;
            msg.textContent = resp;
        });
    } else {
        request("POST", "exists.php", data,
                function(e) {
                    var resp = e.target.response;
                    console.log("response:", resp);
                    if (resp == "1") {
                        msg.textContent = "script name is already used";
                        saveSpinner.style.display = "none";
                        saveBtn.disabled = false;
                    } else {
                        save(function() {
                            window.location.search = "?name="+scriptName;
                        });
                    }
                });
    }
}

window.onkeypress = (function(event) {
    if (!(event.which == 115 && event.ctrlKey) && !(event.which == 19)) return true;
    saveBtn.click();
    event.preventDefault();
    return false;
});
