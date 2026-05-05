    <script src="{{asset('admin/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/bootstrap.bundle.min.js')}}"></script>

    <script src="{{asset('admin/assets/vendors/apexcharts/apexcharts.js')}}"></script>
    <script src="{{asset('admin/assets/js/pages/dashboard.js')}}"></script>

    <script src="{{asset('admin/assets/js/main.js')}}"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
function copyText(value) {
    navigator.clipboard.writeText(value);
    alert("Copied: " + value);
}

 $(document).on('click', '.editblogs', function () {
    var id = $(this).data('id');
   
    if(id){
      $.ajax({
					type: "POST",
                    url: "{{route('blogfetch')}}",
					data: {  "_token": "{{ csrf_token() }}",
					id: id },
					success: function (res) {
					console.log(res);
          var obj=JSON.parse(res)
		 
          $('#image').val(obj.image);
		  $('#appid').val(id); 
          $('#heading').val(obj.heading);
          $('#desc').val(obj.description);
					},
					});	
		}
   
		$('#editapp_model').modal('show');
	});


     $(document).on('click', '.editbooks', function () {
    var id = $(this).data('id');
   
    if(id){
      $.ajax({
					type: "POST",
                    url: "{{route('bookfetch')}}",
					data: {  "_token": "{{ csrf_token() }}",
					id: id },
					success: function (res) {
					console.log(res);
          var obj=JSON.parse(res)
		  $('#appid').val(id); 
          $('#cover').val(obj.book_image); 
          $('#heading').val(obj.title);
          $('#desc').val(obj.desc);
           $('#price').val(obj.price);
            $('#link').val(obj.link);
					},
					});	
		}
   
		$('#editapp_model').modal('show');
	});


    $(document).on('click', '.editorders', function () {
    var id = $(this).data('id');
   
    if(id){
   $.ajax({
    type: "POST",
    url: "{{ route('orderfetch') }}",
    data: {
        _token: "{{ csrf_token() }}",
        id: id
    },
    success: function (res) {

        console.log(res);
  var obj=JSON.parse(res)
        // Build address from AJAX response
        var address =
            obj.line1 + ', ' +
            obj.line2 + ', ' +
            obj.city + ', ' +
            obj.state + ', ' +
            obj.pincode;

        $('#appid').val(id);
        $('#address').val(address);
        $('#status').val(obj.status);
        $('#deliverynote').val(obj.deliverynote);
    }
});

		}
   
		$('#editapp_model').modal('show');
	});

$(document).on('click', '.delete-blog', function () {
    var id = $(this).data('id');
   
    if(id){
     
        
		  $('#appid').val(id); 
          let url = "{{ url('deleteblog') }}/" + id;
            $('#delete').attr('href', url);
				
					
		}
       
		$('#deleteModal').modal('show');
	});

$(document).on('click', '.deletebooks', function () {
    var id = $(this).data('id');
   
    if(id){
     
        
		  $('#appid').val(id); 
          let url = "{{ url('deletebooks/" + id;
            $('#delete').attr('href', url);
				
					
		}
       
		$('#deleteModal').modal('show');
	});
    

    

    
    
</script>