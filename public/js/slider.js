const slides=document.querySelector(".slider").children,
      indicator=document.querySelector(".indicator");

let index=0;

// prev.addEventListener("click",function () {
//     prevSlide();
//     updateCircleIndicator();
//     resetTimer();
// });
//
// next.addEventListener("click",function () {
//     nextSlide();
//     updateCircleIndicator();
//     resetTimer();
// });

//  Create circle indicators
function circleIndicator(){
    for(let i=0;i<slides.length; i++){
        const div=document.createElement("div");
        // div.innerHTML=i+1;
        div.setAttribute("onclick","indicateSlide(this)");
        div.id=i;
        if (i==0){
            div.className="active";
        }
        indicator.appendChild(div);
    }
}

circleIndicator();

//Now when we click to indicator circle
function indicateSlide(element){
    index=element.id;
    changeSlide();
    updateCircleIndicator();
    resetTimer();
}

//Esta función elimina la clase active de todos los hijos de indicator para despues añadir esta clase llamada active solo al hijo que ha sido seleccionado por el usuario
function updateCircleIndicator() {
    for (let i=0; i<indicator.children.length;i++){
        indicator.children[i].classList.remove("active");
    }
    indicator.children[index].classList.add("active");
}
//Esta función realiza el cambio de slide hacia su posicioón anterior
function prevSlide() {
    if(index==0){
        index=slides.length-1;
    }else{
        index--;
    }
    changeSlide()/*Esta función toma el index para hacer el cambio correspondiente*/
}
//Esta función realiza el cambio de slide hacia su posicioón posterior
function nextSlide() {
    if(index==slides.length-1){
        index=0;
    }else{
        index++;
    }
    changeSlide()
}
//Esta función remueve todas las clases activas de los slides para despues añadir la clase active solo aquel slide elegido por el usuario
function changeSlide() {
    //remove active class from all slides
    for (let i=0;i<slides.length;i++){
        slides[i].classList.remove("active")
    }
    slides[index].classList.add("active")
}

//Ahora crearemos la funcion circleIndicator -> mirar arriba

//Ahora haremos el autoplay slide

function autoPlay(){
    nextSlide();
    updateCircleIndicator();
}

let timer=setInterval(autoPlay,4000);

function resetTimer(){
    //When we click to indicator or controls botton we stop the timer
    clearInterval(timer);
    //Then started again
    // let timer=setInterval(autoPlay,4000);
}
