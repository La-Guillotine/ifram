$(document).ready(function(){
    $("select").select2();
    $(".listPlantes > select").on('change', function(){
        let option = this.options[this.selectedIndex];
        console.log(option);
        let plante = $(option).data();
        console.log(plante);
        alert(plante.plante.nom);
    });
});

