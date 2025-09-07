/*=========================================================================================
    File Name: pricing.js
    Description: pricing page js
    ----------------------------------------------------------------------------------------
    Item Name: Vuexy  - Vuejs, HTML & Laravel Admin Dashboard Template
    Author: PIXINVENT
    Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/

$(function () {
  'use strict';

  // variables
  var priceSwitch = $('#priceSwitch'),
    priceStandardValue = $('.pricing-standard-value'),
    priceEnterpriseValue = $('.pricing-enterprise-value'),
    enterpriseAnnualPricing = $('.enterprise-pricing .annual-pricing'),
    standardAnnualPricing = $('.standard-pricing .annual-pricing'),
    standardAnnualPlan = 375,
    standardMonthlyPlan = 150,
    enterpriseAnnualPlan = 500,
    enterpriseMonthlyPlan = 200;

  // price and duration change on switch button toggle
  priceSwitch.on('change', function () {
    if ($(this).is(':checked')) {
      // for enterprise plan
      var enterpriseMonthValue = enterpriseAnnualPlan / 2.5;
      priceEnterpriseValue.html(enterpriseMonthValue);
      enterpriseAnnualPricing.removeClass('d-none').html('TL ' + enterpriseAnnualPlan + ' / yıllık');

      // for standard plan
      var standardMonthValue = standardAnnualPlan / 2.5;
      priceStandardValue.html(standardMonthValue);
      standardAnnualPricing.removeClass('d-none').html('TL ' + standardAnnualPlan + ' / yıllık');
    } else {
      // for enterprise plan
      priceEnterpriseValue.html(enterpriseMonthlyPlan);
      enterpriseAnnualPricing.addClass('d-none');

      // for standard plan
      priceStandardValue.html(standardMonthlyPlan);
      standardAnnualPricing.addClass('d-none');
    }
  });
});
