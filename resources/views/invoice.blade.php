<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Invoice</title>
    <style type="text/css">
      .clearfix:after {
  content: "";
  display: table;
  clear: both;
}

a {
  color: #5D6975;
  text-decoration: underline;
}

body {
  position: relative;
  width: 21cm;
  height: 29.7cm;
  margin: 0 auto;
  color: #001028;
  background: #FFFFFF;
  font-family: Arial, sans-serif;
  font-size: 12px;
  font-family: Arial;
}

header {
  padding: 10px 0;
  margin-bottom: 30px;
}

#logo {
  text-align: center;
  margin-bottom: 10px;
}

#logo img {
  width: 120px;
  height: 120px;
}

h1 {
  border-top: 1px solid  #5D6975;
  border-bottom: 1px solid  #5D6975;
  color: #5D6975;
  font-size: 2.4em;
  line-height: 1.4em;
  font-weight: normal;
  text-align: center;
  margin: 0 20px 20px 0;
  background: url(dimension.png);
}

#project {
  float: left;
}

#project span {
  color: #5D6975;
  text-align: right;
  width: 52px;
  margin-right: 10px;
  display: inline-block;
  font-size: 0.8em;
}

#company {
  float: right;
  text-align: right;
}

#project div,
#company div {
  white-space: nowrap;
  margin-right: 50px;
}

table {
  width: 90%;
  border-collapse: collapse;
  border-spacing: 0;
  margin-bottom: 20px;
  margin-top: 25px;
}

table tr:nth-child(2n-1) td {
  background: #F5F5F5;
}

table th,
table td {
  text-align: center;
}

table th {
  padding: 5px 20px;
  color: #5D6975;
  border-bottom: 1px solid #C1CED9;
  white-space: nowrap;
  font-weight: normal;
}

table .service,
table .desc {
  text-align: left;
}

table td {
  padding: 20px;
  text-align: right;
}

table td.service,
table td.desc {
  vertical-align: top;
}

table td.unit,
table td.qty,
table td.total {
  font-size: 1.2em;
}

table td.grand {
  border-top: 1px solid #5D6975;;
}

#notices .notice {
  color: #5D6975;
  font-size: 1.2em;
}

footer {
  color: #5D6975;
  width: 100%;
  height: 30px;
  position: absolute;
  bottom: 0;
  border-top: 1px solid #C1CED9;
  padding: 8px 0;
  text-align: center;
}
    </style>
  </head>
  <body>
    <header class="clearfix">
      <div id="logo">


      </div>
      <h1>  STORE SDP - RECEIPT </h1>
      <div id="company" class="clearfix">
        <div>Ka</div>
        <div>Store SDP,<br /> Adamawa, Yola</div>
        </div>
      <div id="project">
        <div><span>CHARGES FOR</span> Purchase</div>
        <div><span>CUSTOMER </span> {{App\Customer::find($transaction->customer_id)->name}}</div>
        <div><span>DATE</span>{{ date('F d, Y', strtotime($transaction->created_at)) }}</div>

      </div>
    </header>
    <main>
      <table>
        <thead>
          <tr>
            <th class="service">PRODUCT</th>
            <th>QUANTITY</th>
            <th>PRICE</th>
            <th>TOTAL</th>
          </tr>
        </thead>
        <tbody>
          @foreach($sales as $sale)
                  <tr>
                    <td class="service">{{App\Product::find($sale->product_id)->name}}</td>
                    <td>{{$sale->quantity}}</td>
                    <?php $price = $sale->total / $sale->quantity ?>
                    <td>{{$price}}</td>
                    <td>{{$sale->total}}</td>
                  </tr>
                @endforeach

          <tr>
            <td colspan="3" class="grand total">TAX</td>
            <td class="grand total">N0.00</td>
          </tr>
          <tr>
            <td colspan="3" class="grand total">SERVICE CHARGE</td>
            <td class="grand total">N0.00</td>
          </tr>
          <tr>
            <td colspan="3" class="grand total">GRAND TOTAL</td>
            <td class="grand total">N{{number_format($transaction->total, 2)}}</td>
          </tr>
        </tbody>
      </table>

    </main>
    <footer>
      Invoice was created on a computer and is valid without the signature and seal.
    </footer>
  </body>
</html>
