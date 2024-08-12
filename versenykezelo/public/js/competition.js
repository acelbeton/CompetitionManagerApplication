document.addEventListener("DOMContentLoaded", function (){
    document.getElementById('add-language').addEventListener('click', function (){
       const languagesWrapper = document.getElementById('available_languages-wrapper');
       const languageInputGroup = document.createElement('div');
       languageInputGroup.classList.add('input-group', 'mb-2');
       languageInputGroup.innerHTML = `<input type="text" class="form-control" name="available_languages[]" required>
        <div class="input-group-append">
             <button class="btn btn-danger remove-language" type="button">&times;</button>
        </div>
       `;
       languagesWrapper.appendChild(languageInputGroup);
    });

    document.addEventListener('click', function(event){
        if (event.target && event.target.classList.contains('remove-language')) {
            event.target.closest('.input-group').remove();
        }
    });
});


function saveCompetition() {
    $('#competition-form').submit(function (event) {
       event.preventDefault();

       const formData = $(this).serialize();

       $.ajax({
          url: '/competitions',

          type: "POST",

          data: formData,

          success: function (response) {
              $('#message').html('<div class="alert alert-success">' + response.message + '</div>');
              $('#competition-form')[0].reset();
          },

          error: function(xhr) {
              let errorMessage = 'There was an error';

              if (xhr.responseJSON && xhr.responseJSON.message) {
                  errorMessage = xhr.responseJSON.message;
              }

              $('#message').html('<div class="alert alert-success">' + errorMessage + '</div>')
          }
       });
    });
}
