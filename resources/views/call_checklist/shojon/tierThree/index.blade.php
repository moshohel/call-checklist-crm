<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>insert question data</title>
</head>
<body>
  <form action="POST" method="POST">
  	@csrf
  	<table>
  		<thead>
  			<tr>
  				<th></th>

  				<th>product</th>
  				<th>price</th>
  				<th>quantity</th>
  			</tr>
  		</thead>
  		<tbody>
  			<tr>
  				<td>
  			<input type="checkbox" name="prodid[]"class="prod-id" value="mobile">
  			</td>
  			<td>
  				Mobile
  				<input type="hidden" name="prod_name[]" class="prod-name" value="mobile">
  			</td>
  			<td>
  				
  				<input type="number" name="prod_price[]" class="prod-price" >
  			</td>
  			<td>
  				
  				<input type="number" name="prod_Qty[]" class="prod-qty">
  			</td>
  			</tr>
  			<tr>
  				<td>
  			<input type="checkbox" name="prodid[]"class="prod-id" value="mobile">
  			</td>
  			<td>
  				Games
  				<input type="hidden" name="prod_name[]" class="prod-name" value="Game">
  			</td>
  			<td>
  				
  				<input type="number" name="prod_price[]" class="prod-price" >
  			</td>
  			<td>
  				
  				<input type="number" name="prod_Qty[]" class="prod-qty">
  			</td>
  			</tr>
  			<tr>
  				<td>
  			<input type="checkbox" name="prodid[]"class="prod-id" value="mobile">
  			</td>
  			<td>
  				LCD
  				<input type="hidden" name="prod_name[]" class="prod-name" value="LCD">
  			</td>
  			<td>
  				
  				<input type="number" name="prod_price[]" class="prod-price" >
  			</td>
  			<td>
  				
  				<input type="number" name="prod_Qty[]" class="prod-qty">
  			</td>
  			</tr>
  		</tbody>
  		
  	</table>
  	<div>
  			<input type="submit" value="Submit" class="btn btn-primary save_btn">
  		</div>
  </form>
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->
  <script src="{{ asset('backend/js/jquery-3.2.1.min.js') }}"></script>
  <script type="text/javascript">
  	$(document).ready(function(){
        $('.save_btn').on('click',function(e){
        	e.preventDefault();

        	 const prodid = [];
        	 const prod_name = [];
        	 const prod_price = [];
        	 const prod_Qty = [];

        	$('.prod-id').each(function(){
        		if($(this).is(":checked")){
        			prodid.push($(this).val());
        		}
          });
        	$('input[name^="prod_name"]').each(function(){
        		prod_name.push($(this).val());

        	});
        	$('input[name^="prod_price"]').each(function(){
        		prod_price.push($(this).val());

        	});
        	$('input[name^="prod_Qty"]').each(function(){
        		prod_Qty.push($(this).val());

        	});
        	$.ajax({
                url: '{{ route('call_checklist.shojon.save_data') }}',
                type:'POST',
                data:{
                	"_token":"{{csrf_token()}}",
                	prodid : prodid,
                	prod_name : prod_name,
                	prod_price : prod_price,
                	prod_Qty : prod_Qty
                },
                success:function(response){
                	

                }
        	});

        });
  	});
  </script>
</body>
</html>