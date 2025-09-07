<script src="https://unpkg.com/@popperjs/core@2"></script>
<script src="https://unpkg.com/feather-icons@4.28.0/dist/feather.min.js"></script>
<script src="../../assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="../../assets/plugins/jquery/jquery-3.4.1.min.js"></script>
<script src="../../assets/plugins/perfectscroll/perfect-scrollbar.min.js"></script>
<script src="../../assets/plugins/pace/pace.min.js"></script>
<script src="../../assets/plugins/jquery.toast/jquery.toast.js"></script>
<script src="../../assets/plugins/sweetalert/sweetalert2@8"></script>
<script src="../../assets/js/main.min.js"></script>
<?php
foreach ($customJAVA as $java) {
    echo $java . "\n";
} ?>
<script>
    $('#01000001').dataTable({
  "paging": true,
  "lengthChange": false,
  "searching": true,
  "ordering": false,
  "info": false,
  "autoWidth": true,
  "responsive": true,
  "sDom": '<"refresh"i<"clear">>rt<"top"lf<"clear">>rt<"bottom"p<"clear">>',
  "language": {
      "emptyTable": "Gösterilecek veri bulunamadı.",
      "processing": "Veriler yükleniyor",
      "sDecimal": ".",
      "sInfo": "_TOTAL_ kayıttan _START_ - _END_ arasındaki kayıtlar gösteriliyor",
      "sInfoFiltered": "(_MAX_ kayıt içerisinden bulunan)",
      "sInfoPostFix": "",
      "sInfoThousands": ".",
      "sLengthMenu": "Sayfada _MENU_ kayıt göster",
      "sLoadingRecords": "Yükleniyor...",
      "sSearch": "Ara :&nbsp;",
      "sZeroRecords": "Eşleşen kayıt bulunamadı",
      "oPaginate": {
          "sFirst": "İlk",
          "sLast": "Son",
          "sNext": "Sonraki",
          "sPrevious": "Önceki"
      },
      "oAria": {
          "sSortAscending": ": artan sütun sıralamasını aktifleştir",
          "sSortDescending": ": azalan sütun sıralamasını aktifleştir"
      },
      "select": {
          "rows": {
              "_": "%d kayıt seçildi",
              "0": "",
              "1": "1 kayıt seçildi"
          }
      }
  }
});

</script>
</body>

</html>