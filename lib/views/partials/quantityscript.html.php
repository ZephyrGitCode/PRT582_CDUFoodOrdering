<script src='jquery-3.2.1.min.js'></script>
<script type="text/javascript">
function increaseValue() {
  var value = parseInt(document.getElementById('quantity').value, 10);
  value = isNaN(value) ? 0 : value;
  value++;
  document.getElementById('quantity').value = value;
  price = 'AUD $'+`<span>${(p * value).toFixed(2)}</span>`;
  document.getElementById('price').innerHTML=price;
}

function decreaseValue() {
  var value = parseInt(document.getElementById('quantity').value, 10);
  value = isNaN(value) ? 0 : value;
  value < 1 ? value = 1 : '';
  value--;
  if (value <= 0){
                value = 1;
            }
  document.getElementById('quantity').value = value;
  price = 'AUD $'+`<span>${(p * value).toFixed(2)}</span>`;
  document.getElementById('price').innerHTML=price;
}
var p= <?php echo "{$price}";?>;
var price = 'AUD $ '+`<span>${p}</span>`;
document.getElementById('price').innerHTML=price;
</script>