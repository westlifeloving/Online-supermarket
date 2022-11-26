var currentProduct;

function productDetail(code){
  currentProduct = code;
  let xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (xhttp.readyState == 4 && xhttp.status == 200) {
	 	document.getElementById("product-inform").innerHTML = xhttp.responseText
    }
  };
  xhttp.open("GET", "productDetail.php?code=" + code, true);
  xhttp.send();
}