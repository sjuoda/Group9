let form = document.getElementById("coorForm");

function validateForm(event){
    let size = parseInt(form.rowscols.value);
    let color = parseInt(form.colors.value);

    if (size < 1 || size > 26) {
        event.preventDefault();
        document.getElementById("rowcolError").style.display = "block";
        console.log("Error: Size entered is out of range. Must be between 1 and 26 inclusive.");
    } else {
        document.getElementById("rowcolError").style.display = "none";
    }

    if (color < 1 || color > COLORS_SIZE) {
        event.preventDefault();
        document.getElementById("colorError").style.display = "block";
        console.log("Error: Size entered is out of range. Must be between 1 and " + COLORS_SIZE + " inclusive.");
    } else {
        document.getElementById("colorError").style.display = "none";
    }
}

form.addEventListener("submit", validateForm);

//Duplicate check 4.3
function checkDuplicateColors(event){

    let dropdowns = document.getElementsByClassName("colorDropdown");
    let message = document.getElementById("duplicateMessage");
    let cell = event.target.parentElement.nextElementSibling;
    let usedColors = [];

    for(let i = 0; i < dropdowns.length; i++){
        if(usedColors.includes(dropdowns[i].value)){
            message.style.display = "block";
            message.textContent = "Error: Color is already in use.";
            event.target.value = event.target.dataset.previous;
            //cell.style.backgroundColor = event.target.value;
            return;
        } 
        else {
            usedColors.push(dropdowns[i].value);
        }
    }
    message.style.display = "none";
    event.target.dataset.previous = event.target.value;
    //cell.style.backgroundColor = event.target.value;
}

let dropdowns = document.getElementsByClassName("colorDropdown");
    for(let i = 0; i < dropdowns.length; i++){
        dropdowns[i].dataset.previous = dropdowns[i].value;
        dropdowns[i].addEventListener("focus", function(){
            this.dataset.previous = this.value;
        });
        dropdowns[i].addEventListener("change", checkDuplicateColors);
}
