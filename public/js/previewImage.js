function previewImage(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    
    reader.onload = function(e) {
      $('#image_preview').attr('src', e.target.result);
    }
    
    reader.readAsDataURL(input.files[0]);
  }
};

$("input[type=file]").change(
	function (e){
		$(this).next('.custom-file-label').text(e.target.files[0].name);

  	previewImage(this);    			
	}
);