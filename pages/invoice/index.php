<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />

	<title>Editable Invoice</title>

	<link rel='stylesheet' type='text/css' href='css/style.css' />
	<link rel='stylesheet' type='text/css' href='css/print.css' media="print" />
	<script type='text/javascript' src='js/jquery-1.3.2.min.js'></script>
	<script type='text/javascript' src='js/example.js'></script>

</head>

<body>

	<div id="page-wrap">

		<div id="header">INVOICE</div>

		<div id="identity">

            <div id="address">Chris Coyier
123 Appleseed Street
Appleville, WI 53719

Phone: (555) 555-5555</div>

            <div id="logo">




              <img id="image" src="images/logo.png" alt="logo" />
            </div>

		</div>

		<div style="clear:both"></div>

		<div id="customer">

            <div id="customer-title">Widget Corp.
c/o Steve Widget</div>

            <table id="meta">

                <tr>

                    <td class="meta-head">Date</td>
                    <td><div id="date">December 15, 2009</div></td>
                </tr>
                <tr>
                    <td class="meta-head">Amount Due</td>
                    <td><div class="due">$875.00</div></td>
                </tr>

            </table>

		</div>

		<table id="items">

		  <tr>
		      <th>Item</th>
		      <th>Description</th>

		      <th>Quantity</th>
		      <th>Price</th>
		  </tr>



		  <tr class="item-row">
		      <td class="item-name"><div>SSL Renewals</div></td>

		      <td class="description"><div>Yearly renewals of SSL certificates on main domain and several subdomains</div></td>

		      <td><div class="qty">3</div></td>
		      <td><span class="price">$225.00</span></td>
		  </tr>



		  <tr>
		      <td colspan="1" class="blank"> </td>
		      <td colspan="2" class="total-line">Subtotal</td>
		      <td class="total-value"><div id="subtotal">$875.00</div></td>
		  </tr>
		  <tr>

		      <td colspan="1" class="blank"> </td>
		      <td colspan="2" class="total-line">Total</td>
		      <td class="total-value"><div id="total">$875.00</div></td>
		  </tr>
		  <tr>
		      <td colspan="1" class="blank"> </td>
		      <td colspan="2" class="total-line">Amount Paid</td>

		      <td class="total-value"><div id="paid">$0.00</div></td>
		  </tr>
		  <tr>
		      <td colspan="1" class="blank"> </td>
		      <td colspan="2" class="total-line balance">Balance Due</td>
		      <td class="total-value balance"><div class="due">$875.00</div></td>
		  </tr>

		</table>
		<div id="terms">
		 <h5>In Memory of Delbert Jepson</h5>



	</div>

</body>

</html>
