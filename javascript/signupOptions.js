function checkOptions() {
    var select = document.getElementById("select");
    var curName = select.options[select.selectedIndex].value;
    
    var container = document.getElementById("newInput");
        
    // Clear previous contents of the container
    while (container.hasChildNodes()) {
        container.removeChild(container.lastChild);
    }

    if(curName == "Faculty") {

        var input = document.createElement("input");
        input.type = "text";
        input.name = "department";
        input.id = "department";
        input.className = "form-control mb-4";
        input.placeholder = "Department";
        input.required = true;
        container.appendChild(input);

        var input = document.createElement("input");
        input.type = "text";
        input.name = "starid";
        input.id = "starid";
        input.className = "form-control mb-4";
        input.placeholder = "StarID";
        input.required = true;
        container.appendChild(input);
    }
}