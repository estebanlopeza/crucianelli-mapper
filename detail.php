<?php include 'inc/head.php'; ?>

<?php 

if(!$_GET['img'] || !file_exists($_GET['img'])) die('No existe el despiece'); 


?>

<script>
    var despiece = '<?php echo basename($_GET['img'], '.jpg');?>';
</script>


<div class="container-fluid" id="detail">
    <div class="row">
        <div class="col">
            <div id="img-wrap"><img src="<?php echo $_GET['img']?>" id="img"></div>
        </div>    
        <div class="col-sm">
            <div id="log">
                <h5>Coordenadas</h5>
                <ol id="coords"></ol>
            </div>
            <div id="actions">
                <button type="button" id="save" class="btn btn-primary">Guardar</button>
                <a class="btn btn-secondary" href="index.php" role="button">Volver al listado</a>
            </div>
        </div>    
    </div>    
</div>    

<?php include 'inc/foot.php'; ?>