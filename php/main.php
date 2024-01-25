<?php
/* 
esto iria debajo de la conexion
$pdo->query("INSERT INTO categoria(categoria_nombre, categoria_ubicacion) VALUES('prueba', 'texto prueba')") */; //prueba de que esta todo oki en la basse d datos y carga perfecto.

function conexion (){
    $pdo = new PDO('mysql:host=localhost;dbname=inventario','root',''); //manera de conectar a base de datos
    return $pdo;
}

// verificar datos
// funcion para verificar datos en cada input de los formularios
function verificar_datos($filtro, $cadena){
    if(preg_match("/^".$filtro ."$/",  $cadena)){
        return false;
    }else {
        return true;
    }
}

// limpiar cadenas de texto
function limpiar_cadena($cadena){
    $cadena=trim($cadena); //sirve para borrar los espacios en blanco
    $cadena=stripslashes($cadena); // sirve para borrar barras o comillas en un string
    $cadena=str_ireplace("<script>", "", $cadena);
    $cadena=str_ireplace("</script>", "", $cadena);
    $cadena=str_ireplace("<script src", "", $cadena);
    $cadena=str_ireplace("<script type=", "", $cadena);
    $cadena=str_ireplace("SELECT * FROM", "", $cadena);
    $cadena=str_ireplace("DELETE FROM", "", $cadena);
    $cadena=str_ireplace("INSERT INTO", "", $cadena);
    $cadena=str_ireplace("DROP TABLE", "", $cadena);
    $cadena=str_ireplace("DROP DATABASE", "", $cadena);
    $cadena=str_ireplace("TRUNCATE TABLE", "", $cadena);
    $cadena=str_ireplace("SHOW TABLES;", "", $cadena);
    $cadena=str_ireplace("SHOW DATABASES;", "", $cadena);
    $cadena=str_ireplace("<?php", "", $cadena);
    $cadena=str_ireplace("?>", "", $cadena);
    $cadena=str_ireplace("--", "", $cadena);
    $cadena=str_ireplace("^", "", $cadena);
    $cadena=str_ireplace("<", "", $cadena);
    $cadena=str_ireplace("[", "", $cadena);
    $cadena=str_ireplace("]", "", $cadena);
    $cadena=str_ireplace("==", "", $cadena);
    $cadena=str_ireplace(";", "", $cadena);
    $cadena=str_ireplace("::", "", $cadena);
    $cadena=trim($cadena);
    $cadena=stripslashes($cadena);
    
    return $cadena;
}

// Funcion renombrar fotos //
function renombrar_fotos($nombre){
    $nombre=str_ireplace(" ", "_", $nombre); // funcion de reemplazar caracter invalido por valido
    $nombre=str_ireplace("/", "_", $nombre);
    $nombre=str_ireplace("#", "_", $nombre);
    $nombre=str_ireplace("-", "_", $nombre);
    $nombre=str_ireplace("$", "_", $nombre);
    $nombre=str_ireplace(".", "_", $nombre);
    $nombre=str_ireplace(",", "_", $nombre);
    $nombre=$nombre."_".rand(0,100); //

    return $nombre;
}

// Funcion paginador de tablas //
function paginador_tablas($pagina,$Npaginas,$url,$botones){
    $tabla='<nav class="pagination is-centered is-rounded" role="navigation" aria-label="pagination">';

    if($pagina<=1){
        $tabla.='
        <a class="pagination-previous is-disabled" disabled >Anterior</a>
        <ul class="pagination-list">';
    }else{
        $tabla.='
        <a class="pagination-previous" href="'.$url.($pagina-1).'" >Anterior</a>
        <ul class="pagination-list">
            <li><a class="pagination-link" href="'.$url.'1">1</a></li>
            <li><span class="pagination-ellipsis">&hellip;</span></li>
        ';
    }

    $ci=0;
    for($i=$pagina; $i<=$Npaginas; $i++){
        if($ci>=$botones){
            break;
        }
        if($pagina==$i){
            $tabla.='<li><a class="pagination-link is-current" href="'.$url.$i.'">'.$i.'</a></li>';
        }else{
            $tabla.='<li><a class="pagination-link" href="'.$url.$i.'">'.$i.'</a></li>';
        }
        $ci++;
    }

    if($pagina==$Npaginas){
        $tabla.='
        </ul>
        <a class="pagination-next is-disabled" disabled >Siguiente</a>
        ';
    }else{
        $tabla.='
            <li><span class="pagination-ellipsis">&hellip;</span></li>
            <li><a class="pagination-link" href="'.$url.$Npaginas.'">'.$Npaginas.'</a></li>
        </ul>
        <a class="pagination-next" href="'.$url.($pagina+1).'" >Siguiente</a>
        ';
    }

    $tabla.='</nav>';
    return $tabla;
}

