<!DOCTYPE html>
<!--
Index: Home Page of Project
-->
<?php
ob_start();
require '../_app/Config.inc.php';
spl_autoload_register('carregarClasses');
?>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="//stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <title>jsPDF to save it as a PDF</title>
    </head>

    <body>
        <style>
            .js_enclosures, .js_padmounted{display: none;}
        </style>

        <h1 class="text-center mb-5 mt-5">Underground Construction Completion Standard Checklist (A1, M610614)</h1>

        <?php
        $ItensEnclosure = [
            '1' => array(1, false, 'Minimum clearances to walls, overhangs, etc.', 'ER'),
            '2' => array(2, false, 'Spare ducts plugged properly', 'ER'),
            '3' => array(3, false, 'Primary enclosures correctly sized', 'ER'),
            '4' => array(4, false, 'Secondary enclosures correctly sized', 'ER'),
            '5' => array(5, false, 'Correct traffic lid installed', 'ER'),
            '6' => array(6, true, 'All bolts securely installed in lid', 'EC'),
            '7' => array(7, true, 'Set at grade and level with no tripping hazard', 'EC'),
            '8' => array(8, false, 'Maintain clear working space as required', 'EC'),
            '9' => array(9, true, 'High voltage sign installed on lid when required', 'EC'),
            '10' => array(10, true, 'Equipment operating number installed on lid when required', 'EC'),
            '11' => array(11, false, 'Ownership identified', 'EC'),
            '12' => array(12, false, 'Cable Protector or Duct Terminators Installed', 'ER'),
            '13' => array(13, false, 'Retaining wall installed as required', 'EC')
        ];

        $ItensPadmounted = [
            '1' => array(14, true, 'Securely anchored transformers, per standard', 'EC'),
            '2' => array(15, true, 'Securely anchored Switches – 4 bolts', 'ER'),
            '3' => array(16, true, 'Caulking applied, no gaps into compartments ', 'EC'),
            '4' => array(17, true, 'Windows grouted', 'EC'),
            '5' => array(18, false, 'Spare ducts plugged properly', 'ER'),
            '6' => array(19, true, 'HV barricade installed, signed, and locked on live-front installations', 'EC'),
            '7' => array(20, true, "High Voltage/Maintain 8' Clearance label on exterior door, as required", 'EC'),
            '8' => array(21, false, 'Pad is level', 'EC'),
            '9' => array(22, false, 'Fault indicators installed as required ', 'ER'),
            '10' => array(23, true, 'Equipment number marked on outside', 'EC'),
            '11' => array(24, true, 'Additional equipment numbers marked on inside', 'EC'),
            '12' => array(25, true, 'Exterior door bolted and padlocked', 'EC'),
            '13' => array(26, true, "8' clear working space in front of doors", 'EC'),
            '14' => array(27, false, "Minimum clearances to walls, overhangs, etc.", 'EC'),
            '15' => array(28, false, "Retaining wall installed, as required", 'EC'),
            '16' => array(29, true, "Traffic barriers w/visibility strips and locks installed as required", 'EC'),
        ];

        function inputsCheckbox(array $itens) {


            foreach ($itens as $item):

                $preprename = str_replace('/', ' ', $item[2]);
                $prename = str_replace(['-', '/'], '_', Check::Name(Check::Words($preprename, 4)));
                $name = str_replace(',', '', $prename);
                ?>

                <div class="form-group<?= ($item[1] ? ' bg-light' : ''); ?>">
                    <span class="mr-2 ml-3"><?= $item[0] ?>.</span>
                    <input class="mr-2" type="checkbox" name="ccsc[<?= $item[0] . '_' . $name; ?>]" value="0"> <span class="col-5"><?= $item[2]; ?></span>
                    <span class="mr-4 float-right"><?= $item[3]; ?></span>
                </div>

                <?php
            endforeach;
        }

        //        var_dump($ItensPadmounted);
        ?>

        <div class="container">

            <form action="jsPdf.php" method="get" enctype="multipart/form-data">

                <input type="hidden" name="action" value="gerar_pdf">

                <div class="form-group bg-primary text-white font-weight-bold">
                    <input id="enclosures" class="mt-3 mb-3 ml-3" type="checkbox"> Check if section is N/A
                    <span class="float-right mt-2 mr-3">EC/ER</span>
                    <span class="float-right mt-2 mr-3">ENCLOSURES</span>
                </div>

                <div class="js_enclosures container">

                    <?php inputsCheckbox($ItensEnclosure); ?>

                </div>

                <div class="form-group bg-primary text-white font-weight-bold">
                    <input id="padmounted" class="mt-3 mb-3 ml-3" type="checkbox"> Check if section is N/A
                    <span class="float-right mt-2 mr-3">EC/ER</span>
                    <span class="float-right mt-2 mr-3">PADMOUNTED EQUIPMENT</span>
                </div>

                <div class="js_padmounted container">

                    <?php inputsCheckbox($ItensPadmounted); ?>

                </div>

                <input type="submit" class="btn btn-success float-right" value="Create PDF">

            </form>
        </div>

        <script src="//code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="//stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <script src="../_cdn/jquery.js"></script>
        <script src="../_cdn/jquery.form.js"></script>
        <script src="js/scripts.js"></script>

        <script>
            $(function () {

                $('form').on('change', '#enclosures', function () {

                    if ($('.js_enclosures').hasClass('active')) {
                        $('.js_enclosures').hide().removeClass('active');
                    } else {
                        $('.js_enclosures').show().addClass('active');
                    }

                });

                $('form').on('change', '#padmounted', function () {

                    if ($('.js_padmounted').hasClass('active')) {
                        $('.js_padmounted').hide().removeClass('active');
                    } else {
                        $('.js_padmounted').show().addClass('active');
                    }

                });
                
                $('form .container').on('change', 'input[type=checkbox]', function () {
                    
                    $(this).val('1');
                    
                });

                $('form').on('click', '.btn', function () {

                        
                        $('form .container').find('input[type=checkbox]').prop('checked', true);

                });

            });
        </script>
    </body>
</html>
<?php ob_end_flush(); ?>