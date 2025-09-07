import devtools from './devtools-detect-main/index.js';

if (devtools.isOpen == true) {
    window.location = '../404.html';
}

console.clear();

document.addEventListener('keydown', event => { 
  if (event.ctrlKey && event.key === 'u') {
    event.preventDefault();
    toastr.error("Invalid CSRF token");
  } if (event.ctrlKey && event.key === 's') {
    event.preventDefault();
    toastr.error("Invalid CSRF token");
  } if (event.key === 'F12') {
    event.preventDefault();
    toastr.error("Invalid CSRF token");
  }
});

function clearAll() {
  $("#jojjoojj").html('<tr class="odd"><td valign="top" colspan="11" class="dataTables_empty">Gösterilecek veri bulunamadı.</td></tr>');
  return false;
}

function copyTable() {
  $.Toast.showToast({
      "title": "Kopyalandı",
      "icon": "success",
      "duration": 1000
  });
}

var copyBtn = document.querySelector('#copy_btn');

copyBtn.addEventListener('click', function () {
  var urlField = document.querySelector('table');
  var range = document.createRange();
  range.selectNode(urlField);
  window.getSelection().addRange(range);
  document.execCommand('copy');
}, false);

function checkNumber() {
  $.Toast.showToast({
      "title": "Sorgulanıyor...",
      "icon": "loading",
      "duration": 60000
  });
}

