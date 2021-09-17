$(document).ready(function () {
	view_cart('view_cart_mini','mini');	
		
});		

function view_cart(src,view,order_id){
	$('#'+src).html('loading...');	
	switch(view){
		case "all":
			$.post('includes/view_cart.php',{},function(view_cart){
			$('#'+src).html(view_cart);	
			});
		break;

		case "checkout":
			$.post('includes/view_cart.php',{page : 'checkout2'},function(view_cart){
			$('#'+src).html(view_cart);	
			});
		break;

		case "review":
			$.post('includes/view_cart_review.php',{},function(view_cart){
			$('#'+src).html(view_cart);	
			});
		break;
		case "detail":
			$.post('includes/view_cart_detail.php',{order_id :order_id},function(view_cart){
			$('#'+src).html(view_cart);	
			});
		break;
		case "mini":
			$.post('includes/view_cart_mini.php',{},function(view_cart_mini){
			$('#'+src).html(view_cart_mini);	
			});
		break;
	}
}

function add_to_cart(src,view,product_id,add_num,auto,todo,dc_code){ 

	$.post('includes/add_to_cart.php',{ product_id : product_id , add_num : add_num , todo : todo , dc_code : dc_code},function(res_cart){
		
	view_cart('view_cart_mini','mini');
	
	if(view == "all"){ 
		view_cart('view_cart','all');
	}
	window.location = "cart.html";
	});	
}

/*
function add_effect(product_id){
	var div=$(".product_ani_"+product_id);
		div.show();	    
		//div.animate({left:"+=600px",opacity:'0.5'},"slow");
		div.animate({top:"-=600px",opacity:'0'},1000);
		
		//div.fadeOut();	
		div.hide();
		//div.animate({top:"+=600px",opacity:'0'},"fast");
		div.animate({top:"+=600px",opacity:'0'},"fast");
		div.show();
		div.animate({opacity:'1'},"fast");
		
	//	$('#header_cart').hide();
	//	$('#header_cart').slideUp(300).delay(800).fadeIn(400);
		
}

//// Cart
function add_to_cart(product_id,add_num,auto,todo){ 
	if(auto ==1){ add_effect(product_id); }
	$.post('includes/add_to_cart.php',{ product_id : product_id , add_num : add_num , todo : todo},function(res_email){
	$('#header_cart').html(res_email);	

	//auto_next(auto);
	});	
}

function cart(product_id,add_num,auto,todo){ 
	if(auto ==1){ add_effect(product_id); }
	$.post('includes/cart.php',{ product_id : product_id , add_num : add_num , todo : todo},function(res_email){
	$('#header_cart').html(res_email);	

	//auto_next(auto);
	});	
}

function auto_next(val){
	//alert(val)
	if(val == 1){
		setTimeout(function() { window.location = "order"; }, 1500);
	}
}

function order_list(){ 
	$.post('includes/order.php',{ },function(order_list){
	$('#order_list').html(order_list);	
	});	
}

function cart_update(product_id,todo,order_num){ 
	$.post('includes/order.php',{ product_id : product_id ,todo : todo, order_num : order_num},function(order_list){
	$('#order_list').html(order_list);	
	
	cart('','');
	
	});	
}

 
*/