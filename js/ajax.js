const formularios_ajax=document.querySelectorAll(".FormularioAjax");

function enviar_formulario_ajax(e){
    e.preventDefault();

    let enviar=confirm("Quieres enviar el formulario");

    if(enviar==true){

        let data= new FormData(this); // todos los datos del formulario
        let method=this.getAttribute("method"); // guarda el metdoo del formulario
        let action=this.getAttribute("action"); // a donde se envia la informacion

        let encabezados= new Headers(); // sirve para la configuracion del api fecht de js

        let config={
            method: method,
            headers: encabezados,
            mode: 'cors', 
            cache: 'no-cache',
            body: data // todos los datos del formulario
        };

        fetch(action,config) // primero el url donde se envian los datos, luego las configuraciones 
        .then(respuesta => respuesta.text()) // inciamos una promesa y convertirla a texto plano
        .then(respuesta =>{ 
            let contenedor=document.querySelector(".form-rest"); // donde se va a mostrar la respuesta
            contenedor.innerHTML = respuesta; // aca se mostraria la respuesta
        });
    }

}

formularios_ajax.forEach(formularios => {
    formularios.addEventListener("submit",enviar_formulario_ajax);
});