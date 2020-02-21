<?php
require __DIR__ . '/vendor/autoload.php';

$faker = Faker\Factory::create();

$content = file_get_contents('datas.txt');

ob_start();
?>

<style>
	table{
		border-collapse: collapse;
		width: 100%;
		color: #717375;
		font-family: helvetica;
		
	}


	table strong{
		color: #000;
	}

	table.border{
		border: 1px solid #FDEDD1;
		padding: 3mm 1mm;
	}

	table.border th{
		color: #FFFFFF;
		background: #000;
		font-weight: normal;
		font-size: 13px;
	}
	table.border td,tr{
		border: 1px solid #330033;
	}
	hr{
		height: 3px;
	}
</style>
<page backtop="20mm" backleft="10mm" backright="10mm" backbottom="20mm" footer="page;date;time">
	<page_footer>
	<hr>
	Bon de commande
	</page_footer>
	<table style="vertical-align: top:">
		<tr>
			<td style="width: 75%;">
				<strong>Nom : Jean Lionel</strong>
				 <br>
				Quartier: KIGOBE  <br>
				STREET : DAMA NO 7 <br>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,</p>
			</td>

			<td style="width: 25%;text-align: right;">
				<strong>INFORMATION</strong> <br>
				<?php echo 'Le '.date('d').' - '.date('m').' - ' .date('Y'); ?>
			</td>
		</tr>
		
	</table>

	<table style="vertical-align: bottom; margin-top: 20mm;">
		<tr>
			<td style="width: 50%;text-align: left;">
				
				<strong>DEVIS No <?= rand()%10 ?></strong>
			</td>
			<td style="width: 50%;text-align: right;">
				
				Emise le  <?php echo date('d/m/Y') ?>
			</td>
		</tr>
	</table>

	<table class="border">
		<thead>
			<tr>
			<th style="width: 60%;">Description</th>
			<th style="width: 12%;">Quantite</th>
			<th style="width: 15%;">Prix unitaire</th>
			<th style="width: 13%;">Montant</th>
		</tr>
			
		</thead>

		<tbody>
			<?php for($i=0;$i<5;$i++) : ?>
				<tr>
					<td><?= $faker->word(); ?></td>
					<td><?= number_format($faker->randomDigitNot(0),2) ?> &euro;</td>
					<td><?= number_format($faker->numberBetween(10,1000),2); ?> &euro;</td>
					<td><?= number_format($faker->randomDigit() * $faker->numberBetween(10,1000) ,2)?> &euro;</td>
				</tr>

			<?php endfor; ?>
		
		</tbody>
		
	</table>


</page>

<?php
$content = ob_get_clean();


use Spipu\Html2Pdf\Html2Pdf;
try {
    $pdf = new Html2Pdf('P', 'A4','fr');
    $pdf->pdf->setDisplayMode('fullpage');
    $pdf->writeHtml($content);
    $pdf->output('test.pdf');

} catch (HTML2PDF_exception $th) {
    die($th);
}
