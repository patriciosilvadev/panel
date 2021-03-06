<?php

#	HTML2PDF Needs
require ROOT . DS . 'vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;

$facture = find_one("bills", "id", $ID);

$client = find_one("clients", "id", $facture->client_id);

$depositcounter = cell_count("payements", "pf_id", $facture->pf_id);

$statement = find_one("init_payement", "pf_id", $facture->pf_id);

$deposit = find_all("payements", " WHERE statement_id='$statement->id' ORDER BY id ASC");

$filename = "Transaction-sur-FACTURE-$facture->pf_id-($client->e_name).pdf";

ob_start();

?>

<style type="text/css">

    table.table {
        width: 100%;
        max-width: 100%;
        margin-bottom: 1rem;
        background-color: transparent;
        border-collapse: collapse;
    }
    table.table-stripped {
        width: 100%;
        max-width: 100%;
        margin-bottom: 1rem;
        background-color: transparent;
        border-collapse: collapse;
    }
    table.table-invoice {
        width: 100%;
        max-width: 100%;
        margin-bottom: 1rem;
        background-color: transparent;
        border-collapse: collapse;
    }
    table thead {
        display: table-header-group;
        vertical-align: middle;
        border-color: inherit;
    }
    table thead th {
        vertical-align: bottom;
        border-bottom: 1px solid #DEE2E6;
    }
    table td, table th {
        vertical-align: top;
        padding: 12px 10px;
    }
    table.table-invoice td,
    table.table-invoice th {
        padding: 8px 10px;
    }


    table .document-title {
        font-size: 30px;
        color: #39B54A;
        vertical-align: top;
    }
    table .header-title {
        font-size: 22px;
        color: #39B54A;
        vertical-align: top;
    }

    table .empty-table {
        background-color: #DEE2E6;
        font-weight: 600;
    }

    table {cellspacing: 0; width: 100%;}
    
    table td.bolder {font-weight: bold;}
    table td.italic {font-style: italic;}
    
    table td.text-center {text-align: center;}
    table td.text-right,
    table th.text-right {text-align: right;}
    
    table td.text-uppercase,
    table th.text-uppercase {text-transform: uppercase;}
    table td.text-capitalize {text-transform: capitalize;}
    
    table td.ts-zx {font-size: 13px;}
    table td.ts-1x {font-size: 15px;}
    table td.ts-2x {font-size: 18px;}
    table td.ts-3x {font-size: 25px;}
    table td.ts-4x {font-size: 30px;}

    table .ts-0x {font-size: 11px;}
    table .ts-zx {font-size: 13px;}
    table .ts-1x {font-size: 15px;}
    table .ts-2x {font-size: 18px;}

    table .text-danger {color: #E74C3C;}
    table .text-orange {color: #F15624;}
    table .text-green {color: #39B54A;}
    table .text-grey {color:#898989;}
    
    table .text-uppercase {text-transform: uppercase;}
    table .text-capitalize {text-transform: capitalize;}

    table.mt-1 {margin-top: 5px;}
    table.mt-2 {margin-top: 10px;}
    table.mt-3 {margin-top: 15px;}
    table.mt-4 {margin-top: 20px;}
    table.mt-5 {margin-top: 30px;}
    table.mt-6 {margin-top: 50px;}

    table.mb-1 {margin-bottom: 5px;}
    table.mb-2 {margin-bottom: 10px;}
    table.mb-3 {margin-bottom: 15px;}
    table.mb-4 {margin-bottom: 20px;}
    table.mb-5 {margin-bottom: 30px;}
    table.mb-6 {margin-bottom: 50px;}

    table .borderblack {border:.5px solid #EBEDF2;}
    table .borderleft {border-left:.5px solid #EBEDF2;}
    table .borderright {border-right:.5px solid #EBEDF2;}
    table .bordertop {border-top:.5px solid #EBEDF2;}
    table .borderbottom {border-bottom:.5px solid #EBEDF2;}

    table .box-p-3 {padding: 10px 7px;}
    table .box-p-2 {padding: 5px 7px;}
    table .box-p-1 {padding: 3px 0;}

    table .bg-green {
        background-color:#39B54A; 
        border:.5px solid #39B54A; 
        color:#FFFFFF;
    }
    table .bg-orange {
        background-color:#F15624; 
        border:.5px solid #F15624; 
        color:#FFFFFF;
    }
    table .bg-soft-grey {
        background-color:#CCCCCC;
        border-color: #CCCCCC;
    }
    table .bg-soft-grey-2x {
        background-color:#EEEEEE;
        border-color: #EEEEEE;
    }
    table .bg-soft-grey-zx {
        background-color:#F7F7F7;
        border-color: #F7F7F7;
    }
    table .bg-striped {
        border-top: 1px solid #DEE2E6;
        border-bottom: 1px solid #DEE2E6;
        background-color:#ECF0F1;
    }

    table .box-h-1 {height:20px;}
    table .box-h-2 {height:30px;}
    table .box-h-3 {height:50px;}
    table .box-h-4 {height:100px;}
    table .box-h-5 {height:150px;}
    table .box-h-6 {height:200px;}
    table .box-h-7 {height:250px;}
    table .box-h-6 {height:300px;}

    table#mytable {
        width: 100%;
        color: #404041;
        border-collapse: collapse;
        font-size: .83rem;
    }

    table td {width: 100%;}
    table td.box-5 {width:5%;}
    table td.box-7 {width:7%;}
    table td.box-10 {width:10%;}
    table td.box-12 {width:12%;}
    table td.box-13 {width:13%;}
    table td.box-15 {width:15%;}
    table td.box-17 {width:17%;}
    table td.box-20 {width:20%;}
    table td.box-21 {width:21%;}
    table td.box-22 {width:22%;}
    table td.box-25 {width:25%;}
    table td.box-30 {width:30%;}
    table td.box-31 {width:31%;}
    table td.box-33 {width:33.33%;}
    table td.box-35 {width:35%;}
    table td.box-40 {width:40%;}
    table td.box-43 {width:43%;}
    table td.box-45 {width:45%;}
    table td.box-46-5 {width:46.5%;}
    table td.box-50 {width:50%;}
    table td.box-52 {width:52%;}
    table td.box-55 {width:55%;}
    table td.box-57 {width:57%;}
    table td.box-60 {width:60%;}
    table td.box-65 {width:65%;}
    table td.box-70 {width:70%;}
    table td.box-73 {width:73%;}
    table td.box-75 {width:75%;}
    table td.box-78 {width:78%;}
    table td.box-80 {width:80%;}
    table td.box-83 {width:83%;}
    table td.box-85 {width:85%;}
    table td.box-90 {width:90%;}
    table td.box-92 {width:92%;}
    table td.box-93 {width:93%;}
    table td.box-95 {width:95%;}
    table td.box-97 {width:97%;}

</style>

<page backtop="5mm" backleft="10mm" backright="10mm" backbottom="5mm">

    <table id="mytable" class="mb-5">
        
        <tbody>
            
        <tr>
            
            <td class="box-75 text-uppercase">

                <h3 class="document-title">

                    <div>Transaction sur facture</div>
                    <small class="text-grey"><?= '309F-' . date('jny',strtotime($facture->created)) . '/' . $facture->pf_id; ?></small>

                </h3>

            </td>

            <td class="box-25"><img src="<?= WURI . "ressources/public/media/uses/logo-p.png"; ?>" style="width:50px;" />
                
               <!--  <table id="mytable">
                    
                    <tr>
                        
                        <td class="box-50 borderright"><img src="<?= WURI . "ressources/public/media/uses/dev-logo.png"; ?>" style="width:100%;" /></td>
                        
                        <td class="box-50 text-right"><img src="<?= WURI . "ressources/public/media/uses/logo-p.png"; ?>" style="width:50px;" /></td>

                    </tr>

                </table> -->

            </td>

        </tr>

        </tbody>

    </table>


    <table id="mytable">
        
        <tbody>
        
         <tr>

            <td class="box-25 text-uppercase ts-zx text-grey">Client</td>

            <td class="box-25 text-uppercase ts-zx text-grey text-center">Téléphone</td>

            <td class="box-25 text-uppercase ts-zx text-grey text-center">Boîte postale</td>

            <td class="box-25 text-uppercase ts-zx text-grey text-right">NCC</td>

        </tr>

        <tr>

            <td class="box-25"><?= "+225 " . $client->e_name ?></td>

            <td class="box-25 text-center"><?= "+225 " . $client->contacts ?></td>

            <td class="box-25 text-center"><?= $client->bp != "" ? $client->bp : "---" ?></td>

            <td class="box-25 text-right"><?= $client->cc != "" ? $client->cc : "---" ?></td>

        </tr>    

        </tbody>

    </table>


    <table id="mytable" class="mt-6 mb-6">
        
        <tbody>
        
         <tr>

            <td class="box-33 bordertop text-uppercase ts-zx text-grey text-center">Montant TTC</td>

            <td class="box-33 bordertop text-uppercase ts-zx text-grey text-center">Acompte perçus</td>

            <td class="box-33 bordertop text-uppercase ts-zx text-grey text-center">Solde</td>

        </tr>

        <tr>

            <td class="box-33 ts-4x bolder text-center"><?= number_format($statement->ttc, 0, '', '.'); ?></td>

            <td class="box-33 ts-4x bolder text-center"><?= number_format($statement->tac, 0, '', '.'); ?></td>

            <td class="box-33 ts-4x bolder text-center"><?= number_format($statement->rap, 0, '', '.'); ?></td>

        </tr>    

        </tbody>

    </table>


    <table class="table-invoice">
        
        <thead>

        <tr>

            <th scope="col">#</th>

            <th scope="col">Date</th>

            <th scope="col">Montant</th>

        </tr>

        </thead>

        <tbody>
                            
        <?php if($depositcounter > 0): ?>

        <?php $i = 1; ?>    

            <?php foreach($deposit as $item): ?>

                <?php $z = $i++ ?>

                <?php if($z & 1): ?>

                <tr>
            
                    <td class="box-7 bg-striped"><?= $z; ?></td>

                    <td class="box-46-5 text-uppercase bg-striped"><?= set_time($item->created); ?></td>

                    <td class="box-46-5 bg-striped"><?= number_format($item->payed_amount, 0, '', '.'); ?></td>

                </tr>

                <?php else: ?>

                <tr>
                    
                    <td class="box-7 borderbottom bordertop"><?= $z; ?></td>

                    <td class="box-46-5 text-uppercase borderbottom bordertop"><?= set_time($item->created); ?></td>

                    <td class="box-46-5 borderbottom bordertop"><?= number_format($item->payed_amount, 0, '', '.'); ?></td>

                </tr>

                <?php endif; ?>

            <?php endforeach; ?>    

        <?php else: ?>    
        
        <tr>
            
            <td colspan="3" class="empty-table text-center">

                <h2>Tableau vide!</h2>

                <span class="text-grey">Vous n'avez reçu aucun versements pour cette facture pour le moment</span>

            </td>

        </tr>

        <?php endif; ?>        

        </tbody>

    </table>
    
    <page_footer>

    <table id="mytable" class="mt-6">
        
        <tbody>
            
        <tr>

            <td class="text-grey text-center">

                <small>Angré Les Oscars – Cocody Abidjan, République de Côte d’Ivoire</small><br>
            
                <small>01 BP 1470 ABIDJAN 01 - Phones : +225 22 527 988 / 08 145 830</small><br>

                <small>Email : sercom.dev@devafrika.com | infos@devafrika.com | Site web : www.devafrika.com</small>

            </td>

        </tr>
            
        </tbody>

    </table>

    </page_footer>

</page>

<?php

$content = ob_get_clean();

try {
	
	$pdf = new Html2Pdf('P', 'A4', 'fr', 'true', 'UTF-8');

    $pdf->pdf->SetDisplayMode('fullpage');
	
	$pdf->writeHTML($content);
	
	$pdf->output($filename);

} catch(HTML2PDF_exception $e) {

	die($e);

}

?>