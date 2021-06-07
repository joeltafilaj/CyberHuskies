$(document).ready(function () {
    
  // Client Side validation
  $("#uploadForm").submit(function (e) {
    e.preventDefault();
    var name = $("#name_input").val();
    var starting_price = $("#str_price_input").val();
    var avl_from_input = $("#avl_from_input").val();
    var avl_unt_input = $("#avl_unt_input").val();
    var selected_option = $("#cat_input option:selected").val();
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

    if (starting_price == '') {
        $('#str_price_input').addClass('is-invalid');
        $('.alert-danger').removeClass('d-none');

        $('#response').text('Complete All required fields!');
        validated = false;
    } else {
        $('#str_price_input').removeClass('is-invalid');
    }

    if (desc_input === '') {
        $('#desc_input').addClass('is-invalid');
        $('.alert-danger').removeClass('d-none');
        $('#response').text('Complete All required fields!');
        validated = false;
    } else {
        $('#desc_input').removeClass('is-invalid');
    }

    if (avl_from_input === '') {
        $('#avl_from_input').addClass('is-invalid');
        $('.alert-danger').removeClass('d-none');
        $('#response').text('Complete All required fields!');
        validated = false;
    } else {
        $('#avl_from_input').removeClass('is-invalid');
    }

    if (avl_unt_input === '') {
        $('#avl_unt_input').addClass('is-invalid');
        $('.alert-danger').removeClass('d-none');
        $('#response').text('Complete All required fields!');
        validated = false;
    } else {
        $('#avl_unt_input').removeClass('is-invalid');
    }
    if (selected_option == '0') {
        $('#cat_input').addClass('is-invalid');
        $('.alert-danger').removeClass('d-none');
        $('#response').text('Complete All required fields!');
        validated = false;
    } else {
        $('#cat_input').removeClass('is-invalid');
    }

    if (photo_input_1 == "") {
        $('#photo_input_1').addClass('is-invalid');
        $('.alert-danger').removeClass('d-none');
        $('#response').text('Complete All required fields!');
        validated = false;
    } else {
        $('#photo_input_1').removeClass('is-invalid');
    }
    

    // If form validated prooceed
    if (validated) {
        $('.alert-danger').addClass('d-none');
        $('#response').text('');
        this.submit();
    }


  });
});

function addPhoto() {
  var i =
    parseInt($(".add-photo-input :last-child").attr("id").substring(12)) + 1;
  var file_input = document.createElement("input");
  file_input.setAttribute("type", "file");
  file_input.setAttribute("name", "photo_input_" + i);
  file_input.setAttribute("id", "photo_input_" + i);
  file_input.setAttribute("class", "form-control mb-2");
  document.getElementsByClassName("add-photo-input")[0].append(file_input);
}
