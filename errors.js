let form = document.getElementById("coorForm");

function validateForm(event){
    let size = form.rowscols.value;
    let color = form.colors.value;

    if (size < 1 || size > 26) {
        event.preventDefault();
        document.getElementById("rowcolError").style.display = "block";
        console.log("Error: Size entered is out of range. Must be between 1 and 26 inclusive.");
    } else {
        document.getElementById("rowcolError").style.display = "none";
    }

    if (color < 1 || color > 10) {
        event.preventDefault();
        document.getElementById("colorError").style.display = "block";
        console.log("Error: Size entered is out of range. Must be between 1 and 10 inclusive.");
    } else {
        document.getElementById("colorError").style.display = "none";
    }
}

form.addEventListener("submit", validateForm);

//Duplicate check 4.3
document.addEventListener("change", function(event){

    if(event.target.className == "colorDropdown"){
        let dropdowns = document.getElementsByClassName("colorDropdown");
        let message = document.getElementById("duplicateMessage");
        let usedColors = [];

        for(let i = 0; i < dropdowns.length; i++){
            if(usedColors.includes(dropdowns[i].value)){
                message.textContent = "Error: Color is already in use.";
                event.target.selectedIndex = 0;
                return;
            } 
            else {
                usedColors.push(dropdowns[i].value);
            }
        }
        message.textContent = "";
    }
});
