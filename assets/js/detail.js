var click;
var coord;
var coords = [];
cont = 0;
var needToConfirm = false; 

$(document).ready(function() {
    var $img = $('#img');
    var $coords = $('#coords');
    
    /* Add spot */
    $img.on("click", function(event) {
        //click = event;
        var width  = $img.width(),
            height = $img.height();

        var x = ((event.pageX - this.offsetLeft) * 100 / width ).toFixed(3);
        var y = ((event.pageY - this.offsetTop ) * 100 / height).toFixed(3);

        /* 
        */
        console.log('x: ' + x);
        console.log('event.pageX: ' + event.pageX);
        console.log('this.offsetLeft: ' + this.offsetLeft);
        console.log('width: ' + width);
        
        ++cont;

        if(event.shiftKey){//Salteo
            coord = '';
        }else{
            coord = x + "||" + y;
        }
        
        set_coord(coord);
        needToConfirm = true;
    });

    function set_coord(coord){
        if( null == coord ){ coord = ''; }

        $coords.append("<li class='coord' >" + coord + '</li>');
        coords.push(coord);
    }

    
    /* Remove spot */
    $(document).on('click', '.coord', function(event){
        var $this = $(this),
            i = $this.index();
        if( confirm('Esto eliminará el punto seleccionado. ¿Está seguro de continuar?') ){
            $this.remove();
            coords.splice(i, 1);
            console.log( event );
        }
        needToConfirm = true;
    });

    /* save coords */
    $('#save').on('click', function(event){

        $.post('ajax.php', {
            'action'    : 'save',
            'despiece'  : despiece,
            'coords'    : JSON.stringify(coords)
        }).done(function( data ) {
            if('1' == data){
                alert( 'Datos guardados' );
                needToConfirm = false;
            }
        });

    });

    /* load coords */
    $.post('ajax.php', {
        'action'    : 'load',
        'despiece'  : despiece,
    }).done(function( data ) {
        
        if('0' == data){return false;}

        var c = JSON.parse(data);
        
        c.forEach(element => {

            set_coord(element[0]);
        });

    });

    window.onbeforeunload = askConfirm;
    
    
});

function askConfirm() {
    if (needToConfirm) {
        return "Seguro que desea salir? los datos no guardados se perderán."; 
    }
}