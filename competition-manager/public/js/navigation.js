$(document).ready(function() {
    function initializeAll() {
        initializeCompetitionForm();
        reinitializeEventListeners();
        saveCompetition();
    }

    function initializeCompetitionForm() {
        const addLanguageButton = document.getElementById('add-language');
        if (addLanguageButton) {
            addLanguageButton.addEventListener('click', function () {
                const languagesWrapper = document.getElementById('available_languages-wrapper');
                const languageInputGroup = document.createElement('div');
                languageInputGroup.classList.add('input-group', 'mb-2');
                languageInputGroup.innerHTML = `
                    <input type="text" class="form-control" name="available_languages[]" required>
                    <div class="input-group-append">
                        <button class="btn btn-danger remove-language" type="button">&times;</button>
                    </div>
                `;
                languagesWrapper.appendChild(languageInputGroup);
            });
        }

        $(document).on('click', '.remove-language', function () {
            $(this).closest('.input-group').remove();
        });
    }

    function reinitializeEventListeners() {
        handleFormSubmission('#addRoundForm', '#addRoundModal', '#roundsList');
        handleDeletion('.delete-round', '/rounds/destroy', '#roundsList', '');

        handleFormSubmission('#addCompetitorForm', '#addCompetitorModal', '#competitorsList');
        handleDeletion('.delete-competitor', '/competitors/destroy', '#competitorsList', '#usersDropdownContainer');

        console.log("Event listeners reinitialized");
    }

    function handleFormSubmission(formId, modalId, listId) {
        $(formId).off('submit');

        $(formId).on('submit', function(event) {
            event.preventDefault();

            const $form = $(this);

            $.ajax({
                url: $form.attr('action'),
                method: 'POST',
                data: $form.serialize(),
                success: function(response) {
                    if (response.html) {
                        $(listId).html(response.html);
                        $(modalId).modal('hide');
                        $form[0].reset();
                        $('#message').empty();
                        reinitializeEventListeners();
                    }
                    if (response.usersDropdown) {
                        $('#usersDropdownContainer').html(response.usersDropdown);
                    }
                },
                error: function(xhr) {
                    let errorMessage = 'There was an error';
                    if (xhr.responseJSON && xhr.responseJSON.error) {
                        errorMessage = xhr.responseJSON.error;
                    }
                    $('#message').html('<div class="alert alert-danger">' + errorMessage + '</div>')
                }
            });
        });
    }


    function handleDeletion(buttonClass, deleteUrl, listId, dropdownContainerId) {
        $(document).off('click', buttonClass);

        $(document).on('click', buttonClass, function() {
            let $button = $(this);
            let itemId = $button.data('id');

            $button.prop('disabled', true);

            $.ajax({
                url: deleteUrl,
                method: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    id: itemId
                },
                success: function(response) {
                    if (response.html) {
                        $(listId).html(response.html);
                        reinitializeEventListeners();
                    }
                    if (response.usersDropdown) {
                        $(dropdownContainerId).html(response.usersDropdown);
                    }
                },
                error: function(xhr) {
                    let errors = xhr.responseJSON.errors;
                    let errorString = '';
                    $.each(errors, function(key, value) {
                        errorString += value[0] + '\n';
                    });
                    alert(errorString);
                }
            });
        });
    }


    function saveCompetition() {
        $('#competition-form').submit(function (event) {
            event.preventDefault();

            const formData = $(this).serialize();

            $.ajax({
                url: '/competitions-store',
                type: "POST",
                data: formData,
                success: function (response) {
                    $('#message').html('<div class="alert alert-success">' + response.message + '</div>');
                    $('#competition-form')[0].reset();
                },
                error: function(xhr) {
                    let errorMessage = 'There was an error';

                    if (xhr.status === 409) {
                        errorMessage = xhr.responseJSON.errors.competition;
                    } else if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    }

                    $('#message').html('<div class="alert alert-danger">' + errorMessage + '</div>')
                }
            });
        });
    }

    function loadContent(url, pushState = true) {
        $.ajax({
            url: url,
            method: 'GET',
            dataType: 'html',
            success: function(response) {
                let newContent = $('<div>').append($.parseHTML(response)).find('#main-content').html();
                if (newContent) {
                    $('#main-content').html(newContent);
                    if (pushState) {
                        window.history.pushState({ path: url }, '', url);
                    }
                    initializeAll();
                } else {
                    console.error('HTML content not found in the response');
                }
            },
            error: function(xhr) {
                console.log('Error occurred:', xhr);
                alert('An error occurred while loading the page.');
            }
        });
    }

    function handleEvent(event) {
        event.preventDefault();
        const $element = $(this);
        const url = $element.is('a.ajax-link') ? $element.attr('href') : $element.attr('action');
        console.log('Navigating to:', url);
        loadContent(url);
    }

    $('body').on('click', 'a.ajax-link', handleEvent)
        .on('submit', 'form.ajax-form', handleEvent);

    window.onpopstate = function(event) {
        if (event.state && event.state.path) {
            loadContent(event.state.path, false);
        }
    };

    initializeAll();
});
