<!DOCTYPE html>
<html lang="en">
    <head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>Document</title>
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="index.css">
    </head>	
<body class="container">

<h2>PAY ETH THROUGH WALLET</h2>

<button onclick="connect()">Connect to Ethereum wallet...</button> <br/>
	<div class='conn-address'> <h6></h6> </div>
	<h6 class="addr" ></h6>
	<div class='alert alert-success conn-success' role='alert'>  </div>
	<hr/>
	
	<h4>PAY ETHER</h4>
	<div class="form-group row col-lg-12">
	<input class="col-lg-5 form-control" id="addr" type="text" placeholder="Address"/>
	<input class="col-lg-2 form-control" id="amt" type="text" placeholder="ETH to transfer"/>
	<button class="col-lg-1 btn btn-success" id="paySm" onClick="pay()">Pay</button></div> 
	<h6 class="txion"></h6>		
	<div class="alert alert-success success" role="alert"></div>
	
	<script type="text/javascript">
	$(document).ready(function(){
		$(".conn-success").hide(); $(".success").hide(); 
		const web3 = new Web3(window.ethereum);
	});
	
	async function connect(){
		const web3 = new Web3(window.ethereum);
		window.ethereum.enable();
		const account = await ethereum.request({ method: 'eth_accounts' });
		// console.log('FROM ADDRESS: '+account);
		$(".addr").text("Wallet Address : "+account);
		$(".conn-success").text("Successfully connected to wallet.");
		$(".conn-success").show(); 
	}
	
	async function pay() {
	window.ethereum.enable();
	const accounts = await ethereum.request({ method: 'eth_accounts' });
	
	var to_address = $("#addr").val();
	var amt = $("#amt").val();
	console.log("to_address: ",to_address)
	console.log("amt: ",amt)
	var wei = amt*1e18;
	console.log("wei: ",wei)
	var weiStr = '0x'+ wei;
	console.log("weiStr: ",weiStr)
	
	try {
	  const transactionHash = await ethereum.request({
		method: 'eth_sendTransaction',
		params: [
		  {
			to: to_address,
			from: accounts[0],			
			value: weiStr,
			gas : '0x76c0',
			gasPrice : '0x9184e72a000'
		  },
		],
	  });
	  
	  $(".txion").text("Transaction Id : "+transactionHash);
	  $(".success").text("Successfully transferred "+amt+" ETH to " +to_address+" address.");
	  $(".success").show();
	} catch (error) {
	  console.log('ERROR OCCURED...... ');
	  console.error(error);
	}
	}
	</script>
</body>
</html>