<?php
function usuarioOk($usuario, $contraseña): bool
{
   if (strlen($usuario) < 8) {
      return false;
   }
   if ($contraseña !== strrev($usuario)) {
      return false;
   }
   return true;
}

function contarPalabras($texto): int
{
   return str_word_count($texto);
}

function letraMasRepetida($texto) {
    $texto = strtolower($texto);
    $contadorLetras = [];
    
    for ($i = 0; $i < strlen($texto); $i++) {
        $letra = $texto[$i];
        
        if ($letra >= 'a' && $letra <= 'z') {
            if (isset($contadorLetras[$letra])) {
                $contadorLetras[$letra]++; 
            } else {
                $contadorLetras[$letra] = 1; 
            }
        }
    }
    
    $maximo = 0;
    $letraMasRepetida = "Ninguna";
    
    foreach ($contadorLetras as $letra => $cantidad) {
        if ($cantidad > $maximo) {
            $maximo = $cantidad;
            $letraMasRepetida = $letra;
        }
    }
    
    return $letraMasRepetida;
}


function palabraMasRepetida($texto) {
    $texto = strtolower($texto);
    $palabras = str_word_count($texto, 1);
    $contadorPalabras = [];
    
    foreach ($palabras as $palabra) {
        if (isset($contadorPalabras[$palabra])) {
            $contadorPalabras[$palabra]++; 
        } else {
            $contadorPalabras[$palabra] = 1; 
        }
    }
    
    $maximo = 0;
    $palabraMasRepetida = "Ninguna";
    
    foreach ($contadorPalabras as $palabra => $cantidad) {
        if ($cantidad > $maximo) {
            $maximo = $cantidad;
            $palabraMasRepetida = $palabra;
        }
    }
    
    return $palabraMasRepetida;
}
