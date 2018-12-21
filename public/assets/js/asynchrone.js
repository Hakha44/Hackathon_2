//let checkbox = document.querySelector("input[name = presence]");
//checkbox.addEventListener('click', function (e) {
    //console.log(this.value);
   // if(this.checked){
    //let id = this.value

    //}

//});
//
let checkboxes=document.getElementsByClassName('presence');
for (let i = 0; i < checkboxes.length; i++){
    checkboxes[i].onclick = function () {
        if (checkboxes[i].checked){
            let id=this.value;
            let presence = 1;
            fetch("/participant/"+id+"/"+presence)
                .then((resp) => resp.json())
                .then((data)=>setSuccess(data))

        }
        else {
            let id=this.value;
            let presence = 0;
            fetch("/participant/"+id+"/"+presence)
                .then((resp) => resp.json())
                .then((data)=>setSuccess(data))
        }
    }
}
function setSuccess(message){
}
