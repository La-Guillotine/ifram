$(document).ready(function(){
    $("select").select2();
    $(".listPlantes > select").on('change', function(){
        let option = this.options[this.selectedIndex];
        console.log(option);
        // let plante = $(option).data('plante');
        // console.log(plante);
        // alert(plante.sensible.nom);
        // $('.nomPlante').text(plante.nom);
        // $('.maladies').text(plante.sensible.nom);
        let id = option.val();
        $.ajax({
            url:'App\Repository\PlanteRepository.php',
            type:'get',
            data: `id= ${id}`,
            dataType:'json',
            success:function(res, statut){
                console.log(res);
            },
            error:function(res, statut, error){
                console.error(error);
            }
        }
            

        );
    });
});
