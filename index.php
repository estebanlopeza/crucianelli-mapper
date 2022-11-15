<?php include 'inc/head.php'; ?>

<div class="container-fluid" id="list">
    <div class="row">
        <div class="col">
            <h1>Mapper</h1>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <ol id="filelist">
                <?php 
                $path = './contents/despieces/*.jpg';
                
                $files = glob($path);

                foreach ($files as $file) {
                    $base_file = basename($file, '.jpg');
                    $csv_file =  'csv/' . $base_file . '.csv';

                    echo '<li><a href="detail.php?img='.$file.'">' . $base_file . '</a> ';
                    
                    if ( file_exists($csv_file) && filesize($csv_file) > 1 )
                    {
                        echo '<i class="bi-check-circle-fill text-success"></i>';
                    } 
                    echo '</li>';
                }
                ?>
            </ol>
        </div>
    </div>
</div>


<?php include 'inc/foot.php'; ?>