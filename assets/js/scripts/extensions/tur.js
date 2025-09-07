/*=========================================================================================
	File Name: tour.js
	Description: tour
	----------------------------------------------------------------------------------------
	Item Name: Vuexy  - Vuejs, HTML & Laravel Admin Dashboard Template
	Author: Pixinvent
	Author URL: hhttp://www.themeforest.net/user/pixinvent
==========================================================================================*/

$(function () {
  'use strict';

  var startBtn = $('#tour');
  function setupTour(tour) {
    var backBtnClass = 'btn btn-sm btn-outline-primary',
      nextBtnClass = 'btn btn-sm btn-primary btn-next';
    tour.addStep({
      title: 'Gezinme Çubuğu',
      text: 'Bu sizin gezinme çubuğunuz',
      attachTo: { element: '.navbar', on: 'bottom' },
      buttons: [
        {
          action: tour.cancel,
          classes: backBtnClass,
          text: 'Atla'
        },
        {
          text: 'İleri',
          classes: nextBtnClass,
          action: tour.next
        }
      ]
    });
	tour.addStep({
      title: 'Site Şampiyonu',
      text: 'Bu bir şampiyon.',
      attachTo: { element: '#basic-tebrik .tebrik', on: 'bottom' },
      buttons: [
        {
          text: 'Atla',
          classes: backBtnClass,
          action: tour.cancel
        },
        {
          text: 'Geri',
          classes: backBtnClass,
          action: tour.back
        },
        {
          text: 'İleri',
          classes: nextBtnClass,
          action: tour.next
        }
      ]
    });
		tour.addStep({
      title: 'Hesap İstatistikleri',
      text: 'Bu senin ve sitenin istatistikleri.',
      attachTo: { element: '#basic-istatistik .istatistik', on: 'bottom' },
      buttons: [
        {
          text: 'Atla',
          classes: backBtnClass,
          action: tour.cancel
        },
        {
          text: 'Geri',
          classes: backBtnClass,
          action: tour.back
        },
        {
          text: 'İleri',
          classes: nextBtnClass,
          action: tour.next
        }
      ]
    });
	tour.addStep({
      title: 'Site Duyuruları',
      text: 'Burada sitenin duyurularını okursun.',
      attachTo: { element: '#basic-duyuru .duyuru', on: 'bottom' },
      buttons: [
        {
          text: 'Atla',
          classes: backBtnClass,
          action: tour.cancel
        },
        {
          text: 'Geri',
          classes: backBtnClass,
          action: tour.back
        },
        {
          text: 'İleri',
          classes: nextBtnClass,
          action: tour.next
        }
      ]
    });
    tour.addStep({
      title: 'Button',
      text: 'Bu bir button',
      attachTo: { element: '#basic-tour .card', on: 'top' },
      buttons: [
        {
          text: 'Atla',
          classes: backBtnClass,
          action: tour.cancel
        },
        {
          text: 'Geri',
          classes: backBtnClass,
          action: tour.back
        },
        {
          text: 'İleri',
          classes: nextBtnClass,
          action: tour.next
        }
      ]
    });
    tour.addStep({
      title: 'Alt Çubuk',
      text: 'Bu sitenin alt çubuğu',
      attachTo: { element: '.footer', on: 'top' },
      buttons: [
        {
          text: 'Geri',
          classes: backBtnClass,
          action: tour.back
        },
        {
          text: 'SON',
          classes: nextBtnClass,
          action: tour.cancel
        }
      ]
    });

    return tour;
  }

  if (startBtn.length) {
    startBtn.on('click', function () {
      var tourVar = new Shepherd.Tour({
        defaultStepOptions: {
          classes: 'shadow-md bg-purple-dark',
          scrollTo: false,
          cancelIcon: {
            enabled: true
          }
        },
        useModalOverlay: true
      });

      setupTour(tourVar).start();
    });
  }
});
