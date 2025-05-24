console.log("EVALUADOR DE RENDIMIENTO ACADEMICO");

// NOTAS PARCIALES

let parcial1 = 12;
let parcial2 = 15;
let proyectoFinal = 18;

// PESOS: (30, 30, 40)(%)

// FORMULA

let notaFinal = ((parcial1 * 0.3) + (parcial2 * 0.3) + (proyectoFinal * 0.4));

document.getElementById("notaFinal").innerText = notaFinal


console.log('Su nota es '+ notaFinal);

let aprobacion = "";

if (notaFinal >= 14) {
    aprobacion = "Aprobado directamente";
} else if (notaFinal >= 10 && notaFinal <= 13.9) {
    aprobacion = "Va a recuperación";
} else{
    aprobacion = "Pierde la materia";
}
console.log(aprobacion);

document.getElementById("aprobacion").innerText = aprobacion;

