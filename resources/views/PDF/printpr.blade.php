<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8" />
	<title>{{$pr->no_pr}}</title>

	<style>
		.invoice-box {
			max-width: 900px;
			margin: auto;
			padding: 30px;
			border: 1px solid #eee;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
			font-size: 13px;
			line-height: 24px;
			font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
			color: #555;
		}

		.invoice-box table {
			width: 100%;
			line-height: inherit;
			text-align: left;
		}

		.invoice-box table td {
			padding: 5px;
			vertical-align: top;
		}

		.invoice-box table tr td:nth-child(2) {
			text-align: right;
		}

		.invoice-box table tr.top table td {
			padding-bottom: 20px;
		}

		.invoice-box table tr.top table td.title {
			font-size: 45px;
			line-height: 45px;
			color: #333;
		}

		.invoice-box table tr.information table td {
			padding-bottom: 40px;
		}

		.invoice-box table tr.heading td {
			background: #eee;
			border-bottom: 1px solid #ddd;
			font-weight: bold;
		}

		.invoice-box table tr.details td {
			padding-bottom: 20px;
		}

		.invoice-box table tr.item td {
			border-bottom: 1px solid #eee;
		}

		.invoice-box table tr.item.last td {
			border-bottom: none;
		}

		.invoice-box table tr.total td:nth-child(2) {
			border-top: 2px solid #eee;
			font-weight: bold;
		}

		@media only screen and (max-width: 600px) {
			.invoice-box table tr.top table td {
				width: 100%;
				display: block;
				text-align: center;
			}

			.invoice-box table tr.information table td {
				width: 100%;
				display: block;
				text-align: center;
			}
		}

		/** RTL **/
		.invoice-box.rtl {
			direction: rtl;
			font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
		}

		.invoice-box.rtl table {
			text-align: right;
		}

		.invoice-box.rtl table tr td:nth-child(2) {
			text-align: left;
		}
	</style>
</head>

<body>
	<div class="invoice-box">
		<center>
		<h3>Purchase Requisition</h3>
		</center>
		<table>
			<tr class="top">
				<td colspan="4">
					<table>
						<tr class="information">
							<td class="title">
							</td>
						</tr>
						<p>PT. Asia Pacific Fibers Tbk.</p>
						<td style="text-align: right;">
							Print Date : <?php
                                                echo "" . date("Y-M-d") . "<br>";
                                        ?>
						</td>
					</table>
				</td>
			</tr>
			
			<tr>
				<td colspan="4">
					<table>
						<tr>
							<td>
								Requested By : Sub Store<br />
								Date : <?php
                                echo "" . date("Y-M-d") . "<br>";
								?><br />
							</td>
						</tr>
					</table>
				</td>
			</tr>

			<tr class="heading">
				<td style="text-align: center;">Part Code</td>
				<td style="text-align: center;">Description</td>
				<td style="text-align: center;">Qty Requested</td>
				<td style="text-align: center;">Rate</td>
				<td style="text-align: center;">Total</td>
			</tr>
			@foreach($data as $barang)
			<tr class="item">
				<td>{{$barang->material->partcode}}</td>
				<td style="text-align: center;">{{$barang->material->description}}</td>
				<td style="text-align: center;">{{$barang->qty_pr}}</td>
				<td style="text-align: center;">@currency($barang->material->harga)</td>
				<td style="text-align: center;">@currency($barang->material->harga * $barang->qty_pr)</td>
			</tr>
			@endforeach
		</table>
	</div>
	<div class="invoice-box">
		<table>
			<thead>
				<th>Remarks :</th>
				<th></th>
				<th></th>
			</thead>
			<thead>
			<tr>
				<th>Departement Head</th>
				<td></td>
				<th>Operator</th>
			</thead>
			<tbody>
				<tr><td></td></tr>
			</tbody>
			<tbody>
				<tr><td></td></tr>
			</tbody>
			<tbody>
				<tr><td></td></tr>
			</tbody>
			<tbody>
				<tr><td></td></tr>
			</tbody>
			<tbody>
			<tr><td></td></tr>
			</tbody>
			<tbody>
			<tr><td></td></tr>
			</tbody>
		</table>
	</div>
</body>
</html>