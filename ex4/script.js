const display = document.getElementById("display");

function append(value){
    display.value += value;
}

function func(value){
    display.value += value;
}

function clearDisplay(){
    display.value = "";
}

function deleteLast(){
    display.value = display.value.slice(0,-1);
}

function calculate(){

    try{

        let expression = display.value;

        expression = expression.replace(/(\d+)%/g,"($1/100)");

        let result = eval(expression);

        if(result === undefined){
            display.value = "";
        }else{
            display.value = result;
        }

    }

    catch{

        display.value = "Error";

        setTimeout(()=>{
            display.value = "";
        },1500);

    }

}

document.addEventListener("keydown",function(e){

    if((e.key>="0" && e.key<="9") ||
       "+-*/().".includes(e.key)){

        append(e.key);
    }

    if(e.key==="Enter"){
        calculate();
    }

    if(e.key==="Backspace"){
        deleteLast();
    }

    if(e.key==="Escape"){
        clearDisplay();
    }

});