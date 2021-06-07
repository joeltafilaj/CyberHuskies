$(document).ready(function () {
    
    // Client Side validation
    $("#uploadForm").submit(function (e) {
      e.preventDefault();
      var name = $("#name_input").val();
      var desc_input = $("#desc_input").val();
      var photo_input_1 = $("#photo_input_1").val();
     
      var validated = true;
  
      if (name === '') {
          $('#name_input').addClass('is-invalid');
          $('.alert-danger').removeClass('d-none');
          $('#response').text('Complete All required fields!');
          validated = false;
      } else {
          $('#response').text('');
          $('#name_input').removeClass('is-invalid');
      }
  
      if (desc_input === '') {
          $('#desc_input').addClass('is-invalid');
          $('.alert-danger').removeClass('d-none');
          $('#response').text('Complete All required fields!');
          validated = false;
      } else {
          $('#desc_input').removeClass('is-invalid');
      }

      // If form validated prooceed
      if (validated) {
          $('.alert-danger').addClass('d-none');
          $('#response').text('');
          this.submit();
      }
    });
  });
  