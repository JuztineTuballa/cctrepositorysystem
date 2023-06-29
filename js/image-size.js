//CHECK IF IMAGE IS 2X2 OR 600X600PX 
 
  function checkImageDimensions() {
  var fileInput = document.getElementById('customFile');
  var file = fileInput.files[0];
  var reader = new FileReader();
  
  reader.onloadend = function() {
    var tempImg = new Image();
    tempImg.src = reader.result;
    tempImg.onload = function() {
      if (tempImg.width == 600 && tempImg.height == 600) {
        // Valid image dimensions, do something
      } else {
        alert('Invalid picture size! Picture must be 600x600 pixels.\nOr equivalent to 2x2 inches.');
        // Reset the file input
        fileInput.value = '';
      }
    };
  };
  
  if (file) {
    reader.readAsDataURL(file);
  }
}
 
//END - CHECK IF IMAGE IS 2X2 OR 600X600PX  
