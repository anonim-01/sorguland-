/*=========================================================================================
	File Name: ext-component-sweet-alerts.js
	Description: A beautiful replacement for javascript alerts
	----------------------------------------------------------------------------------------
	Item Name: Vuexy  - Vuejs, HTML & Laravel Admin Dashboard Template
	Author: Pixinvent
	Author URL: hhttp://www.themeforest.net/user/pixinvent
==========================================================================================*/
$(function () {
  'use strict';

  var success = $('#type-error1');
  var error = $('#type-error2');
  var warning = $('#type-error3');
  var sa = $('#type-error4');
  var as = $('#type-error5');
  var ss = $('#type-error6');

  var customImage = $('#custom-image');
  var autoClose = $('#auto-close');
  var outsideClick = $('#outside-click');
  var question = $('#prompt-function');
  var ajax = $('#ajax-request');

  var confirmText = $('#confirm-text');
  var confirmColor = $('#confirm-color');

  var assetPath = '../../../app-assets/';
  if ($('body').attr('data-framework') === 'laravel') {
    assetPath = $('body').attr('data-asset-path');
  }

  //--------------- Basic Examples ---------------

  // Basic
  //--------------- Types ---------------

  // Success
  if (error.length) {
    success.on('click', function () {
      Swal.fire({
        title: 'Hata!',
        text: ' Görev Tamamlanmadı!',
        icon: 'error',
        customClass: {
          confirmButton: 'btn btn-primary'
        },
        buttonsStyling: false
      });
    });
  }

  // Error
  if (error.length) {
    error.on('click', function () {
      Swal.fire({
        title: 'Hata!',
        text: ' Görev Tamamlanmadı!',
        icon: 'error',
        customClass: {
          confirmButton: 'btn btn-primary'
        },
        buttonsStyling: false
      });
    });
  }

  // Warning
  if (error.length) {
    warning.on('click', function () {
      Swal.fire({
        title: 'Hata!',
        text: ' Görev Tamamlanmadı!',
        icon: 'error',
        customClass: {
          confirmButton: 'btn btn-primary'
        },
        buttonsStyling: false
      });
    });
  }

  // Info
  if (error.length) {
    sa.on('click', function () {
      Swal.fire({
        title: 'Hata!',
        text: ' Yetersiz Bakiye!',
        icon: 'error',
        customClass: {
          confirmButton: 'btn btn-primary'
        },
        buttonsStyling: false
      });
    });
  }
  
    if (error.length) {
    as.on('click', function () {
      Swal.fire({
        title: 'Hata!',
        text: ' Yetersiz Bakiye!',
        icon: 'error',
        customClass: {
          confirmButton: 'btn btn-primary'
        },
        buttonsStyling: false
      });
    });
  }
  
    if (error.length) {
    ss.on('click', function () {
      Swal.fire({
        title: 'Hata!',
        text: ' Yetersiz Bakiye!',
        icon: 'error',
        customClass: {
          confirmButton: 'btn btn-primary'
        },
        buttonsStyling: false
      });
    });
  }

  //--------------- Options ---------------

  // Custom Image
  if (customImage.length) {
    customImage.on('click', function () {
      Swal.fire({
        title: 'Sweet!',
        text: 'Modal with a custom image.',
        imageUrl: assetPath + 'images/slider/04.jpg',
        imageWidth: 400,
        imageHeight: 200,
        imageAlt: 'Custom image',
        customClass: {
          confirmButton: 'btn btn-primary'
        },
        buttonsStyling: false
      });
    });
  }

  // Auto Close
  if (autoClose.length) {
    autoClose.on('click', function () {
      var timerInterval;
      Swal.fire({
        title: 'Auto close alert!',
        html: 'I will close in <b></b> milliseconds.',
        timer: 2000,
        timerProgressBar: true,
        didOpen: () => {
          Swal.showLoading();
          timerInterval = setInterval(() => {
            const content = Swal.getHtmlContainer();
            if (content) {
              const b = content.querySelector('b');
              if (b) {
                b.textContent = Swal.getTimerLeft();
              }
            }
          }, 100);
        },
        willClose: () => {
          clearInterval(timerInterval);
        }
      }).then(result => {
        /* Read more about handling dismissals below */
        if (result.dismiss === Swal.DismissReason.timer) {
          console.log('I was closed by the timer');
        }
      });
    });
  }

  // Click Outside
  if (outsideClick.length) {
    outsideClick.on('click', function () {
      Swal.fire({
        title: 'Click outside to close!',
        text: 'This is a cool message!',
        customClass: {
          confirmButton: 'btn btn-primary'
        },
        buttonsStyling: false
      });
    });
  }

  // Question
  if (question.length) {
    question.on('click', function () {
      /* global Swal */

      const steps = ['1', '2', '3'];
      const swalQueueStep = Swal.mixin({
        confirmButtonText: 'Forward',
        cancelButtonText: 'Back',
        progressSteps: steps,
        input: 'text',
        inputAttributes: {
          required: true
        },
        validationMessage: 'This field is required'
      });

      async function backAndForth() {
        const values = [];
        let currentStep;

        for (currentStep = 0; currentStep < steps.length; ) {
          const result = await new swalQueueStep({
            title: 'Question ' + steps[currentStep],
            showCancelButton: currentStep > 0,
            currentProgressStep: currentStep
          });

          if (result.value) {
            values[currentStep] = result.value;
            currentStep++;
          } else if (result.dismiss === 'cancel') {
            currentStep--;
          }
        }

        Swal.fire(JSON.stringify(values));
      }

      backAndForth();
    });
  }

  // Ajax
  if (ajax.length) {
    ajax.on('click', function () {
      Swal.fire({
        title: 'Search for a GitHub user',
        input: 'text',
        customClass: {
          confirmButton: 'btn btn-primary',
          cancelButton: 'btn btn-outline-danger ms-1'
        },
        buttonsStyling: false,
        inputAttributes: {
          autocapitalize: 'off'
        },
        showCancelButton: true,
        confirmButtonText: 'Look up',
        showLoaderOnConfirm: true,
        preConfirm: login => {
          return fetch(`//api.github.com/users/${login}`)
            .then(response => {
              if (!response.ok) {
                throw new Error(response.statusText);
              }
              return response.json();
            })
            .catch(error => {
              Swal.showValidationMessage(`Request failed: ${error}`);
            });
        }
      }).then(result => {
        if (result.isConfirmed) {
          Swal.fire({
            title: '' + result.value.login + "'s avatar",
            imageUrl: result.value.avatar_url,
            customClass: { confirmButton: 'btn btn-primary' }
          });
        }
      });
    });
  }

  //--------------- Confirm Options ---------------

  // Confirm Text
  if (confirmText.length) {
    confirmText.on('click', function () {
      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        customClass: {
          confirmButton: 'btn btn-primary',
          cancelButton: 'btn btn-outline-danger ms-1'
        },
        buttonsStyling: false
      }).then(function (result) {
        if (result.value) {
          Swal.fire({
            icon: 'success',
            title: 'Deleted!',
            text: 'Your file has been deleted.',
            customClass: {
              confirmButton: 'btn btn-success'
            }
          });
        }
      });
    });
  }

  // Confirm Color
  if (confirmColor.length) {
    confirmColor.on('click', function () {
      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        customClass: {
          confirmButton: 'btn btn-primary',
          cancelButton: 'btn btn-outline-danger ms-1'
        },
        buttonsStyling: false
      }).then(function (result) {
        if (result.value) {
          Swal.fire({
            icon: 'success',
            title: 'Deleted!',
            text: 'Your file has been deleted.',
            customClass: {
              confirmButton: 'btn btn-success'
            }
          });
        } else if (result.dismiss === Swal.DismissReason.cancel) {
          Swal.fire({
            title: 'Cancelled',
            text: 'Your imaginary file is safe :)',
            icon: 'error',
            customClass: {
              confirmButton: 'btn btn-success'
            }
          });
        }
      });
    });
  }
});
